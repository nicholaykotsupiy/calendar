<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\StoreRequest;
use App\Http\Resources\Event\EventResource;
use App\Mail\ConfirmMail;
use App\Models\Event;
use App\Models\Guest;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $eventData = $request->event;
        $user = User::where('access_token', $request->token)->first();

        if(! $user)
        {
            return response()->json('Bad request');
        }
        $event = new Event();

        $event->name = $eventData['name'];
        $event->location = $eventData['location'];
        $event->description = $eventData['description'];
        $event->date_start = $eventData['dateStart'];
        $event->date_end = $eventData['dateEnd'];
        $event->time_start = $eventData['timeStart'];
        $event->time_end = $eventData['timeEnd'];
        $event->bg_color = '#FAFAFA';
        $event->main_color = '#808080';
        $event->user_id = $user->id;

        $event->save();

        $guests = Guest::saveForEvent($request, $event);

        return response()->json(new EventResource($event));
    }

    public function confirm(Request $request)
    {
        $guest = Guest::where('uuid', $request->uuid)->first();

        if($guest)
        {
            $guest->status = true;
            $guest->uuid = null;

            $guest->save();

            return response('Confirm', 200);
        }

        return response('Bad request', 404);
    }

    public function update(Request $request)
    {
        $user = User::where('access_token',$request->token)->first();
        $event = Event::where('user_id', $user->id)->where('id', $request->event['id'])->first();

        $eventData = $request->event;

        if( ! ($user && $event) )
        {
            return response()->json('Bad token');
        }

        $event = Event::find($eventData['id']);

        $event->name = $eventData['name'];
        $event->location = $eventData['location'];
        $event->description = $eventData['description'];
        $event->date_start = $eventData['dateStart'];
        $event->date_end = $eventData['dateEnd'];
        $event->time_start = $eventData['timeStart'];
        $event->time_end = $eventData['timeEnd'];

        $guests = Guest::where('event_id', $eventData['id'])->get();

        foreach ($guests as $guest)
        {
            $guest->delete();
        }

        $guestsArr = explode(', ', $eventData['guests']);

        if($guestsArr[0] !== "")
        {
            foreach($guestsArr as $guestItem)
            {
                $guest = new Guest();

                $guest->mail = $guestItem;
                $guest->event_id = $eventData['id'];

                $randStr = Str::random(16);

                $guest->uuid = $randStr;

                Mail::to($guest->mail)
                    ->send(new ConfirmMail($randStr));

                $guest->save();
            }
        }

        $event->save();

        return response()->json(new EventResource($event), 200);
    }

    public function destroy($id)
    {
        $event = Event::find($id);

        if($event)
        {
            $guests = Guest::where('event_id', $id)->get();

            foreach ($guests as $guest)
            {
                $guest->delete();
            }

            $event->delete();
            return response()->json('Good', 200);
        }

        return response()->json('Nosing search');
    }
}

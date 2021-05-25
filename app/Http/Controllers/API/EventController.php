<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\ConfirmEventRequest;
use App\Http\Requests\Event\EditRequest;
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
    public function store(StoreRequest $request): JsonResponse
    {
        $eventData = $request->event;
        $user = User::where('access_token', $request->token)->first();

        if(! $user)
        {
            return response()->json('Bad request');
        }

        $event = new Event();

        $event->name = $eventData['name'];
        //поле может быть пустым
        if ($request->event['location']) {
            $event->location = $eventData['location'];
        }
        $event->description = $eventData['description'];
        $event->date_start = $eventData['dateStart'];
        $event->date_end = $eventData['dateEnd'];
        $event->time_start = $eventData['timeStart'];
        $event->time_end = $eventData['timeEnd'];
        $event->bg_color = '#FAFAFA';
        $event->main_color = '#808080';
        $event->user_id = $user->id;

        $event->save();

        //поле может быть пустым
        if ($request->event['guests']) {
            $guests = Guest::saveForEvent($request, $event);
        }

        return response()->json(new EventResource($event));
    }

    public function confirm(ConfirmEventRequest $request)
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

    public function update(EditRequest $request)
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

        $guestsDelete = Guest::where('event_id', $eventData['id'])->get();
        foreach ($guestsDelete as $guest)
        {
            $guest->delete();
        }

        //поле может быть пустым
        if ($request->event['guests']) {
            $guests = Guest::saveForEvent($request, $event);
        }

        $event->save();

        return response()->json(new EventResource($event), 200);
    }

    public function destroy(Request $request)
    {
        $user = User::find($request->user_id);
        $event = Event::find($request->id);

        if($event->user_id === $user->id)
        {
            $guests = Guest::where('event_id', $request->id)->get();

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

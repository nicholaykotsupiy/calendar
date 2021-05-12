<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\StoreRequest;
use App\Http\Resources\Event\EventResource;
use App\Mail\ConfirmMail;
use App\Models\Event;
use App\Models\Guest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function store(StoreRequest $request): JsonResponse
    {
        $event = new Event();

        $event->name = $request->name;
        $event->location = $request->location;
        $event->description = $request->description;
        $event->date_start = $request->dateStart;
        $event->date_end = $request->dateEnd;
        $event->time_start = $request->timeStart;
        $event->time_end = $request->timeEnd;
        $event->bg_color = '#FAFAFA';
        $event->main_color = '#808080';
        $event->user_id = 1;//потом нужно добавлять user_id через аутентификацию
//        $event->user_id= Auth::user()->id;

        $event->save();

        if ($request->guests) {
            $guests = Guest::saveForEvent($request, $event);
        }

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
        $event = Event::find($request->id);

        $event->name = $request->name;
        $event->location = $request->location;
        $event->description = $request->description;
        $event->date_start = $request->dateStart;
        $event->date_end = $request->dateEnd;
        $event->time_start = $request->timeStart;
        $event->time_end = $request->timeEnd;

        $guests = Guest::where('event_id', $event->id)->get();

        foreach ($guests as $guest) {
            $guest->delete();
        }

        $guestsArr = explode(', ', $request->guests);

        foreach($guestsArr as $guestItem) {
            $guest = new Guest();

            $guest->mail = $guestItem;
            $guest->event_id = $event->id;

            $guest->save();
        }

        $event->save();

        return response()->json(new EventResource($event), 200);
    }

    public function destroy($id)
    {
        $event = Event::find($id);

        if($event)
        {
            $event->delete();
            return response()->json('Good', 200);
        }

        return response()->json('Nosing search');
    }
}

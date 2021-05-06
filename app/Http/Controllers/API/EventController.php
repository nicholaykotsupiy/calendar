<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\StoreRequest;
use App\Http\Resources\Event\StoreResource;
use App\Models\Event;
use App\Models\Guest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
        $event->user_id = 1;//потом нужно добавлять user_id через аутентификацию
//        $event->user_id= Auth::user()->id;

        $event->save();

        if ($request->guests) {
            $guests = Guest::saveForEvent($request, $event);
            //return response()->json($guests, 201);
        }

        return response()->json($event, 201);
    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}

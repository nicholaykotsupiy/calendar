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
    public function store(Request $request): JsonResponse
//    public function store(StoreRequest $request): JsonResponse
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

        if ($request->guests) {
            $arrGuests = explode(' ', $request->guests);
            foreach ($arrGuests as $item){
                $guest = new Guest();
                $guest->mail = $item;
                $guest->event_id = 11;
//                $guest->event_id = $event->id;
                $guest->save();
                return response()->json($guest, 201);
            }
        }
//        if ($request->guests) {
//            //dd($request->guests);
//            $guest = Guest::saveForEvent($request, $event);
//            return response()->json($guest, 201);
//        }

//        $image->post_id = $post->id;
//        $image->path = $imagesFile->store("/images/posts", 'public');
//
//        if ($request->hasFile('images')) {
//            //dump('hasFile', $request->file('images'));
//            $image = Image::saveForPost($request->file('images'), $post);
//            return response()->json($image, 201);
//        }

//        $event->save();
//        $guest->save();

//        return response()->json(new StoreResource($event), 200);
//        return response()->json($event, 201);
    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}

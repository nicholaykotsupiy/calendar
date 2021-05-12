<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reminder\StoreRequest;
use App\Http\Resources\Reminder\ReminderResource;
use App\Mail\ConfirmMail;
use App\Models\Reminder;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ReminderController extends Controller
{
    public function store(StoreRequest $request): JsonResponse
    {
        $reminder = new Reminder();

        $reminder->name = $request->name;
        $reminder->date = $request->date;
        $reminder->time = $request->time;
        $reminder->repeat = $request->toRepeat;
        $reminder->bg_color = '#FAFAFA';
        $reminder->main_color = '#808080';
        $reminder->user_id = 1;//потом нужно добавлять user_id через аутентификацию
//        $reminder->user_id = Auth::user()->id;



        return response()->json(new ReminderResource($reminder));
    }

    public function update(Request $request)
    {
        $reminder = Reminder::find($request->id);

        $reminder->name = $request->name;
        $reminder->date = $request->date;
        $reminder->time = $request->time;
        $reminder->repeat = $request->toRepeat;

        $reminder->save();

        return response()->json(new ReminderResource($reminder), 200);
    }

    public function destroy($id)
    {
        $reminder = Reminder::find($id);

        if($reminder)
        {
            $reminder->delete();
            return response()->json('Good', 200);
        }

        return response()->json('Nosing search');
    }
}

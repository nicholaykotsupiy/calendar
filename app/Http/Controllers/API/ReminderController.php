<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reminder\StoreRequest;
use App\Http\Resources\Reminder\ReminderResource;
use App\Mail\ConfirmMail;
use App\Models\Reminder;
use App\Models\User;
use http\Env\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ReminderController extends Controller
{
    public function store(Request $request)
    {
        $reminderData = $request->reminder;

        $user = User::where('access_token', $request->token)->first();

        if(! $user)
        {
            return response()->json('Bad request');
        }

        $reminder = new Reminder();

        $reminder->name = $reminderData['name'];
        $reminder->date = $reminderData['date'];
        $reminder->time = $reminderData['time'];
        $reminder->repeat = $reminderData['toRepeat'];
        $reminder->bg_color = '#FAFAFA';
        $reminder->main_color = '#808080';
        $reminder->user_id = $user->id;

        $reminder->save();

        return response()->json(new ReminderResource($reminder));
    }

    public function update(Request $request)
    {
        $user = User::where('access_token',$request->token)->first();
        $reminder = Reminder::where('user_id', $user->id)->where('id', $request->reminder['id'])->first();

        $reminderData = $request->reminder;

        if( ! ($user && $reminder) )
        {
            return response()->json('Bad token');
        }

        $reminder = Reminder::find($reminderData['id']);

        $reminder->name = $reminderData['name'];
        $reminder->date = $reminderData['date'];
        $reminder->time = $reminderData['time'];
        $reminder->repeat = $reminderData['toRepeat'];

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

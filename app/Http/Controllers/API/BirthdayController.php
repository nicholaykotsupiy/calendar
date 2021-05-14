<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Birthday\EditRequest;
use App\Http\Requests\Birthday\StoreRequest;
use App\Http\Resources\Birthday\StoreResource;
use App\Models\Birthday;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BirthdayController extends Controller
{

    public function store(Request $request): JsonResponse
    {
        $birthdayData = $request->birthday;

        $user = User::where('access_token', $request->token)->first();

        if(! $user)
        {
            return response()->json('Bad request');
        }
        $birthday = new Birthday;

        $birthday->name = $birthdayData['name'];
        $birthday->description = $birthdayData['description'];
        $birthday->date = $birthdayData['date'];
        $birthday->time = $birthdayData['time'];
        $birthday->all_day = $birthdayData['allDay'];
        $birthday->every_year = $birthdayData['everyYear'];
        $birthday->bg_color = '#FAFAFA';
        $birthday->main_color = '#808080';
        $birthday->user_id = $user->id;

        $birthday->save();

        return response()->json(new StoreResource($birthday));
    }

    public function update(Request $request)
    {
        $user = User::where('access_token',$request->token)->first();
        $event = Birthday::where('user_id', $user->id)->where('id', $request->birthday['id'])->first();

        $birthdayData = $request->birthday;

//        return response($birthdayData['name']);

        if( ! ($user && $event) )
        {
            return response()->json('Bad token');
        }

        $birthday = Birthday::find($birthdayData['id']);

        $birthday->name = $birthdayData['name'];
        $birthday->description = $birthdayData['description'];
        $birthday->date = $birthdayData['date'];
        $birthday->time = $birthdayData['time'];
        $birthday->all_day = $birthdayData['allDay'];
        $birthday->every_year = $birthdayData['everyYear'];
        $birthday->save();

        return response()->json(new StoreResource($birthday), 200);
    }

    public function destroy($id): JsonResponse
    {
        $birthday = Birthday::find($id);

        if($birthday)
        {
            $birthday->delete();
            return response()->json('Good', 200);
        }

        return response()->json('Nosing search');
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Birthday\EditRequest;
use App\Http\Requests\Birthday\StoreRequest;
use App\Http\Resources\Birthday\StoreResource;
use App\Models\Birthday;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BirthdayController extends Controller
{

    public function store(StoreRequest $request): JsonResponse
    {
        $birthday = new Birthday;

//        $birthday->fill($request->all());
        $birthday->name = $request->name;
        $birthday->description = $request->description;
        $birthday->date = $request->date;
        $birthday->time = $request->time;
        $birthday->all_day = $request->allDay;
        $birthday->every_year = $request->everyYear;
        $birthday->user_id = 1;//потом нужно добавлять user_id через аутентификацию

        $birthday->save();

        return response()->json(new StoreResource($birthday));
    }

    public function update(EditRequest $request): JsonResponse
    {
        $birthday = Birthday::find($request->id);

        if($request->name) {
            $birthday->name = $request->name;
        }
        if($request->description) {
            $birthday->description = $request->description;
        }
        if($request->date) {
            $birthday->date = $request->date;
        }
        if($request->time) {
            $birthday->time = $request->time;
        }
        if($request->all_day) {
            $birthday->all_day = $request->all_day;
        }
        if($request->every_year) {
            $birthday->every_year = $request->every_year;
        }

        $birthday->save();

        return response()->json(new StoreResource($birthday));
    }
//    complete
    public function destroy($id): JsonResponse
    {
        $birthday = Birthday::where('id', $id)->first();

        if($birthday)
        {
            $birthday->delete();
            return response()->json('Good', 200);
        }

        return response()->json('Nosing search');
    }
}
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
//    complete
    public function store(StoreRequest $request): JsonResponse
    {
        $birthday = new Birthday;

        $birthday->name = $request->name;
        $birthday->description = $request->description;
        $birthday->date = $request->date;
        $birthday->time = $request->time;
        $birthday->all_day = $request->all_day;
        $birthday->every_year = $request->every_year;
        $birthday->user_id = $request->user_id;

        $birthday->save();

        return response()->json(new StoreResource($birthday));
    }
//    complete
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

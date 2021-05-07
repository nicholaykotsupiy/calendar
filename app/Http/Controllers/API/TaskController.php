<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreRequest;
use App\Http\Resources\Task\StoreResource;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(StoreRequest $request): JsonResponse
    {
        $task = new Task();

        $task->name = $request->name;
        $task->description = $request->description;
        $task->date_start = $request->dateStart;
        $task->date_end = $request->dateEnd;
        $task->time_start = $request->timeStart;
        $task->time_end = $request->timeEnd;
        $task->all_day = $request->allDay;
        $task->user_id = 1;//потом нужно добавлять user_id через аутентификацию
//        $birthday->user_id= Auth::user()->id;

        $task->save();

        return response()->json(new StoreResource($task));
    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}

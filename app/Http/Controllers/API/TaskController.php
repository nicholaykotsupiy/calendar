<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreRequest;
use App\Http\Resources\Task\TaskResource;
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
        $task->bg_color = '#FAFAFA';
        $task->main_color = '#808080';
        $task->user_id = 1;//потом нужно добавлять user_id через аутентификацию
//        $birthday->user_id= Auth::user()->id;

        $task->save();

        return response()->json(new TaskResource($task));
    }

    public function update(Request $request)
    {
        $task = Task::find($request->id);

        $task->name = $request->name;
        $task->description = $request->description;
        $task->date_start = $request->dateStart;
        $task->date_end = $request->dateEnd;
        $task->time_start = $request->timeStart;
        $task->time_end = $request->timeEnd;
        $task->all_day = $request->allDay;
        $task->bg_color = $request->bg_color;
        $task->main_color = $request->main_color;
//
//        $task->save();

        return response()->json(new TaskResource($task), 200);
    }

    public function destroy($id)
    {
        $task = Task::find($id);

        if($task)
        {
            $task->delete();
            return response()->json('Good', 200);
        }

        return response()->json('Nosing search');
    }
}

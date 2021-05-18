<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\EditRequest;
use App\Http\Requests\Task\StoreRequest;
use App\Http\Resources\Task\TaskResource;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskController extends Controller
{
    public function store(StoreRequest $request): JsonResponse
    {
        $taskData = $request->task;

        $user = User::where('access_token', $request->token)->first();

        if(! $user)
        {
            return response()->json('Bad request');
        }

        $task = new Task();

        $task->name = $taskData['name'];
        //поле может быть пустым
        if ($request->task['description']) {
            $task->description = $taskData['description'];
        }
        $task->date_start = $taskData['dateStart'];
        $task->date_end = $taskData['dateEnd'];
        $task->time_start = $taskData['timeStart'];
        $task->time_end = $taskData['timeEnd'];
        $task->all_day = $taskData['allDay'];
        $task->bg_color = '#FAFAFA';
        $task->main_color = '#808080';
        $task->user_id = $user->id;

        $task->save();

        return response()->json(new TaskResource($task));
    }

    public function update(EditRequest $request)
    {
        $user = User::where('access_token',$request->token)->first();
        $task = Task::where('user_id', $user->id)->where('id', $request->task['id'])->first();

        $taskData = $request->task;

        if( ! ($user && $task) )
        {
            return response()->json('Bad token');
        }

        $task = Task::find($taskData['id']);

        $task->name = $taskData['name'];
        //поле может быть пустым
        if ($request->task['description']) {
            $task->description = $taskData['description'];
        }
        $task->date_start = $taskData['dateStart'];
        $task->date_end = $taskData['dateEnd'];
        $task->time_start = $taskData['timeStart'];
        $task->time_end = $taskData['timeEnd'];
        $task->all_day = $taskData['allDay'];

        $task->save();

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

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Birthday\StoreResource;
use App\Http\Resources\Event\EventResource;
use App\Http\Resources\Reminder\ReminderResource;
use App\Http\Resources\Task\TaskResource;
use App\Models\Birthday;
use App\Models\Event;
use App\Models\Reminder;
use App\Models\Task;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        $birthdays = StoreResource::collection(Birthday::all());
        $events = EventResource::collection(Event::all());
        $reminders = ReminderResource::collection(Reminder::all());
        $tasks = TaskResource::collection(Task::all());

        return response()->json(['birthdays' => $birthdays, 'events' => $events, 'reminders' => $reminders, 'tasks' => $tasks]);
    }

    public function updateColors(Request  $request)
    {
        $events = null;

        if($request->type === 'task')
        {
            $events = Task::all();
        }else if($request->type === 'reminder')
        {
            $events = Reminder::all();
        }else if($request->type === 'event')
        {
            $events = Event::all();
        }else if($request->type === 'birthday')
        {
            $events = Birthday::all();
        }else {
            return response('bad type');
        }

        foreach ($events as $event) {
            $event->bg_color = $request->bg_color;
            $event->main_color = $request->main_color;

            $event->save();
        }

        return response('update');
    }
}

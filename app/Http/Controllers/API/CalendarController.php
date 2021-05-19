<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalendarColor\UpdateColors;
use App\Http\Resources\Birthday\StoreResource;
use App\Http\Resources\Event\EventResource;
use App\Http\Resources\Reminder\ReminderResource;
use App\Http\Resources\Task\TaskResource;
use App\Models\Birthday;
use App\Models\Event;
use App\Models\Guest;
use App\Models\Reminder;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        $user = User::where('access_token', $request->token)->first();

        if(! $user)
        {
            return response()->json(['birthdays' => [], 'events' => [], 'reminders' => [], 'tasks' => []]);
        }

        $eventsGuest = Guest::where('mail', $user->email)->get();
        $events = Event::where('user_id', $user->id)->get();
        $responseEvents = Event::where('user_id', $user->id)->get();
        $eventsID = [];

        foreach ($events as $event)
        {
            $eventsID[] = $event->id;
        }

        foreach($eventsGuest as $eventGuest)
        {
            if(! in_array($eventGuest->event_id, $eventsID))
            {
                $responseEvents[] = Event::find($eventGuest->where('event_id', $eventGuest->event_id));
            }
        }
        $responseEvents = EventResource::collection($responseEvents);
        $birthdays = StoreResource::collection(Birthday::where('user_id', $user->id)->get());
        $reminders = ReminderResource::collection(Reminder::where('user_id', $user->id)->get());
        $tasks = TaskResource::collection(Task::where('user_id', $user->id)->get());

        return response()->json(['birthdays' => $birthdays, 'events' => $responseEvents, 'reminders' => $reminders, 'tasks' => $tasks]);
    }

    public function updateColors(UpdateColors $request)
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

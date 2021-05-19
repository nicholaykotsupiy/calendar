<?php

namespace App\Models;

use App\Mail\ConfirmMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class Guest extends Model
{
    use HasFactory;

    public $fillable = [
        'mail',
//        'event_id'
    ];

    public function enent()
    {
        return $this->belongsTo(Event::class);
    }

    public static function saveForEvent(Request $request, Event $event)
    {
        $strGuests = explode(',', $request->event['guests']);

        $guests = [];
        $k = 0;

        foreach ($strGuests as $item) {

            $guest = new Guest();

            $item = trim($item);
            $guest->mail = $item;
            $guest->event_id = $event->id;

            $randStr = Str::random(16);
            $guest->uuid = $randStr;
            Mail::to($guest->mail)
                ->send(new ConfirmMail($randStr));

            $guest->save();

            $guests[$k] = $guest;
            $k++;
        }

        return $guests;

    }
}

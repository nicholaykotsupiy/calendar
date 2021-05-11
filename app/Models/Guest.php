<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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
        $strGuests = explode(',', $request->guests);

        $guests = [];
        $k = 0;

        foreach ($strGuests as $item) {

            $guest = new Guest();

            $item = trim($item);
            $guest->mail = $item;
            $guest->event_id = $event->id;

            $guest->save();

            $guests[$k] = $guest;
            $k++;

        }

    }
}

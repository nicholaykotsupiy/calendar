<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Guest extends Model
{
    use HasFactory;

    private $arrGuests;

    public $fillable = [
        'mail',
        'user_id'
    ];

    public function enent()
    {
        return $this->belongsTo(Event::class);
    }

    public static function saveForEvent(Request $request, Event $event)
    {
        $arrGuests = explode(' ', $request->guests);
        foreach ($arrGuests as $item){
            $guest = new Guest();
            $guest->mail = $item;
            $guest->event_id = $event->id;
            //$guest->save();
        }

    }
}

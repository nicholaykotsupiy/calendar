<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;

    const DAILY = 'ежедневно';
    const WEEKLY = 'еженедельно';
    const YEARLY = 'каждый год';
    const DONOTREPEAT = 'не повторять';
    const ALLDAY = 'весь день';

    public $fillable = [
        'name',
        'date',
        'time',
        'reminder',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

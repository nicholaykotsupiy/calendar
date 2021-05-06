<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'location',
        'description',
        'date_start',
        'date_end',
        'time_start',
        'time_end',
        'user_id'
    ];

    public function guests()
    {
        return $this->hasMany(Guest::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

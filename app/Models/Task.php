<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'description',
        'date_start',
        'date_end',
        'time_start',
        'time_end',
        'all_day',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

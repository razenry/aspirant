<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Model;

class Aspiration extends Model
{
    //
    protected $fillable = [
        'sender_id',
        'staff_id',
        'title',
        'location',
        'content',
        'status',
    ];



    protected $casts = [
        'status' => Status::class,
    ];
}

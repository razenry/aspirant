<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grade extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'name',
        'level',
        'academic_year'
    ];

    public function students()
    {
        return $this->hasMany(User::class);
    }
}

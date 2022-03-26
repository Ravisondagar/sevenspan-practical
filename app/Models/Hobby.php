<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    use HasFactory;

    // get user hobbies
    public function userHobbies()
    {
        return $this->hasMany(UserHobby::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHobby extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['user_id', 'hobby_id'];

    // get hobby data
    public function hobby()
    {
        return $this->belongsTo(Hobby::class);
    }

    // get user data
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

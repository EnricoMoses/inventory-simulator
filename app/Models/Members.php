<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    protected $table = 'members';

    protected $fillable = [
        'first_name',
        'last_name',
        'hobby',
        'major',
        'profile_picture',
        'bio',
    ];
}

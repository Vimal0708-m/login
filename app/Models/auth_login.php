<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class auth_login extends Model
{
    protected $fillable = [
        "name",
        "email",
        "password"
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'userID'; 
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['username', 'password', 'position'];

    public $timestamps = false; 
}


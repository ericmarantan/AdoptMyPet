<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Adopter extends Authenticatable
{
    use HasFactory;
    protected $guard = 'adopter';

    protected $fillable = [
        'name',
        'type',
        'company',
        'mobile',
        'email',
        'password',
        'image',
        'street_address',
        'city',
        'state',
        'status'
    ];

    protected $hidden = [
        'password',
    ];

}
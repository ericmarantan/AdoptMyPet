<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Order extends Model
{
    use HasFactory;

    protected $guard = 'order';

    protected $fillable = [
        'order_number',
        'order_item',
        'price',
        'qty',
        'color',
        'shape',
        'account_name',
        'account_id',
        'company_street',
        'company_city',
        'adopter_name',
        'adopter_phone',
        'adopter_address',
        'adopter_city_state',
        'mailing_name',
        'mailing_email',
        'mailing_street_address',
        'mailing_city_state_zip',
        'mailing_note',
        'order_status',
        'status'
    ];
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class requestMoney extends Model
{
    protected $table = 'request_money';
    protected $fillable = ['full_name', 'phone', 'indentity_card', 'money', 'status'];

}

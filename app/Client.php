<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public $table = 'clients';

    protected $fillable = [
        'clientname','email','contact','address',
    ];

    protected $casts = [
        'clientid',
    ];
}

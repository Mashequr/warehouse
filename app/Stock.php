<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    public $table = 'stocks';

    protected $fillable = [
        'stockid','category','description','quantity','amount','unit','client','stockdate','stockuntil','discharge_date','status',
    ];

    protected $casts = [
        'sl',
    ];
}

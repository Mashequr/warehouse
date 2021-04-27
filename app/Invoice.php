<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public $table = 'invoices';

    protected $fillable = [
        'stockid','total','paid','due','paymethod','status','invoicedate','latefee',
    ];

    protected $casts = [
        'invoiceid',
    ];
}

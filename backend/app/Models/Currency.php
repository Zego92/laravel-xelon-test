<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'currencyCodeA',
        'currencyCodeB',
        'date',
        'rateSell',
        'rateBuy',
        'rateCross',
    ];

    protected $table = 'currencies';
}
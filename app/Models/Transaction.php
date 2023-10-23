<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'balance_id',
        'description',
        'amount',
        'balance',
    ];

    protected $casts = [
        'created_at' => 'date:d-m-Y H:i:s',
    ];
}

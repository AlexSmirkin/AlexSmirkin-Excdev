<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'description',
        'balance',
    ];

    protected $casts = [
        'created_at' => 'date:d-m-Y',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}

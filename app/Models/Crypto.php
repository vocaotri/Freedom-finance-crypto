<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Crypto extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $fillable = ['user_id', 'symbol', 'avg_price', 'total_coin', 'total_usdt'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    protected $casts = [
        'total_usdt' => 'float',
        'avg_price' => 'float',
        'total_coin' => 'float',
    ];
}

<?php

namespace App\Models;

use App\Enums\Market;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $fillable = ['user_id', 'crypto_id', 'market', 'price', 'amount'];
    public function crypto()
    {
        return $this->belongsTo(Crypto::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $casts = [
        'market' => Market::class,
        'price' => 'float',
        'amount' => 'float',
    ];
}

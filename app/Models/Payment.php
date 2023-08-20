<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payment';

    protected $fillable = [
        'kd_pesanan',
        'nominal_payment',
        'kembali_payment',
    ];

    public function order() {
        return $this->belongsTo(Order::class, 'kd_pesanan', 'kd_pesanan');
    }
}

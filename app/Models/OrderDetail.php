<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Barang;
use App\Models\Order;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_detail';

    protected $fillable = [
        'kd_pesanan',
        'barang_id',
        'qty',
        'sub_total'
    ];

    public function order() {
        return $this->belongsTo(Order::class, 'kd_pesanan', 'kd_pesanan');
    }

    public function barang() {
        return $this->hasOne(Barang::class, 'id', 'barang_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderDetail;
use App\Models\Payment;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';

    protected $fillable = [
        'kd_pesanan',
        'pemesan_pesanan',
        'total_pesanan',
        'user_id',
        'tanggal_pesanan',
        'status',
    ];

    public function orderDetail() {
        return $this->hasMany(OrderDetail::class, 'kd_pesanan', 'kd_pesanan');
    }

    public function payment() {
        return $this->hasOne(Payment::class, 'kd_pesanan', 'kd_pesanan');
    }

    public static function generateKodePesanan() {
        $format = 'KD_%04d_%s';

        do {
            $randomNumber = mt_rand(1, 1000);
            $kodePesanan = sprintf($format, $randomNumber, date('dmy'));
        } while (self::where('kd_pesanan', $kodePesanan)->exists());

        return $kodePesanan;
    }
}

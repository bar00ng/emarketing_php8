<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Barang;
use App\Models\Payment;
use Carbon\Carbon;
use Auth;
use Cart;

class OrderController extends Controller
{
    public function daftarOrder() {
        $orderData = Order::where('user_id', Auth::user()->id)->get();

        return view('daftarOrder', compact('orderData'));
    }

    public function formOrder() {
        return view('formOrder');
    }

    public function orderAction(Request $req) {        
        $kd_pesanan = Order::generateKodePesanan();

        $validated = $req->validate([
            'pemesan_pesanan' => 'required|string|max:255',
            'total_pesanan' => 'required|numeric',
            'bayar_pesanan' => 'required|numeric',
            'kembali_pesanan' => 'required|numeric'
        ]);
        
        $queryOrder = Order::create([
            'kd_pesanan' => $kd_pesanan,
            'pemesan_pesanan' => $validated['pemesan_pesanan'],
            'total_pesanan' => $validated['total_pesanan'],
            'user_id' => Auth::user()->id,
            'tanggal_pesanan' => Carbon::now()
        ]);

        if ($queryOrder) {
            $cartContent = Cart::session(Auth::user()->id)->getContent();

            foreach ($cartContent as $item) {
                OrderDetail::create([
                    'kd_pesanan' => $kd_pesanan,
                    'barang_id' => $item->id,
                    'qty' => $item->quantity,
                    'sub_total' => $item->price * $item->quantity
                ]);
            }

            Payment::create([
                'kd_pesanan' => $kd_pesanan,
                'nominal_payment' => $validated['bayar_pesanan'],
                'kembali_payment' => $validated['kembali_pesanan']
            ]);

            Cart::session(Auth::user()->id)->clear();

            return redirect()->route('user.dashboard')->with('success', 'Berhasil Order');
        } else {
            return back()->with('failed', 'Gagal order');
        }
    }

    public function addToCart(Request $req, $barang_id) {
        $validated = $req->validate([
            'quantity_barang' => 'required|numeric'
        ]);

        $barangData = Barang::find($barang_id);

        $addToCart = Cart::session(Auth::user()->id)
            ->add(array(
                'id' => $barangData->id,
                'name' => $barangData->nama_barang,
                'price' => $barangData->harga_barang,
                'quantity' => $validated['quantity_barang']
            ));

        if ($addToCart) {
            return redirect()->route('user.dashboard')->with('success', 'Berhasil menambahkan item ke Cart.');
        } else {
            return back()->with('failed', 'Gagal menambahkan item ke cart');
        }
        
    }

    public function deleteOrder($order_id) {
        $query = Order::where('kd_pesanan', $order_id)->delete();

        if ($query) {
            return back()->with('success', 'Berhasil menghapus data Order');
        } else {
            return back()->with('failed', 'Gagal menghapus data order');
        }
        
    }  

    public function removeFromCart($barang_id) {
        $removeFromCart = Cart::session(Auth::user()->id)
                                ->remove($barang_id);

        if ($removeFromCart) {
            return back()->with('success', 'Berhasil menghapus item dari keranjang belanja');
        } else {
            return back()->with('failde', 'Gagal menghapus item dari keranjang belanja');
        }
    }
}

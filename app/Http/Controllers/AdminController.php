<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Order;
use App\Models\Payment;

class AdminController extends Controller
{
    public function listUser() {
        $pageName = "Daftar Pengguna";

        $userData = User::whereHasRole('user')->get();

        return view('admin.listUser', compact('userData', 'pageName'));
    }

    public function formUser($user_id = null) {
        if ($user_id != null) {
            $pageName = "Edit User";
            $userData = User::find($user_id);

            return view('admin.formUser', compact('pageName', 'userData'));
        } else {
            $pageName = "Tambah User";

            return view('admin.formUser', compact('pageName'));
        }
    }

    public function formUserAction(Request $req, $user_id = null) {
        $validated = $req->validate([
            'first_name' => 'required|string|max:255',
            'alamat_lengkap' => 'required|string',
            'no_telp'=> 'required',
            'email' => 'required|email|unique:users,email,' . ($user_id ? $user_id : 'NULL') . ',id',
            'username' => 'required|string|max:255',
        ]);
    
        if($req->filled('last_name')) {
            $validated['last_name'] = $req->last_name;
        }
    
        $userAttributes = [
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'alamat_lengkap' => $validated['alamat_lengkap'],
            'no_telp' => $validated['no_telp'],
            'username' => $validated['username'],
            'email' => $validated['email'],
        ];
    
        if ($user_id) {
            $user = User::findOrFail($user_id);
            $user->update($userAttributes);
        } else {
            $user = User::create(array_merge($userAttributes, [
                'password' => Hash::make($req->password),
            ]));
            $user->addRole('user');
        }
    
        if ($user_id) {
            return redirect()->route('user.list')->with('success', 'Berhasil mengedit info user.');
        } else {
            return redirect()->route('user.list')->with('success', 'Berhasil menambahkan user baru.');
        }
    }

    public function deleteUser($user_id) {
        User::find($user_id)->delete();

        return back()->with('success', 'Berhasil menghapus data user');
    }

    public function daftarOrder() {
        $pageName = "Daftar Order";
        $orderData = Order::get();

        return view('admin.listOrder', compact('orderData', 'pageName'));
    }

    public function daftarPayment() {
        $pageName = "Daftar Payment";
        $paymentData = Payment::get();

        return view('admin.listPayment', compact('paymentData', 'pageName'));
    }

    public function updateOrder($kd_pesanan, $value) {
        $query = Order::where('kd_pesanan', $kd_pesanan)->update([
            'status' => $value
        ]);

        if ($value == 'Selesai') {
            $message = 'Berhasil menandai order sebagai selesai';
        } else {
            $message = 'Berhasil menandai order sebagai Belum selesai';
        }

        if ($query) {
            return back()->with('success', $message);
        } else {
            return back()->with('failed', 'Gagal update status order.');
        }
        
    }
}

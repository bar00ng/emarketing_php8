<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\User;
use App\Models\Order;
use App\Models\Payment;
use Carbon\Carbon;
use PDF;
use Auth;
use Illuminate\Support\Facades\File;

class ReportController extends Controller
{
    public function index() {
        $userData = User::whereHasRole('user')->orderBy('created_at', 'desc')->get();

        $pdf = PDF::loadView('admin.reportUser', compact('userData'));

        $pdf->setPaper('A4', 'portrait');

        $filename = 'report_user_' . Carbon::now()->format('Ymd_His') . '.pdf';

        return $pdf->download($filename);
    }

    public function reportBarang() {
        $barangData = Barang::orderBy('created_at', 'desc')->get();

        $pdf = PDF::loadView('admin.reportBarang', compact('barangData'));

        $pdf->setPaper('A4', 'portrait');

        $filename = 'report_barang_' . Carbon::now()->format('Ymd_His') . '.pdf';

        return $pdf->download($filename);
    }

    public function reportOrder() {
        $orderData = Order::where('user_id', Auth::user()->id)->get();
            
        $pdf = PDF::loadView('reportOrder', compact('orderData'));

        $pdf->setPaper('A4', 'portrait');

        $filename = 'report_order_user_' . Carbon::now()->format('Ymd_His') . '.pdf';

        return $pdf->download($filename);
    }

    public function reportOrderAdmin() {
        $orderData = Order::get();

        $pdf = PDF::loadView('admin.reportOrder', compact('orderData'));

        $pdf->setPaper('A4', 'portrait');

        $filename = 'report_order_' . Carbon::now()->format('Ymd_His') . '.pdf';

        return $pdf->download($filename);
    }

    public function reportPayment() {
        $paymentData = Payment::get();

        $pdf = PDF::loadView('admin.reportPayment', compact('paymentData'));

        $pdf->setPaper('A4', 'portrait');

        $filename = 'report_payment_' . Carbon::now()->format('Ymd_His') . '.pdf';

        return $pdf->download($filename);
    }
}

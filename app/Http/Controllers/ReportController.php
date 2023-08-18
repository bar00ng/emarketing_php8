<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\User;
use Carbon\Carbon;
use PDF;

class ReportController extends Controller
{
    public function index() {
        $barangData = Barang::orderBy('created_at', 'desc')->get();
        $userData = User::whereHasRole('user')->orderBy('created_at', 'desc')->get();

        $pdf = PDF::loadView('report', compact('barangData', 'userData'));

        $pdf->setPaper('A4', 'landscape');

        $filename = 'report_' . Carbon::now()->format('Ymd_His') . '.pdf';

        return $pdf->download($filename);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    public function daftarBarang() {
        $pageName = "Daftar Barang";
        $barangData = Barang::get();
        
        return view('admin.listBarang', compact("barangData", "pageName"));
    }

    public function formBarang($barang_id = null) {
        $pageName = 'Tambah Barang';

        if ($barang_id != null) {
            $pageName = 'Edit Barang';
            $barangData = Barang::find($barang_id);

            return view('admin.formBarang', compact('pageName', 'barangData'));
        } else {
            return view('admin.formBarang', compact('pageName'));
        }
        
    }

    public function formBarangAction(Request $req, $barang_id = null) {
        $validated = $req->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori_barang' => 'required|string|max:255',
            'desc_barang' => 'required|string|max:255',
            'harga_barang' => 'required|numeric|min:0',
            'pic_barang' => 'required|mimes:jpeg,png,bmp,tiff|max:4096'
        ]);

        if ($req->hasFile('pic_barang') && $req->file('pic_barang')->isValid()) {
            $file = $req->file('pic_barang');
            $originalFileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();

            $uniqueFileName = time() . '_' . uniqid() . '.' . $extension;

            $file->storeAs('/public/uploads/pic_barang', $uniqueFileName);

            $barangAttributes = [
                'nama_barang' => $validated['nama_barang'],
                'kategori_barang' => $validated['kategori_barang'],
                'desc_barang' => $validated['desc_barang'],
                'harga_barang' => $validated['harga_barang'],
                'pic_barang' => $uniqueFileName
            ];
        }


        if ($barang_id) {
            $barang = Barang::findOrFail($barang_id);
            $barang->update($barangAttributes);

            return redirect()->route('barang.list')->with('success', 'Berhasil mengedit data barang.');
        } else {
            $barang = Barang::create($barangAttributes);

            return redirect()->route('barang.list')->with('success', 'Berhasil menambahkan data barang baru.');
        }
    }

    public function deleteBarang($barang_id) {
        $query = Barang::find($barang_id)->delete();

        if ($query) {
            return back()->with('success', 'Berhasil menghapus data.');
        } else {
            return back()->with("error", 'Gagal menghapus data.');
        }
    }

    public function updateStatusBarang($barang_id = null, $isActive = null) {
        if ($isActive == 'false') {
            $statusNew = false;
        } else {
            $statusNew = true;
        }
        $query = Barang::find($barang_id)->update([
            'isActive' => $statusNew
        ]);

        return back()->with('success', 'Berhasil update status barang');
    }
}

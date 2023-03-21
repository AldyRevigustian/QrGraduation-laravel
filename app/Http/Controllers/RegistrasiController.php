<?php

namespace App\Http\Controllers;

use App\Exports\RegistrasiExport;
use App\Models\Registrasi;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

// use Alert;

class RegistrasiController extends Controller
{
    public function index()
    {
        $registrasi = Registrasi::with('siswa')->get();
        return view('admin.registrasi.index', compact('registrasi'));
    }
    public function scan()
    {
        return view('admin.scan');
    }

    public function preview($barcode)
    {
        $explode = explode("|", $barcode);
        $preview = Siswa::where('nis', $explode[0])->where('nama', $explode[1])->first();
        return view('admin.preview', compact('preview'));
    }

    public function submit_preview(Request $request)
    {
        $cek = Registrasi::where('siswa_id', $request->siswa_id)->first();
        if ($cek == null) {
            $submit = Registrasi::create([
                'siswa_id' => $request->siswa_id,
                'status' => 'Hadir',
                'jam_hadir' => date('Y-m-d H:i:s')
            ]);

            if ($submit) {
                toast('Berhasil Registrasi', 'success');
                return redirect()->route('admin.scan')->with('success', 'Berhasil Regis');
            }

            toast('Gagal Registrasi', 'error');
            return redirect()->route('admin.scan');
        }
        toast('Gagal Registrasi', 'error');
        return redirect()->route('admin.scan');
    }

    public function export()
    {
        return Excel::download(new RegistrasiExport, 'Daftar Hadir.xlsx');
    }
}

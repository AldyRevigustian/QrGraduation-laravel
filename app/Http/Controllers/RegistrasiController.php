<?php

namespace App\Http\Controllers;

use App\Exports\RegistrasiExport;
use App\Models\DetailStatus;
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
        $format_kelas = str_replace("_", " ", $explode[0]);
        $preview = Siswa::where('kelas', $format_kelas)->where('nama', $explode[1])->first();

        return view('admin.preview', compact('preview'));
    }

    public function submit_preview(Request $request)
    {
        if ($request->register == null) return redirect()->back();
        $cek = Registrasi::where('siswa_id', $request->siswa_id)->first();
        if ($cek == null) {
            $submit = Registrasi::create([
                'siswa_id' => $request->siswa_id,
                'status' => 'Hadir',
                'jam_hadir' => date('Y-m-d H:i:s')
            ]);

            if ($submit) {
                foreach ($request->register as $det) {
                    $status = DetailStatus::where('id', $det)->first();
                    $status->update([
                        'status' => 1
                    ]);
                }
                toast('Berhasil Registrasi', 'success');
                return redirect()->route('admin.scan')->with('success', 'Berhasil Regis');
            }

            toast('Gagal Registrasi', 'error');
            return redirect()->route('admin.scan');
        } else {
            if ($request->register) {
                foreach ($request->register as $det) {
                    $status = DetailStatus::where('id', $det)->first();
                    $status->update([
                        'status' => 1
                    ]);
                }
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

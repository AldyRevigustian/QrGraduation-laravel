<?php

namespace App\Http\Controllers;

use App\Imports\SiswaImport;
use App\Models\DetailStatus;
use App\Models\Kelas;
use App\Models\Siswa;
use Google\Service\ContainerAnalysis\Detail;
// use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
// use Barryvdh\DomPDF\PDF as DomPDFPDF;
// use GdImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Milon\Barcode\Facades\DNS2DFacade;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

// use PDF;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::get();
        return view('admin.siswa.index', compact('siswas'));
    }

    public function create()
    {
        $kelas = Kelas::get();
        return view('admin.siswa.create', compact('kelas'));
    }
    
    public function import(Request $request)
    {
        Excel::import(new SiswaImport, $request->file('file'));
        $this->status();
        // $this->pdf();
        return redirect()->route('admin.siswa')->with('status', 'success')->with('message', 'Berhasil Mengimport Siswa');
    }

    public function status()
    {
        $siswas = Siswa::all();

        foreach ($siswas as $siswa) {
            DetailStatus::create([
                "siswa_id" => $siswa->id,
                "name" => $siswa->nama,
            ]);

            if ($siswa->pendamping_1 != '-') {
                DetailStatus::create([
                    "siswa_id" => $siswa->id,
                    "name" => $siswa->pendamping_1,
                ]);
            }

            if ($siswa->pendamping_2 != '-') {
                DetailStatus::create([
                    "siswa_id" => $siswa->id,
                    "name" => $siswa->pendamping_2,
                ]);
            }
        }
    }


    public function pdf()
    {
        $siswas = Siswa::all();
        foreach ($siswas as $siswa) {
            $qr_string = $siswa->nis . '|' . $siswa->nama;
            $format = str_replace(" ", "_", $siswa->kelas);

            $filename =  $format . '/QR/' . $siswa->nama . '_' . $siswa->nis . '.png';
            Storage::disk('public')->put($filename, base64_decode(DNS2DFacade::getBarcodePNG($qr_string, "QRCODE")));

            $update = $siswa->update([
                'foto_barcode' => $filename
            ]);

            if ($update) {
                $data = [
                    'nama' => $siswa->nama,
                    'nis' => $siswa->nis,
                    'kelas' => $siswa->kelas,
                    'foto_barcode' => $siswa->foto_barcode,
                ];
                $pdfName = $format . '/' . $siswa->nama . '_' . $siswa->nis . '.pdf';

                $pdf = app('dompdf.wrapper');
                set_time_limit(6000);
                $hasil = $pdf->loadView('admin.siswa.qr', $data);

                $content = $pdf->download()->getOriginalContent();
                // Storage::disk('google')->put($pdfName, $content);
                Storage::disk('public')->put($pdfName, $content);

                $siswa->update([
                    'tiket' => $pdfName
                ]);
            }
        }
    }

    function read_pdf($id)
    {
        $siswa = Siswa::where('id', $id)->first();
        $data = Gdrive::get($siswa->tiket);
        return response($data->file, 200)
            ->header('Content-Type', $data->ext)
            ->header('Content-disposition', 'attachment; filename="' . $data->filename . '"');
    }
}

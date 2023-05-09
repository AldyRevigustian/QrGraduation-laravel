<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;

class SiswaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Siswa([
            'nama' => trim($row[0]),
            'kelas' => trim($row[1]),
            'pendamping_1' => trim($row[2]),
            'pendamping_2' => trim($row[3]),
        ]);



    }
}

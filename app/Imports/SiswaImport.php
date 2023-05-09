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
            'nama' => $row[0],
            'kelas' => $row[1],
            'pendamping_1' => $row[2],
            'pendamping_2' => $row[3],
        ]);



    }
}

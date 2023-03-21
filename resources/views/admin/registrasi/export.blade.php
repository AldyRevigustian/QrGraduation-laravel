<table>
    <thead>
        <tr>
            <th>NIS</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Pendamping</th>
            <th>Status</th>
            <th>Jam Hadir</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($siswas as $siswa)
            <tr>
                <td>{{ $siswa->nis }}</td>
                <td>{{ $siswa->nama }}</td>
                <td>{{ $siswa->kelas }}</td>
                <td>{{ $siswa->pendamping ?? " " }}</td>
                <td>{{ $siswa->registrasi->status ?? ' ' }}</td>
                <td>{{ $siswa->registrasi == null ? "" : date('d/m/Y H:i:s', strtotime($siswa->registrasi->jam_hadir)) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

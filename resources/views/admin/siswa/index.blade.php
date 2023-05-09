@extends('layouts.master')

@section('content')
    <section class="section">
        <div class="card shadow-sm">
            <div class="card-header" style="padding-bottom: 0px">
                <h3>
                    Siswa
                </h3>
                <hr>
                @include('message')
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-6 d-flex justify-content-start">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Import Excel
                        </button>

                    </div>
                </div>

                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Pendamping 1</th>
                            <th>Pendamping 2</th>
                            <th style="text-align:center">Tiket</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswas as $siswa)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $siswa->nama }}</td>
                                <td>{{ $siswa->kelas }}</td>
                                <td>{{ $siswa->pendamping_1 }}</td>
                                <td>{{ $siswa->pendamping_2 }}</td>
                                <td style="text-align:center"><a
                                        href="{{ route('admin.siswa.read.pdf', $siswa->id) }}"style="color: black"><i
                                            class="bi bi-download" style="font-size: 1.2rem"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </section>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action={{ route('admin.import.siswa') }} enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Input Excel</label>
                            <input type="file" name="file" required="required" class="form-control">
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

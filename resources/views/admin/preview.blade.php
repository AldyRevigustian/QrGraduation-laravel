@extends('layouts.master')

@section('content')
    <form action="{{ route('admin.submit-preview') }}" method="POST" style="display: block">
        <div class="d-flex justify-content-center">
            <div class="card col-11">
                <div class="card-header" style="padding-bottom: 0px">
                    <h3>
                        Konfirmasi Pengunjung
                    </h3>
                    <hr>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>
                                    <p class="m-0 py-3 px-1" style="font-size: 1rem">Nama Siswa</p>
                                </td>
                                <td>
                                    <p class="m-0 py-3 px-1" style="font-size: 1rem">{{ $preview->nama }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="m-0 py-3 px-1" style="font-size: 1rem">Kelas</p>
                                </td>
                                <td>
                                    <p class="m-0 py-3 px-1" style="font-size: 1rem">XII {{ $preview->kelas }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="m-0 py-3 px-1" style="font-size: 1rem">Pengunjung</p>
                                </td>
                                <td>
                                    @foreach ($preview->detail_status as $detail)
                                        <div class="form-check m-2">
                                            <div class="checkbox">
                                                <input type="checkbox" {{ $detail->status == 1 ? 'disabled' : '' }}
                                                    name="register[]" value={{ $detail->id }} class="form-check-input"
                                                    {{ $detail->status == 1 ? 'checked' : '' }}>
                                                <label> {{ $detail->name }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-6">
                            <a href="{{ route('admin.scan') }}" class="btn btn-danger">Cancel</a>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            @csrf
                            <input type="hidden" value="{{ $preview->id }}" name="siswa_id">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

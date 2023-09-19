@extends('layouts.master')

@section('title')
Laporan
@endsection

@section('sub-title')
Laporan Pengaduan
@endsection

@section('content')
<div class="row">
    <div class="col-lg-4 col-12">
        <div class="card">
            <div class="card-header">Cari Berdasarkan Tanggal</div>
            <div class="card-body">
                <form action="{{route('laporan.getLaporan')}}">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="from" class="form-control" placeholder="Tanggal Awal" onfocusin="(this.type='date')" onfocusout="(this.type='text')">
                    </div>
                    <div class="form-group">
                        <input type="text" name="to" class="form-control" placeholder="Tanggal Akhir" onfocusin="(this.type='date')" onfocusout="(this.type='text')">
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%">Cari Data</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-12">
        <div class="card">
            <div class="card-header">Data
                <div class="float-right">
                    @if ($pengaduan ?? '')
                        <a href="{{route('laporan.cetaklaporan', ['from' => $from, 'to' => $to])}}" class="btn btn-danger">EXPORT PDF</a>
                    @endif
                </div>
            </div>
            <div class="card-body">
                @if ($pengaduan ?? '')
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Isi Laporan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengaduan as $k => $v)
                        <tr>
                            <td>{{ $k + 1 }}</td>
                            <td>{{ $v->tgl_pengaduan }}</td>
                            <td>{{ $v->isi_laporan }}</td>
                            <td>
                                @if ($v->status == '0')
                                    <a href="#" class="badge badge-danger">Pending</a>
                                @elseif ($v->status == 'proses')
                                    <a href="#" class="badge badge-warning text-white p-1" style="border-radius: 20%; font-size: 13px;">Proses</a>
                                @else
                                    <a href="#" class="badge badge-success">Selesai</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <div class="text-center">Tidak Ada Data</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

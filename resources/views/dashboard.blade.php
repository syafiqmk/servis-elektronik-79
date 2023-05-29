@extends('template.dashboard')

@section('title')
    Dashboard
@endsection

@section('side_title')
    <h5>{{ date('l, d F Y') }}</h5>
@endsection

@section('content')
    <div class="row mb-3">
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Total of devices</h5>
                </div>
                <div class="card-body">
                    <h3>{{ $devices->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Devices added today</h5>
                </div>
                <div class="card-body">
                    <h3>{{ $device_today->count() }}</h3>
                </div>
            </div>
        </div>

    </div>
    
    <div class="row d-flex justify-content-center">
        <div class="col-md-4 col-sm-12 mb-2">
            <div class="card h-100">
                <div class="card-header bg-primary text-white">
                    <h5>Baru</h5>
                </div>
                <div class="card-body">
                    <h3>{{ $devices->where('status', '=', 'Baru')->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12 mb-2">
            <div class="card h-100">
                <div class="card-header bg-warning text-white">
                    <h5>Proses</h5>
                </div>
                <div class="card-body">
                    <h3>{{ $devices->where('status', '=', 'Proses')->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12 mb-2">
            <div class="card h-100">
                <div class="card-header bg-info text-white">
                    <h5>Belum Diambil</h5>
                </div>
                <div class="card-body">
                    <h3>{{ $devices->where('status', '=', 'Belum Diambil')->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12 mb-2">
            <div class="card h-100">
                <div class="card-header bg-success text-white">
                    <h5>Sudah Diambil</h5>
                </div>
                <div class="card-body">
                    <h3>{{ $devices->where('status', '=', 'Sudah Diambil')->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12 mb-2">
            <div class="card h-100">
                <div class="card-header bg-danger text-white">
                    <h5>Batal</h5>
                </div>
                <div class="card-body">
                    <h3>{{ $devices->where('status', '=', 'Batal')->count() }}</h3>
                </div>
            </div>
        </div>
    </div>
@endsection
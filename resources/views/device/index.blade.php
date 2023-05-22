@extends('template.dashboard')

@section('title')
    Devices list
@endsection

@section('side_title')
    <a href="{{ route('device.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add new device</a>
@endsection
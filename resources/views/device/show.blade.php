@extends('template.dashboard')

@section('title')
    Device detail
@endsection

@section('content')
    <div class="container">

        {{-- device detail --}}
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <img src="{{ (empty($device->image)) ? asset('image').'No-Image.png' : asset('image/device/').$device->image }}" class="img-fluid rounded" height="500">
            </div>
        </div>
        {{-- end of device detail --}}
    </div>
@endsection
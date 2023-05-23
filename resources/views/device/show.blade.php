@extends('template.dashboard')

@section('title')
    Device detail
@endsection

@section('content')
    <div class="container">

        {{-- device detail --}}
        <div class="row">
            {{-- image --}}
            <div class="col-md-6 col-sm-12 mb-3">
                <img src="{{ (empty($device->image)) ? asset('image').'/No-Image.png' : asset('image/device').'/'.$device->image }}" class="img-fluid rounded">
            </div>
            {{-- end of image --}}

            {{-- device detail --}}
            <div class="col-md-6 col-sm-12">
                <h5>Details</h5>
                <div class="mb-3">
                    <b>Category</b>
                    <p>{{ $device->category->category }}</p>
                </div>

                <div class="mb-3">
                    <b>Status</b>
                    @switch($device->status)
                        @case('Baru')
                            <h5><span class="badge bg-primary">{{ $device->status }}</span></h5>
                            @break
                        @case('Proses')
                            <h5><span class="badge bg-warning">{{ $device->status }}</span></h5>
                            @break
                        @case('Belum Diambil')
                            <h5><span class="badge bg-info">{{ $device->status }}</span></h5>
                            @break
                        @case('Sudah Diambil')
                            <h5><span class="badge bg-success">{{ $device->status }}</span></h5>
                            @break
                        @case('Batal')
                            <h5><span class="badge bg-danger">{{ $device->status }}</span></h5>
                            @break
                    @endswitch
                </div>

                <div class="mb-3">
                    <b>Phone number</b>
                    <p>{{ (empty($device->phone_number)) ? '-' : $device->phone_number }}</p>
                </div>

                <div class="mb-3">
                    <b>Price</b>
                    <p>Rp. {{ number_format($device->price, 2, ',', '.') }}</p>

                    <form action="" method="post">
                        @csrf
                        @method('PUT')
                        <div class="input-group">
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" autocomplete="off" value="{{ old('price') }}">
                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                        </div>
                        @error('price')
                            <div class="invalid-feedback mb-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </form>
                </div>

                <div class="mb-3">
                    <b>Detail</b>
                    {!! $device->detail !!}
                </div>
            </div>
            {{-- end of device detail --}}
        </div>
        {{-- end of device detail --}}
    </div>
@endsection
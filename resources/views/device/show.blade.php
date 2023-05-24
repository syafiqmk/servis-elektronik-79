@extends('template.dashboard')

@section('title')
    Device detail
@endsection

@section('side_title')
    <form action="{{ route('device.destroy', $device->id) }}" method="post" id="delete">
        @csrf
        @method('DELETE')
        <div class="btn-group">
            <a href="{{ route('device.index') }}" class="btn btn-success"><i class="fa-solid fa-chevron-left"></i> Back</a>
            <a href="{{ route('transaction.create', $device->id) }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> New transaction</a>
            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Delete</button>
        </div>
    </form>
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

                    <form action="{{ route('device.updatePhone', $device->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="input-group">
                            <input type="number" name="phone" class="form-control @error('phone') is-invalid @enderror" autocomplete="off" value="{{ old('phone') }}">
                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                        </div>
                        @error('phone')
                            <div class="invalid-feedback mb-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </form>
                </div>

                <div class="mb-3">
                    <b>Price</b>
                    <p>Rp. {{ number_format($device->price, 2, ',', '.') }}</p>

                    <form action="{{ route('device.updatePrice', $device->id) }}" method="post">
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


        {{-- device transaction --}}
        @if ($transactions->count() != 0)
        <div class="row d-flex justify-content-center">
            <h4>Transaction</h4>
            <div class="row d-flex justify-content-center">
                <div class="col-md-8 col-sm-12">
                    @foreach ($transactions as $data)
                        <div class="card mb-3">
                            {{-- card header --}}
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 fs-6">
                                        @switch($data->type)
                                            @case('Proses')
                                                <span class="badge bg-warning">{{ $data->type }}</span>
                                                @break
                                            @case('Belum Diambil')
                                                <span class="badge bg-info">{{ $data->type }}</span>
                                                @break
                                            @case('Sudah Diambil')
                                                <span class="badge bg-success">{{ $data->type }}</span>
                                                @break
                                            @case('Batal')
                                                <span class="badge bg-danger">{{ $data->type }}</span>
                                                @break
                                        @endswitch
                                        By. {{ $data->user->name }} - {{ $data->created_at->diffForHumans() }}
                                    </div>

                                    <div class="col-md-6 col-sm-12 text-end">
                                        <form action="{{ route('transaction.destroy', ['transaction' => $data->id, 'device' => $device->id]) }}" method="post" id="del-tr">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- end of card header --}}
        
                            <div class="card-body">
                                @if (!empty($data->image))
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('image/transaction').'/'.$data->image }}" class="img-thumbnail w-50" >
                                </div>
                                @endif
        
                                @if (!empty($data->detail))
                                    {!! $data->detail !!}
                                @else
                                    <p>No details.</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
        {{-- end of device transaction --}}
    </div>



    {{-- script --}}
    <script>
        $('#delete').submit(function(e) {
            let form = this;
            e.preventDefault();

            Swal.fire({
                icon: 'warning',
                text: 'Delete device?',
                showCancelButton: true,
                cancelButtonText: 'Cancel',
                confirmButtonText: 'Delete',
            }).then((result) => {
                if(result.isConfirmed) {
                    form.submit();
                }
            })
        })

        $('#del-tr').submit(function(e) {
            let form = this;
            e.preventDefault();

            Swal.fire({
                icon: 'warning',
                text: 'Delete transaction?',
                showCancelButton: true,
                cancelButtonText: 'Cancel',
                confirmButtonText: 'Delete',
            }).then((result) => {
                if(result.isConfirmed) {
                    form.submit();
                }
            })
        })
    </script>
@endsection
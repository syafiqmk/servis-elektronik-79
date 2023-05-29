@extends('template.dashboard')

@section('title')
    Devices list
@endsection

@section('side_title')
    <div class="btn-group">
        <a href="{{ route('device.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add new device</a>
    </div>
@endsection

@section('content')
    <div class="container">
        @if ($devices->count() != 0)
        <div class="row">
            @foreach ($devices as $data)
            <div class="col-md-4 col-sm-6 mb-3">
                <div class="card h-100">
                    {{-- card header --}}
                    <div class="card-header">
                        {{-- status & category --}}
                        <b>{{ $data->category->category }}</b>
                        @switch($data->status)
                            @case('Baru')
                                <span class="badge bg-primary">{{ $data->status }}</span>
                                @break
                            @case('Proses')
                                <span class="badge bg-warning">{{ $data->status }}</span>
                                @break
                            @case('Belum Diambil')
                                <span class="badge bg-info">{{ $data->status }}</span>
                                @break
                            @case('Sudah Diambil')
                                <span class="badge bg-success">{{ $data->status }}</span>
                                @break
                            @case('Batal')
                                <span class="badge bg-danger">{{ $data->status }}</span>
                                @break
                        @endswitch
                        {{-- end of status and category --}}
                    </div>
                    {{-- end of car header --}}

                    {{-- image --}}
                    <img src="{{ (empty($data->image)) ? asset('image').'/No-Image.png' : asset('image/device').'/'.$data->image }}" class="h-50">
                    {{-- end of image --}}

                    {{-- card body --}}
                    <div class="card-body">
                        {{-- time created --}}
                            <p class="text-end">{{ $data->created_at->diffForHumans() }}</p>
                        {{-- end of time created --}}

                        {{-- price --}}
                        @if (!empty($data->price))
                            <p>Rp. {{ number_format($data->price, 2, ',', '.') }}</p>
                        @endif
                        {{-- end of price --}}

                        {{-- link --}}
                        <div class="text-end">
                            <a href="{{ route('device.show', $data->id) }}" class="btn btn-primary"><i class="fa-solid fa-book"></i> Detail</a>
                        </div>
                        {{-- end of link --}}
                    </div>
                    {{-- end of card body --}}
                </div>
            </div>
            @endforeach
        </div>
        {{ $devices->withQueryString()->links() }}
        @else
            <p>No entries found!</p>
        @endif
    </div>
@endsection
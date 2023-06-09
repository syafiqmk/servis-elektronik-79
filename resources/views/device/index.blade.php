@extends('template.dashboard')

@section('title')
    Devices list
@endsection

@section('side_title')
    <div class="btn-group">
        <a href="{{ route('device.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add new device</a>
        <a href="{{ route('device.index') }}" class="btn btn-success"><i class="fa-solid fa-xmark"></i> Reset</a>
    </div>
@endsection

@section('content')

    <h5>Filters</h5>
    {{-- search --}}
    <form action="{{ route('device.index') }}" method="get" class="mb-2">

        <div class="input-group">
            {{-- search input --}}
            <div class="form-floating">
                <input type="text" name="search" id="search" class="form-control mb-2" autocomplete="off" value="{{ request('search') }}">
                <label for="search">Search</label>
            </div>
            {{-- end of search input --}}
    
            {{-- date input --}}
            <div class="form-floating">
                <input type="date" name="date" id="date" class="form-control mb-2" value="{{ request('date') }}">
                <label for="date">Date</label>
            </div>
            {{-- end of date input --}}
        </div>


        <div class="input-group">

            {{-- category select --}}
            <div class="form-floating">
                <select name="category" id="category" class="form-select">
                    <option value="">All category</option>
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}" {{ ($item->id == request('category')) ? 'selected' : ''}}>{{ $item->category }}</option>
                    @endforeach
                </select>
                <label for="category">Category</label>
            </div>
            {{-- end of category select --}}

            {{-- status select --}}
            <div class="form-floating">
                <select name="status" id="status" class="form-select">
                    <option value="">All status</option>
                    <option value="Baru" {{ (request('status') == 'Baru') ? 'selected' : '' }}>Baru</option>
                    <option value="Proses" {{ (request('status') == 'Proses') ? 'selected' : '' }}>Proses</option>
                    <option value="Belum Diambil" {{ (request('status') == 'Belum Diambil') ? 'selected' : '' }}>Belum Diambil</option>
                    <option value="Sudah Diambil" {{ (request('status') == 'Sudah Diambil') ? 'selected' : '' }}>Sudah Diambil</option>
                    <option value="Batal" {{ (request('status') == 'Batal') ? 'selected' : '' }}>Batal</option>
                </select>
                <label for="status">Status</label>
            </div>
            {{-- end of status select --}}

            {{-- sort select --}}
            <div class="form-floating">
                <select name="sort" id="sort" class="form-select">
                    <option value="DESC" {{ (request('sort') == 'DESC') ? 'selected' : '' }}>Terbaru</option>
                    <option value="ASC" {{ (request('sort') == 'ASC') ? 'selected' : '' }}>Terlama</option>
                </select>
                <label for="sort">Sort</label>
            </div>
            {{-- end of sort select --}}

            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
        </div>
    </form>
    {{-- end of search --}}

    {{-- device list --}}
    <h5>Devices</h5>
    @if ($devices->count() != 0)
    <div class="row">
        @foreach ($devices as $data)
        <div class="col-md-4 col-sm-12 mb-3">
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
                <div class="card-body h-25">
                    {{-- time created --}}
                        <p>{{ date('l, d M Y', strtotime($data->created_at)) }} ({{ $data->created_at->diffForHumans() }})</p>
                    {{-- end of time created --}}

                    {{-- phone number --}}
                    @if (!empty($data->phone_number))
                        <p>Phone number : {{ $data->phone_number }}</p>
                    @endif
                    {{-- end of phone number --}}

                    {{-- price --}}
                    @if (!empty($data->price))
                        <p>Rp. {{ number_format($data->price, 2, ',', '.') }}</p>
                    @endif
                    {{-- end of price --}}

                </div>
                {{-- end of card body --}}

                {{-- card footer --}}
                {{-- link --}}
                <div class="card-footer">
                    <div class="text-end">
                        <a href="{{ route('device.show', $data->id) }}" class="btn btn-primary"><i class="fa-solid fa-book"></i> Detail</a>
                    </div>
                </div>
                {{-- end of link --}}
                {{-- end of card footer --}}
            </div>
        </div>
        @endforeach
    </div>
    {{ $devices->withQueryString()->links() }}
    @else
        <p>No entries found!</p>
    @endif
    {{-- end of device list --}}

@endsection
@extends('template.dashboard')

@section('title')
    {{ $title }}
@endsection

@section('content')
    
    {{-- Table --}}
    <table class="table">
        <thead>
            <th>No</th>
            <th>Category</th>
            <th>Action</th>
        </thead>
        <tbody>
            @if ($categories->count() == 0)
                <tr>
                    <td colspan="3" class="text-center">No entries found.</td>
                </tr>
            
            @else
                @foreach ($categories as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->category }}</td>
                        <td>
                            <a href="" class="btn btn-success"><span data-feather="edit"></span> Edit</a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

@endsection
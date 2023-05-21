@extends('template.dashboard')

@section('title')
    User Account
@endsection
    
@section('content')
    <a href="" class="btn btn-primary mb-3"><i class="fa-solid fa-plus"></i> Create new account</a>
    
    <table class="table">
        <thead>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </thead>
        <tbody>
            @if ($users->count() == 0)
                <tr>
                    <td colspan="4" class="text-center">No entries found.</td>
                </tr>
            @else
                @foreach ($users as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{  }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection
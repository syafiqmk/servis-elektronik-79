@extends('template.dashboard')

@section('title')
    User Account
@endsection
    
@section('content')
    <a href="{{ route('user.create') }}" class="btn btn-primary mb-3"><i class="fa-solid fa-plus"></i> Create new account</a>
    
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
                        <td>{{ $data->email }}</td>
                        <td>
                            <form action="" method="post" id="delete">
                                @csrf
                                @method('DELETE')
                                <div class="button-group">
                                    <a href="{{ route('user.edit', $data->id) }}" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Delete</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    {{ $users->links() }}
@endsection
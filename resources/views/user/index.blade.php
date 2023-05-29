@extends('template.dashboard')

@section('title')
    User Account
@endsection

@section('side_title')
    <a href="{{ route('user.create') }}" class="btn btn-primary mb-3"><i class="fa-solid fa-plus"></i> Create new account</a>
@endsection
    
@section('content')

    {{-- search --}}
    <form action="{{ route('user.index') }}" method="GET">
        <div class="input-group mb-3">
            <input type="text" name="search" class="form-control" placeholder="Search" autocomplete="off" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
            <a href="{{ route('user.index') }}" class="btn btn-success"><i class="fa-solid fa-xmark"></i> Reset</a>
        </div>
    </form>
    {{-- end of search --}}
    
    {{-- table --}}
    <div class="table-responsive">
        <table class="table table-striped">
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
                            <td>{{ $users->firstItem() + $loop->index }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>
                            <td>
                                <form action="{{ route('user.delete', $data->id) }}" method="post" id="delete">
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
    </div>
    {{-- end of table --}}

    {{ $users->withQueryString()->links() }}

    <script>
        $('#delete').submit(function(e) {
            let form = this;
            e.preventDefault();

            Swal.fire({
                icon: 'warning',
                text: 'Delete device user account?',
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
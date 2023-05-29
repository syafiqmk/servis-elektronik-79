@extends('template.dashboard')

@section('title')
    {{ $title }}
@endsection

@section('side_title')
    <a href="{{ route('category.create') }}" class="btn btn-primary mb-3"><i class="fa-solid fa-plus"></i> Add new category</a>
@endsection

@section('content')

    {{-- search --}}
    <form action="{{ route('category.index') }}" method="GET">
        <div class="input-group mb-3">
            <input type="text" name="search" class="form-control" placeholder="Search" autocomplete="off" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
            <a href="{{ route('category.index') }}" class="btn btn-success"><i class="fa-solid fa-xmark"></i> Reset</a>
        </div>
    </form>
    {{-- end of search --}}
    
    {{-- Table --}}
    <div class="table-responsive">
        <table class="table table-striped">
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
                            <td>{{ $categories->firstItem() + $loop->index }}</td>
                            <td>{{ $data->category }}</td>
                            <td>
                                <form action="{{ route('category.delete', $data->id) }}" method="post" id="delete">
                                    @csrf
                                    @method('DELETE')
                                    <div class="btn-group">
                                        <a href="{{ route('category.edit', $data->id) }}" class="btn btn-success"><span data-feather="edit"></span> Edit</a>
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

    {{ $categories->withQueryString()->links() }}

    <script>
        $('#delete').submit(function(e) {
            let form = this;
            e.preventDefault();

            Swal.fire({
                icon: 'warning',
                text: 'Delete device category?',
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
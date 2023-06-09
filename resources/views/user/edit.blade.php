@extends('template.dashboard')

@section('title')
    Edit user account
@endsection

@section('side_title')
    <form action="{{ route('user.delete', $user->id) }}" method="post" id="delete">
        @csrf
        @method('DELETE')
        <div class="btn-group">
            <a href="{{ route('user.index') }}" class="btn btn-success"><i class="fa-solid fa-chevron-left"></i> Back</a>
            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Delete</button>
        </div>
    </form>
@endsection

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 col-sm-12">

                <h4>User Details</h4>
                {{-- user details --}}
                <form action="{{ route('user.updateDetail', $user->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    {{-- name input --}}
                    <div class="mb-3">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" autocomplete="off" value="@if($errors->has('name')) {{ old('name') }} @else{{ $user->name }}@endif">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- email input --}}
                    <div class="mb-3">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email@mail.com" autocomplete="off" value="@if($errors->has('email')) {{ old('email') }} @else {{ $user->email }} @endif">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- button --}}
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                    </div>
                </form>

                {{-- user password --}}
                <h4>User Password</h4>
                <form action="{{ route('user.updatePassword', $user->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="">New Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" autocomplete="off" placeholder="New Password">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- button --}}
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
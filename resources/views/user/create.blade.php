@extends('template.dashboard')

@section('title')
    Create new user
@endsection

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-7 col-sm-12">
                <form action="{{ route('user.store') }}" method="post">
                    @csrf
                    
                    {{-- name input --}}
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="name" autocomplete="off" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- email input --}}
                    <div class="mb-3">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email@mail.com" autocomplete="off" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- password input --}}
                    <div class="mb-3">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" autocomplete="off">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- button --}}
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Create</button>
                        <a href="{{ url()->previous() }}" class="btn btn-danger"><i class="fa-solid fa-xmark"></i> Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
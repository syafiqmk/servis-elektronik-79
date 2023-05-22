@extends('template.dashboard')

@section('title')
    Add new device
@endsection

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 col-sm-12">
                <form action="" method="post">
                    @csrf

                    {{-- image --}}
                    <div class="mb-3">
                        <label for="">Image</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
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

                    {{-- device category --}}
                    <div class="mb-3">
                        <label for="">Category<span class="text-danger">*</span></label>
                        <select name="category" class="form-select">
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}" {{ (old('category') == $item->id) ? 'selected' : '' }}>{{ $item->category }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- phone number --}}
                    <div class="mb-3">
                        <label for="">Phone Number</label>
                        <input type="number" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone Number" autocomplete="off">
                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- detail --}}
                    <div class="mb-3">
                        <label for="">Detail<span class="text-danger">*</span></label>
                        <textarea name="detail" class="form-control">{{ old('detail') }}</textarea>
                        @error('detail')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- button --}}
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
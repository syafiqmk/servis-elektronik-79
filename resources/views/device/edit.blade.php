@extends('template.dashboard')

@section('title')
    Edit device
@endsection

@section('side_title')
    <a href="{{ route('device.show', $device->id) }}" class="btn btn-success"><i class="fa-solid fa-chevron-left"></i> Back</a>
@endsection

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 col-sm-12">
                <form action="{{ route('device.update', $device->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- image --}}
                    <div class="mb-3">
                        <label for="">Image</label>
                        @if ($device->image != NULL)
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('image/device'.'/'.$device->image) }}" class="img-thumbnail" width="500">
                        </div>
                        @endif
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
                                <option value="{{ $item->id }}" {{ ((($errors->has('category')) ? old('category') : $device->category_id) == $item->id) ? 'selected' : '' }}>{{ $item->category }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- phone number --}}
                    <div class="mb-3">
                        <label for="">Phone Number</label>
                        <input type="number" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone Number" autocomplete="off" value="@if($errors->has('phone')){{ old('phone') }}@else{{ $device->phone_number }}@endif">
                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- detail --}}
                    <div class="mb-3">
                        <label for="">Detail<span class="text-danger">*</span></label>
                        <textarea name="detail" class="form-control">{{ ($errors->has('detail')) ? old('detail') : $device->detail }}</textarea>
                        @error('detail')
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
@endsection
@extends('template.dashboard')

@section('title')
    Edit category : {{ $category->category }}
@endsection

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-6 col-sm-12">
            <form action="{{ route('category.update', $category->id) }}" method="post">
                @csrf
                @method('PUT')
                {{-- Category input --}}
                <div class="mb-3">
                    <label for="">Category</label>
                    <input type="text" name="category" class="form-control @error('category') is-invalid @enderror" placeholder="Category" autocomplete="off" value="@if($errors->has('category')){{ old('category') }}@else{{ $category->category }}@endif">
                    @error('category')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                {{-- button --}}
                <div class="mb-3">
                    <button class="btn btn-primary"><i class="fa-solid fa-plus"></i> Save</button>
                    <a href="{{ url()->previous() }}" class="btn btn-danger"><i class="fa-solid fa-xmark"></i> Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
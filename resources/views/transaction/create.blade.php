@extends('template.dashboard')

@section('title')
    New transaction
@endsection

@section('side_title')
    <a href="{{ route('device.show', $device) }}" class="btn btn-success"><i class="fa-solid fa-chevron-left"></i> Back</a>
@endsection

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 col-sm-12">
                <form action="{{ route('transaction.store', $device->id) }}" method="post" enctype="multipart/form-data">
                    @csrf

                    {{-- type input --}}
                    <div class="mb-3">
                        <label for="">Type<span class="text-danger">*</span></label>
                        <select name="type" class="form-select @error('type') is-invalid @enderror">
                            <option value="Proses" {{ (old('type') == 'Proses') ? 'selected' : '' }}>Proses</option>
                            <option value="Belum Diambil" {{ (old('type') == 'Belum Diambil') ? 'selected' : '' }}>Belum Diambil</option>
                            <option value="Sudah Diambil" {{ (old('type') == 'Sudah Diambil') ? 'selected' : '' }}>Sudah Diambil</option>
                            <option value="Batal" {{ (old('type') == 'Batal') ? 'selected' : '' }}>Batal</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    {{-- end of type input --}}

                    {{-- image input --}}
                    <div class="mb-3">
                        <label for="">Image</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    {{-- end of image input --}}

                    {{-- detail input --}}
                    <div class="mb-3">
                        <label for="">Detail<span class="text-danger">*</span></label>
                        <textarea name="detail">{{ old('detail') }}</textarea>
                    </div>
                    {{-- end of detail input --}}

                    {{-- button --}}
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Submit</button>
                    </div>
                    {{-- end of button --}}
                </form>
            </div>
        </div>
    </div>
@endsection
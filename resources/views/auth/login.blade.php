<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    
    {{-- Links --}}
    {{-- bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    {{-- feather icons --}}
    <script src="https://unpkg.com/feather-icons"></script>
    {{-- fontawesome --}}
    <script src="https://kit.fontawesome.com/c8ae339e7b.js" crossorigin="anonymous"></script>
    {{-- sweetalert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    {{-- TinyMce --}}
    <script src="https://cdn.tiny.cloud/1/36rw5ypvwnxo4vmew1ajhrf3zl3j8wlomjwgkk6smign4cx2/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body>
    
    <div class="container">
        <div class="row d-flex justify-content-center vh-100 align-items-center">
            <div class="col-md-5">
                <h4>Login</h4>

                <form action="{{ route('auth.login') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email@mail.com" autocomplete="off" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" autocomplete="off" placeholder="Password">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-right-to-bracket"></i> Login</button>
                            <a href="{{ route('home') }}" class="btn btn-danger"><i class="fa-solid fa-xmark"></i> Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    {{-- script --}}
    {{-- bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    {{-- feather icons --}}
    <script>
        feather.replace()
    </script>
    {{-- TinyMce --}}
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });
    </script>
</body>
</html>
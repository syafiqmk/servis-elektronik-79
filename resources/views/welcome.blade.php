<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Servis Elektronik "79"</title>

    <style>
        html {
            scroll-behavior: smooth;
        }

        .tx-justify {
            text-align: justify;
        }
    </style>
    
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

    {{-- navbar --}}
    <div class="fixed-top py-2 px-3 bg-primary">
        <div class="container">
            <span class="fs-6 text-white">Servis Elektronik "79"</span>
            @if (auth()->check())
                <a href="{{ route('dashboard') }}" class="text-white float-end">Dashboard</a>
            @else
                <a href="{{ route('auth.login') }}" class="text-white float-end">Login</a>
            @endif
        </div>
    </div>
    {{-- end of navbar --}}

    {{-- content --}}
    {{-- header --}}
    <div class="container-fluid vh-100 bg-primary d-flex justify-content-center align-items-center text-white">
        <div class="text-center">
            <h1>Servis Elektronik "79"</h1>
            <a href="#jasa" class="btn btn-outline-light">Selengkapnya</a>
        </div>
    </div>
    {{-- end of header --}}

    {{-- jasa --}}
    <div class="container py-5 mb-3" id="jasa">
        <h2>Jasa Kami</h2>
        <div class="d-flex justify-content-center mb-3">
            <img src="/image/perangkat-elektronik.jpg" alt="" class="img-thumbnail" width="500">
        </div>
        <p class="tx-justify">Apakah perangkat elektronik Anda mengalami masalah? Jangan khawatir! Kami di sini untuk membantu Anda. Kami adalah ahli dalam jasa reparasi perangkat elektronik yang siap memberikan solusi cepat dan efektif bagi semua masalah elektronik Anda.

        Dengan pengalaman bertahun-tahun di industri ini, kami memahami betapa pentingnya perangkat elektronik dalam kehidupan sehari-hari. Oleh karena itu, kami berkomitmen untuk memberikan layanan terbaik kepada pelanggan kami.</p>
    </div>
    {{-- end of jasa --}}

    {{-- kontak --}}
    <div class="bg-primary text-white py-5">
        <div class="container">
            <div class="h2">Kontak</div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d498.706588617801!2d117.15186875313519!3d-0.5220446959531964!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df67f3dca72dcc3%3A0xe24cc287cb610353!2sSarana%20Mitra%20Elektrindo!5e0!3m2!1sid!2sid!4v1685946055881!5m2!1sid!2sid" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="mb-3">
                        <h4>No.HP / Whatsapp</h4>
                        <h6>+62-853-9330-9196</h6>
                    </div>

                    <div class="mb-3">
                        <h4>Alamat</h4>
                        <h6>Jl.Mangkupalas Rt.20 No.61 Kel.Mesjid Kec.Samarinda Seberang Kota Samarinda</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end of kontak --}}
    {{-- end of content --}}

    {{-- footer --}}
    <div class="bg-dark text-white py-5">
        <div class="container text-center">
            <p>Dibuat oleh ❣Syafiq Muhammad Kahfi❣</p>
            <p>Aplikasi ini dibuat untuk menyelesaikan tugas akhir sebagai syarat untuk menyelesaikan pendidikan D3 Program Studi Teknik Informatika</p>
        </div>
    </div>
    {{-- end of footer --}}

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
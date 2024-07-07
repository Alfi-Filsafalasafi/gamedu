<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME', 'Laravel') }} - 404</title>

    @include('layouts.scripts.css')
</head>

<main>
    <div class="container">

        <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
            <h1>404</h1>
            <h2>Halaman yang anda tuju tidak tersedia</h2>
            <a class="btn" href="{{ route('welcome') }}">Kembali ke home</a>
        </section>

    </div>
</main>

<body>


    @include('layouts.scripts.js')
</body>

</html>

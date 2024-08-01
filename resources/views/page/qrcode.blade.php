<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/style-saya.css') }}">
    <title>File Surat</title>
</head>

<body>
    <div class="container">
        <div class="bro row justify-content-center align-items-center">
            <div class="col-md-12">
                <h1 class="text-center">Dokumen ini ditanda tangani secara digital menggunakan QRcode</h1>
                <div class="text-center">
                <a class="btn btn-primary text-white" href="{{ asset($surat) }}" target="_blank">Lihat File Surat</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

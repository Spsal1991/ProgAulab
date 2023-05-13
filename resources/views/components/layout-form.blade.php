<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BoomBuy</title>
    <link rel="shortcut icon" href="/Media-Css/logo2.png" type="image/png">

    {{-- fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Rubik:wght@700&display=swap" rel="stylesheet">

    <!--CDN FONTAWSOME-->
    <script src="https://kit.fontawesome.com/d83d50a182.js" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    {{-- <link rel="stylesheet" href="/node_modules/@splidejs/splide/dist/css/splide.min.css"> --}}

</head>

<body>




    @if (session('message'))
    <div class="alert alert-success">
        <p class="my-0">{{ session('message') }}</p>
    </div>
    @endif

    <div class="container-fluid">
        {{ $slot }}
    </div>

    @livewireScripts




</body>

</html>
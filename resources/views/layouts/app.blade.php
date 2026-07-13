<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GSCRI</title>

    <link rel="stylesheet"
          href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

    @vite(['resources/css/app.css','resources/js/app.js'])

</head>

<body>

    <div class="app">

        @include('partials.sidebar')

        <div class="main">

            @include('partials.navbar')

            <main class="content">

                @yield('content')

            </main>

        </div>

    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

</body>

</html>
<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GSCRI</title>

    <!-- Leaflet CSS -->
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

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- Script dari setiap halaman -->
    @stack('scripts')

</body>

</html>
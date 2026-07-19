@extends('layouts.app')

@section('content')

<div class="hero">

    <div class="hero-left">

        <span class="hero-tag">
            🌍 GSCRI Dashboard
        </span>

        <h1>
            Global Supply Chain Risk
            <span>Intelligence</span>
        </h1>

        <p>
            Monitor risiko rantai pasok global secara real-time
            melalui data ekonomi, cuaca, pelabuhan,
            berita internasional, dan analisis risiko.
        </p>

        <div style="margin-top:25px;">

            <strong>
                👋 Welcome,
                {{ auth()->user()->name }}
            </strong>

            <br><br>

            @if(auth()->user()->role=='admin')

                <span class="trend trend-down">
                    Administrator
                </span>

            @else

                <span class="trend trend-up">
                    User
                </span>

            @endif

        </div>

    </div>

    <div class="hero-right">

        <div class="status-card">

            <small>System Status</small>

            <h2>LIVE</h2>

            <span>Monitoring Active</span>

        </div>

        <div class="update-card">

            <small>Last Update</small>

            <h3>{{ now()->format('d M Y') }}</h3>

            <span>{{ now()->format('H:i') }}</span>

        </div>

    </div>

</div>
<div class="stats">

    <div class="stat-card">

        <div class="stat-header">

            <div class="stat-icon">🌍</div>

            <span class="trend trend-up">Live</span>

        </div>

        <span class="stat-label">
            TOTAL COUNTRIES
        </span>

        <h2>{{ $totalCountries }}</h2>

        <p>Total negara dalam database</p>

    </div>

    <div class="stat-card">

        <div class="stat-header">

            <div class="stat-icon">⚓</div>

            <span class="trend trend-up">Active</span>

        </div>

        <span class="stat-label">
            TOTAL PORTS
        </span>

        <h2>{{ $totalPorts }}</h2>

        <p>Total pelabuhan</p>

    </div>

    <div class="stat-card">

        <div class="stat-header">

            <div class="stat-icon">📈</div>

        </div>

        <span class="stat-label">
            AVG GDP
        </span>

        <h2>{{ number_format($avgGdp,2) }}%</h2>

        <p>Average GDP</p>

    </div>

    <div class="stat-card">

        <div class="stat-header">

            <div class="stat-icon">💰</div>

        </div>

        <span class="stat-label">
            AVG INFLATION
        </span>

        <h2>{{ number_format($avgInflation,2) }}%</h2>

        <p>Average Inflation</p>

    </div>

</div>
<div class="dashboard-grid">

    <!-- Global Risk Map -->
    <div class="panel large">

        <h3>🌍 Global Risk Map</h3>

        <div id="worldMap"></div>

        <script>

            window.countries = @json($countries);

            window.riskData = {

                low: {{ $lowRisk }},

                medium: {{ $mediumRisk }},

                high: {{ $highRisk }}

            };

        </script>

    </div>

    <!-- Latest News -->
    <div class="panel">

        <h3>📰 Latest News</h3>

        @forelse($news as $article)

            <div style="margin-bottom:15px;padding-bottom:12px;border-bottom:1px solid #eee;">

                <strong>

                    <a href="{{ $article['url'] }}" target="_blank">

                        {{ $article['title'] }}

                    </a>

                </strong>

                <br>

                <small>

                    {{ $article['source']['name'] ?? '-' }}

                </small>

            </div>

        @empty

            <p>Tidak ada berita.</p>

        @endforelse

    </div>

    <!-- Risk Distribution -->
    <div class="panel">

        <h3>📊 Risk Distribution</h3>

        <canvas id="riskChart" height="220"></canvas>

    </div>

    <!-- Weather -->
    <div class="panel">

        <h3>🌦️ Weather</h3>

        @forelse($weatherCountries as $country)

            <div style="display:flex;justify-content:space-between;margin-bottom:12px;">

                <strong>{{ $country->name }}</strong>

                <span>{{ $country->weather }}</span>

            </div>

        @empty

            <p>Tidak ada data cuaca.</p>

        @endforelse

    </div>

</div>

@endsection
@push('scripts')

<script>

const chartCanvas = document.getElementById('riskChart');

if (chartCanvas) {

    new Chart(chartCanvas, {

        type: 'doughnut',

        data: {

            labels: [

                'Low',

                'Medium',

                'High'

            ],

            datasets: [{

                data: [

                    {{ $lowRisk }},

                    {{ $mediumRisk }},

                    {{ $highRisk }}

                ],

                backgroundColor: [

                    '#22c55e',

                    '#facc15',

                    '#ef4444'

                ],

                borderWidth: 0

            }]

        },

        options: {

            responsive: true,

            plugins: {

                legend: {

                    position: 'bottom'

                }

            }

        }

    });

}

</script>

@endpush
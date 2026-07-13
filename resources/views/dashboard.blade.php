@extends('layouts.app')

@section('content')

<div class="hero">

    <div class="hero-content">

        <div>

            <h1>🌍 Global Supply Chain Risk </h1>

            <p>
                Monitor risiko rantai pasok global secara real-time
                melalui data ekonomi, cuaca, pelabuhan,
                berita internasional, dan analisis risiko.
            </p>

        </div>

        <div class="hero-status">

            <span class="live">
                <span class="live-dot"></span>
                Live Monitoring
            </span>

            <small>
                Last Update :
                {{ now()->format('d M Y H:i') }}
            </small>

        </div>

    </div>

</div>
{{-- Statistic --}}
<div class="stats">

    <!-- Total Countries -->
    <div class="stat-card">

        <div class="stat-header">
            <div class="stat-icon">🌍</div>
            <div class="trend trend-up">Live</div>
        </div>

        <span class="stat-label">TOTAL COUNTRIES</span>

        <h2>{{ $totalCountries }}</h2>

        <p>Total negara dalam database</p>

    </div>

    <!-- Total Ports -->
<div class="stat-card">

    <div class="stat-header">
        <div class="stat-icon">⚓</div>
        <div class="trend trend-up">Active</div>
    </div>

    <span class="stat-label">TOTAL PORTS</span>

    <h2>{{ $totalPorts }}</h2>

    <p>Total pelabuhan dalam database</p>

</div>
 <!-- Average GDP -->
<div class="stat-card">

    <div class="stat-header">
        <div class="stat-icon">📈</div>
    </div>

    <span class="stat-label">AVG GDP</span>

    <h2>{{ number_format($avgGdp,2) }}%</h2>

    <p>Rata-rata GDP</p>

</div>
<!-- Average Inflation -->
<div class="stat-card">

    <div class="stat-header">
        <div class="stat-icon">💰</div>
    </div>

    <span class="stat-label">AVG INFLATION</span>

    <h2>{{ number_format($avgInflation,2) }}%</h2>

    <p>Rata-rata inflasi</p>

</div>
    <!-- Low Risk -->
    <div class="stat-card">

        <div class="stat-header">
            <div class="stat-icon">🟢</div>
            <div class="trend trend-up">LOW</div>
        </div>

        <span class="stat-label">LOW RISK</span>

        <h2>{{ $lowRisk }}</h2>

        <p>Negara berisiko rendah</p>

    </div>

    <!-- Medium Risk -->
    <div class="stat-card">

        <div class="stat-header">
            <div class="stat-icon">🟡</div>
            <div class="trend trend-up">MEDIUM</div>
        </div>

        <span class="stat-label">MEDIUM RISK</span>

        <h2>{{ $mediumRisk }}</h2>

        <p>Negara berisiko sedang</p>

    </div>

    <!-- High Risk -->
    <div class="stat-card">

        <div class="stat-header">
            <div class="stat-icon">🔴</div>
            <div class="trend trend-down">HIGH</div>
        </div>

        <span class="stat-label">HIGH RISK</span>

        <h2>{{ $highRisk }}</h2>

        <p>Negara berisiko tinggi</p>

    </div>

</div>

{{-- Dashboard Grid --}}
<div class="dashboard-grid">

    {{-- Global Risk Map --}}
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

    {{-- Latest News --}}
<div class="panel">

    <h3>📰 Berita Terkini</h3>

    @forelse($news as $article)

        <div style="margin-bottom:15px; border-bottom:1px solid #eee; padding-bottom:10px;">

            <strong>
                <a href="{{ $article['url'] }}" target="_blank">
                    {{ $article['title'] }}
                </a>
            </strong>

            <br>

            <small>
                {{ $article['source']['name'] ?? '-' }}
                •
                {{ \Carbon\Carbon::parse($article['publishedAt'])->format('d M Y H:i') }}
            </small>

        </div>

    @empty

        <p>Belum ada berita.</p>

    @endforelse

</div>

    {{-- Risk Distribution --}}
    <div class="panel">

        <h3>📊 Risk Distribution</h3>

        <canvas id="riskChart" height="250"></canvas>

    </div>

    {{-- Weather --}}
<div class="panel">

    <h3>🌦️ Cuaca Global</h3>

    @forelse($weatherCountries as $country)

        <div style="display:flex;justify-content:space-between;margin-bottom:12px;border-bottom:1px solid #eee;padding-bottom:8px;">

            <div>
                <strong>{{ $country->name }}</strong>
            </div>

            <div>
                {{ $country->weather }}
            </div>

        </div>

    @empty

        <p>Belum ada data cuaca.</p>

    @endforelse

</div>

</div>
@endsection
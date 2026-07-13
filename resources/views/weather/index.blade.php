@extends('layouts.app')

@section('content')

<div class="panel">

    <div class="panel-header">

        <h2>🌦️ Global Weather Monitoring</h2>

    </div>

    <table class="table">

        <thead>

            <tr>
                <th>Country</th>
                <th>Temperature</th>
                <th>Humidity</th>
                <th>Wind</th>
                <th>Condition</th>
            </tr>

        </thead>

        <tbody>

        @forelse($weatherData as $weather)

            <tr>

                <td>{{ $weather['country'] }}</td>

                <td>{{ $weather['temperature'] }} °C</td>

                <td>{{ $weather['humidity'] }} %</td>

                <td>{{ $weather['wind'] }} m/s</td>

                <td>{{ $weather['condition'] }}</td>

            </tr>

        @empty

            <tr>

                <td colspan="5" style="text-align:center;">
                    Data cuaca belum tersedia.
                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection
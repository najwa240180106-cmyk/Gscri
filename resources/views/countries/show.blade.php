@extends('layouts.app')

@section('content')

<div class="panel">

    <div class="panel-header">
        <h2>🌍 {{ $country->name }}</h2>
    </div>

    <table class="table">

        <tr>
            <th width="220">Country</th>
            <td>{{ $country->name }}</td>
        </tr>

        <tr>
            <th>Region</th>
            <td>{{ $country->region ?? '-' }}</td>
        </tr>

        <tr>
            <th>Currency</th>
            <td>{{ $country->currency ?? '-' }}</td>
        </tr>

        <tr>
            <th>GDP</th>
            <td>{{ $country->gdp }}</td>
        </tr>

        <tr>
            <th>Inflation</th>
            <td>{{ $country->inflation }}</td>
        </tr>

        <tr>
            <th>Weather</th>
            <td>{{ $country->weather }}</td>
        </tr>

        <tr>
            <th>Risk</th>
            <td>{{ $country->risk }}</td>
        </tr>

        <tr>
            <th>Port</th>
            <td>{{ $country->port }}</td>
        </tr>

    </table>

    <br>

    <a href="{{ route('countries.index') }}" class="btn btn-primary">
        ← Back
    </a>

</div>

@endsection
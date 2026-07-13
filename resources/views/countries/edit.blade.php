@extends('layouts.app')

@section('content')

<div class="panel">

    <h2>✏️ Edit Country</h2>

    <form action="{{ route('countries.update', $country) }}" method="POST">

        @csrf
        @method('PUT')

        <div style="margin-bottom:15px;">
            <label>Nama Negara</label><br>
            <input type="text" name="name" value="{{ $country->name }}" required>
        </div>

        <div style="margin-bottom:15px;">
            <label>Risk</label><br>

            <select name="risk">

                <option value="LOW" {{ $country->risk == 'LOW' ? 'selected' : '' }}>LOW</option>

                <option value="MEDIUM" {{ $country->risk == 'MEDIUM' ? 'selected' : '' }}>MEDIUM</option>

                <option value="HIGH" {{ $country->risk == 'HIGH' ? 'selected' : '' }}>HIGH</option>

            </select>

        </div>

        <div style="margin-bottom:15px;">
            <label>GDP</label><br>
            <input type="number" step="0.01" name="gdp" value="{{ $country->gdp }}" required>
        </div>

        <div style="margin-bottom:15px;">
            <label>Inflation</label><br>
            <input type="number" step="0.01" name="inflation" value="{{ $country->inflation }}" required>
        </div>

        <div style="margin-bottom:15px;">
            <label>Weather</label><br>
            <input type="text" name="weather" value="{{ $country->weather }}" required>
        </div>

        <div style="margin-bottom:15px;">
            <label>Port</label><br>
            <input type="text" name="port" value="{{ $country->port }}" required>
        </div>

        <div style="margin-bottom:15px;">
            <label>Latitude</label><br>
            <input type="number" step="0.000001" name="latitude" value="{{ $country->latitude }}" required>
        </div>

        <div style="margin-bottom:15px;">
            <label>Longitude</label><br>
            <input type="number" step="0.000001" name="longitude" value="{{ $country->longitude }}" required>
        </div>

        <button class="btn-primary">
            💾 Update Negara
        </button>

    </form>

</div>

@endsection
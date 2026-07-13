@extends('layouts.app')

@section('content')

<div class="panel">

    <h2>➕ Tambah Negara</h2>

    <form action="{{ route('countries.store') }}" method="POST">

        @csrf

        <div style="margin-bottom:15px;">
            <label>Nama Negara</label><br>
            <input type="text" name="name" required>
        </div>

        <div style="margin-bottom:15px;">
            <label>Risk</label><br>
            <select name="risk">
                <option value="LOW">LOW</option>
                <option value="MEDIUM">MEDIUM</option>
                <option value="HIGH">HIGH</option>
            </select>
        </div>

        <div style="margin-bottom:15px;">
            <label>GDP</label><br>
            <input type="number" step="0.01" name="gdp" required>
        </div>

        <div style="margin-bottom:15px;">
            <label>Inflation</label><br>
            <input type="number" step="0.01" name="inflation" required>
        </div>

        <div style="margin-bottom:15px;">
            <label>Weather</label><br>
            <input type="text" name="weather" required>
        </div>

        <div style="margin-bottom:15px;">
            <label>Port</label><br>
            <input type="text" name="port" required>
        </div>

        <div style="margin-bottom:15px;">
            <label>Latitude</label><br>
            <input type="number" step="0.000001" name="latitude" required>
        </div>

        <div style="margin-bottom:15px;">
            <label>Longitude</label><br>
            <input type="number" step="0.000001" name="longitude" required>
        </div>

        <button class="btn-primary">
            💾 Simpan Negara
        </button>

    </form>

</div>

@endsection
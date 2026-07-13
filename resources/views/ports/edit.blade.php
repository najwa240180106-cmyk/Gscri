@extends('layouts.app')

@section('content')

<div class="panel">

    <div class="panel-header">
        <h2>✏️ Edit Port</h2>
    </div>

    <form action="{{ route('ports.update', $port) }}" method="POST">

        @csrf
        @method('PUT')

        <div style="margin-bottom:15px;">
            <label>Country</label><br>

            <select name="country_id">

                @foreach($countries as $country)

                    <option value="{{ $country->id }}"
                        {{ $country->id == $port->country_id ? 'selected' : '' }}>
                        {{ $country->name }}
                    </option>

                @endforeach

            </select>

        </div>

        <div style="margin-bottom:15px;">
            <label>Nama Port</label><br>
            <input type="text"
                   name="name"
                   value="{{ $port->name }}">
        </div>

        <div style="margin-bottom:15px;">
            <label>Status</label><br>

            <select name="status">

                <option value="Active"
                    {{ $port->status == 'Active' ? 'selected' : '' }}>
                    Active
                </option>

                <option value="Closed"
                    {{ $port->status == 'Closed' ? 'selected' : '' }}>
                    Closed
                </option>

            </select>

        </div>

        <div style="margin-bottom:15px;">
            <label>Capacity</label><br>
            <input type="text"
                   name="capacity"
                   value="{{ $port->capacity }}">
        </div>

        <div style="margin-bottom:15px;">
            <label>Risk</label><br>

            <select name="risk">

                <option value="LOW"
                    {{ $port->risk == 'LOW' ? 'selected' : '' }}>
                    LOW
                </option>

                <option value="MEDIUM"
                    {{ $port->risk == 'MEDIUM' ? 'selected' : '' }}>
                    MEDIUM
                </option>

                <option value="HIGH"
                    {{ $port->risk == 'HIGH' ? 'selected' : '' }}>
                    HIGH
                </option>

            </select>

        </div>

        <div style="margin-bottom:15px;">
            <label>Latitude</label><br>
            <input type="text"
                   name="latitude"
                   value="{{ $port->latitude }}">
        </div>

        <div style="margin-bottom:15px;">
            <label>Longitude</label><br>
            <input type="text"
                   name="longitude"
                   value="{{ $port->longitude }}">
        </div>

        <button type="submit" class="btn-primary">
            💾 Update Port
        </button>

        <a href="{{ route('ports.index') }}" class="btn-edit">
            ← Kembali
        </a>

    </form>

</div>

@endsection
@extends('layouts.app')

@section('content')

<div class="panel">

    <div class="panel-header">
        <h2>⚓ {{ $port->name }}</h2>
    </div>

    <table class="table">

        <tr>
            <th width="220">Port</th>
            <td>{{ $port->name }}</td>
        </tr>

        <tr>
            <th>Country</th>
            <td>{{ $port->country->name ?? '-' }}</td>
        </tr>

        <tr>
            <th>Status</th>
            <td>{{ $port->status }}</td>
        </tr>

        <tr>
            <th>Capacity</th>
            <td>{{ number_format($port->capacity) }}</td>
        </tr>

        <tr>
            <th>Risk</th>
            <td>{{ $port->risk }}</td>
        </tr>

        <tr>
            <th>Latitude</th>
            <td>{{ $port->latitude }}</td>
        </tr>

        <tr>
            <th>Longitude</th>
            <td>{{ $port->longitude }}</td>
        </tr>

    </table>

    <br>

    <a href="{{ route('ports.index') }}" class="btn btn-primary">
        ← Back
    </a>

</div>

@endsection
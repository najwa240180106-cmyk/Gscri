@extends('layouts.app')

@section('content')

<div class="panel">

    <div class="panel-header">
        <h2>📈 Global Economy Monitoring</h2>
    </div>
    @if(auth()->user()->isAdmin())

    <div style="margin:20px 0;">

        <form action="{{ route('economy.update') }}" method="POST">

            @csrf

            <button class="btn btn-primary">
                🔄 Update Economy Data
            </button>

        </form>

    </div>

@endif

@if(session('success'))

    <div class="alert alert-success">
        {{ session('success') }}
    </div>

@endif

    <table class="table">

        <thead>
            <tr>
                <th>Country</th>
                <th>Region</th>
                <th>GDP Growth</th>
                <th>Inflation</th>
                <th>Weather</th>
                <th>Risk</th>
            </tr>
        </thead>

        <tbody>

        @forelse($countries as $country)

            <tr>

                <td>{{ $country->name }}</td>

                <td>{{ $country->region ?? '-' }}</td>

                <td>
                    {{ $country->gdp ? number_format($country->gdp,2).'%' : '-' }}
                </td>

                <td>
                    {{ $country->inflation ? number_format($country->inflation,2).'%' : '-' }}
                </td>

                <td>{{ $country->weather ?? '-' }}</td>

                <td>

                    @if($country->risk == 'LOW')

                        <span class="badge badge-low">
                            🟢 LOW
                        </span>

                    @elseif($country->risk == 'MEDIUM')

                        <span class="badge badge-medium">
                            🟡 MEDIUM
                        </span>

                    @else

                        <span class="badge badge-high">
                            🔴 HIGH
                        </span>

                    @endif

                </td>

            </tr>

        @empty

            <tr>
                <td colspan="6" style="text-align:center;">
                    Belum ada data ekonomi.
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection
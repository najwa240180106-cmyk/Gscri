@extends('layouts.app')

@section('content')

<div class="panel">

    <div class="panel-header">
        <h2>🚨 Global Supply Chain Risk Analysis</h2>

        @if(auth()->user()->isAdmin())
            <form action="{{ route('risk.update') }}" method="POST" style="margin-top:10px;">
                @csrf
                <button type="submit" class="btn btn-primary">
                    🔄 Update Risk Analysis
                </button>
            </form>
        @endif

        @if(session('success'))
            <div class="alert alert-success" style="margin-top:10px;">
                {{ session('success') }}
            </div>
        @endif

    </div>

    <table class="table">

        <thead>
            <tr>
                <th>Country</th>
                <th>GDP Growth</th>
                <th>Inflation</th>
                <th>Weather</th>
                <th>Risk Score</th>
                <th>Risk Level</th>
            </tr>
        </thead>

        <tbody>

        @forelse($countries as $country)

            <tr>

                <td>{{ $country->name }}</td>

                <td>
                    {{ $country->gdp ? number_format($country->gdp,2).'%' : '-' }}
                </td>

                <td>
                    {{ $country->inflation ? number_format($country->inflation,2).'%' : '-' }}
                </td>

                <td>{{ $country->weather ?? '-' }}</td>

                <td>
                    <strong>{{ $country->score }}</strong> / 3
                </td>

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
                    Belum ada data risk analysis.
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection
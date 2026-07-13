@extends('layouts.app')

@section('content')

<div class="panel">

    <div class="panel-header">
        <h2>🚨 Risk Analysis</h2>
    </div>

    <table class="table">

        <thead>
            <tr>
                <th>Country</th>
                <th>GDP</th>
                <th>Inflation</th>
                <th>Weather</th>
                <th>Score</th>
                <th>Risk</th>
            </tr>
        </thead>

        <tbody>

        @forelse($countries as $country)

            <tr>

                <td>{{ $country->name }}</td>

                <td>{{ number_format($country->gdp, 2) }}%</td>

                <td>{{ number_format($country->inflation, 2) }}%</td>

                <td>{{ $country->weather }}</td>

                <td>{{ $country->score }}</td>

                <td>
                    @if($country->risk == 'LOW')
                        <span class="badge badge-low">🟢 LOW</span>
                    @elseif($country->risk == 'MEDIUM')
                        <span class="badge badge-medium">🟡 MEDIUM</span>
                    @else
                        <span class="badge badge-high">🔴 HIGH</span>
                    @endif
                </td>

            </tr>

        @empty

            <tr>
                <td colspan="6" style="text-align:center;">
                    Belum ada data.
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection
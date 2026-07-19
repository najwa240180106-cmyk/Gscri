@extends('layouts.app')

@section('content')

<div class="panel">

    <div class="panel-header">
        <h2>🌦️ Global Weather Monitoring</h2>

        @if(auth()->user()->isAdmin())
            <form action="{{ route('weather.update') }}" method="POST" style="margin-top:10px;">
                @csrf
                <button type="submit" class="btn btn-primary">
                    🔄 Update Weather Data
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
                <th>Temperature</th>
                <th>Humidity</th>
                <th>Wind Speed</th>
                <th>Condition</th>
            </tr>
        </thead>

        <tbody>

        @forelse($countries as $country)

            <tr>

                <td>{{ $country->name }}</td>

                <td>-</td>

                <td>-</td>

                <td>-</td>

                <td>
                    @if($country->weather == 'Clear')

                        <span class="badge badge-success">
                            ☀️ Clear
                        </span>

                    @elseif($country->weather == 'Clouds')

                        <span class="badge badge-medium">
                            ☁️ Clouds
                        </span>

                    @elseif($country->weather == 'Rain')

                        <span class="badge badge-high">
                            🌧 Rain
                        </span>

                    @elseif($country->weather == 'Thunderstorm')

                        <span class="badge badge-high">
                            ⛈ Thunderstorm
                        </span>

                    @elseif($country->weather)

                        <span class="badge">
                            🌤 {{ $country->weather }}
                        </span>

                    @else

                        <span class="badge">
                            No Data
                        </span>

                    @endif
                </td>

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
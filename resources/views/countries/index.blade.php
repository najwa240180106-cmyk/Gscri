@extends('layouts.app')

@section('content')

<div class="panel">

    <div class="panel-header">
        <h2>🌍 Global Monitoring Countries</h2>
    </div>

    {{-- Import hanya untuk Admin --}}
    @if(auth()->user()->isAdmin())

    <form action="{{ route('countries.import') }}" method="POST" style="margin-bottom:20px;">
        @csrf

        <input
            type="text"
            name="name"
            placeholder="Contoh: Indonesia, Japan, China"
            required>

        <button type="submit">
            Import Country
        </button>
    </form>

    @endif

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert-error">
            {{ session('error') }}
        </div>
    @endif

    <table class="table">

        <thead>
            <tr>
                <th>Country</th>
                <th>Region</th>
                <th>Currency</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

        @forelse($countries as $country)

            <tr>
                <td>{{ $country->name }}</td>
                <td>{{ $country->region ?? '-' }}</td>
                <td>{{ $country->currency ?? '-' }}</td>

               <td>
    <span class="badge badge-success">
        Monitoring
    </span>
</td>

                <td>
    <a href="{{ route('countries.show', $country) }}" class="btn btn-primary">
        View
    </a>
</td>
            </tr>

        @empty

            <tr>
                <td colspan="5" style="text-align:center;">
                    Belum ada data negara.
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection
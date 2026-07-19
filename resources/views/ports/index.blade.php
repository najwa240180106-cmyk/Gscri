@extends('layouts.app')

@section('content')

<div class="panel">

    <div class="panel-header">

        <h2>⚓ Master Data Ports</h2>

    </div>

    {{-- Import Port --}}
    @if(auth()->user()->isAdmin())

<form action="{{ route('ports.import') }}" method="POST" style="margin-bottom:20px;">
    @csrf

    <input
        type="text"
        name="name"
        placeholder="Contoh: Tanjung Priok"
        required>

    <button type="submit" class="btn-primary">
        Import Port
    </button>

    <a href="{{ route('ports.create') }}" class="btn-primary">
        + Tambah Manual
    </a>

</form>

@endif

    @if(session('success'))
        <div style="color:green;margin-bottom:10px;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="color:red;margin-bottom:10px;">
            {{ session('error') }}
        </div>
    @endif

    <table class="table">

        <thead>
            <tr>
                <th>Country</th>
                <th>Port</th>
                <th>Status</th>
                <th>Capacity</th>
                <th>Risk</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

        @forelse($ports as $port)

            <tr>

                <td>{{ $port->country->name }}</td>

                <td>{{ $port->name }}</td>

                <td>{{ $port->status }}</td>

                <td>{{ $port->capacity }}</td>

                <td>
                    @if($port->risk == 'LOW')
                        <span class="badge badge-low">🟢 LOW</span>
                    @elseif($port->risk == 'MEDIUM')
                        <span class="badge badge-medium">🟡 MEDIUM</span>
                    @else
                        <span class="badge badge-high">🔴 HIGH</span>
                    @endif
                </td>

               <td>

    <a href="{{ route('ports.show', $port) }}" class="btn btn-primary">
        View
    </a>

    @if(auth()->user()->isAdmin())

        <a href="{{ route('ports.edit', $port) }}" class="btn-edit">
            ✏️
        </a>

        <form action="{{ route('ports.destroy', $port) }}"
              method="POST"
              style="display:inline;">

            @csrf
            @method('DELETE')

            <button type="submit"
                    class="btn-delete"
                    onclick="return confirm('Yakin ingin menghapus port ini?')">
                🗑️
            </button>

        </form>

    @endif

</td>

            </tr>

        @empty

            <tr>
                <td colspan="6" style="text-align:center;">
                    Belum ada data port.
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

    <br>

    {{ $ports->links() }}

</div>

@endsection
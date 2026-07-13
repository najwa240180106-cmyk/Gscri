@extends('layouts.app')

@section('content')

<div class="panel">

    <div class="panel-header">
        <h2>⚓ Tambah Port</h2>
    </div>

    <form action="{{ route('ports.store') }}" method="POST">

        @csrf

        <div class="form-group">
            <label>Country</label>

            <select name="country_id" class="form-control">

                @foreach($countries as $country)

                    <option value="{{ $country->id }}">
                        {{ $country->name }}
                    </option>

                @endforeach

            </select>
        </div>

        <div class="form-group">
            <label>Nama Port</label>
            <input type="text" name="name" class="form-control">
        </div>

        <div class="form-group">
            <label>Status</label>

            <select name="status" class="form-control">
                <option>Active</option>
                <option>Closed</option>
            </select>

        </div>

        <div class="form-group">
            <label>Capacity</label>
            <input type="text" name="capacity" class="form-control">
        </div>

        <div class="form-group">
            <label>Risk</label>

            <select name="risk" class="form-control">
                <option>LOW</option>
                <option>MEDIUM</option>
                <option>HIGH</option>
            </select>

        </div>

        <div class="form-group">
            <label>Latitude</label>
            <input type="text" name="latitude" class="form-control">
        </div>

        <div class="form-group">
            <label>Longitude</label>
            <input type="text" name="longitude" class="form-control">
        </div>

        <br>

        <button type="submit" class="btn-primary">
    💾 Simpan
</button>
    </form>

</div>

@endsection
@extends('layouts.app')

@section('content')

<div class="panel">

    <div class="panel-header">
        <h2>👤 My Profile</h2>
    </div>

    <div style="padding:20px;">

        <div class="panel" style="margin-bottom:20px;">
            <div style="padding:20px;">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="panel" style="margin-bottom:20px;">
            <div style="padding:20px;">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="panel">
            <div style="padding:20px;">
                @include('profile.partials.delete-user-form')
            </div>
        </div>

    </div>

</div>

@endsection

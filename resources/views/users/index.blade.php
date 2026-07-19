@extends('layouts.app')

@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">

    <h2>User Management</h2>

    <form action="{{ route('logout') }}" method="POST">
        @csrf

        <button class="btn btn-danger">
            🚪 Logout
        </button>
    </form>

</div>
<div class="page-header">
    <h2>👥 User Management</h2>
    <p>Kelola akun Admin dan User.</p>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="panel">

    <table class="table">

        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th width="260">Action</th>
            </tr>
        </thead>

        <tbody>

        @forelse($users as $user)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $user->name }}</td>

                <td>{{ $user->email }}</td>

                <td>
                    @if($user->role == 'admin')
                        <span class="badge badge-danger">👑 ADMIN</span>
                    @else
                        <span class="badge badge-success">👤 USER</span>
                    @endif
                </td>

                <td>

                    @if(auth()->id() != $user->id)

                    <form action="{{ route('users.role', $user) }}"
                          method="POST"
                          style="display:inline;">
                        @csrf
                        @method('PATCH')

                        <input type="hidden"
                               name="role"
                               value="{{ $user->role == 'admin' ? 'user' : 'admin' }}">

                        <button type="submit" class="btn btn-warning">
                            {{ $user->role == 'admin' ? 'Jadikan User' : 'Jadikan Admin' }}
                        </button>

                    </form>

                    <form action="{{ route('users.destroy', $user) }}"
                          method="POST"
                          style="display:inline;">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="btn btn-danger"
                                onclick="return confirm('Yakin ingin menghapus user ini?')">
                            Hapus
                        </button>
                    </form>

                    @else

                        <span class="text-muted">Akun Anda</span>

                    @endif

                </td>

            </tr>

        @empty

            <tr>
                <td colspan="5" style="text-align:center;">
                    Tidak ada user.
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection
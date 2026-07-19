<aside class="sidebar">

    <div class="logo">
        <h2>GSCRI</h2>
        <small>Global Supply Chain Risk Intelligence</small>
    </div>

    <nav class="sidebar-menu">

        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}"
   class="menu {{ request()->routeIs('dashboard') ? 'active' : '' }}">
    📊 Dashboard
</a>

        <div class="menu-title">
            MONITORING
        </div>

        <a href="{{ route('countries.index') }}"
           class="menu {{ request()->is('countries*') ? 'active' : '' }}">
            🌍 Countries
        </a>

        <a href="{{ route('ports.index') }}"
           class="menu {{ request()->is('ports*') ? 'active' : '' }}">
            ⚓ Ports
        </a>

        <a href="{{ route('economy.index') }}"
           class="menu {{ request()->is('economy*') ? 'active' : '' }}">
            📈 Economy
        </a>

        <a href="{{ route('weather.index') }}"
           class="menu {{ request()->is('weather*') ? 'active' : '' }}">
            🌦 Weather
        </a>

        <a href="{{ route('news.index') }}"
           class="menu {{ request()->is('news*') ? 'active' : '' }}">
            📰 News
        </a>

        <a href="{{ route('risk.index') }}"
           class="menu {{ request()->is('risk*') ? 'active' : '' }}">
            🚨 Risk Analysis
        </a>

        {{-- Menu Admin --}}
        @if(auth()->user()->isAdmin())

    <div class="menu-title">
        ADMIN PANEL
    </div>

    <a href="{{ route('users.index') }}"
       class="menu {{ request()->is('users*') ? 'active' : '' }}">
        👥 User Management
    </a>

    <a href="{{ route('countries.index') }}"
       class="menu {{ request()->is('countries*') ? 'active' : '' }}">
        🌍 Manage Countries
    </a>

    <a href="{{ route('ports.index') }}"
       class="menu {{ request()->is('ports*') ? 'active' : '' }}">
        ⚓ Manage Ports
    </a>

@endif

        <div class="menu-title">
            ACCOUNT
        </div>

        <a href="{{ route('profile.edit') }}"
           class="menu">
            👤 Profile
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"
                style="
                    width:100%;
                    background:none;
                    border:none;
                    color:inherit;
                    text-align:left;
                    padding:12px 16px;
                    cursor:pointer;
                    font-size:15px;">
                🚪 Logout
            </button>
        </form>

    </nav>

</aside>
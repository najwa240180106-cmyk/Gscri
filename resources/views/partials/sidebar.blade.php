<aside class="sidebar">

    <div class="logo">
        <h2>GSCRI</h2>
        <small>Global Supply Chain Risk Intelligence</small>
    </div>

    <nav class="sidebar-menu">

        {{-- Dashboard --}}
        <a href="{{ url('/') }}"
           class="menu {{ request()->is('/') ? 'active' : '' }}">
            📊 Dashboard
        </a>

        {{-- Master Data --}}
        <div class="menu-title">
            MASTER DATA
        </div>

        <a href="{{ route('countries.index') }}"
           class="menu {{ request()->is('countries*') ? 'active' : '' }}">
            🌍 Countries
        </a>

         <a href="{{ route('ports.index') }}"
             class="menu {{ request()->is('ports*') ? 'active' : '' }}">
             ⚓ Pelabuhan
        </a>
        <a href="{{ route('economy.index') }}"
        class="menu {{ request()->is('economy*') ? 'active' : '' }}">
            📈 Economy
        </a>

       <a href="{{ route('weather.index') }}"
        class="menu {{ request()->is('weather*') ? 'active' : '' }}">
         🌦️ Cuaca
         </a>
        <a href="/news"
        class="menu {{ request()->is('news') ? 'active' : '' }}">
        📰 News
        </a>

        {{-- Analytics --}}
        <div class="menu-title">
            ANALYTICS
        </div>
      <a href="/risk"
         class="menu {{ request()->is('risk*') ? 'active' : '' }}">
         📊 Risk Analysis
        </a>

        {{-- Settings --}}
        <div class="menu-title">
            SYSTEM
        </div>

        <a href="#" class="menu">
            ⚙️ Settings
        </a>

    </nav>

</aside>
<!-- resources/views/layouts/navigation.blade.php -->

<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Sistem Penilaian Prestasi') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                @auth
                    @if(auth()->user()->role === 'superadmin' || auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.index') }}">{{ __('Pengguna') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tempoh-penilaian.index') }}">{{ __('Tempoh Penilaian') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('penilaian.index') }}">{{ __('Penilaian') }}</a>
                        </li>
                    @endif
                    
                    @if(auth()->user()->role === 'ppp' || auth()->user()->role === 'ppk')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('penilaian.index') }}">{{ __('Penilaian') }}</a>
                        </li>
                    @endif
                    
                    @if(auth()->user()->role === 'pyd')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('penilaian.pyd') }}">{{ __('Penilaian Saya') }}</a>
                        </li>
                    @endif
                @endauth
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Log Masuk') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Daftar') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                            <span class="badge bg-secondary">{{ __(ucfirst(Auth::user()->role)) }}</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                {{ __('Profil') }}
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    {{ __('Log Keluar') }}
                                </button>
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
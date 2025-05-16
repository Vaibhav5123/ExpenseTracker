<header class="py-2 bg-white shadow-sm">
    <div class="container-fluid px-3 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <img src="{{ asset('img/ex.jpg') }}" alt="App Icon" width="60" height="60">
            <h1 class="h5 mb-0">Expense Tracker</h1>
        </div>

        @if (Route::has('login'))
            <div class="d-flex gap-2 align-items-center">
                @auth
                    <span class="me-2">Hello, {{ Auth::user()->name }}</span>
                    <a href="{{ url('/dashboard') }}" class="btn btn-outline-primary">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline-primary">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</header>

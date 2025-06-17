<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">Bookstore</a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('books.index') }}">Books</a>
                    </li>
                    @if (!Auth::user()->isAdmin())
                        <li class="nav-item">
                        <a class="nav-link" href="{{ route('invoices.index') }}">Invoices</a>
                        </li>
                    @endif
                    @if (!Auth::user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart.index') }}">🛒 Cart</a>
                        </li>
                    @endif

                    @if (!Auth::user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('topup.form') }}">💳Top Up </a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="nav-link btn btn-link" type="submit">Logout</button>
                        </form>
                    </li>
                @endauth
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

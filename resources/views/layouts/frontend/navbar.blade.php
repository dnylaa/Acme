<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm fixed-top">
    <div class="container">
        <!-- Logo -->
<a class="navbar-brand d-flex align-items-center mb-1" href="{{ route('admin.dashboard') }}">
    <img src="{{ asset('assets/img/My Acme Icon.png') }}" alt="Acme Logo" style="width:100px; height:30px; object-fit:cover;">
</a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Menu kiri -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link @yield('homeActive')" aria-current="page" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link @yield('productActive')" href="{{ route('home.product.index') }}"> {{ __('Product') }} </a></li>
                <li class="nav-item"><a class="nav-link @yield('articlesActive')" href="{{ route('home.articles.index') }}"> {{ __('Articles') }} </a></li>
                <li class="nav-item"><a class="nav-link @yield('informationActive')" href="{{ route('home.information.index') }}"> {{ __('Informations') }} </a></li>
                <li class="nav-item"><a class="nav-link @yield('teamActive')" href="{{ route('home.team.index') }}"> {{ __('Redaktions') }} </a></li>
                <li class="nav-item"><a class="nav-link @yield('aboutActive')" href="{{ route('home.about.index') }}">{{ __('About') }}</a></li>
                <li class="nav-item"><a class="nav-link @yield('contactActive')" href="{{ route('home.contact.index') }}"> {{ __('Contact') }} </a></li>
            </ul>

            <!-- Menu kanan (cart & user) -->
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cart.index') }}">
                        <i class="bi bi-cart4"></i>
                        @if (isset($cartItemCount) && $cartItemCount > 0)
                            <span class="badge bg-danger rounded-pill">{{ $cartItemCount }}</span>
                        @endif
                    </a>
                </li>

                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link fw-bold text-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle fw-bold text-primary" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                    {{ __('Dashboard') }}
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<nav class="navbar navbar-light bg-pink sidebar navbar-minimal border-0 shadow-sm" style="position:fixed; top:0; left:0; height:100vh; width:250px; overflow-y:auto; ">
    <div class="container-fluid flex-column">
        <a class="navbar-brand d-flex align-items-center mb-4" href="{{ route('admin.dashboard') }}">
    <img src="{{ asset('assets/img/Icon Acme Final.png') }}" alt="Acme Logo" style="width:170px; height:50px; object-fit:cover;" class="me-2">
    
</a>

        {{-- Menu Kiri (Sidebar) --}}
        <ul class="navbar-nav flex-column w-100">
            @if(Auth::user()->isAdmin() || Auth::user()->isAuthor())
                <li class="nav-item mb-1 ">
                    <a class="nav-link text-white ps-3 @yield('homeActive')" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-house me-2"></i> {{ __('Dashboard') }}
                    </a>
                </li>

                <li class="nav-item dropdown mb-1">
    <a class="nav-link dropdown-toggle text-white ps-3 @yield('categoriesActive') @yield('productTypesActive')" 
       href="{{ route('admin.categories.index') }}" 
       id="sidebarDropdownKategori" 
       role="button" 
       data-bs-toggle="dropdown" 
       aria-expanded="false">
        <i class="bi bi-tags me-2"></i> Category
    </a>
    <ul class="dropdown-menu dropdown-menu-dark border-0 shadow"
        aria-labelledby="sidebarDropdownKategori"
        style="position: static; float: none; background-color: #ff80ab;">
        <li><a class="dropdown-item text-white @yield('categoriesActive')" href="{{ route('admin.categories.index') }}">Category</a></li>
        <li><a class="dropdown-item text-white @yield('productTypesActive')" href="{{ route('admin.product-types.index') }}">Product Types</a></li>
    </ul>
</li>



                <li class="nav-item mb-1">
                    <a class="nav-link text-white ps-3 @yield('productsActive')" href="{{ route('admin.products.index') }}">
                        <i class="bi bi-box-seam me-2"></i> {{ __('Products') }}
                    </a>
                </li>

                <li class="nav-item mb-1">
                    <a class="nav-link text-white ps-3 @yield('articlesActive')" href="{{ route('admin.articles.index') }}">
                        <i class="bi bi-journal-text me-2"></i> {{ __('Articles') }}
                    </a>
                </li>

                <li class="nav-item mb-1">
                    <a class="nav-link text-white ps-3 @yield('informationsActive')" href="{{ route('admin.informations.index') }}">
                        <i class="bi bi-info-circle me-2"></i> {{ __('Informations') }}
                    </a>
                </li>

                <li class="nav-item mb-1">
                    <a class="nav-link text-white ps-3 @yield('testimonialsActive')" href="{{ route('admin.testimonials.index') }}">
                        <i class="bi bi-chat-text me-2"></i> {{ __('Testimonials') }}
                    </a>
                </li>

                <li class="nav-item mb-1">
                    <a class="nav-link text-white ps-3 @yield('ordersActive')" href="{{ route('admin.orders.index') }}">
                        <i class="bi bi-bag-check me-2"></i> {{ __('Orders') }}
                    </a>
                </li>

                @if(Auth::user()->isAdmin())
                    <li class="nav-item mb-1">
                        <a class="nav-link text-white ps-3 @yield('usersActive')" href="{{ route('admin.users.index') }}">
                            <i class="bi bi-people me-2"></i> {{ __('Users') }}
                        </a>
                    </li>
                @endif
            @endif
        </ul>

        <hr class="text-white">

        {{-- Menu Kanan (Profil & Logout di Sidebar bawah) --}}
<ul class="navbar-nav flex-column mt-auto">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle fw-bold text-white" 
           href="#" 
           id="sidebarDropdownProfile" 
           role="button" 
           data-bs-toggle="dropdown" 
           aria-expanded="false">
            {{ Auth::user()->name }} ({{ Auth::user()->role }})
        </a>
        <ul class="dropdown-menu dropdown-menu-dark border-0 shadow" 
            aria-labelledby="sidebarDropdownProfile"
            style="position: static; float: none; background-color: #f979a4;">
            
            <li class="mb-1">
                <a class="dropdown-item text-white" href="{{ route('admin.profile.edit') }}">
                    {{ __('Profile') }}
                </a>
            </li>
            <li class="mb-1">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="dropdown-item text-white" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </a>
                </form>
            </li>
            <li>
                <a class="dropdown-item text-white" href="/">
                    {{ __('Back to Home') }}
                </a>
            </li>
        </ul>
    </li>
</ul>

    </div>
</nav>


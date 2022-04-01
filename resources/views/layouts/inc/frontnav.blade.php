<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand " href="{{ url('/') }}"><img class="logo"
                src="{{ asset('assets/images/logo.png') }}"></a>
                <div class="search-bar">
                    <form action="{{url('searchProduct')}}" method="POST">
                        @csrf
                        <div class="input-group flex-nowrap">
                            <input type="search" class="form-control" name="search" id="search_product" placeholder="Product Name" aria-label="Username" aria-describedby="addon-wrapping">
                            <button type="submit" class="input-group-text"><i class="fa fa-search"></i></button>
                          </div>
                    </form>
                </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mynavbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('category') }}">Category</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/cart') }}"><i class="fa fa-shopping-cart"></i>
                    <span class="badge badge-pill bg-success cart-count">0</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/wishlist') }}"><i class="fa fa-heart"></i>
                        <span class="badge badge-pill bg-primary wish-count">0</span></a>
                    </a>
                </li>

                @can('isGuest')

                @else
                @if(Auth::user())
                <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ url('/my-orders') }}">My Orders</a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="{{ url('profile/'.Auth::user()->id) }}">My Profile</a>
                            </li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">{{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </a>
                    </li>
                </ul>
                    @elseif (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                @endif

                @endcan

            </ul>

        </div>
    </div>
</nav>

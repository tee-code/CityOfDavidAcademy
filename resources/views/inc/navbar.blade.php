 <nav class="shadow p-3 mb-5 bg-white rounded navbar navbar-expand-lg navbar-light fixed-top bg-light shadow-sm mb-3">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">

                <span class="lara">Lara</span><img class = "mx-1" style = "width: 20px" src="/images/icons/laravel-brands.svg" alt=""><span class="learn">Learn</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li class="nav-item">
                        <a class="text-blue nav-link" href="#home"><i class="fas fa-home mr-1"></i>Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="text-blue nav-link" href="#about"><i class="fas fa-info-circle mr-1"></i>About</a>
                    </li>
                    <li class="nav-item">
                        <a class="text-blue nav-link" href="#services"><i class="fas fa-cogs mr-1"></i>What we do</a>
                    </li>
                    <li class="nav-item">
                        <a class="text-blue nav-link" href="#team"><i class="fas fa-users mr-1"></i>Our Team</a>
                    </li>
                    <li class="nav-item">
                        <a class="text-blue nav-link" href="#reviews"><i class="fas fa-quote-right mr-1"></i>Testimonials</a>
                    </li>
                    <li class="nav-item">
                        <a class="text-orange nav-link" href="#contact"><i class="fas fa-address-card mr-1"></i>Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="text-red nav-link" href="/posts"><i class="fas fa-blog mr-1"></i>Blog</a>
                    </li>
                    <div class="flash-button float-list">
                        <li class="nav-item">
                            <a class = "nav-link" href="/posts/create"><i class="fas fa-users mr-1"></i>Classroom</a>
                        </li>
                    </div>

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto mr-2">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="text-blue nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt mr-1"></i>{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="text-blue nav-link" href="{{ route('register') }}"><i class="fas fa-registered mr-1"></i>{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a href="/dashboard" class="dropdown-item">Dashboard</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>


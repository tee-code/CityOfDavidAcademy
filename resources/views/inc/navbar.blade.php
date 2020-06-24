 <nav class="shadow p-3 mb-5 bg-white rounded navbar navbar-expand-md navbar-light bg-light shadow-sm mb-3 fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                CityOfDavidAcademy
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li class="nav-item">
                        <a class="flash-button text-blue nav-link" href="/dashboard"><i class="fas fa-home mr-1"></i>Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="flash-button text-blue nav-link" href="/about"><i class="fas fa-info-circle mr-1"></i>About</a>
                    </li>

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto mr-2">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="flash-button text-blue nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt mr-1"></i>{{ __('Login') }}</a>
                        </li>

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


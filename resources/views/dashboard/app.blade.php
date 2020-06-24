<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME', 'CityOfDavidAcademy') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">




    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">




</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-light">
        <button class="navbar-toggler ml-auto mb-2 bg-light" type = "button" data-target = "#navigation" data-toggle = "collapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id = "navigation">
            <div class="container-fluid">
                <div class="row">
                    <!-- Sidebar -->
                    <div id = "sidebar" class="col-xl-3 col-md-4 col-lg-3 sidebar fixed-top">
                        <a href="#" class="navbar-brand mx-auto d-block py-3 text-center mb-2 border-bottom">CityOfDavidAcademy</a>
                        <div class="border-bottom mb-3">
                            <img src="/images/profile.png" style = "width: 40" class = "rounded-circle mr-1" alt="">
                            <a href = "#" class = "text-normal username">{{ Auth::user()->name }}</a>
                        </div>
                        <ul class="navbar-nav flex-column custom-list">
                            <li class="nav-item">
                                <a href="/dashboard" class="text-normal nav-link p-2 mb-1 sidebar-link"><i class="fas fa-home  mr-2"></i>Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a href="/dashboard/profile/{{ Auth::user()->id }}" class="text-normal nav-link p-2 mb-1 sidebar-link"><i class="fas fa-user  mr-2"></i>Your Profile</a>
                            </li>
                            @if (Auth()->user()->role == "Super Admin")
                                <li class="nav-item">
                                    <a href="/dashboard/users" class="text-normal nav-link p-2 mb-1 sidebar-link"><i class="fas fa-user-cog  mr-2"></i>User Management</a>
                                </li>
                            @endif

                            <li class="nav-item">
                                <a href="/dashboard/sections" class="text-normal nav-link p-2 mb-1 sidebar-link"><i class="fas fa-calendar  mr-2"></i>Section Management</a>
                            </li>
                            <li class="nav-item">
                                <a href="/dashboard/classes" class="text-normal nav-link p-2 mb-1 sidebar-link"><i class="fas fa-graduation-cap  mr-2"></i>Class Management</a>
                            </li>
                            <li class="nav-item">
                                <a href="/dashboard/students" class="text-normal nav-link p-2 mb-1 sidebar-link"><i class="fas fa-user  mr-2"></i>Student Management</a>
                            </li>
                            <li class="nav-item">
                                <a href="/dashboard/staffs" class="text-normal nav-link p-2 mb-1 sidebar-link"><i class="fas fa-user  mr-2"></i>Staff Management</a>
                            </li>
                            <li class="nav-item">
                                <a href="/dashboard/fees" class="text-normal nav-link p-2 mb-1 sidebar-link"><i class="fas fa-money-bill-alt  mr-2"></i>Fees Management</a>
                            </li>
                            <li class="nav-item">
                                <a href="/dashboard/discounts" class="text-normal nav-link p-2 mb-1 sidebar-link"><i class="fas fa-percentage  mr-1"></i>Discount Management</a>
                            </li>
                            <li class="nav-item">
                                <a href="/dashboard/schoolfees" class="text-normal nav-link p-2 mb-1 sidebar-link"><i class="fas fa-money-bill-alt  mr-2"></i>School Fees</a>
                            </li>


                            <li class="nav-item">
                                <a href="/dashboard/debtors" class="text-normal nav-link p-2 mb-1 sidebar-link"><i class="fas fa-money-bill-alt  mr-2"></i>Debtors</a>
                            </li>
                            <li class="nav-item">
                                <a href="/dashboard/taxes" class="text-normal nav-link p-2 mb-1 sidebar-link"><i class="fas fa-money-bill-alt  mr-2"></i>Tax Deductions</a>
                            </li>
                            <li class="nav-item">
                                <a href="/dashboard/allowances" class="text-normal nav-link p-2 mb-1 sidebar-link"><i class="fas fa-money-bill-alt  mr-2"></i>Allowances</a>
                            </li>
                            <li class="nav-item">
                                <a href="/dashboard/expenses" class="text-normal nav-link p-2 mb-1 sidebar-link"><i class="fas fa-money-bill-alt  mr-2"></i>Expenses</a>
                            </li>
                            <li class="nav-item">
                                <a href="/dashboard/notifications" class="text-normal nav-link p-2 mb-1 sidebar-link"><i class="fas fa-bell  mr-2"></i>Notifications</a>
                            </li>
                        </ul>

                    </div>
                    <!-- End of Sidebar -->

                    <!-- Top Nav -->

                    <div id = "dashboard" class="topbar col-xl-9 col-lg-9 col-md-8 ml-auto bg-theme-color fixed-top py-2">
                        <div class="row align-items-center">
                                <div class="col-md-6 mb-0">
                                    <h4>Dashboard</h4>
                                </div>
                                <div class="col-md-6">
                                    <ul class="navbar-nav ml-md-auto float-right">
                                        <li class="nav-item icon-parent">
                                            <a href="/dashboard/notifications" class = "nav-link text-white icon-bullet"><span class="fas fa-bell mx-2"></span></a>
                                        </li>

                                        <li class="nav-item icon-parent">
                                            <a class = "nav-link text-white" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                          document.getElementById('logout-form').submit();">
                                             {{ __('Logout') }}<span class="fas fa-sign-out-alt  mx-2"></span></a>
                                             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                        </li>
                                    </ul>
                                </div>
                        </div>

                    </div>
                    <!-- End of Top Nav -->
                </div>
            </div>
        </div>
    </nav>
    <!-- End of Navbar -->
    <section>
        <div id = "expand" class="expand"><span id = "arrow" class="fas fa-arrow-left"></span></div>
        <div class="container-fluid">
            <div class="row content-wrapper">
                <div id = "content" class="col-md-8 col-xl-9 col-lg-9 ml-auto mt-4">
                    @include('inc.messages')
                   @yield('dashboard')
                </div>
            </div>
        </div>
    </section>

    <script>

        //script to fire when a link is clicked

        const links = document.querySelectorAll('ul li.nav-item a.nav-link');

        links.forEach(link => {

            if(window.location.href == link.href){
                link.className = "text-normal nav-link p-2 mb-1 sidebar-link current";
            }

        });

        //script to fire when the expand button is clicked

        let isClicked = false;


        document.querySelector('#expand').addEventListener('click', (e) => {

            isClicked = !isClicked;
            if(isClicked){
                document.querySelector('#content').className = "col-md-10 col-xl-11 col-lg-11 ml-auto mt-4";
                document.querySelector('#arrow').className = "fas fa-arrow-right";
                document.querySelector('#sidebar').className = "col-xl-1 col-md-2 col-lg-1 sidebar fixed-top";
                document.querySelector('#dashboard').className = "topbar col-xl-11 col-lg-11 col-md-10 ml-auto bg-theme-color fixed-top py-2";

            }else{
                document.querySelector('#content').className = "col-md-8 col-xl-9 col-lg-9 ml-auto mt-4";
                document.querySelector('#arrow').className = "fas fa-arrow-left";
                document.querySelector('#sidebar').className = "col-xl-3 col-md-4 col-lg-3 sidebar fixed-top";
                document.querySelector('#dashboard').className = "topbar col-xl-9 col-lg-9 col-md-8 ml-auto bg-theme-color fixed-top py-2";
            }

        });
    </script>
    <script>
            var acc = document.getElementsByClassName("accordion");
            var i;

            for (i = 0; i < acc.length; i++) {
              acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.maxHeight) {
                  panel.style.maxHeight = null;
                } else {
                  panel.style.maxHeight = panel.scrollHeight + "px";
                }
              });
            }
            </script>
</body>
</html>



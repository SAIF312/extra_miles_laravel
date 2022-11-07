    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
        <title>@yield('title') | Extra Miless</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/assets/img/favicon.ico') }}" />
        <link href="{{ asset('assets/assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
        <script src="{{ asset('assets/assets/js/loader.js') }}"></script>

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />

    </head>

    <body>
    </body>

    </html>
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{ asset('assets/plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/assets/css/dashboard/dash_2.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <!-- FontAwsem Link -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />



    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/table/datatable/datatables.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/table/datatable/dt-global_style.css') }}">

    <!-- END PAGE LEVEL STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ asset('assets/assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <!-- toastr -->
    <link href="{{ asset('assets/plugins/notification/snackbar/snackbar.min.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="{{ asset('assets/assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/jquery-step/jquery.steps.css') }}">

    <link href="{{ asset('assets/assets/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />





    <style>
        ul li span .fa {
            font-size: 20px;
            display: inline;
            color: #FFFFFF;
        }

        label.error {
            color: white !important;
            background-color: #27AE60;
            border-color: #27AE60;
            padding: 1px 20px 1px 20px;
        }
    </style>

    </head>

    <body>
        <!-- BEGIN LOADER -->
        <div id="load_screen">
            <div class="loader">
                <div class="loader-content">
                    <div class="spinner-grow align-self-center" style="background-color: #ffa000;"></div>
                </div>
            </div>
        </div>
        <!--  END LOADER -->

        <!--  BEGIN NAVBAR  -->
        <div class="header-container fixed-top">
            <header class="header navbar navbar-expand-sm">
                <ul class="navbar-item theme-brand flex-row  text-center">

                    {{-- <li class="nav-item theme-logo">
                        <a href="{{url('home')}}">
                            <img src="{{asset('assets/assets/img/LogoQR.png')}}" class="navbar-logo" alt="logo">
                        </a>
                    </li> --}}

                    <li class="nav-item theme-text">
                        <a href="{{ route('motorist.price') }}" class="nav-link">Extra Miless</a>

                    </li>
                </ul>
                <ul class="navbar-item flex-row ml-md-auto">
                    <li class="nav-item dropdown user-profile-dropdown">
                        <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <img src="{{asset(!is_null(auth()->user()->profile_img_url)?auth()->user()->profile_img_url:'assets/assets/img/profile.jpg')}}" alt="avatar">
                        </a>
                        <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                            <div>
                                <div class="dropdown-item">
                                    <a href="{{ route('profile.index') }}"><svg xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-user">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg> My Profile</a>
                                </div>
                                <div class="dropdown-item">
                                    <form id="logout" action="{{route('logout')}}" method="post">
                                        {{ csrf_field() }}
                                        <a href="javascript:{}" onclick="document.getElementById('logout').submit();">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-log-out">
                                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                                <polyline points="16 17 21 12 16 7"></polyline>
                                                <line x1="21" y1="12" x2="9" y2="12">
                                                </line>
                                            </svg>Sign Out
                                        </a>
                                    </form>
                                </div>

                            </div>
                    </li>

                </ul>
            </header>
        </div>
        <!--  END NAVBAR  -->

        <!--  BEGIN NAVBAR  -->
        <div class="sub-header-container">
            <header class="header navbar navbar-expand-sm">
                <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-menu">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg></a>

                <ul class="navbar-nav flex-row">
                    <li>
                        <div class="page-header">

                            <nav class="breadcrumb-one" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li> -->
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <span>@yield('header')</span></li>
                                </ol>
                            </nav>

                        </div>
                    </li>
                </ul>

            </header>
        </div>
        <!--  END NAVBAR  -->

        <!--  BEGIN MAIN CONTAINER  -->
        <div class="main-container" id="container">

            <div class="overlay"></div>
            <div class="search-overlay"></div>

            <!--  BEGIN SIDEBAR  -->
            <div class="sidebar-wrapper sidebar-theme">

                <nav id="sidebar" style="background-color:#00ADEE;">

                    <!-- <div class="shadow-bottom"></div> -->

                    <ul class="list-unstyled menu-categories" id="accordionExample">

                        <!-- <li class="menu">
                            <a href="{{-- route('dashboard') --}}"
                                data-active="{{ Request::is(['dashboard', 'dashboard/*']) ? 'true' : 'false' }}"
                                aria-expanded="false" class="dropdown-toggle">
                                <div>
                                    <span> <i class="fa fa-tachometer"></i>&nbsp;&nbsp;&nbsp;Dashboard</span>
                                </div>
                            </a>
                        </li> -->


                        <li class="menu">
                            <a href="{{route('motorist.price')}}"
                                data-active="{{ Request::is(['user', 'user/*']) ? 'true' : 'false' }}"
                                aria-expanded="false" class="dropdown-toggle">
                                <div>
                                    <span> <i class="fa fa-tint"></i>&nbsp;&nbsp;&nbsp;Singapore Fuel Price</span>
                                </div>
                            </a>
                        </li>


                        <li class="menu">
                            <a href="{{ route('malaysian.price') }}"
                                data-active="{{ Request::is(['package', 'package/*']) ? 'true' : 'false' }}"
                                aria-expanded="false" class="dropdown-toggle">
                                <div>
                                    <span> <i class="fa fa-tint"></i>&nbsp;&nbsp;&nbsp;Malaysia Fuel Price</span>
                                </div>
                            </a>
                        </li>

                        <li class="menu">
                            <a href="{{route('openbidding.price') }}"
                                data-active="{{ Request::is(['subscription', 'subscription/*']) ? 'true' : 'false' }}"
                                aria-expanded="false" class="dropdown-toggle">
                                <div>
                                    <span> <i class="fa fa-tint"></i>&nbsp;&nbsp;&nbsp;Open Bidding</span>
                                </div>
                            </a>
                        </li>

                        <li class="menu">
                            <a href="{{ route('Trafic_images.price') }}"
                                data-active="{{ Request::is(['payments', 'payments/*']) ? 'true' : 'false' }}" aria-expanded="false"
                                class="dropdown-toggle">
                                <div>
                                    <span> <i class="fa fa-globe"
                                            aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Traffic images</span>
                                </div>
                            </a>
                        </li>

                        <li class="menu">
                            <a href="{{ route('carparking.price') }}" data-active="{{Request::is(['scan','scan/*']) ? 'true' : 'false'}}" aria-expanded="false" class="dropdown-toggle">
                                <div>
                                    <span> <i class="fa fa-car"></i>&nbsp;&nbsp;&nbsp;Car Parking Rates</span>
                                </div>
                            </a>
                        </li>

                        {{-- <li class="menu">
                            <a href="{{ route('dashboard.password_logs') }}"
                                data-active="{{ Request::is(['dashboard/password_logs', 'dashboard/password_logs/*']) ? 'true' : 'false' }}"
                                aria-expanded="false" class="dropdown-toggle">
                                <div>
                                    <span> <i class="fa fa-lock"></i>&nbsp;&nbsp;&nbsp;Password Logs</span>
                                </div>
                            </a>
                        </li>

                        <li class="menu">
                            <a href="{{ route('dashboard.index') }}"
                                data-active="{{ Request::is(['dashboard/index', 'dashboard/index/*']) ? 'true' : 'false' }}"
                                aria-expanded="false" class="dropdown-toggle">
                                <div>
                                    <span> <i class="fa fa-user-plus"></i>&nbsp;&nbsp;&nbsp;Dashboard Admin</span>
                                </div>
                            </a>
                        </li> --}}

                        <form id="logout" action="{{-- route('logout') --}}" method="post">
                            <li class="menu">
                                <a href="javascript:{}" aria-expanded="false" class="dropdown-toggle"
                                    onclick="document.getElementById('logout').submit();">
                                    <div>
                                        <span> <i class="fa fa-sign-out"></i>&nbsp;&nbsp;&nbsp;Sign Out</span>
                                    </div>
                                </a>
                            </li>
                        </form>

                    </ul>

                </nav>

            </div>
            <!--  END SIDEBAR  -->

            @yield('content')

        </div>
        <!-- END MAIN CONTAINER -->

        <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
        <script src="{{ asset('assets/assets/js/libs/jquery-3.1.1.min.js') }}"></script>
        <script src="{{ asset('assets/assets/js/libs/jquery.validate.js') }}"></script>
        <script src="{{ asset('assets/bootstrap/js/popper.min.js') }}"></script>
        <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('assets/assets/js/app.js') }}"></script>

        <script>
            $(document).ready(function() {
                App.init();
            });
        </script>

        <!-- END GLOBAL MANDATORY SCRIPTS -->
        <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!--<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>-->
        <script src="{{ asset('assets/assets/js/dashboard/dash_2.js') }}"></script>
        <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
        <script src="{{ asset('assets/plugins/table/datatable/datatables.js') }}"></script>
        <script src="{{ asset('assets/plugins/table/datatable/custom_miscellaneous.js') }}"></script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <!-- END GLOBAL MANDATORY SCRIPTS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{{ asset('assets/assets/js/scrollspyNav.js') }}"></script>
        <!-- toastr -->
        <script src="{{ asset('assets/plugins/notification/snackbar/snackbar.min.js') }}"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!--  BEGIN CUSTOM SCRIPTS FILE  -->
        <script src="{{ asset('assets/assets/js/components/notification/custom-snackbar.js') }}"></script>

        <script src="{{ asset('assets/assets/js/scrollspyNav.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-step/jquery.steps.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-step/custom-jquery.steps.js') }}"></script>
        <script src="{{ asset('assets/plugins/apex/apexcharts.min.js') }}"></script>
        <!--<script src="{{ asset('assets/plugins/apex/custom-apexcharts.js') }}"></script>-->

        <script>
            $('#zero-config, #zero-config2').DataTable({
                "oLanguage": {
                    "oPaginate": {
                        "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                        "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                    },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                    "sLengthMenu": "Results :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [7, 10, 20, 50],
                "pageLength": 7
            });
        </script>

        @if (Session::has('success'))
            <script>
                Snackbar.show({
                    // text: 'I Am Here.',
                    text: '{!! Session::get('success') !!}',
                    pos: 'top-right',
                    // text: 'Info',
                    actionTextColor: '#fff',
                    backgroundColor: '#2196f3'
                    // toastr.success("{!! Session::get('success') !!}"),
                });
            </script>
        @endif

        @if (Session::has('msg'))
            <script>
                Snackbar.show({
                    // text: 'I Am Here.',
                    text: '{!! Session::get('msg') !!}',
                    pos: 'top-right',
                    // text: 'Danger',
                    actionTextColor: '#fff',
                    backgroundColor: '#e7515a'
                    // toastr.success("{!! Session::get('success') !!}"),
                });
            </script>
        @endif

        <script>
            $("#form").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3
                    },
                    image: {
                        required: true,
                    },
                    cat_id: {
                        required: true,
                    },
                    contact: {
                        required: true,
                    },
                    email: {
                        required: true,
                    },
                    password: {
                        required: true,
                    },
                    gender: {
                        required: true,
                    },
                    date_of_birth: {
                        required: true,
                    },
                    description: {
                        required: true,
                        minlength: 50
                    },
                    hospital_name: {
                        required: true,
                    },
                    fees_amount: {
                        required: true,
                    },
                    'speciality[]': {
                        required: true,
                    },


                },
                messages: {
                    name: {
                        required: "Name is required"
                    },
                    image: {
                        required: "Image is required"
                    },
                    cat_id: {
                        required: "Category is required"
                    },
                    // contact: {
                    //     required: "Contact is required"
                    // },
                    // email: {
                    //     required: "Email is required"
                    // },
                    // password: {
                    //     required: "Contact is required"
                    // },
                    // gender: {
                    //     required: "Gender is required"
                    // },
                    // date_of_birth: {
                    //     required: "Date Of Birth is required"
                    // },
                    'speciality[]': {
                        required: "Speciality is required"
                    },
                }
            });
        </script>

        @yield('javascript')

    </body>

    </html>
{{-- @else
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    @php
        Session::flush();
        Auth::logout();
    @endphp

    <body class="error404 text-center">
        <div class="card"
            style="width: 25rem; position:absolute; top:50%;left:50%; transform:translate(-50%,-50%); border-radius: 10px;padding:50px;">
            <div class="card-body">
                <i class="fa fa-exclamation" aria-hidden="true"></i>
                <h6 class="card-subtitle mb-2" style="color:red;">Access Blocked</h6>
                <p class="card-text">You do not have any rights to access the page</p>
                <a href="{{ route('loginPage') }}" class="card-link">Go back</a>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>
    </body>

    </html>

@endif --}}

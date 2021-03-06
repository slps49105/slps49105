<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MES</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('vendor/jquery/jquery.min.js') }}" defer></script> --}}
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('vendor/metisMenu/metisMenu.min.js') }}" defer></script>
    <script src="{{ asset('dist/js/sb-admin-2.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.10/lodash.min.js"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.2/jquery.twbsPagination.js"></script>
    <!-- Styles -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/metisMenu/metisMenu.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
   
    @yield('css')
    
    <style>
        .a-font {
            color: white;
        }
        .sidebar ul li {
            border: 0px;
        }
        .navbar-default {
            border-color: #343641; 
        }
        .nav>li>a:focus, .nav>li>a:hover {
            background-color: #343641;
        }
        .nav .open>a, .nav .open>a:focus, .nav .open>a:hover {
            background-color: #343641;
        }
        .sidebar ul li a.active {
            background-color: #343641;
        }
        .slectbtn{
            width:10%;
        }
        .clearable{
            background: #fff url(http://i.stack.imgur.com/mJotv.gif) no-repeat right -10px center;
            border: 1px solid #ccc;
            padding: 3px 18px 3px 4px;     /* Use the same right padding (18) in jQ! */
            border-radius: 3px;
            transition: background 0.4s;
        }
        .clearable.x  { background-position: right 5px center; } /* (jQ) Show icon */
        .clearable.onX{ cursor: pointer; }              /* (jQ) hover cursor style */
        .clearable::-ms-clear {display: none; width:0; height:0;} /* Remove IE default X */
    </style>

    @yield('script')

    <script>
        function tog(v){return v?'addClass':'removeClass';} 
        $(document).on('input', '.clearable', function(){ //$(document)????????????????????????????????????????????? on ??????????????? {events, selector, data, handler}
           $(this)[tog(this.value)]('x');
        }).on('mousemove', '.x', function( e ){
            $(this)[tog(this.offsetWidth-18 < e.clientX-this.getBoundingClientRect().left)]('onX');//??????X
        }).on('touchstart click', '.onX', function( ev ){
            ev.preventDefault();
            $(this).removeClass('x onX').val('').change();//????????????
        });
    </script>

</head>
<body>
    <div id="wrapper" style="background-color: #3D404C;">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: #3D404C;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('img/u9.png') }}" width="125px">
                </a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color: white;">
                        <i class="fa fa-user fa-fw"></i> {{ Auth::user()->name }} <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out fa-fw"></i>Logout
                            </a>

                        </li>
                    </ul>
                </li>
            </ul>

            <div class="navbar-default sidebar" role="navigation" style="background-color: #3D404C;">
                <div id="sidebar-option" class="sidebar-nav navbar-collapse" hidden>
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="{{ route('home') }}" style="color: white;">??????</a>
                        </li>
                        
                        <li>
                            <a href="#" style="color: white;">????????????<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ route('year-calendar') }}" style="color: white;">???????????????</a>
                                </li>
                                <li>
                                    <a href="{{ route('process-calendar') }}" style="color: white;">???????????????</a>
                                </li>
                                <li>
                                    <a href="{{ route('work-type.index') }}" style="color: white;">????????????</a>
                                </li>
                                <li>
                                    <a href="{{ route('rest-time.index') }}" style="color: white;">????????????</a>
                                </li>
                                <li>
                                    <a href="{{ route('machine-category.index') }}" style="color: white;">??????????????????</a>
                                </li>
                                <li>
                                    <a href="{{ route('machine-definition.index') }}" style="color: white;">????????????</a>
                                </li>
                                <li>
                                    <a href="{{ route('process-routing.index') }}" style="color: white;">????????????</a>
                                </li>
                                <li>
                                    <a href="{{ route('processing-time.index') }}" style="color: white;">????????????</a>
                                </li>
                            </ul>
                        </li>
                        <!-- <li>
                            <a href="#" style="color: white;">????????????<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ route('variable-formula.index') }}" style="color: white;">??????????????????</a>
                                </li>
                                <li>
                                    <a href="{{ route('formula-setting.index') }}" style="color: white;">????????????</a>
                                </li>
                                <li>
                                    <a href="{{ route('machineoee.index') }}" style="color: white;">??????OEE??????</a>
                                </li> 
                            </ul>
                        </li> -->
                        <li>
                            <a href="#" style="color: white;">MES??????<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <!-- <li>
                                <a href="{{route('sale-order')}}" style="color: white;">???????????????</a>
                                </li> -->
                                <li>
                                <a href="{{route('search-manufacture')}}" style="color: white;">???????????????</a>
                                </li>
                                
                                <li>
                                    <a href="{{route('show_machineperformance')}}" style="color: white;">????????????</a>
                                </li>
                                <li>
                                    <a href="{{route('show_dayperformance')}}" style="color: white;">?????????????????????</a>
                                </li>
                                <li>
                                    <a href="{{route('show_OEEperformance')}}" style="color: white;">OEE????????????</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')
    </div>
    @yield('js')
</body>
</html>

<!DOCTYPE html>
<html lang="en" style="zoom:90%">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="http://www.lctip.com/wp-content/uploads/2016/04/cropped-picture1-32x32.png" sizes="32x32" />

        <title>{{$title}}</title>

        <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="{{asset('css/freelancer.css?v=3')}}" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="{{asset('font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
        <link rel='stylesheet' id='zerif_font-css'  href='//fonts.googleapis.com/css?family=Lato%3A300%2C400%2C700%2C400italic%7CMontserrat%3A700%7CHomemade+Apple&#038;subset=latin%2Clatin-ext' type='text/css' media='all' />
        <link rel='stylesheet' id='zerif_font_all-css'  href='//fonts.googleapis.com/css?family=Open+Sans%3A400%2C300%2C300italic%2C400italic%2C600italic%2C600%2C700%2C700italic%2C800%2C800italic&#038;ver=4.5.2' type='text/css' media='all' />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body  id="page-top" style="background-image:url('{{asset('images/background.png')}}')" class="index" onload="setCountDown();">

        <!-- Navigation -->
        <nav class="navbar navbar-default ">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!--                    <div class="col-md-3 pull-left" >
                                             <a style="padding:0px" href="http://online-test.lctip.com/" class="navbar-brand"><img src="http://www.lctip.com/wp-content/uploads/2016/04/picture1.png" width="33%"  alt="LCTIP 2016"></a>
                                        </div>-->
                    <a href="{{ url('/')}}" class="navbar-brand">KK</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <form class="navbar-form navbar-left" role="search">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Search">
                            </div>
                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>
                        <li class="hidden">
                            <a href="#page-top"></a>
                        </li>

                        @if (Auth::guard('member')->check())
                        <li class="dropdown page-scroll">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" >
                                {{ Auth::guard('member')->user()->username }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/profile/'.Auth::guard('member')->user()->username) }}"><i class="glyphicon glyphicon-user"></i> Profile</a></li>
                                @if($dataPanel->tryOutGate == 'open')
                                <li><a href="{{ url('/profile/'.Auth::guard('member')->user()->username) }}/panel"><i class="glyphicon glyphicon-hand-right"></i> TryOut!!</a></li>
                                @elseif(($dataPanel->quizGate1 == 'open')||($dataPanel->quizGate2 == 'open'))
                                <li><a href="{{ url('/profile/'.Auth::guard('member')->user()->username) }}/panel"><i class="glyphicon glyphicon-hand-right"></i> Online Test!!</a></li>
                                @endif
                                @if((isset($statusPendaftaran)) && ($statusPendaftaran == 1))
                                <li><a href="{{ url('/profile/'.Auth::guard('member')->user()->username) }}/edit"><i class="glyphicon glyphicon-list-alt"></i> Show profile</a></li>
                                @else
                                <li><a href="{{ url('/profile/'.Auth::guard('member')->user()->username) }}/edit"><i class="glyphicon glyphicon-list-alt"></i> Edit profile</a></li>
                                @endif
                                <li><a href="{{ url('/profile/'.Auth::guard('member')->user()->username) }}/logout"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
                            </ul>
                        </li>
                        @else
                        <li class="page-scroll">
                            <a href="{{url('/login')}}">Login </a>
                        </li>
                        @if($dataPanel->registrationGate == 'open')
                        <li class="page-scroll">
                            <a href="{{url('/register')}}">Registration</a>
                        </li>
                        @else

                        @endif
                        @endif
                    </ul>

                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>

        @yield('content')

        <!-- jQuery -->
        <script src="{{asset('js/jquery.js')}}"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <!-- Plugin JavaScript -->
        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
        <script src="{{asset('js/classie.js')}}"></script>
        <script src="{{asset('js/cbpAnimatedHeader.js')}}"></script>
        <!-- Contact Form JavaScript -->
        <script src="{{asset('js/jqBootstrapValidation.js')}}"></script>
        <script src="{{asset('js/contact_me.js')}}"></script>
        <!-- Custom Theme JavaScript -->
        <script src="{{asset('js/freelancer.js')}}"></script>

    </body>

</html>

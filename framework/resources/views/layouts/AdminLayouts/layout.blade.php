<!DOCTYPE html>
<html lang="en" style="zoom:90%">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Admin Page</title>

        <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="{{asset('css/freelancer.css?v=4')}}" rel="stylesheet">
        <!-- Tiny Mce -->
        <script src="{{asset('tinymce/js/tinymce/tinymce.min.js')}}"></script>

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

    <body id="page-top" style="background-image:url('images/background.png')" class="index">

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
                    <a href="http://www.lctip.com/" class="navbar-brand">LCTIP</a>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="myModal_quizAccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Access Denied</h4>
                            </div>
                            <div class="modal-body">
                                Im sorry but u dont have permission to access the page
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="hidden">
                            <a href="#page-top"></a>
                        </li>

                        <li class="page-scroll">
                            <a href="{{url('/admin/member')}}">Member </a>
                        </li>
                        <li class="page-scroll">
                            <a href="{{url('/admin/message')}}">Message </a>
                        </li>
                        @if(Auth::guard('admin')->user()->role == 'superAdmin')
                        <li class="page-scroll">
                            <a href="{{url('/admin/quiz')}}">quiz </a>
                        </li>
                        @else
                        <li class="page-scroll">
                            <a type='button' data-toggle="modal" data-target="#myModal_quizAccess">quiz </a>
                        </li>
                        @endif
                        <li class="page-scroll">
                            <a href="{{url('/admin/panel')}}">Panel </a>
                        </li>
                        <li class="page-scroll">
                            <a href="{{url('/admin/result')}}">Online test result </a>
                        </li>
                        <li class="page-scroll">
                            <a href="{{url('/admin/ranking')}}">Ranking</a>
                        </li>
                        <li class="page-scroll">
                            <a href="{{url('/admin/suggestion')}}">Suggestions</a>
                        </li>
                        <li class="page-scroll">
                            <a href="{{url('/admin/logout')}}">Logout</a>
                        </li>

                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>

        @yield('content')

        <!-- jQuery -->
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

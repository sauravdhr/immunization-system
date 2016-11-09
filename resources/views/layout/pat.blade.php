<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Immunization Management System</title>
      <!-- Bootstrap Core CSS -->
      <link href="{{ URL::asset('css/bootstrap.css') }}" rel="stylesheet">
      <link href="{{ URL::asset('css/toastr.css') }}" rel="stylesheet">
      <!-- Custom CSS -->
      <link href="{{ URL::asset('css/business-casual.css') }}" rel="stylesheet">
      <link rel="stylesheet" href="{{ URL::asset('css/datepicker.css') }}">
      <!-- Fonts -->
      <link href="{{ URL::asset('css/fonts/font1.css') }}" rel="stylesheet" type="text/css">
      <link href="{{ URL::asset('css/fonts/font2.css') }}" rel="stylesheet" type="text/css">
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <body>
      <div class="brand">Immunization Management System</div>
      <div class="address-bar">Better health | Better nation</div>
      <!-- Navigation -->
      <nav class="navbar navbar-default" role="navigation">
         <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               </button>
               <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
               <a class="navbar-brand" href="index.html">Immunization</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
               <ul class="nav navbar-nav">
                  <li class="{{ (Request::is('/') ? 'active' : '') }}">
                     <a href="{{ URL::to('') }}">Home</a>
                  </li>
                  <li class="{{ (Request::is('/about') ? 'active' : '') }}">
                     <a href="{{ URL::to('profile') }}">Profile</a>
                  </li>
                  <li class="{{ (Request::is('/viewNotifications') ? 'active' : '') }}" >
                     <a href="{{ URL::to('viewNotifications') }}"> View</br>Notifications</a>
                  </li>
                  <li class="{{ (Request::is('/logout') ? 'active' : '') }}">
                     <a href="{{ URL::to('logout') }}">Logout</a>
                  </li>
               </ul>
            </div>
            <!-- /.navbar-collapse -->
         </div>
         <!-- /.container -->
      </nav>
      <div class="container">
         <div class="row">
            <div class="box">
               @yield('content')
               <div class="clearfix"></div>
            </div>
         </div>
      </div>
      <!-- /.container -->
      <footer>
         <div class="container">
            <div class="row">
               <div class="col-lg-12 text-center">
                  <p>Copyright &copy; www.ims-bd.com 2015</p>
               </div>
            </div>
         </div>
      </footer>
      <!-- jQuery -->
      <script src="{{ URL::asset('js/jquery.js') }}"></script>
      <!-- Bootstrap Core JavaScript -->
      <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
      <script src="{{ URL::asset('js/bootstrap-datepicker.js') }}"></script>
      <script src="{{ URL::asset('js/toastr.js') }}"></script>
      <script type="text/javascript">
         // When the document is ready
         $(document).ready(function () {
             
             $('#example1').datepicker({
                 format: "dd/mm/yyyy"
             });  
         
         });
      </script>
      @yield('toast')
   </body>
</html>

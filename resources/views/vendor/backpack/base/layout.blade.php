<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Encrypted CSRF token for Laravel, in order for Ajax requests to work --}}
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>
      {{ isset($title) ? $title.' :: '.config('backpack.base.project_name').' Admin' : config('backpack.base.project_name').' Admin' }}
    </title>

    @yield('before_styles')

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/dist/css/skins/_all-skins.min.css">

    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/plugins/pace/pace.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/backpack/pnotify/pnotify.custom.min.css') }}">

    <!-- BackPack Base CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/backpack/backpack.base.css') }}">


    <?php  $user = \Auth::user();


    if((($user)AND(!$user->hasRole('admin') )) OR ( \Request::route()->getName() =="backpack.auth.register") ){     ?>


    <link href="{{ URL::to('/') }}/css/bulma.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/css/style.css" rel="stylesheet">


<style>

table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>td:first-child:before, table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>th:first-child:before {

    background-color: #00B49A !important;
}

.fa{
  font-weight: initial !important;
      font: normal normal normal 14px/1 FontAwesome !important;
}
.container-fluid {
    width: 100% !important;
}

.content ul {
    margin-left: 8em !important;

}

body[class^='skin-purple'] .pagination>.active>a, body[class^='skin-purple'] .pagination>.active>a:focus, body[class^='skin-purple'] .pagination>.active>a:hover, body[class^='skin-purple'] .pagination>.active>span, body[class^='skin-purple'] .pagination>.active>span:focus, body[class^='skin-purple'] .pagination>.active>span:hover {
    background-color: #00B49A !important;
    border-color: #00B49A !important;
}

body[class^='skin-purple'] .btn-primary:focus,
body[class^='skin-purple'] .btn-primary.focus {
  color: #fff;
  background-color: #00B49A !important;
  border-color: #00B49A !important;
}

body[class^='skin-purple'] .btn-primary {
    color: #fff;
    background-color: #00B49A !important;
    border-color: #00B49A;
}


.btn-primary:active,.btn-primary.hover{    background-color: #00B49A !important;
    border-color: #00B49A !important;}

.content h1, .content h2, .content h3, .content h4, .content h5, .content h6 {
    color: white; 

}

.footer{
background-color:#FAFAFA !important; 
}

.content {
    min-height: 30px !important;
}    

.content-wrapper{
    background-color: #F5F5F5 !important;
    margin-left: 50px !important;
}

.skin-purple .wrapper, .skin-purple .main-sidebar, .skin-purple .left-side {
     background-color: #F5F5F5 !important;
}

.breadcrumb li {
    /* align-items: center; */
    display: inline !important;
}
</style>


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    <?php } 

     ?>


    @yield('after_styles')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition {{ config('backpack.base.skin') }} sidebar-mini">

      <!-- jQuery 2.2.0 -->
  <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>

	<script type="text/javascript">
		/* Recover sidebar state */
		(function () {
			if (Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))) {
				var body = document.getElementsByTagName('body')[0];
				body.className = body.className + ' sidebar-collapse';
			}
		})();
	</script>
    <!-- Site wrapper -->
    <div class="wrapper">




    <?php  $user = \Auth::user();


   if(($user)AND($user->hasRole('admin') )){     ?>


      <header class="main-header">
        <!-- Logo -->
        <a href="{{ url('') }}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">{!! config('backpack.base.logo_mini') !!}</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">{!! config('backpack.base.logo_lg') !!}</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">{{ trans('backpack::base.toggle_navigation') }}</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>

          @include('backpack::inc.menu')
        </nav>
      </header>

      <?php  }else{ 


if (!\Request::is('admin/login')) { 

  ?>



<header>

  <div class="navbar-cont" style="background-color:white !important">
    <div class="container">
      <div class="columns header-img is-mobile">
        <div class="column has-text-centered ">
          <img src="{{ URL::to('/') }}/img/untref-logo.png">
          
        </div>
        <div class="column has-text-centered ">
          <img src="{{ URL::to('/') }}/img/cidem-logo.png">
          
        </div>
        <div class="column has-text-centered ">
          <img src="{{ URL::to('/') }}/img/logo.png">
          
        </div>
        <div class="column has-text-centered is-one-quarter is-mobile">
          <nav class="navbar-end " role="navigation" aria-label="dropdown navigation">
            <div class="navbar-item has-dropdown is-hoverable has-text-right">
              <a class="navbar-link no-arrow">
                <i class="fas fa-bars"></i>
              </a>

              <div class="navbar-dropdown is-right" style="
    z-index: 99;
">
                <a class="navbar-item">
                  Administración
                </a>
                <a class="navbar-item" href="{{ url(config('backpack.base.route_prefix', 'admin') . '/user') }}">
                  Control de usuario
                </a>
                 <a class="navbar-item">
                    Parámetros
                  </a>
                   <a class="navbar-item">
                    Vista - Usuarios
                  </a>
                <hr class="navbar-divider">
                <a class="navbar-item" href="{{ url(config('backpack.base.route_prefix', 'admin') . '/lines/create') }}">
                  Nueva fuente
                </a>
                
                  <a class="navbar-item" href="{{ url(config('backpack.base.route_prefix', 'admin') . '/lines') }}" >
                    Editar fuente
                  </a>


              <?php /* <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Salir</a>  */ ?>

<a class="navbar-item" href="http://localhost:8000/admin/logout"><i class="fa fa-btn fa-sign-out"></i> Salir</a>

 
            
              </div>
            </div>
          </nav>
          
        </div>
      </div>
    </div>
  </div>
</header>





      <?php  }

        }

       ?>

      <!-- =============================================== -->

<?php  $user = \Auth::user();
        
        if(($user)AND($user->hasRole('admin') )){     ?>
          ?>
        @include('backpack::inc.sidebar') 

      <?php }else{ ?>

      <style>/*
      .skin-purple .wrapper, .skin-purple .main-sidebar, .skin-purple .left-side {
      background-color: #ECF0F5 !important;
      }  */
    </style>

      <?php   }  ?>
      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
         @yield('header')

        <!-- Main content -->
        <section class="content">

          @yield('content')

        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->



 <?php  if(($user)AND($user->hasRole('admin') )){     ?>



      <footer class="main-footer">
        @if (config('backpack.base.show_powered_by'))
            <div class="pull-right hidden-xs">
              {{ trans('backpack::base.powered_by') }} <a target="_blank" href="http://backpackforlaravel.com?ref=panel_footer_link">Backpack for Laravel</a>
            </div>
        @endif
        {{ trans('backpack::base.handcrafted_by') }} <a target="_blank" href="{{ config('backpack.base.developer_link') }}">{{ config('backpack.base.developer_name') }}</a>.
      </footer>

    <?php  }else{ ?>

    <footer class="footer">
      <div class="container">
        <div class="content has-text-centered">
          <p>
            <strong>CIDEM</strong> Centro de Innovación y Desarrollo de Empresas y Organizaciones <a href="http://untref.edu.ar">UNTREF</a>
          </p>
        </div>
      </div>
    </footer>


    <?php  } ?>
    </div>
    <!-- ./wrapper -->


    @yield('before_scripts')

    <script>window.jQuery || document.write('<script src="{{ asset('vendor/adminlte') }}/plugins/jQuery/jQuery-2.2.0.min.js"><\/script>')</script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{ asset('vendor/adminlte') }}/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ asset('vendor/adminlte') }}/plugins/pace/pace.min.js"></script>
    <script src="{{ asset('vendor/adminlte') }}/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="{{ asset('vendor/adminlte') }}/plugins/fastclick/fastclick.js"></script>
    <script src="{{ asset('vendor/adminlte') }}/dist/js/app.min.js"></script>

    <!-- page script -->
    <script type="text/javascript">
        /* Store sidebar state */
        $('.sidebar-toggle').click(function(event) {
          event.preventDefault();
          if (Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))) {
            sessionStorage.setItem('sidebar-toggle-collapsed', '');
          } else {
            sessionStorage.setItem('sidebar-toggle-collapsed', '1');
          }
        });
        // To make Pace works on Ajax calls
        $(document).ajaxStart(function() { Pace.restart(); });

        // Ajax calls should always have the CSRF token attached to them, otherwise they won't work
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
        // Set active state on menu element
        var current_url = "{{ Request::fullUrl() }}";
        var full_url = current_url+location.search;
        var $navLinks = $("ul.sidebar-menu li a");
        // First look for an exact match including the search string
        var $curentPageLink = $navLinks.filter(
            function() { return $(this).attr('href') === full_url; }
        );
        // If not found, look for the link that starts with the url
        if(!$curentPageLink.length > 0){
            $curentPageLink = $navLinks.filter(
                function() { return $(this).attr('href').startsWith(current_url) || current_url.startsWith($(this).attr('href')); }
            );
        }
        
        $curentPageLink.parents('li').addClass('active');
        {{-- Enable deep link to tab --}}
        var activeTab = $('[href="' + location.hash.replace("#", "#tab_") + '"]');
        location.hash && activeTab && activeTab.tab('show');
        $('.nav-tabs a').on('shown.bs.tab', function (e) {
            location.hash = e.target.hash.replace("#tab_", "#");
        });
    </script>

    @include('backpack::inc.alerts')

    @yield('after_scripts')

    <!-- JavaScripts -->
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="CIDEM - Centro de Innovación y Desarrollo de Empresas y Organizaciones">
    <meta name="author" content="CIDEM">
	<!--title-->
    <title>CIDEM - Centro de Innovación y Desarrollo de Empresas y Organizaciones</title>
	
	<!--CSS-->
    
	<link rel="shortcut icon" href="{{ URL::to('/') }}/img/logoicon.png" type="image/png">

	<link href="{{ URL::to('/') }}/css/bulma.css" rel="stylesheet">
	<link href="{{ URL::to('/') }}/css/style.css" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

	
	
	<!--Google Fonts-->
</head><!--/head-->






<header>

	<div class="navbar-cont">
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

					    <div class="navbar-dropdown is-right">
					      <a class="navbar-item">
					        Administración
					      </a>
					      <a class="navbar-item" href="{{ url(config('backpack.base.route_prefix', 'admin') . '/user') }}" >
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
					      
					        <a class="navbar-item" href="{{ url(config('backpack.base.route_prefix', 'admin') . '/lines') }}">
					        	Editar fuente
					        </a>


							<?php /* <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Salir</a>  */ ?>

<a class="navbar-item" href="{{ URL::to('/')}}/admin/logout"><i class="fa fa-btn fa-sign-out"></i> Salir</a>

 
					  
					    </div>
					  </div>
					</nav>
				  
				</div>
			</div>
		</div>
	</div>
</header>




<body>
	@yield("das")

	  </body>
</html>

<div class="main-menu">
	<header class="header">
		<a href="index.html" class="logo">Reservas Hotel</a>
		<button type="button" class="button-close fa fa-times js__menu_close"></button>
		<div class="user">
			<a href="#" class="avatar"><img src="http://placehold.it/80x80" alt=""><span class="status online"></span></a>
			<h5 class="name"><a href="profile.html">Nombre Usuario</a></h5>
			<h5 class="position">Tipo Usuario</h5>
			<!-- /.name -->
			<div class="control-wrap js__drop_down">
				<i class="fa fa-caret-down js__drop_down_button"></i>
				<div class="control-list">
					<div class="control-item"><a href="cerrarSesion.php"><i class="fa fa-sign-out"></i> Log out</a></div>
				</div>
				<!-- /.control-list -->
			</div>
			<!-- /.control-wrap -->
		</div>
		<!-- /.user -->
	</header>
	<!-- /.header -->
	<div class="content">


		<div class="navigation">
			<h5 class="title">Navigation</h5>
			<!-- /.title -->
			<ul class="menu js__accordion">
				<li class="current">
					<a class="waves-effect" href="index.php"><i class="menu-icon fa fa-home"></i><span>Dashboard</span></a>
			</li>
            <li class="current">
					<a class="waves-effect" href="page-login.php"><i class="menu-icon fa fa-bed"></i><span>Habitaciones</span></a>
			</li>
            <li class="current">
					<a class="waves-effect" href="page-login.php"><i class="menu-icon fa fa-calendar "></i><span>Reservaciones</span></a>
			</li>
            <li class="current">
					<a class="waves-effect" href="page-login.php"><i class="menu-icon fa fa-user "></i><span>Clientes</span></a>
			</li>
            <li class="current">
					<a class="waves-effect" href="page-login.php"><i class="menu-icon fa fa-users "></i><span>Usuarios</span></a>
			</li>
            <li class="current">
					<a class="waves-effect" href="page-login.php"><i class="menu-icon fa fa-line-chart "></i><span>Ganancias</span></a>
			</li>
			<li class="current">
					<a class="waves-effect" href="page-login.php"><i class="menu-icon fa fa-power-off "></i><span>Cerrar sesion</span></a>
			</li>
			
			</ul>
			
			
		</div>
		<!-- /.navigation -->
	</div>
	<!-- /.content -->
</div>

<div class="fixed-navbar">
	<div class="pull-left">
		<button type="button" class="menu-mobile-button glyphicon glyphicon-menu-hamburger js__menu_mobile"></button>
		<h1 class="page-title"><?php if(isset($respuesta)){echo $respuesta;}else{echo "HOME";}?></h1>
		<!-- /.page-title -->
	</div>
	<!-- /.pull-left -->
	<div class="pull-right">

		<!-- /.ico-item -->
		<div class="ico-item fa fa-arrows-alt js__full_screen"></div>
		
		<!-- /.ico-item -->
		<a href="cerrarSesion.php" class="ico-item fa fa-power-off "></a>
	</div>
	<!-- /.pull-right -->
</div>
<!-- /.fixed-navbar -->
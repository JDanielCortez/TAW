<div class="main-menu">
	<header class="header">
		<a href="index.html" class="logo">Gestor Escolar</a>
		<button type="button" class="button-close fa fa-times js__menu_close"></button>
		<div class="user">
			<a href="#" class="avatar"><img src="http://placehold.it/80x80" alt=""><span class="status online"></span></a>
			<h5 class="name"><a href="#"><?php if(isset($_SESSION['nombre'])){echo $_SESSION['nombre'];} ?></a></h5>
			<h5 class="position">Administrador</h5>
			<!-- /.name -->
			<div class="control-wrap js__drop_down">
				<i class="fa fa-caret-down js__drop_down_button"></i>
				<div class="control-list">
					<div class="control-item"><a href="salir.php"><i class="fa fa-sign-out"></i> Salir</a></div>
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
			<h5 class="title">Menú</h5>
			<!-- /.title -->
			<ul class="menu js__accordion">
				<li class="current">
					<a class="waves-effect parent-item" href="index.php"><i class="menu-icon fa fa-home"></i><span>Inicio</span></a>
				</li>
				<li class="current">
						<a class="waves-effect parent-item" href="index.php?action=alumnos"><i class="menu-icon fa fa-user"></i><span>Alumnos</span></a>
						
				</li>
				<li class="current">
						<a class="waves-effect parent-item  js__control" href="#"><i class="menu-icon fa fa-briefcase"></i><span>Maestros</span><span class="menu-arrow fa fa-angle-down"></span></a>
						<ul class="sub-menu js__content">
							<li><a href="index.php?action=maestros">Gestor Maestros</a></li>
							<li><a href="index.php?action=tutorias">Tutorias</a></li>
						</ul>
				</li>

				<li class="current">
						<a class="waves-effect parent-item" href="index.php?action=materias"><i class="menu-icon fa fa-book"></i><span>Materias</span></a>
				</li>	
				
				<li class="current">
						<a class="waves-effect parent-item" href="index.php?action=grupos"><i class="menu-icon fa fa-users"></i><span>Grupos</span></a>
				</li>		
			</ul>
	</div>
		<!-- /.navigation -->
	</div>
	<!-- /.content -->
</div>

$resultado = "";
<?php if(isset($_GET['action'])){ $resultado = strtoupper($_GET['action']);}else{ $resultado = 'INICIO';} ?>
<?php if($_GET['action'] == 'salir'){ header('location: index.php?action=login');	 } ?>
<div class="fixed-navbar">
	<div class="pull-left">
		<button type="button" class="menu-mobile-button glyphicon glyphicon-menu-hamburger js__menu_mobile"></button>
		<h1 class="page-title"><?php echo $resultado; if(isset($_GET['registrar'])){ echo ' / AGREGAR';} else if(isset($_GET['ver'])) { echo ' / CONSULTAR';} else if(isset($_GET['id'])) { echo ' / EDITAR';} ?></h1>
		<!-- /.page-title -->
	</div>
	<!-- /.pull-left -->
	<div class="pull-right">

		<!-- /.ico-item -->
		<div class="ico-item fa fa-arrows-alt js__full_screen"></div>
		
		<!-- /.ico-item -->
		<a href="index.php?action=salir" class="ico-item fa fa-power-off "></a>
	</div>
	<!-- /.pull-right -->
</div>
<!-- /.fixed-navbar -->
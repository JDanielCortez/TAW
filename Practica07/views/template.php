<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">
  
  <link rel="shortcut icon" type="image/x-icon" href="img/eductaion-hat-school-icon-4-300x300.png" />


	<title>Gestor Escolar</title>

	<!-- Main Styles -->
	<link rel="stylesheet" href="assets/styles/style.min.css">

	<!-- mCustomScrollbar -->
	<link rel="stylesheet" href="assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.min.css">

	<!-- Waves Effect -->
	<link rel="stylesheet" href="assets/plugin/waves/waves.min.css">

	<!-- Sweet Alert -->
	<link rel="stylesheet" href="assets/plugin/sweet-alert/sweetalert.css">
	
	<!-- Percent Circle -->
	<link rel="stylesheet" href="assets/plugin/percircle/css/percircle.css">

	<!-- FullCalendar -->
	<link rel="stylesheet" href="assets/plugin/fullcalendar/fullcalendar.min.css">
	<link rel="stylesheet" href="assets/plugin/fullcalendar/fullcalendar.print.css" media='print'>

	<!-- Data Tables -->
	<link rel="stylesheet" href="assets/plugin/datatables/media/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="assets/plugin/datatables/extensions/Responsive/css/responsive.bootstrap.min.css">

	<!-- Select2 -->
	<link rel="stylesheet" href="assets/plugin/select2/css/select2.min.css">


	<!-- Dark Themes -->
	<link rel="stylesheet" href="assets/styles/style-dark.min.css">
</head>
<body>
    
<?php
	session_start();
	
	if(isset($_SESSION['validar']) and $_SESSION['validar']==true){
		include "modules/navegacion.php";?>
		<div id="wrapper">
			<div class="main-content">
				<div class="row small-spacing">
					<div class="col-xs-12">
					<?php
	}

	/** AQUI VA LO DE ENLACES PAGINAS CONTROLLER */
	
	$mvc = new MvcController();
	$mvc -> enlacesPaginasController();
	
	?>
          </div>
        </div>
      </div>
  </div>

    <!-- Placed at the end of the document so the pages load faster -->
	<script src="assets/scripts/jquery.min.js"></script>
	<script src="assets/scripts/modernizr.min.js"></script>
	<script src="assets/plugin/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="assets/plugin/nprogress/nprogress.js"></script>
	<script src="assets/plugin/sweet-alert/sweetalert.min.js"></script>
	<script src="assets/plugin/waves/waves.min.js"></script>
	<!-- Full Screen Plugin -->
	<script src="assets/plugin/fullscreen/jquery.fullscreen-min.js"></script>


	<!-- FullCalendar -->
	<script src="assets/plugin/moment/moment.js"></script>
	<script src="assets/plugin/fullcalendar/fullcalendar.min.js"></script>
	<script src="assets/scripts/fullcalendar.init.js"></script>

	<!-- Data Tables -->
	<script src="assets/plugin/datatables/media/js/jquery.dataTables.min.js"></script>
	<script src="assets/plugin/datatables/media/js/dataTables.bootstrap.min.js"></script>
	<script src="assets/plugin/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
	<script src="assets/plugin/datatables/extensions/Responsive/js/responsive.bootstrap.min.js"></script>
	<script src="assets/scripts/datatables.demo.min.js"></script>

            
  <!-- Datepicker -->
	<script src="assets/plugin/datepicker/js/bootstrap-datepicker.min.js"></script>

	<!-- Select2 -->
	<script src="assets/plugin/select2/js/select2.min.js"></script>

	<script src="assets/scripts/main.min.js"></script>
</body>
</html>
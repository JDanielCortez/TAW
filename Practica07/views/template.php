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
	<link rel="stylesheet" href="views/assets/styles/style.min.css">

	<!-- mCustomScrollbar -->
	<link rel="stylesheet" href="views/assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.min.css">

	<!-- Waves Effect -->
	<link rel="stylesheet" href="views/assets/plugin/waves/waves.min.css">

	<!-- Sweet Alert -->
	<link rel="stylesheet" href="views/assets/plugin/sweet-alert/sweetalert.css">
	
	<!-- Percent Circle -->
	<link rel="stylesheet" href="views/assets/plugin/percircle/css/percircle.css">

	<!-- FullCalendar -->
	<link rel="stylesheet" href="views/assets/plugin/fullcalendar/fullcalendar.min.css">
	<link rel="stylesheet" href="views/assets/plugin/fullcalendar/fullcalendar.print.css" media='print'>

	<!-- Data Tables -->
	<link rel="stylesheet" href="views/assets/plugin/datatables/media/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="views/assets/plugin/datatables/extensions/Responsive/css/responsive.bootstrap.min.css">

	<!-- Select2 -->
	<link rel="stylesheet" href="views/assets/plugin/select2/css/select2.min.css">

	<!-- Colorpicker -->
	<link rel="stylesheet" href="views/assets/plugin/colorpicker/css/bootstrap-colorpicker.min.css">

<!-- Datepicker -->
<link rel="stylesheet" href="views/assets/plugin/datepicker/css/bootstrap-datepicker.min.css">


	<!-- Timepicker -->
	<link rel="stylesheet" href="views/assets/plugin/timepicker/bootstrap-timepicker.min.css">


	<!-- Dark Themes -->
	<!-- <link rel="stylesheet" href="views/assets/styles/style-dark.min.css"> -->
	
	<!-- <link rel="stylesheet" href="./views/css/foundation.css" /> -->
	<link href="./views/css/select2.min.css" rel="stylesheet" />
	<!-- <link rel="stylesheet" type="text/css" href="./views/css/datatables.min.css"/> -->

	
	
	<script src="./views/js/vendor/jquery.js"></script>
  <script src="./views/js/vendor/modernizr.js"></script>
	<script src="./views/js/select2.min.js"></script>
	<!-- <script type="text/javascript" src="./views/js/datatables/datatables.min.js"></script> -->


    
	<style>
		td {
		  vertical-align: baseline;
		}

		
	</style>

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
	<script src="views/assets/scripts/jquery.min.js"></script>
	<script src="views/assets/scripts/modernizr.min.js"></script>
	<script src="views/assets/plugin/bootstrap/js/bootstrap.min.js"></script>
	<script src="views/assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="views/assets/plugin/nprogress/nprogress.js"></script>
	<script src="views/assets/plugin/sweet-alert/sweetalert.min.js"></script>
	<script src="views/assets/plugin/waves/waves.min.js"></script>
	<!-- Full Screen Plugin -->
	<script src="views/assets/plugin/fullscreen/jquery.fullscreen-min.js"></script>


	<!-- FullCalendar -->
	<script src="views/assets/plugin/moment/moment.js"></script>
	<script src="views/assets/plugin/fullcalendar/fullcalendar.min.js"></script>
	<script src="views/assets/scripts/fullcalendar.init.js"></script>

	<!-- Data Tables -->
	<script src="views/assets/plugin/datatables/media/js/jquery.dataTables.min.js"></script>
	<script src="views/assets/plugin/datatables/media/js/dataTables.bootstrap.min.js"></script>
	<script src="views/assets/plugin/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
	<script src="views/assets/plugin/datatables/extensions/Responsive/js/responsive.bootstrap.min.js"></script>
	<script src="views/assets/scripts/datatables.demo.min.js"></script>

            
  <!-- Datepicker -->
	<script src="views/assets/plugin/datepicker/js/bootstrap-datepicker.min.js"></script>

	<!-- Timepicker -->
	<script src="views/assets/plugin/timepicker/bootstrap-timepicker.min.js"></script>


	<!-- Select2 -->
	<script src="views/assets/plugin/select2/js/select2.min.js"></script>

	<script src="views/assets/scripts/main.min.js"></script>
</body>
<script>
	$(document).ready( function () {
	    $('#table').DataTable();
	} );		
</script>
</html>
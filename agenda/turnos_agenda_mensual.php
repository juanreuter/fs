<?php
error_reporting('0');

//controlo acceso y auditoria
session_start();
if(!$_SESSION["log"]) header("location:acceso.php");
$usrmodi=$_SESSION["dni"];
$fecmodi=date("Y-m-d H:i:s");
$usralta=$_SESSION["dni"];
$fecalta=date("Y-m-d H:i:s");
$id_usuario=$_SESSION["idusuario"];

//base de datos
include ("../funciones/conexion_bbdd.php");

// recibo el dato del medico
if($_REQUEST["idmedico"] != "") {
$idmedico = $_REQUEST["idmedico"];
}

$res_agenda=mysqli_query($link,"SELECT fecha_turno, pacientes.idpaciente as idpaciente, idturno, hora_turno, hora_llegada, hora_atencion, pacientes.nombre as nombre_paciente, motivo_turno, primera_consulta FROM turnos, pacientes WHERE turnos.idpaciente=pacientes.idpaciente AND idmedico = $idmedico AND turnos.vigente='1' ORDER BY hora_turno ");

?>


<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link href='fullcalendar.css' rel='stylesheet' />
<link href='fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='lib/moment.min.js'></script>
<script src='lib/jquery.min.js'></script>
<script src='fullcalendar.min.js'></script>
<script>

	$(document).ready(function() {

		$('#calendar').fullCalendar({
			defaultDate: '2014-11-01',
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: [
				<?php while($row=mysqli_fetch_assoc($res_agenda)) { ?>	

				{
					title: '<?php echo date("H:i",strtotime($row["hora_turno"]))?> - <?php echo $row["nombre_paciente"]?>',
					start: '<?php echo $row["fecha_turno"]?>'
				},
				<?php } ?>
								
			]
		});
		
	});

</script>
<style>

	body {
		margin: 40px 10px;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}

	#calendar {
		max-width: 900px;
		margin: 0 auto;
	}

</style>
</head>
<body>

	<div id='calendar'></div>

</body>
</html>

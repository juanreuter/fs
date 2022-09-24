<?php
//controlo acceso y auditoria
session_start();
if(!$_SESSION["log"]) header("location:index.php");
$usrmodi=$_SESSION["Usuario"];
$fecmodi=date("Y-m-d H:i:s");
$usralta=$_SESSION["Usuario"];
$fecalta=date("Y-m-d H:i:s");

//base de datos
include ("../funciones/conexion_bbdd.php");

$denuncias=mysqli_query($link,"SELECT denuncias_docentes.ID as IDDenuncia, ACC_Nombre, ACC_Junta, ACC_JuntaHora, ACC_Telefono, Nombre as NomInst, DE_DiagnosticoPres, Descripcion as Especialidad FROM denuncias_docentes , instituciones, especialidades WHERE ACC_Junta <> '0000-00-00' AND denuncias_docentes.DE_IDInstitucion = instituciones.ID  AND especialidades.IDEspecialidad= denuncias_docentes.ACC_IDEspecialidad ORDER BY Acc_Junta ASC");

?>


<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link href='fullcalendar.css' rel='stylesheet' />
<link href='fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='lib/moment.min.js'></script>
<script src='lib/jquery.min.js'></script>
<script src='fullcalendar.min.js'></script>
<script src='lang-all.js'></script>
<script>
	$(document).ready(function() {
			$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			defaultDate: '2014-12-01',
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: [
				
				<?php while($row=mysqli_fetch_assoc($denuncias)) { ?>	
				{
					title: '<?php echo date("H:i",strtotime($row["ACC_JuntaHora"]))?> - <?php echo $row["ACC_Nombre"]?> - <?php echo $row["NomInst"]?> ',
					start: '<?php echo $row["ACC_Junta"]?>'
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

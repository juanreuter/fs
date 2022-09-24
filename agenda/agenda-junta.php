<?php
//controlo acceso y auditoria
session_start();
if(!$_SESSION["log"]) header("location:index.php");
$usrmodi=$_SESSION["Usuario"];
$fecmodi=date("Y-m-d H:i:s");
$usralta=$_SESSION["Usuario"];
$fecalta=date("Y-m-d H:i:s");
$fecha =date("Y-m-d");

//base de datos
include ("../funciones/conexion_bbdd.php");

// regla de negocios
$denuncias=mysqli_query($link,"SELECT denuncias_docentes.ID as IDDenuncia, ACC_Nombre, ACC_Junta, ACC_JuntaHora, Descripcion as Especialidad, instituciones.Nombre as NombreInst FROM denuncias_docentes , instituciones, especialidades WHERE ACC_Junta <> '0000-00-00' AND denuncias_docentes.DE_IDInstitucion = instituciones.ID  AND especialidades.IDEspecialidad= denuncias_docentes.ACC_IDEspecialidad AND denuncias_docentes.vigente=1 ORDER BY Acc_Junta ASC");

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
		var currentLangCode = 'es';
			// build the language selector's options
		$.each($.fullCalendar.langs, function(langCode) {
			$('#lang-selector').append(
				$('<option/>')
					.attr('value', langCode)
					.prop('selected', langCode == currentLangCode)
					.text(langCode)
			);
		});

  		// rerender the calendar when the selected option changes
		$('#lang-selector').on('change', function() {
			if (this.value) {
				currentLangCode = this.value;
				$('#calendar').fullCalendar('destroy');
				renderCalendar();
			}
		});

		function renderCalendar() {
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			defaultDate: '<?php echo $fecha?>',
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: [
			<?php while($row=mysqli_fetch_assoc($denuncias)) { ?>	
				{
					title: '<?php echo $row["ACC_Nombre"]?> - <?php echo $row["Especialidad"]?> - <?php echo $row["NombreInst"]?>',
					start: '<?php echo $row["ACC_Junta"]?>T<?php echo $row["ACC_JuntaHora"]?>',
					end: '<?php echo $row["ACC_Junta"]?>T<?php echo date('H:i:s', strtotime($row["ACC_JuntaHora"]) + 3600)?>'
				},
				<?php } ?>
				]
		   });
		}
		renderCalendar();
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

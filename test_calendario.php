<?php
//controlo acceso y auditoria
session_start();
if(!$_SESSION["log"]) header("location:index.php");
$usrmodi=$_SESSION["Usuario"];
$fecmodi=date("Y-m-d H:i:s");
$usralta=$_SESSION["Usuario"];
$fecalta=date("Y-m-d H:i:s");

//base de datos
include ("funciones/conexion_bbdd.php");


// regla de negocios
$denuncias=mysqli_query($link,"SELECT denuncias_docentes.ID as IDDenuncia, ACC_Nombre, ACC_Junta, ACC_JuntaHora, ACC_Telefono, Nombre as NomInst, DE_DiagnosticoPres, Descripcion as Especialidad FROM denuncias_docentes , instituciones, especialidades WHERE ACC_Junta <> '0000-00-00' AND ACC_Junta >= curdate() AND denuncias_docentes.DE_IDInstitucion = instituciones.ID  AND especialidades.IDEspecialidad= denuncias_docentes.ACC_IDEspecialidad ORDER BY Acc_Junta ASC");

?>


<?php 
# definimos los valores iniciales para nuestro calendario
$month=date("n");
$year=date("Y");
$diaActual=date("j");

# Obtenemos el dia de la semana del primer dia
# Devuelve 0 para domingo, 6 para sabado
$diaSemana=date("w",mktime(0,0,0,$month,1,$year))+7; 
echo $diaSemana;
# Obtenemos el ultimo dia del mes
$ultimoDiaMes=date("d",(mktime(0,0,0,$month+1,1,$year)-1));
echo $ultimoDiaMes;

$meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
"Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
?>

<!DOCTYPE html>
<html lang="es">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	
	<style>
		#calendar {
			font-family:Arial;
			font-size:12px;
		}
		#calendar caption {
			text-align:left;
			padding:10px 20px;
			background-color:#003366;
			color:#fff;
			font-weight:bold;
		}
		#calendar th {
			background-color:#006699;
			color:#fff;
			width:100px;
			height:50px;
			font-size:14px;
		}
		#calendar td {
			text-align:center;
			font-size:14px			
			padding:5px 10px;
			background-color:silver;
			height:70px;
		}
		#calendar .hoy {
			background-color:red;
		}
	</style>
</head>

<body>
<table id="calendar"> 
	<caption><?php echo $meses[$month]." ".$year?></caption>
	<tr> 
		<th>Lun</th><th>Mar</th><th>Mie</th><th>Jue</th>
		<th>Vie</th><th>Sab</th><th>Dom</th>
	</tr>
	<tr bgcolor="silver"> 
		<?php
		$last_cell=$diaSemana+$ultimoDiaMes;
		echo $last_cell;
		// hacemos un bucle hasta 42, que es el m�ximo de valores que puede
		for($i=1;$i<=42;$i++)
		{
			if($i==$diaSemana)
			{
				// determinamos en que dia empieza
				$day=1;
			}
			if($i<$diaSemana || $i>=$last_cell)
			{
				// celca vacia
				echo "<td >  </td>";
			}else{
				
				// mostramos el dia
				if($day==$diaActual)
				
				// fin de la pregunta
					echo "<td class='hoy'>$day</td>";
				else
					echo "<td>$day</td>";
				$day++;
				
				
			}
			// cuando llega al final de la semana, iniciamos una columna nueva
			if($i%7==0)
			{
				echo "</tr><tr>\n";
			}
		}
	?>
	</tr>
</table>
</body>
</html>
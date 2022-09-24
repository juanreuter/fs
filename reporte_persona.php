<?php
//controlo acceso y auditoria
session_start();
if(!$_SESSION["log"]) header("location:index.php");
$usrmodi=$_SESSION["Usuario"];
$fecmodi=date("Y-m-d H:i:s");
$usralta=$_SESSION["Usuario"];
$fecalta=date("Y-m-d H:i:s");
$mensaje = "Clic para cargar o imprimir los beneficiarios";
//base de datos
include ("funciones/conexion_bbdd.php");


if($_REQUEST["id"]) {
	$inst = mysqli_fetch_assoc(mysqli_query($link,"select b.* from personal a, instituciones b where b.ID=a.IDInstitucion and a.ID=". $_REQUEST["id"]));
	$per = mysqli_fetch_assoc(mysqli_query($link,"select * from personal where ID=". $_REQUEST["id"]));
	$ddjj = mysqli_query($link,"select * from declaraciones_juradas where IDPersonal=". $_REQUEST["id"]);
}

else {
	echo "<script>window.close();</script>";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<html>

<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

<title>Fondo Solidario  |  Sistema de Gestión</title>



<link href="../estilos/estilos.css" rel="stylesheet" type="text/css">

</head>

<body style="background-color:transparent" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<table border="0" class="tablapie" >

  <tr>

    <td><div align="center"><img src="images/top_reportes.png" width="673" height="99" /></div></td>

  </tr>

</table>

<br />

<table width="700" align="left" >

  <tr>

    <td width="500" height="25" colspan="2" class="tahoma12"><b>&nbsp;&nbsp;1. DATOS DEL ESTABLECIMIENTO</b></td>

  </tr>

</table>

<br />

<br />

<table width="700"  align="left" class="tablareporte" >

  <tr>

    <td height="25" colspan="2" class="tahoma12"><b>Instituto:</b>&nbsp;<?php echo $inst["Nombre"]?></td>

  </tr>

  <tr>

    <td width="250" height="25" bordercolor="#000000" class="tahoma12"><b>Domicilio:</b>&nbsp;<?php echo $inst["Domicilio"]?></td>

    <td width="250" bordercolor="#000000" class="tahoma12"><b>Localidad:</b>&nbsp;<?php echo $inst["Localidad"]?></td>

  </tr>

</table>

<p></p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<table width="700" align="left" cellpadding="2" >

  <tr>

    <td width="500" height="25" colspan="2" class="tahoma12"><b>&nbsp;&nbsp;2. DATOS DEL TITULAR</b></td>

  </tr>

</table>

<br />

<br />

<table align="left" class="tablareporte" >

<tr>

  <td height="25" colspan="2" class="tahoma12"><b>Apellido y Nombre:</b>&nbsp;<?php echo $per["Nombre"]?></td>

</tr>
	<tr>

  <td width="250" height="25" class="tahoma12"><b>DNI:</b>&nbsp;<?php echo $per["CUIL"]?></td>
  <td width="250" height="25" class="tahoma12"><b>Ingreso:</b>&nbsp;<?php echo $per["FechaIngreso"]?></td>


</tr>
	<tr>
  <td height="25" colspan="2" class="tahoma12"><p></p></td>
    </tr>

<tr>

  <td width="250" height="25" bordercolor="#000000" class="tahoma12"><b>Domicilio:</b>&nbsp;<?php echo $per["Direccion"]?></td>

  <td width="250" bordercolor="#000000" class="tahoma12"><b>Localidad:</b>&nbsp;<?php echo $per["Localidad"]?></td>

</tr>

<tr>

  <td height="25" bordercolor="#000000" class="tahoma12"><b>CP:</b>&nbsp;<?php echo $per["CodigoPostal"]?></td>

  <td bordercolor="#000000" class="tahoma12"><b>Tel&eacute;fono:</b>&nbsp;<?php echo $per["Telefono"]?></td>

</tr>

</table>

<br />

<br />

<table width="700" align="left" cellpadding="2" >

  <tr>

    <td width="500" height="25" colspan="2" class="tahoma12"><b>&nbsp;&nbsp;3. BENEFICIARIOS DEL SEGURO DE VIDA OBLIGATORIO</b></td>

  </tr>

</table>

<br />

<br />

<table width="700" class="tablareporte" >

  <tr>

    <td width="253" height="25" align="center" class="tahoma12"><strong>APELLIDO Y NOMBRE</strong></td>

    <td width="138" align="center" class="tahoma12"><strong>TIPO Y NRO. DOC.</strong></td>

    <td width="131" align="center" class="tahoma12"><strong>PORCENAJE</strong></td>

    <td width="158" height="25" align="center" class="tahoma12"><strong>PARENTESCO</strong></td>

  </tr>
	<tr>
		<td colspan="4" style="border-bottom: solid 1px;"></td>
	</tr>

  <?php while($row=mysqli_fetch_assoc($ddjj)){?>

  <tr>
	
    <td height="25" align="center" class="tahoma12"><?php echo $row["Nombre"]?></td>

    <td align="center" class="tahoma12"><?php echo $row["Documento"]?></td>

    <td align="center" class="tahoma12"><?php echo $row["Porcentaje"]?></td>

    <td height="25" align="center" class="tahoma12"><?php echo $row["Parentesco"]?></td>
	
  </tr>
	<tr>
		<td colspan="4" style="border-bottom: solid 1px;"></td>
	</tr>

  <?php }?>

</table>
<br /><br /><br /><br />
	
<table width="100%">
	<tr>
		<td width="30%"><hr></td>
		<td width="5%"></td>
		<td width="30%"><hr></td>
		<td width="5%"></td>
		<td width="30%"><hr></td>
	</tr>
	<tr>
		<td width="30%" style="text-align: center">Firma</td>
		<td width="5%"></td>
		<td width="30%" style="text-align: center">Aclaración</td>
		<td width="5%"></td>
		<td width="30%" style="text-align: center">DNI</td>
	</tr>
	
</table>

</body>

</html>

<script>

window.print();

</script>
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



if($_REQUEST["id"]!="") {

	$sql = mysqli_fetch_assoc(mysqli_query($link,"SELECT d.ID as IDDenuncia, i.Nombre as NombInstitucion, i.Domicilio as DirInstitucion, i.Localidad as LocInstitucion, d.ACC_Nombre, d.ACC_TipoDoc, d.ACC_Documento, d.ACC_FechaNac, d.ACC_Domicilio, d.ACC_Barrio, d.ACC_Localidad, d.DE_Fecha, d.DE_DiagnosticoPres, d.ACC_Cargo, ACC_Aporte, ACC_Solicitud, ACC_Seguimiento, ACC_Art, ACC_Inicio, ACC_Junta, ACC_JuntaHora, e.Descripcion, i.Nombre_RL, i.Domicilio_RL, d.AudFecAlta, d.AudUsrAlta FROM instituciones i, denuncias_docentes d, especialidades e WHERE d.DE_IDInstitucion=i.ID AND d.ACC_IDEspecialidad=e.IDEspecialidad AND d.vigente='1' AND d.ID=". $_REQUEST["id"]));      
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


</head>

<body style="background-color:transparent" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<table border="0" class="tablapie" align="center">

  <tr>

    <td><div align="center"><img src="images/top_reportes.png" width="673" height="99" /></div></td>

  </tr>

</table>

<table width="700">

  <tr>
    <td align="center"><strong>SOLICITUD DE LICENCIA PARA SALUD OCUPACIONAL</strong></td>
  </tr>
  <tr>

    <td ><div align="center"><strong>DENUNCIA DE ACCIDENTE N&ordm; <?php echo $sql["IDDenuncia"]?> DE FECHA <?php echo $sql["DE_Fecha"]?></strong></div></td>
  </tr>
</table>

<p>&nbsp;</p>
<table>
  <tr>
    <td colspan="2"><div align="left"><strong>1. DATOS DEL ESTABLECIMIENTO </strong></div></td>
  </tr>

  <tr>

    <td colspan="2" ><b>Instituci&oacute;n:</b>&nbsp;<?php echo $sql["NombInstitucion"]?></td>

  </tr>

  <tr>

    <td ><b>Direcci&oacute;n:</b>&nbsp;<?php echo $sql["DirInstitucion"]?></td>

    <td ><strong>Localidad:</strong>&nbsp;<?php echo $sql["LocInstitucion"]?></td>

  </tr>

</table>
<table>

  <tr>

    <td height="25" colspan="3" class="tahoma11"><strong>2. DATOS DEL BENEFICIARIO </strong></td>

  </tr>

  <tr>

    <td colspan="3" ><b>Apelldio y Nombre:</b>&nbsp;<?php echo $sql["ACC_Nombre"]?></td>

  </tr>

  <tr>

    <td ><b>Tipo y N&ordm; Doc.:</b>&nbsp;

      DNI - <?php echo $sql["ACC_Documento"]?></td>

    <td colspan="2"><strong>Fecha de Nac.: </strong><?php echo $sql["ACC_FechaNac"]?></td>

  </tr>

  <tr>
    <td ><b>Domicilio:</b>&nbsp;<?php echo $sql["ACC_Domicilio"]?></td>
    <td ><strong>Barrio:</strong>&nbsp;<?php echo $sql["ACC_Barrio"]?></td>
    <td ><strong>Localidad:</strong>&nbsp;<?php echo $sql["ACC_Localidad"]?></td>
  </tr>
 <tr>
    <td colspan="3"><b>Cargo:</b>&nbsp;<?php echo $sql["ACC_Cargo"]?></td>
 </tr>
</table>

<table >

  <tr>

    <td height="25" colspan="2" class="tahoma11"><strong>3. DETALLES DE LA LICENCIA </strong></td>

  </tr>

<tr>
<td ><b>Tipo de Solicitud:</b>&nbsp;<?php if ($sql["ACC_Solicitud"]=="P") echo "PRIMERA VEZ"?> <?php if ($sql["ACC_Solicitud"]=="R") echo "RENOVACION"?></td>
</tr>
<tr>
<td ><b>Aporte:</b>&nbsp;<?php if ($sql["ACC_Aporte"]=="S") echo "SI"?> <?php if ($sql["ACC_Aporte"]=="N") echo "NO"?> </td>
</tr>
<tr>
<td ><b>ART:</b>&nbsp;<?php if ($sql["ACC_Art"]=="S") echo "SI"?>  <?php if ($sql["ACC_Art"]=="N") echo "NO"?> </td>
</tr>
<tr>
<td ><b>Seguimiento de la Denuncia:</b>&nbsp;<?php if ($sql["ACC_Seguimiento"]=="J") echo "PARA JUNTA MEDICA"?> <?php if ($sql["ACC_Seguimiento"]=="I") echo "PARA SEGUIMIENTO INSTITUCIONAL"?></td>
</tr>

<tr>
<td ><b>Fecha Inicio de la Licencia:</b>&nbsp;<?php if ($sql["ACC_Inicio"]=="0000-00-00") echo "SIN DATOS"?> <?php if ($sql["ACC_Inicio"]!="0000-00-00") echo $sql["ACC_Inicio"]?></td>
</tr>
<tr>
<td ><b>Fecha y Hora próxima Junta Médica:</b>&nbsp;<?php if ($sql["ACC_Junta"]=="0000-00-00") echo "SIN DATOS"?> <?php if ($sql["ACC_Junta"]!="0000-00-00") echo $sql["ACC_Junta"]?> - <?php if ($sql["ACC_JuntaHora"]=="0000-00-00") echo "SIN DATOS"?> <?php if ($sql["ACC_JuntaHora"]!="0000-00-00") echo $sql["ACC_JuntaHora"]?></td>
</tr>

<tr>
<td><b>Especialidad:</b>&nbsp;<?php echo $sql["Descripcion"]?></td>
</tr>
<tr>
<td><b>Diagnostico Presuntivo:</b>&nbsp;<?php echo $sql["DE_DiagnosticoPres"]?></td>
</tr>
<tr>
<td><b>Observaciones:</b>&nbsp;<?php echo $sql["DE_Observaciones"]?></td>
</tr>
</table>
<table>
    <tr>

    <td height="25" colspan="2" class="tahoma11"><strong>4. DATOS DEL REPRESENTANTE LEGAL </strong></td>

  </tr>

  <tr>

    <td height="25" colspan="2" class="tahoma11"><strong>Nombre y Apellido : </strong><?php echo $sql["Nombre_RL"] ?></td>

  </tr>
<tr>
    <td height="25" colspan="2" class="tahoma11"><strong>Correo electrónico: </strong><?php echo $sql["Domicilio_RL"]?></td>
</tr>

</table>

<p>&nbsp;</p>

<table >

  <tr>

    <td height="50"> <i>Este formulario ha sido enviado por correo electrónico a saludocupacional@jaeccba.org.ar en la siguiente fecha <b><?php echo $sql["AudFecAlta"] ?></b>  por el usuario <b><?php echo $sql["AudUsrAlta"] ?></b></i>.

    </td>
 </tr>

</table>

<p>&nbsp;</p>

<blockquote>&nbsp;</blockquote>

</body>

</html>

<script>

window.print();

</script>
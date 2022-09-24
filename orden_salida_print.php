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

	$sql = mysqli_fetch_assoc(mysqli_query($link,"SELECT idsalida , st.descripcion as tiposalida,  i.Nombre as NombInstitucion, i.Domicilio as DirInstitucion, i.Localidad as LocInstitucion, i.Nivel, i.Nombre_RL, i.Domicilio_RL, i.Entidad as Entidad, i.TipoEntidad as TipoEntidad , actividad_fecha_desde, actividad_lugar, actividad_detalle, actividad_destinatario, actividad_alumnos, responsable_nombre, responsable_dni, responsable_cargo, responsable_contacto, docentesotros1, responsablesotros1, transporte_empresa, transporte_vehiculo, transporte_responsables, transporte_autorizacion, transporte_seguro, seguro_poliza, s.AudFecAlta as AudFecAlta , s.AudUsrAlta as AudUsrAlta  FROM instituciones i, salidas_educativas s, salidas_tipos st WHERE s.idinstitucion=i.ID AND s.idtiposalida=st.idsalidatipo AND s.vigente='1' AND s.idsalida=". $_REQUEST["id"]));      
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

    <td><div align="center"><img src="images/top_salidas.jpg" width="600" height="250" /></div></td>
  </tr>
</table>

<table width="700"  align="center" >

  <tr>

    <td height="25"><div align="left"><strong>1) <u>Nota de presentaci&oacute;n</u></strong> firmada por El Representante Legal y el Director de la Instituci&oacute;n en folio N&deg; 1</div></td>
  </tr>
</table>


<table width="700"  align="center" >

  <tr>

    <td height="25"><div align="left"><strong>2) <u>Datos de la Institución</u></strong></div></td>
  </tr>
</table>

<table width="700" border="1"  align="center" cellpadding="1" cellspacing="1" bordercolor="#000000" >


  <tr>

    <td height="25" colspan="2" class="tahoma11"><b>Instituci&oacute;n:</b>&nbsp;<?php echo $sql["NombInstitucion"]?></td>
  </tr>
  <tr>

    <td height="25" colspan="2" class="tahoma11"><b>Nivel:</b>&nbsp;<?php echo $sql["Nivel"]?> </td>
  </tr>

  <tr>

    <td width="250" height="25"  class="tahoma11"><b>Domicilio:</b>&nbsp;<?php echo $sql["DirInstitucion"]?></td>

    <td width="250" height="25"  class="tahoma11"><strong>Localidad:</strong>&nbsp;<?php echo $sql["LocInstitucion"]?></td>
  </tr>
  <tr>
    <td height="25"  class="tahoma11"><b>Representante Legal:</b>&nbsp;<?php echo $sql["Nombre_RL"]?></td>
    <td height="25"  class="tahoma11"><b>Contacto:</b>&nbsp;<?php echo $sql["Domicilio_RL"]?></td>
  </tr>
  <tr>
    <td height="25" colspan="2"  class="tahoma11"><strong>Entidad Propietaria:</strong> <?php echo $sql["Entidad"]?></td>
  </tr>
  <tr>
    <td height="25" colspan="2"  class="tahoma11"><strong>Tipo de Entidad Propietaria:</strong> <?php echo $sql["TipoEntidad"]?></td>
  </tr>
</table>
<table width="700"  align="center" >

  <tr>

    <td height="25"><div align="left"><strong>3) <u>Actividad</u></strong></div></td>
  </tr>
</table>
<table width="700" border="1"  align="center" cellpadding="1" cellspacing="1" bordercolor="#000000" >
<tr>

    <td width="672" height="25" ><b>Tipo de Salida:</b>&nbsp;<?php echo $sql["tiposalida"]?></td>
  </tr>
<tr>

<tr>

    <td width="672" height="25" ><b>Actividad:</b>&nbsp;<?php echo $sql["actividad_detalle"]?></td>
  </tr>
<tr>

    <td width="672" height="25" ><b>Lugar:</b>&nbsp;<?php echo $sql["actividad_lugar"]?></td>
  </tr>

  
<tr>

    <td width="672" height="25" ><b>Fecha:</b>&nbsp;<?php echo $sql["actividad_fecha_desde"]?></td>
  </tr>
<tr>

    <td width="672" height="25" ><b>Destinatarios:</b>&nbsp;<?php echo $sql["actividad_destinatario"]?></td>
  </tr>
<tr>

    <td width="672" height="25" ><b>Cantidad de Alumnos:</b>&nbsp;<?php echo $sql["actividad_alumnos"]?></td>
  </tr>


</table>

<table width="700"  align="center" >

  <tr>

    <td height="25"><div align="left"><strong>4) <u>Docentes a cargo</u></strong></div></td>
  </tr>
</table>
<table width="700" border="1"  align="center" cellpadding="1" cellspacing="1" bordercolor="#000000" >
<tr>

    <td width="672" height="25" ><b>Responsable:</b>&nbsp;<?php echo $sql["responsable_nombre"]?></td>
 
	
  </tr>
  <tr>

    <td width="672" height="25" ><b>DNI:</b>&nbsp;<?php echo $sql["responsable_dni"]?></td>
 
	
  </tr>
  <tr>

    <td width="672" colspan="2" height="25" ><b>Cargo:</b>&nbsp;<?php echo $sql["responsable_cargo"]?></td>
  </tr>


<tr>

  <td width="672"  colspan="2" height="25" ><b>Contacto:</b>&nbsp;<?php echo $sql["responsable_contacto"]?></td>

  </tr>
<tr>

  <td width="672"  colspan="2" height="25" ><b>Otros Docentes:</b>&nbsp;<?php echo $sql["docentesotros1"]?></td>

  </tr>
<tr>

  <td width="672"  colspan="2" height="25" ><b>Otros Acompañantes:</b>&nbsp;<?php echo $sql["responsablesotros1"]?></td>

  </tr>
 
</table>
<table width="700"  align="center" >

  <tr>

    <td height="25"><div align="left"><strong>5) <u>Seguro de Responsabilidad Civil Art. 6°</u></strong></div></td>
  </tr>
</table>
<table width="700" border="1"  align="center" cellpadding="1" cellspacing="1" bordercolor="#000000" >

<tr>

  <td width="672"   height="25" ><b>N° de Póliza:</b>&nbsp;<?php echo $sql["seguro_poliza"]?></td>

  </tr>
  <tr>

  <td width="672"   height="25" ><b>Último recibo de pago:</b>&nbsp;Se adjunta fotocopia.</td>

  </tr>
</table>

<table width="700"  align="center" >

  <tr>

    <td height="25"><div align="left"><strong>6) <u>Transporte</u></strong></div></td>
  </tr>
</table>
<table width="700" border="1"  align="center" cellpadding="1" cellspacing="1" bordercolor="#000000" >
<tr>

  <td width="672"   height="25" ><b>Empresa:</b>&nbsp;<?php echo $sql["transporte_nombre"]?></td>

  </tr>
<tr>

  <td width="672"   height="25" ><b>Vehículo:</b>&nbsp;<?php echo $sql["transporte_vehiculo"]?></td>

  </tr>
<tr>

  <td width="672"   height="25" ><b>Responsables:</b>&nbsp;<?php echo $sql["transporte_responsables"]?></td>

  </tr>
<tr>

  <td width="672"   height="25" ><b>Autorización:</b>&nbsp;<?php echo $sql["transporte_autorizacion"]?></td>

  </tr>

<tr>

  <td width="672"   height="25" ><b>Seguro:</b>&nbsp;<?php echo $sql["transporte_seguro"]?></td>

  </tr>

</table>




</body>

</html>

<script>

window.print();

</script>
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
$id=mysqli_real_escape_string($link,$_REQUEST["id"]);
	$sql = mysqli_fetch_assoc(mysqli_query($link,"SELECT i.Nombre as NombInstitucion, i.Domicilio as DirInstitucion, i.Telefono as TelInstitucion, d.ACC_Nombre as NombAccidentado, dd.Derivacion as TipoDerivacion, dd.Fecha as FechaDerivacion, dd.Diagnostico as Tratamiento, dc.Nombre as NombCentro, dc.Domicilio as DirCentro, dc.Contacto as ContactoCentro FROM instituciones i, denuncias d, denuncias_derivaciones dd, derivaciones_centros dc WHERE i.ID=d.DE_IDInstitucion AND d.ID=dd.IDDenuncia AND dd.IDCentro=dc.ID AND dd.ID='$id'"));      

}

else {

	echo "<script>window.close();</script>";

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<html>

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>modulo</title>



<link href="../estilos/estilos.css" rel="stylesheet" type="text/css">

</head>

<body style="background-color:transparent" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<table border="0" class="tablapie" align="center">

  <tr>

    <td><div align="center"><img src="images/top_reportes.png" width="673" height="99" /></div></td>

  </tr>

</table>

<table align="center" width="90%">

  <tr>

    <td width="500" height="25" colspan="2" ><div align="center"><strong>DERIVACION ATENCION MEDICA - <?php echo $sql["NombCentro"]?></strong></div></td>

  </tr>

  <tr>

    <td height="25" colspan="2">Por la presente se solicita la atenci&oacute;n m&eacute;dica de: <b><?php echo $sql["NombAccidentado"]?></b></td>

  </tr>

  <tr>

    <td height="25" colspan="2" class="tahoma12">Fecha: <strong><?php echo $sql["FechaDerivacion"]?></strong></td>

  </tr>

</table>

<br />

<table align="center" width="90%" >

  <tr>

    <td height="25" colspan="2" class="tahoma12"><b>Instituto:</b>&nbsp;<strong><?php echo $sql["NombInstitucion"]?></strong></td>

  </tr>

  <tr>

    <td height="25" colspan="2"  class="tahoma12"><b>Direcci&oacute;n:</b>&nbsp;<?php echo $sql["DirInstitucion"]?></td>

  </tr>

  <tr>

    <td width="250" height="25" bordercolor="#000000" class="tahoma12"><b>Tel&eacute;fono:</b>&nbsp;<?php echo $sql["TelInstitucion"]?></td>

    <td width="250" bordercolor="#000000" class="tahoma12">&nbsp;</td>

  </tr>

</table>

<br />

<table align="center" width="90%">

  <tr>

    <td width="672" height="25" class="tahoma12"><b>Nombre Accidentado:</b>&nbsp;<?php echo $sql["NombAccidentado"]?></td>

  </tr>

  <tr>

    <td height="25" class="tahoma12"><b>Tipo de Derivaci&oacute;n:</b>&nbsp;

	<?php if ($sql["TipoDerivacion"]=='FS') 

	{ 

	echo $deriva='RED P.M. del FSCR';

	}

	if ($sql["TipoDerivacion"]=='PA') 

	{ 

	echo $deriva='Particular Autorizada por los Padres';

	}

	?>

   </td>

  </tr>

  <tr>

    <td height="25" class="tahoma12"><b>Centro de Derivaci&oacute;n:</b>&nbsp;<?php echo $sql["NombCentro"]?></td>

  </tr>

  <tr>

    <td height="25" class="tahoma12"><b>Domicilio:</b>&nbsp;<?php echo $sql["DirCentro"]?></td>

  </tr>

  <tr>

    <td height="25" class="tahoma12"><b>Contacto:</b>&nbsp;<?php echo $sql["ContactoCentro"]?></td>

  </tr>

  <tr>

    <td height="25" class="tahoma12"><b>Indicaciones a seguir:</b>&nbsp;<?php echo $sql["Tratamiento"]?></td>

  </tr>

</table>

<table width="700"  align="center" class="tablareporte" >

  <tr>

    <td width="500" height="25"  class="tahoma12" align="right">

    <p align="right">&nbsp;</p>

    <p align="right"><strong><br />

        <br />

        -----------------------------<br />

    FIRMA RESPONSABLE </strong> </p></td>

  </tr>

</table>

<p>&nbsp;</p>

<blockquote>&nbsp;</blockquote>

</body>

</html>

<script>

window.print();

</script>
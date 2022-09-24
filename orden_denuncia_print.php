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

	$sql = mysqli_fetch_assoc(mysqli_query($link,"SELECT d.ID as IDDenuncia,  i.Nombre as NombInstitucion, i.Domicilio as DirInstitucion, i.Localidad as LocInstitucion, d.ACC_Nombre, d.ACC_TipoDoc, d.ACC_Documento, d.ACC_FechaNac, d.ACC_Domicilio, d.ACC_Barrio, d.ACC_Localidad, d.ACC_ObraSocial, d.ACC_NAfiliado, d.DA_Fecha, d.DA_Hora, d.DA_Horario, d.DA_DetalleActividad, d.DA_Actividad, d.DA_Hecho, d.L_Lugar, d.L_Responsables, d.L_Testigos, e.Descripcion as EspacioFisico, d.L_Responsables, d.L_Testigos  FROM instituciones i, denuncias d, espacios_fisicos e WHERE d.DE_IDInstitucion=i.ID AND e.ID=d.L_EspacioFisico AND d.vigente='1' AND d.ID=". $_REQUEST["id"]));      

	$sql_emergencias = mysqli_fetch_assoc(mysqli_query($link,"SELECT e.AM_Empresa, e.AM_Tiempo, e.AM_Ficha, e.AM_Valoracion, e.AM_Diagnostico, e.AP_Persona, e.AP_Hora, e.AP_Fecha, e.AF_Persona, e.AF_Hora, e.AF_Fecha, e.AF_Forma   FROM denuncias_emergencias e  WHERE e.vigente='1' AND e.IDDenuncia=". $_REQUEST["id"])); 

	$sql_derivaciones = mysqli_query($link,"SELECT d.Fecha, d.Hora, c.Nombre as NombInstitucion, d.Derivacion, d.Diagnostico  FROM denuncias_derivaciones d, derivaciones_centros c  WHERE d.vigente='1' AND c.ID=d.IDCentro AND d.IDDenuncia=". $_REQUEST["id"] ." ORDER BY d.AudFecModi DESC");      

	

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

    <td width="50" height="25"  class="tahoma12"><div align="left"> </div></td>

    <td width="105"  class="tahoma12">&nbsp;</td>

    <td width="258"  class="tahoma10">&nbsp;</td>

    <td width="267"  class="tahoma12"><div align="right"><strong>DENUNCIA DE ACCIDENTE N&ordm; <?php echo $sql["IDDenuncia"]?></strong></div></td>

  </tr>

</table>

<table width="700"  align="center" >

  <tr>

    <td height="25" colspan="2"><div align="left"><strong>1. DATOS DEL ESTABLECIMIENTO </strong></div></td>

  </tr>

  <tr>

    <td height="25" colspan="2" class="tahoma11"><b>Instituci&oacute;n:</b>&nbsp;<?php echo $sql["NombInstitucion"]?></td>

  </tr>

  <tr>

    <td width="250" height="25"  class="tahoma11"><b>Direcci&oacute;n:</b>&nbsp;<?php echo $sql["DirInstitucion"]?></td>

    <td width="250" height="25"  class="tahoma11"><strong>Localidad:</strong>&nbsp;<?php echo $sql["LocInstitucion"]?></td>

  </tr>

</table>

<table width="988" class="tablareporte" align="center">

  <tr>

    <td height="25" colspan="3" class="tahoma11"><strong>2. DATOS DEL ACCIDENTADO </strong></td>

  </tr>

  <tr>

    <td width="672" height="25" colspan="3" class="tahoma11"><b>Apelldio y Nombre:</b>&nbsp;<?php echo $sql["ACC_Nombre"]?></td>

  </tr>

  <tr>

    <td height="25" class="tahoma11"><b>Tipo y N&ordm; Doc.:</b>&nbsp;

      DNI - <?php echo $sql["ACC_Documento"]?></td>

    <td colspan="2" class="tahoma11"><strong>Fecha de Nac.: </strong><?php echo $sql["ACC_FechaNac"]?></td>

  </tr>

  <tr>

    <td height="25" class="tahoma11"><b>Domicilio:</b>&nbsp;<?php echo $sql["ACC_Domicilio"]?></td>

    <td height="25" class="tahoma11"><strong>Barrio: </strong><?php echo $sql["ACC_Barrio"]?></td>

    <td class="tahoma11"><strong>Localidad: </strong><?php echo $sql["ACC_Localidad"]?></td>

  </tr>

  <tr>

    <td height="25" class="tahoma11"><b>Obra Social :</b>&nbsp;<?php echo $sql["ACC_ObraSocial"]?></td>

    <td height="25" class="tahoma11"><strong>N&ordm; Afiliado: </strong><?php echo $sql["ACC_NAfiliado"]?></td>

    <td height="25" class="tahoma11">&nbsp;</td>

  </tr>

</table>

<table width="988" class="tablareporte" align="center">

  <tr>

    <td height="25" colspan="2" class="tahoma11"><strong>3. DETALLES DEL ACCIDENTE </strong></td>

  </tr>

  <tr>

    <td width="276" height="25" class="tahoma11"><b>Fecha :</b>&nbsp;<?php echo $sql["DA_Fecha"]?></td>

    <td width="408" height="25" class="tahoma11"><strong>Hora:</strong>&nbsp;<?php echo $sql["DA_Hora"]?></td>

  </tr>

  <!-- case de actividad y horario -->

  		<?php 

		switch ($sql["DA_Actividad"]) { 

		case "AH": 

		$actividad= "Actividad Habitual"; 

		break; 

		case "SP": 

		$actividad= "Salida Programada";  

		break; 

		case "AE": 

		$actividad= "Actividad  Extra-Programada";   

		break; 

		case "O": 

		$actividad= "Otras";  

		break; 

		} 

		?>

		<?php 

		switch ($sql["DA_Horario"]) { 

		case "HP": 

		$horario= "Horario Programado"; 

		break; 

		case "CT": 

		$horario= "Contra Turno";  

		break; 

		case "HE": 

		$horario= "Horario Excepcional";   

		break; 

		} 

		?> 

 <tr>

    <td height="25" class="tahoma11"><b>Tipo Actividad:</b>&nbsp;<?php echo $actividad?> </td>

    <td class="tahoma11"><strong>Horario:</strong> <?php echo $horario?></td>

  </tr>

  <tr>

    <td height="25" colspan="2" class="tahoma11"><b>Detalles de la Actividad:</b>&nbsp;<?php echo $sql["DA_DetalleActividad"]?></td>

  </tr>

  <tr>

    <td height="25" colspan="2" class="tahoma11"><strong>Hecho que produce el accidente: </strong><?php echo $sql["DA_Hecho"]?></td>

  </tr>

  

	 <!-- case de lugar fisico-->

  		<?php 

		switch ($sql["L_Lugar"]) { 

		case "AI": 

		$lugar= "En la Institución"; 

		break; 

		case "FI": 

		$lugar= "Fuera de la Institución";  

		break; 

		} 

		?>

 

  <tr>

    <td height="25" class="tahoma11"><strong>Lugar: </strong><?php echo $lugar?></td>

    <td height="25" class="tahoma11"><strong>Espacio f&iacute;sico: </strong><?php echo $sql["EspacioFisico"]?></td>

  </tr>

  <tr>

    <td height="25" colspan="2" class="tahoma11"><strong>Personal Responsable: </strong><?php echo $sql["L_Responsables"]?></td>

  </tr>

  <tr>

    <td height="25" colspan="2" class="tahoma11"><strong>Testigos: </strong><?php echo $sql["L_Testigos"]?></td>

  </tr>

</table>

<table width="988" class="tablareporte" align="center">

  <tr>

    <td height="25" colspan="3" class="tahoma11"><strong>4. ASISTENCIA MEDICA DE EMERGENCIA</strong></td>

  </tr>

  <tr>

    <td width="165" height="25" class="tahoma11"><b>Empresa :</b>&nbsp;<?php echo $sql_emergencias["AM_Empresa"]?></td>

    <td width="167" height="25" class="tahoma11"><strong>Tiempo esperado: </strong><?php echo $sql_emergencias["AM_Tiempo"]?></td>

    <td width="336" height="25" class="tahoma11"><strong>N&ordm; Ficha Clinica: </strong><?php echo $sql_emergencias["AM_Ficha"]?></td>

  </tr>

  <!-- case de valoracion del accidente-->

  		<?php 

		switch ($sql_emergencias["AM_Valoracion"]) { 

		case 1: 

		$valoracion= "Gravedad"; 

		break; 

		case 2: 

		$valoracion= "Urgente";  

		break; 

		case 3: 

		$valoracion= "Leve";   

		break; 

		} 

		?>



  

  <tr>

    <td height="25" colspan="3" class="tahoma11"><strong>Valoraci&oacute;n de Accidente: </strong><?php echo $valoracion?></td>

  </tr>

  <tr>

    <td height="25" colspan="3" class="tahoma11"><b>Indicaciones a Seguir:</b>&nbsp;<?php echo $sql_emergencias["AM_Diagnostico"]?></td>

  </tr>

</table>

<table width="988" class="tablareporte" align="center">

  <tr>

    <td height="25" colspan="4" class="tahoma11"><strong>5. DERIVACION </strong></td>

  </tr>

  <tr>

    <td width="165" height="25" class="tahoma11"><div align="center">

      

        <p><strong><u>Fecha/Hora</u></strong></p>

      

    </div></td>

    <td width="167" height="25" class="tahoma11"><div align="center"><strong><u>Centro M&eacute;dico </u></strong></div></td>

    <td width="167" height="25" class="tahoma11"><div align="center"><strong><u>Derivaci&oacute;n</u></strong></div></td>

    <td width="167" class="tahoma11"><div align="center"><strong><u>Indicaciones</u></strong></div></td>

  </tr>

  

  <?php while($row =  mysqli_fetch_assoc($sql_derivaciones)){ ?>

  <tr>

    <td height="25" class="tahoma11" align="center"><?php echo $row["Fecha"]?> - <?php echo $row["Hora"]?></td>

    <td height="25" class="tahoma11" align="center"><?php echo $row["NombInstitucion"]?>

    </td>

    

	 <!-- case de forma de aviso-->

  		<?php 

		switch ($row["Derivacion"]) { 

		case "FS": 

		$derivacion= "RED P.M. del FSCR"; 

		break; 

		case "PA": 

		$derivacion= "Particular Autorizada por los Padres";  

		break; 

		} 

		?>



	<td height="25" class="tahoma11" align="center"><?php echo $derivacion ?>

    </td>

    <td class="tahoma11" align="center"><?php echo $row["Diagnostico"]?>

    </td>

  </tr>

  <?php } ?>

</table>

<table width="988" class="tablareporte" align="center">

  <tr>

    <td height="25" class="tahoma11"><strong>6. AVISO A LOS PADRES O TUTORES </strong></td>

  </tr>

  <tr>

    <td height="25" class="tahoma11"><b>Persona a quien se aviso:</b>&nbsp;<?php echo $sql_emergencias["AP_Persona"]?></td>

  </tr>

  <tr>

    <td height="25" class="tahoma11"><strong>Fecha/Hora:</strong><?php echo $sql_emergencias["AP_Fecha"]?> - <?php echo $sql_emergencias["AP_Hora"]?></td>

  </tr>

</table>

<table width="988" class="tablareporte" align="center">

  <tr>

    <td height="25" colspan="2" class="tahoma11"><strong>7. AVISO AL FSCR </strong></td>

  </tr>

  <tr>

    <td height="25" colspan="2" class="tahoma11"><b>Persona a quien se aviso:</b>&nbsp;<?php echo $sql_emergencias["AF_Persona"]?></td>

  </tr>

  

  <!-- case de forma de aviso-->

  		<?php 

		switch ($sql_emergencias["AF_Forma"]) { 

		case 1: 

		$forma= "Telefónica"; 

		break; 

		case 2: 

		$forma= "FAX";  

		break; 

		case 3: 

		$forma= "Correo electrónico";   

		break; 

		case 4: 

		$forma= "Otro medio";  

		break; 

		} 

		?>



  

  <tr>

    <td height="25" class="tahoma11"><strong>Fecha/Hora</strong>: <?php echo $sql_emergencias["AF_Fecha"]?> - <?php echo $sql_emergencias["AF_Hora"]?></td>

    <td class="tahoma11"><strong>Forma de aviso: </strong><?php echo $forma?></td>

  </tr>

</table>

<p>&nbsp;</p>

<table width="700"  align="center" class="tabla" >

  <tr>

    <td width="249" height="50" align="right" valign="bottom"  class="tahoma11">

    <p ><strong>----------------------------------<br />

    SELLO DE LA INSTITUCION </strong> </p>

    </td>

    <td width="249" height="100" align="right" valign="bottom"  class="tahoma11"><strong>-------------------------------------<br />

FIRMA Y SELLO RESP. LEGAL </strong></td>

  </tr>

</table>

<p>&nbsp;</p>

<blockquote>&nbsp;</blockquote>

</body>

</html>

<script>

window.print();

</script>
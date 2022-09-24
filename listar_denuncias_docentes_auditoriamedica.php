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
$denuncias=mysqli_query($link,"SELECT denuncias_docentes.ID as IDDenuncia, FechaEnvio, ACC_Nombre, ACC_Telefono, ACC_Domicilio, Nombre as NomInst, especialidades.Descripcion as Especialidad , ACC_Estado as Estado FROM denuncias_docentes , instituciones, auditoriamedica_docentes, especialidades  WHERE Enviado_Auditoriamedica='1' AND IDEstadoAuditoria='1' AND denuncias_docentes.DE_IDInstitucion = instituciones.ID  AND auditoriamedica_docentes.IDDenuncia= denuncias_docentes.ID  AND especialidades.IDEspecialidad=denuncias_docentes.ACC_IDEspecialidad  AND denuncias_docentes.vigente='1' ORDER BY FechaEnvio DESC");

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->
<!--SEO -->
<meta name="Keywords" content=" " />
<meta name="description" content=" " />
<title>Fondo Solidario  |  Sistema de Gestión</title>
<?php include("scripts.php"); ?>
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
-->
</style>
</head>
<body>
<form name="frm" id="frm" method="post" action="">
<script language="javascript" src="calendar/calendar.js"></script>



<div id="Cabecera">
  <?php include("top.php"); ?>
</div>
<div id="Menin">
  <div class="row">
    <?php include("menu.php"); ?>
   
  </div>
</div>
<div class="row" id="Cont">
<div class="small-12 large-12 columns">
  <div class="small-12 large-4 columns">
    <div class="small-12 large-12 columns th radius gris">
      <div class="small-4 large-4 columns"><img src="animacion/interior/bienvenido.png" width="44" height="64" alt="bienvenido"> </div>
      <div class="small-8 large-8 columns">
        <h1><?php echo $_SESSION["Nombre_Usuario"] ?></h1>
		<h1><a href="index.php?accion=S" class="linkverde">Desconectarme</a></h1>
		</div>
    </div>
    <div class="clear2"> </div>
    <div class="small-12 large-12 columns th radius grisoscuro">
       <?php include("menu_izq.php"); ?>
 		  
    </div>
    <div class="clear2"> </div>
  </div>
  <div class="small-12 large-8 columns ">
       <div class="small-12 large-12 columns  menutitulo"> 
		<img src="images/map.png" width="30" height="36" border="0"> <b>Formularios de Salud Ocupacional</b>
	</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="5%" align="center" ><div align="center"><strong>Estado</strong></div></td>
	<td width="5%" align="center" ><div align="center"><strong>Denuncia</strong></div></td>
    <td width="25%" align="center" ><div align="center"><strong>Accidentado</strong></div></td>
    <td width="25%" align="center" ><div align="center"><strong>Instituci&oacute;n</strong></div></td>
	<td width="20%" align="center" ><div align="center"><strong>Especialidad</strong></div></td>
    <td width="20%" align="center" ><div align="center"><strong> Enviado</strong></div></td>
    <td width="10%" align="center"  ><div align="center"><strong>Observaciones</strong></td>
	
  </tr>
  <?php while($row =  mysqli_fetch_assoc($denuncias)){

					$cant++;

					if( $row["Estado"] == 'A'){ $bg = '#009900'; } else { $bg = '#0033CC'; }

			?>
  <tr>
    <td align="center" style="background-color:<?php echo $bg ?>" ><?php echo $row["Estado"]?></td>
	<td align="center"  ><a href="denuncias_docentes.php?id_den=<?php echo $row["IDDenuncia"]?>"><?php echo substr("00000".$row["IDDenuncia"],-5)?></a></td>
    <td align="center"  ><?php echo $row["ACC_Nombre"]?></td>
    <td align="center"  ><?php echo $row["NomInst"]?></td>
    <td align="center"  ><?php echo $row["Especialidad"]?></td>
    <td align="center" ><?php echo $row["FechaEnvio"]?></td>
	<td align="center" ><a href="#"><img src="images/icon_juntas.png" border="0"  width="25" height="25" title="agregar observaciones" onClick="window.open('denuncias_docentes.auditoriamedica.php?id_den=<?php echo $row["IDDenuncia"]?>','_self');" /></a> </td>
    
  </tr>
  <?php } ?>
  <tr>
    <td height="40" colspan="7" align="center" class="tahoma11">&nbsp;</td>
  </tr>
</table>
    </div>
  </div>
</div>
</div>
<div class="clear"> </div>
<?php include("pie.php"); ?>
<input type="hidden" name="action" id="action">
<input type="hidden" name="id_der" id="id_der">
</form>
	
</body>
</html>
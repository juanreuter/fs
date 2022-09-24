<?php
error_reporting('0');

//controlo acceso y auditoria
session_start();
if(!$_SESSION["log"]) header("location:index.php");
$usrmodi=$_SESSION["Usuario"];
$fecmodi=date("Y-m-d H:i:s");
$usralta=$_SESSION["Usuario"];
$fecalta=date("Y-m-d H:i:s");

//base de datos
include ("funciones/conexion_bbdd.php");
// datos de la institucion seleccionada
$idinstitucion =  $_POST["cmbInst"];

$sql = mysqli_fetch_assoc(mysqli_query($link,"SELECT i.Nombre, i.Nombre2, i.Caracter, i.Nivel, i.Zona, i.Domicilio, l.Nombre as Localidad, i.Telefono, i.Email, i.Junta, i.Fondo, i.Nombre_RL, i.Domicilio_RL, i.Nombre_D, i.Domicilio_D, i.Nombre_VD, i.Domicilio_VD, i.Nombre_SD, i.Domicilio_SD FROM instituciones i, localidades l  WHERE l.ID=i.IDLocalidad AND i.ID='". $idinstitucion."'")); 


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->
<!--SEO -->
<meta name="Keywords" content=" " />
<meta name="description" content=" " />
<title>Fondo Solidario  |  Sistema de Gestión</title>
<?php include("scripts.php"); ?>
<link rel="stylesheet" href="css/jquery-ui.css">
 
<script src="js/jquery-1.10.2.js"></script>
<script src="js/jquery-ui.js"></script>

</head>
<body>
<form name="frm" id="frm"  method="post" action="ticket_nuevo3.php">

<div id="Cabecera">
  <?php include("top.php"); ?>
 </div>
<div id="Menin">
  <div class="row">
    <?php include("menu.php"); ?>
    <div class="clear"> </div>
  </div>
</div>
<div class="row" id="Cont">
<div class="small-12 large-12 columns">
  <div class="small-12 large-4 columns">
    <div class="small-12 large-12 columns th radius gris">
      <div class="small-4 large-4 columns"><img src="animacion/interior/bienvenido.png" width="44" height="64" alt="bienvenido"> </div>
      <div class="small-8 large-8 columns">
        <h1> <?php echo $_SESSION["Nombre_Usuario"] ?></h1>
		<h1><a href="index.php?accion=S" class="linkverde">Desconectarme</a></h1>
		</div>
    </div>
    <div class="clear2"> </div>
    <div class="small-12 th radius grisoscuro">
     <?php include("menu_izq.php"); ?>
    </div>
    <div class="clear2"> </div>
  </div>
  <div class="small-12 large-8 columns ">
    <div class="small-12 large-12 columns  menutitulo"> 
	<img src="images/map.png" width="30" height="36" border="0"> <b>Nuevo eTicket - Datos de la Institución </b>
	</div>
    <div class="clear2"> </div>
    <div >
    
      <div class="clear2"> </div>
    
      <table width="700" border="1"  align="center" cellpadding="1" cellspacing="1" bordercolor="#000000" >


  <tr>

    <td height="25" colspan="2"><b>Institución:</b>&nbsp;<?php echo $sql["Nombre"]?>  <b>[<a href="instituciones.php?id_inst=<?php echo $idinstitucion ?>">Clic para actualizar Datos</a>]</b></td>
  </tr>
  <tr>
    <td height="25" colspan="2"><b>Alias:</b>&nbsp;<?php echo $sql["Nombre2"]?></td>
  </tr>
  <tr>
    <?php 
	if ($sql["Caracter"] == '1') $caracter="Adheridos";
	if ($sql["Caracter"] == '2') $caracter="Congregacional - Asociaciones Confesionales";
	if ($sql["Caracter"] == '3') $caracter="Diocesano";
	if ($sql["Caracter"] == '4') $caracter="Parroquial";
	
	?>
    <td height="25" colspan="2"><b>Carácter:</b>&nbsp;<?php echo $caracter ?></td>
  </tr>
  <tr>

    <td height="25"><b>Nivel:</b>&nbsp;<?php echo $sql["Nivel"]?> </td>
	<td height="25"><b>Zona:</b>&nbsp;<?php echo $sql["Zona"]?> </td>
  </tr>

  <tr>

    <td width="250" height="25"  ><b>Domicilio:</b>&nbsp;<?php echo $sql["Domicilio"]?></td>

    <td width="250" height="25"  ><strong>Localidad:</strong>&nbsp;<?php echo $sql["Localidad"]?></td>
  </tr>
  <tr>
    <td height="25"  ><b>Teléfono:</b>&nbsp;<?php echo $sql["Telefono"]?></td>
    <td height="25"  ><b>Correo electrónico:</b>&nbsp;<?php echo $sql["Email"]?></td>
  </tr>
  <tr>
   <?php 
   if ($sql["Junta"] == 'S') $junta="SI";
   if ($sql["Junta"] == 'N') $junta="NO";
   if ($sql["Fondo"] == 'S') $fondo="SI";
   if ($sql["Fondo"] == 'N') $fondo="NO";
   
   ?>
    <td height="25"  ><b>Aporta Junta?:</b>&nbsp;<?php echo $junta?></td>
    <td height="25"  ><b>Aporta Fondo?:</b>&nbsp;<?php echo $fondo?></td>
  </tr>
  <tr>
    <td height="25"  ><b>Representante Legal:</b>&nbsp;<?php echo $sql["Nombre_RL"]?></td>
    <td height="25"  ><b>Contacto:</b>&nbsp;<?php echo $sql["Domicilio_RL"]?></td>
  </tr>
   <tr>
    <td height="25"  ><b>Director:</b>&nbsp;<?php echo $sql["Nombre_D"]?></td>
    <td height="25"  ><b>Contacto:</b>&nbsp;<?php echo $sql["Domicilio_D"]?></td>
  </tr>
    <tr>
    <td height="25"  ><b>Vice - Director:</b>&nbsp;<?php echo $sql["Nombre_VD"]?></td>
    <td height="25"  ><b>Contacto:</b>&nbsp;<?php echo $sql["Domicilio_VD"]?></td>
  </tr>
    <tr>
    <td height="25"  ><b>Secretario Docente:</b>&nbsp;<?php echo $sql["Nombre_SD"]?></td>
    <td height="25"  ><b>Contacto:</b>&nbsp;<?php echo $sql["Domicilio_SD"]?></td>
  </tr>
</table>

	 <table width="700" border="1"  align="center" cellpadding="1" cellspacing="1" bordercolor="#000000" >


		  
		<tr><td ><div align="center">
 		  <input onClick="window.history.back();" name="cmdprev" type="button" class="btn" value="<< ANTERIOR "  />
		  <input name="cmdnext" type="submit" class="btn" value="SIGUIENTE >> " />

		  </div></td></tr></table>
         

		</div>
  </div>
</div>
</div>
<div class="clear"> </div>
<?php include("pie.php"); ?>
<input name="id_ins" type="hidden" id="id_ins" value="<?php echo $idinstitucion?>">
        
</form>
	
</body>
</html>
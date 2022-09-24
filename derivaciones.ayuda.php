<?php
//controlo acceso y auditoria
session_start();
if(!$_SESSION["log"]) header("location:index.php");
$usrmodi=$_SESSION["Usuario"];
$fecmodi=date("Y-m-d H:i:s");
$usralta=$_SESSION["Usuario"];
$fecalta=date("Y-m-d H:i:s");


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->
<!--SEO -->
<meta name="Keywords" content=" " />
<meta name="description" content=" " />
<title>Fondo Solidario  |  Sistema de Gestión</title>
<?php include("scripts.php"); ?>
</head>
<body>
<form name="frm" id="frm" method="post" action="">

<div id="Cabecera">
  <?php include("top.php"); ?>
</div>
<div id="Menin">
  <div class="row">
    <?php include("menu.php"); ?>
    <div class="clear"> </div>
    <div class="large-12 columns " >
      <?php include("animacion_sec.php"); ?>
    </div>
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
    <div class="clear2"> </div>
    <div class="clear2"> </div>
    <div >
      <h1><b><img src="animacion/interior/help.png" width="50" height="50"><br>Qué puedo hacer en el link Derivaciones?</b> </h1>

      <div style="text-align:justify"> 
	  <br>
	  En esta sección Ud deberá <strong>registrar la solicitud de derivación</strong> del alumno. Es importante que conozca la denuncia de accidente a partir del cual desea solicitar la derivación.<br><br>
	  La solicitud le <strong>requiere datos mínimos</strong> que acelerarán el proceso para que el alumno sea atendido de manera eficiente. <br><br>
	  Como paso final de la carga usted deberá <strong>imprimir la solicitud</strong>, así mismo <strong>esta solicitud llega vía correo electrónico </strong>a la administración del establecimiento seleccionado para optimizar el trámite.
  
	  	  </div>
    </div>
  </div>
</div>
</div>
<div class="clear"></div>
<?php include("pie.php"); ?>
</form>
	
</body>
</html>
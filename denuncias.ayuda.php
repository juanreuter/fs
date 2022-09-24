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
      <h1><b><img src="animacion/interior/help.png" width="50" height="50"><br>
        Qué puedo hacer en el link Nueva Denuncia?</b> </h1>

      <div style="text-align:justify"> 
	  <br>
	  En esta sección Ud deberá <strong>registrar la denuncia</strong> de accidente de cada alumno de la institución a su cargo haciendo clic en "Nueva denuncia". No es necesario contar con toda la información ya que puede actualizar la dencuncia conforme se vayan sucediendo los hechos, por ejemplo, en una segunda etapa usted podr&aacute; completar la obra social del menor o alguna información no  imprescindible al momento del registro. <br><br>
	  Para <strong>acelerar el proceso de carga </strong> usted puede ingresar el DNI del alumno y hacer clic en la "lupa" y el sistema le traerá todos los datos del alumno. <br><br>Si usted no ha enviado la información de todos los alumnos hágalo en formato excel a "sistemas@jaeccba.org.ar" para poder utilizar esta funcionalidad.  <br><br>
	  Como dato complementario y de alta importancia para la denuncia son los <b>Datos de Emergencia</b> que usted debererá completar cada vez que cuente con ellos. Esta información permitirá optimizar los servicios de emergencias y obtener un control efectivo sobre el servicio.
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
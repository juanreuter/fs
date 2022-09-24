<<<<<<< HEAD
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
        Qué puedo hacer en el link Buscar Denuncias?</b> </h1>

      <div style="text-align:justify"> 
	    <p><br>
	      En esta sección usted podr&aacute; <strong>localizar cualquier denuncia</strong> registrada en el sistema que sea de su propiedad, es decir que sea de su instituci&oacute;n.<br>
	      <br>
	      Los datos por los cuales puede buscar son: <strong>per&iacute;odos de fecha de las denuncias</strong>, por ejemplo si ingresa fecha desde &quot;20/04/2014&quot; y deja en blanco fecha hasta el sistema buscar&aacute; todas las denuncias de su instituci&oacute;n cargadas desde el 20/04/2014 hasta la fecha actual; <strong>nombre y apellido del alumno </strong>por ejemplo usted puede poner una parte del nombre o apellido y <strong>n&uacute;mero de documento del alumno</strong></p>
	    <p>Si el sistema encuentra coincidencias se listar&aacute;n las denuncias y al lado de cada una de ellas unos &iacute;conos que le permitir&aacute;n <strong>editarla</strong> para ampliar informac&iacute;on, <strong>generar una orden de derivaci&oacute;n electr&oacute;nica</strong>, <strong>solicitar un reintegro</strong>  e <strong>imprimir una constancia de la denuncia</strong></p>
	    <p>&nbsp;</p>
      </div>
    </div>
  </div>
</div>
</div>
<div class="clear"></div>
<?php include("pie.php"); ?>
</form>
	
</body>
=======
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
        Qué puedo hacer en el link Buscar Denuncias?</b> </h1>

      <div style="text-align:justify"> 
	    <p><br>
	      En esta sección usted podr&aacute; <strong>localizar cualquier denuncia</strong> registrada en el sistema que sea de su propiedad, es decir que sea de su instituci&oacute;n.<br>
	      <br>
	      Los datos por los cuales puede buscar son: <strong>per&iacute;odos de fecha de las denuncias</strong>, por ejemplo si ingresa fecha desde &quot;20/04/2014&quot; y deja en blanco fecha hasta el sistema buscar&aacute; todas las denuncias de su instituci&oacute;n cargadas desde el 20/04/2014 hasta la fecha actual; <strong>nombre y apellido del alumno </strong>por ejemplo usted puede poner una parte del nombre o apellido y <strong>n&uacute;mero de documento del alumno</strong></p>
	    <p>Si el sistema encuentra coincidencias se listar&aacute;n las denuncias y al lado de cada una de ellas unos &iacute;conos que le permitir&aacute;n <strong>editarla</strong> para ampliar informac&iacute;on, <strong>generar una orden de derivaci&oacute;n electr&oacute;nica</strong>, <strong>solicitar un reintegro</strong>  e <strong>imprimir una constancia de la denuncia</strong></p>
	    <p>&nbsp;</p>
      </div>
    </div>
  </div>
</div>
</div>
<div class="clear"></div>
<?php include("pie.php"); ?>
</form>
	
</body>
>>>>>>> 64483f4e4592a7d8cfa1980d291de5bef1badd92
</html>
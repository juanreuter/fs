<<<<<<< HEAD
<?php
//controlo acceso y auditoria
session_start();
if(!$_SESSION["log"]) header("location:index.php");
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
      <div class="intete"> <a href="denuncias.php" class="linkdenuncias">Denuncias</a> </div>
      <div class="intete"> <a href="news.php" class="linkdenuncias">Próximos Pasos ... </a> </div>
      <!--<div class="intete"> <a href="cambio_clave.php" class="linkdenuncias">Cambio de Clave</a></div>-->
	  <!--<div class="intete"> <a href="manual.pdf" class="linkdenuncias" target="_blank">Manual de Uso</a></div>-->
	  <!--<div class="intete"> <a href="servicios_emergencia.php" class="linkdenuncias">Servicio de Emergencias</a></div>-->
	 		  
    </div>
    <div class="clear2"> </div>
  </div>
  <div class="small-12 large-8 columns ">
    <div class="clear2"> </div>
    <div class="clear2"> </div>
    <div >
      <h1><b>Nuestros próximos pasos ... </b></h1>

      <div class="clear2"> </div>

	<h1><b>* Jueves 5 de Junio se podrán solicitar REINTEGROS para cada DENUNCIA por medio del sistema</b></h1>
	<br><br><br>
	<h1><b>* Lunes 9 de Junio pondremos a disposición los SERVICIOS DE EMERGENCIAS utilizados</b> </h1>
	</div>
    </div>
</div>
</div>
</div>
<?php include("pie.php"); ?>
</body>
=======
<?php
//controlo acceso y auditoria
session_start();
if(!$_SESSION["log"]) header("location:index.php");
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
      <div class="intete"> <a href="denuncias.php" class="linkdenuncias">Denuncias</a> </div>
      <div class="intete"> <a href="news.php" class="linkdenuncias">Próximos Pasos ... </a> </div>
      <!--<div class="intete"> <a href="cambio_clave.php" class="linkdenuncias">Cambio de Clave</a></div>-->
	  <!--<div class="intete"> <a href="manual.pdf" class="linkdenuncias" target="_blank">Manual de Uso</a></div>-->
	  <!--<div class="intete"> <a href="servicios_emergencia.php" class="linkdenuncias">Servicio de Emergencias</a></div>-->
	 		  
    </div>
    <div class="clear2"> </div>
  </div>
  <div class="small-12 large-8 columns ">
    <div class="clear2"> </div>
    <div class="clear2"> </div>
    <div >
      <h1><b>Nuestros próximos pasos ... </b></h1>

      <div class="clear2"> </div>

	<h1><b>* Jueves 5 de Junio se podrán solicitar REINTEGROS para cada DENUNCIA por medio del sistema</b></h1>
	<br><br><br>
	<h1><b>* Lunes 9 de Junio pondremos a disposición los SERVICIOS DE EMERGENCIAS utilizados</b> </h1>
	</div>
    </div>
</div>
</div>
</div>
<?php include("pie.php"); ?>
</body>
>>>>>>> 64483f4e4592a7d8cfa1980d291de5bef1badd92
</html>
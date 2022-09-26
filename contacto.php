<<<<<<< HEAD
<<<<<<< HEAD
<?php
/*conexion DB*/
include ("funciones/conexion_bbdd.php");

/*datos de sesion del usuario*/
session_start();
$correo = $_POST["txtcorreo"];
$mensaje = $_POST["txtmensaje"];

if(($_POST) && $mensaje!="" && $correo!="")
{
$destinatario = "sistemas@jaeccba.org.ar";
$asunto = "Formulario de Contacto"; 
$cuerpo = 'Correo electrónico: '.$correo.  '<br>  Mensaje: '.$mensaje. '<br> '; 
//para el envío en formato HTML 
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
//dirección del remitente 
$headers .= "From: sistemas@jaeccba.org.ar\r\n";
//direcciones que recibirán copia oculta 
$headers .= "Bcc: lorena.abatidaga@gmail.com \r\n"; 
mail($destinatario,$asunto,$cuerpo,$headers);
// **************** fin envio de datos por correo
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->
<!--SEO -->
<meta content="text/html; charset=iso-8859-1" http-equiv=Content-Type>
<meta name="Keywords" content=" " />
<meta name="description" content=" " />
<title>Fondo Solidario  |  Sistema de Gesti&oacute;n</title>
<?php include("scripts.php"); ?>
</head>
<body>
<div id="Cabecera">
  <?php include("top.php"); ?>
</div>
<div id="Men">
  <div class="row">
    <?php include("menu_home.php"); ?>
    <div class="clear"> </div>
    <div class="large-12 columns " >
      
    </div>
  </div>
</div>
<div class="row" id="Cont">
  <div class="small-12 large-12 columns">
    <div class="small-12 large-4 columns hide-for-small">
      <h1></h1>
      </div>
    <div class="small-12 large-3 columns  hide-for-small"></div>
    <div class="small-12 large-5 th radius gris" style="margin-top:15px">
      <div class="gris">
        <h1> <img src="images/home/ingrese.jpg" alt="Ingrese sus datos de acceso" width="24" height="26" align="absmiddle"> Cu&aacute;l es su inquietud? </h1>
        <hr />
        <form name="form1" id="form1" action="" method="post">
          <div class="row">
            <div class="large-12 columns">
              <label style="margin-bottom:10px">Su correo</label>
              <input type="text"  name="txtcorreo" id="txtcorreo"  />
            </div>
          </div>
          <div class="clear"> </div>
          <div class="row">
            <div class="large-12 columns">
              <label style="margin-bottom:10px">Su mensaje</label>
              <textarea name="txtmensaje" id="txtmensaje"></textarea>
            </div>
          </div>
		    <div class="clear"> </div>
          <div class="row">
            <div class="large-12 columns">
              <input name="Submit" type="submit" value="ENVIAR MENSAJE">
            </div>
          </div>
        </form>
        <div class="clear2"> </div>
      </div>
    </div>
  </div>
</div>
<div class="clear"> </div>
<?php include("pie.php"); ?>
</body>
=======
<?php
/*conexion DB*/
include ("funciones/conexion_bbdd.php");

/*datos de sesion del usuario*/
session_start();
$correo = $_POST["txtcorreo"];
$mensaje = $_POST["txtmensaje"];

if(($_POST) && $mensaje!="" && $correo!="")
{
$destinatario = "sistemas@jaeccba.org.ar";
$asunto = "Formulario de Contacto"; 
$cuerpo = 'Correo electrónico: '.$correo.  '<br>  Mensaje: '.$mensaje. '<br> '; 
//para el envío en formato HTML 
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
//dirección del remitente 
$headers .= "From: sistemas@jaeccba.org.ar\r\n";
//direcciones que recibirán copia oculta 
$headers .= "Bcc: lorena.abatidaga@gmail.com \r\n"; 
mail($destinatario,$asunto,$cuerpo,$headers);
// **************** fin envio de datos por correo
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->
<!--SEO -->
<meta content="text/html; charset=iso-8859-1" http-equiv=Content-Type>
<meta name="Keywords" content=" " />
<meta name="description" content=" " />
<title>Fondo Solidario  |  Sistema de Gesti&oacute;n</title>
<?php include("scripts.php"); ?>
</head>
<body>
<div id="Cabecera">
  <?php include("top.php"); ?>
</div>
<div id="Men">
  <div class="row">
    <?php include("menu_home.php"); ?>
    <div class="clear"> </div>
    <div class="large-12 columns " >
      
    </div>
  </div>
</div>
<div class="row" id="Cont">
  <div class="small-12 large-12 columns">
    <div class="small-12 large-4 columns hide-for-small">
      <h1></h1>
      </div>
    <div class="small-12 large-3 columns  hide-for-small"></div>
    <div class="small-12 large-5 th radius gris" style="margin-top:15px">
      <div class="gris">
        <h1> <img src="images/home/ingrese.jpg" alt="Ingrese sus datos de acceso" width="24" height="26" align="absmiddle"> Cu&aacute;l es su inquietud? </h1>
        <hr />
        <form name="form1" id="form1" action="" method="post">
          <div class="row">
            <div class="large-12 columns">
              <label style="margin-bottom:10px">Su correo</label>
              <input type="text"  name="txtcorreo" id="txtcorreo"  />
            </div>
          </div>
          <div class="clear"> </div>
          <div class="row">
            <div class="large-12 columns">
              <label style="margin-bottom:10px">Su mensaje</label>
              <textarea name="txtmensaje" id="txtmensaje"></textarea>
            </div>
          </div>
		    <div class="clear"> </div>
          <div class="row">
            <div class="large-12 columns">
              <input name="Submit" type="submit" value="ENVIAR MENSAJE">
            </div>
          </div>
        </form>
        <div class="clear2"> </div>
      </div>
    </div>
  </div>
</div>
<div class="clear"> </div>
<?php include("pie.php"); ?>
</body>
>>>>>>> 64483f4e4592a7d8cfa1980d291de5bef1badd92
=======
<?php
/*conexion DB*/
include ("funciones/conexion_bbdd.php");

/*datos de sesion del usuario*/
session_start();
$correo = $_POST["txtcorreo"];
$mensaje = $_POST["txtmensaje"];

if(($_POST) && $mensaje!="" && $correo!="")
{
$destinatario = "sistemas@jaeccba.org.ar";
$asunto = "Formulario de Contacto"; 
$cuerpo = 'Correo electrónico: '.$correo.  '<br>  Mensaje: '.$mensaje. '<br> '; 
//para el envío en formato HTML 
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
//dirección del remitente 
$headers .= "From: sistemas@jaeccba.org.ar\r\n";
//direcciones que recibirán copia oculta 
$headers .= "Bcc: lorena.abatidaga@gmail.com \r\n"; 
mail($destinatario,$asunto,$cuerpo,$headers);
// **************** fin envio de datos por correo
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->
<!--SEO -->
<meta content="text/html; charset=iso-8859-1" http-equiv=Content-Type>
<meta name="Keywords" content=" " />
<meta name="description" content=" " />
<title>Fondo Solidario  |  Sistema de Gesti&oacute;n</title>
<?php include("scripts.php"); ?>
</head>
<body>
<div id="Cabecera">
  <?php include("top.php"); ?>
</div>
<div id="Men">
  <div class="row">
    <?php include("menu_home.php"); ?>
    <div class="clear"> </div>
    <div class="large-12 columns " >
      
    </div>
  </div>
</div>
<div class="row" id="Cont">
  <div class="small-12 large-12 columns">
    <div class="small-12 large-4 columns hide-for-small">
      <h1></h1>
      </div>
    <div class="small-12 large-3 columns  hide-for-small"></div>
    <div class="small-12 large-5 th radius gris" style="margin-top:15px">
      <div class="gris">
        <h1> <img src="images/home/ingrese.jpg" alt="Ingrese sus datos de acceso" width="24" height="26" align="absmiddle"> Cu&aacute;l es su inquietud? </h1>
        <hr />
        <form name="form1" id="form1" action="" method="post">
          <div class="row">
            <div class="large-12 columns">
              <label style="margin-bottom:10px">Su correo</label>
              <input type="text"  name="txtcorreo" id="txtcorreo"  />
            </div>
          </div>
          <div class="clear"> </div>
          <div class="row">
            <div class="large-12 columns">
              <label style="margin-bottom:10px">Su mensaje</label>
              <textarea name="txtmensaje" id="txtmensaje"></textarea>
            </div>
          </div>
		    <div class="clear"> </div>
          <div class="row">
            <div class="large-12 columns">
              <input name="Submit" type="submit" value="ENVIAR MENSAJE">
            </div>
          </div>
        </form>
        <div class="clear2"> </div>
      </div>
    </div>
  </div>
</div>
<div class="clear"> </div>
<?php include("pie.php"); ?>
</body>
>>>>>>> 64483f4e4592a7d8cfa1980d291de5bef1badd92
</html>
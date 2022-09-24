<?php
/*conexion DB*/
include ("funciones/conexion_bbdd.php");

/*datos de sesion del usuario*/
session_start();
$mensaje="Ingrese usuario y correo";

if($_POST)
{
	if($_POST["usu"]!="" && $_POST["correo"]!="" )
	{
	$usu_log=mysqli_query($link,"SELECT * FROM usuarios WHERE Usuario='". $_POST["usu"] ."' AND Email='". $_POST["correo"] ."' AND vigente='1'");
	if($row=mysqli_fetch_assoc($usu_log))
	{
		$txtcorreo=$row["Email"];
		$txtpss=$row["Pass"];
		$txtnombre=$row["Nombre"];
		$txtusuario=$row["Usuario"];
		$mensaje="Se ha enviado información a su correo";

		//enviar email
		$destinatario = $txtcorreo; 
		$asunto = "Sistema de Gestion del Fondo Solidario - Recupero de Clave"; 
		$correo_alta_fecha = date("Y-m-d H:i:s");
		$cuerpo = 'Le informamos los datos solicitados. <br><br> Usuario: '.$txtusuario. ' <br> Contraseña: ' .$txtpss.' <br> Fecha de Solicitud: ' .$correo_alta_fecha.' <br><br> Muchas gracias por el contacto!' ;

		//para el envío en formato HTML 
		$headers = "MIME-Version: 1.0\r\n"; 
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
		//dirección del remitente 
		$headers .= "From: sistemas@jaeccba.org.ar\r\n";
		//direcciones que recibirán copia oculta 
		mail($destinatario,$asunto,$cuerpo,$headers);
		// **************** fin envio de datos por correo
	} 
	else
	{
		$mensaje="Su usuario/correo no son correctos";
	}
 }	
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
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
        <h1> <img src="images/home/ingrese.jpg" alt="Ingrese sus datos de acceso" width="24" height="26" align="absmiddle"> Ingrese los datos requeridos </h1>
        <hr />
        <form name="form1" id="form1" action="" method="post">
          <div class="row">
            <div class="large-12 columns">
              <label style="margin-bottom:10px">Usuario </label>
              <input type="text"  name="usu" id="usu"  />
            </div>
          </div>
          <div class="clear"> </div>
          <div class="row">
            <div class="large-12 columns">
              <label style="margin-bottom:10px">Correo electrónico  </label>
              <input name="correo" id="correo" type="text" />
            </div>
          </div>
		    <div class="clear"> </div>
          <div class="row">
            <div class="large-12 columns">
              <input name="Submit" type="submit" value="RECUPERAR"> <?php echo $mensaje; ?>
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
</html>
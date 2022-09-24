<?php
error_reporting('1');

/*conexion DB*/
include ("funciones/conexion_bbdd.php");

/*datos de sesion del usuario*/
session_start();
$mensaje="Ingrese usuario y contraseña";
if($_REQUEST["accion"]=="S")

{
	$_SESSION["log"]=false;
	$_SESSION["ID_Usuario"]=false;
	$_SESSION["Nombre_Usuario"]=false;
	$_SESSION["Usuario"]=false;
	$_SESSION["Institucion"]=false;
}


//if($_REQUEST["accion"]=="H" && $_SESSION["log"]) header("location:acceso.php");

if($_POST)

{
	$usu_log=mysqli_query($link,"SELECT * FROM usuarios WHERE Usuario='". $_POST["usu"] ."' AND pass='". $_POST["pass"] ."' AND vigente='1'");
	if($row=mysqli_fetch_assoc($usu_log))
	{
		$_SESSION["log"]=true;	
		$_SESSION["ID_Usuario"]=$row["ID"];
		$_SESSION["Nombre_Usuario"]=$row["Nombre"];
		$_SESSION["Institucion"]=$row["IDInstitucion"];
		$_SESSION["Usuario"]=$row["Usuario"];
		header("location:inicio.php");
	} 
	else
	{
		$_SESSION["log"]=false;
		$_SESSION["ID_Usuario"]=false;
		$_SESSION["Nombre_Usuario"]=false;
		$_SESSION["Institucion"]=false;
		$mensaje="Ingrese usuario y contraseña";
		header("location:index.php");
	}	
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->
<!--SEO -->
<meta content="text/html; charset=utf-8" http-equiv=Content-Type>
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
    <div class="small-12 large-3 columns  hide-for-small"></div>
    <div class="small-12 large-5 th radius gris" style="margin-top:15px">
      <div class="gris">
        <h1> <img src="images/home/ingrese.jpg" alt="Ingrese sus datos de acceso" width="24" height="26" align="absmiddle" style="font-size:14px"> Ingrese sus datos de acceso </h1>
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
              <label style="margin-bottom:10px">Contrase&ntilde;a </label>
              <input name="pass" id="pass" type="password" />
            </div>
          </div>
		    <div class="clear"> </div>
          <div class="row">
            <div class="large-12 columns">
              <input name="Submit" type="submit" value="INGRESAR"> <?php echo $mensaje; ?>
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
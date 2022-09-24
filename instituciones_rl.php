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
$mensaje="(*) Complete los datos";

$nombre_rl=$_POST["txtNombreRL"];
$dni_rl=$_POST["txtDniRL"];
$domicilio_rl=$_POST["txtDomRL"];
$telefono_rl=$_POST["txtTelRL"];
$nombre_d=$_POST["txtNombreD"];
$dni_d=$_POST["txtDniD"];
$domicilio_d=$_POST["txtDomD"];
$nombre_vd=$_POST["txtNombreVD"];
$dni_vd=$_POST["txtDniVD"];
$domicilio_vd=$_POST["txtDomVD"];
$nombre_sd=$_POST["txtNombreSD"];
$dni_sd=$_POST["txtDniSD"];
$domicilio_sd=$_POST["txtDomSD"];
$id=$_REQUEST["id_inst"];

if($_POST["action"] == "G" && $id!="")
{
	mysqli_query($link,"UPDATE instituciones SET
						Nombre_RL = '$nombre_rl',
						DNI_RL = '$dni_rl',
						Domicilio_RL = '$domicilio_rl',
						Telefono_RL = '$telefono_rl',
						Nombre_D = '$nombre_d',
						DNI_D = '$dni_d',
						Domicilio_D = '$domicilio_d',
						Nombre_VD = '$nombre_vd',
						DNI_VD = '$dni_vd',
						Domicilio_VD = '$domicilio_vd',
						Nombre_SD = '$nombre_sd',
						DNI_SD = '$dni_sd',
						Domicilio_SD = '$domicilio_sd',
						AudUsrModi='$usrmodi',
						AudFecModi='$fecmodi'
						WHERE ID = $id");

	$mensaje = 	"**** Institución actualizada correctamente ****";
}

if($id != "")
{
	$row = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM instituciones WHERE vigente='1' AND ID=$id"));
	$nombre_rl=$row["Nombre_RL"];
	$dni_rl=$row["DNI_RL"];
	$domicilio_rl=$row["Domicilio_RL"];
	$telefono_rl=$row["Telefono_RL"];
	$nombre_d=$row["Nombre_D"];
	$dni_d=$row["DNI_D"];
	$domicilio_d=$row["Domicilio_D"];
	$nombre_vd=$row["Nombre_VD"];
	$dni_vd=$row["DNI_VD"];
	$domicilio_vd=$row["Domicilio_VD"];
	$nombre_sd=$row["Nombre_SD"];
	$dni_sd=$row["DNI_SD"];
	$domicilio_sd=$row["Domicilio_SD"];
	$id = $row["ID"];
}

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
</head>
<body>
<script language="javascript" src="calendar/calendar.js"></script>
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
    <div class="small-12 large-12 columns  menutitulo"> 
	<img src="images/map.png" width="30" height="36" border="0"> <b>Instituciones - Alta y Modificación</b>
	</div>
       <div class="clear2"> </div>
    <div class="clear2"> </div>
    <div >
      <form name="frm" id="frm" action="" method="post">
      
	  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tahoma12">

         <tr> 

          <td align="right" valign="middle">

              <table width="100%" border="0" align="center">

              	<tr>

                  <td  style="text-align:center" colspan="2"><strong> Responsable Legal</strong></td>
                </tr>

                <tr>

                  <td >Nombre y Apellido:</td>

                  <td ><input name="txtNombreRL" type="text" class="tahoma12" id="txtNombreRL" value="<?php echo $nombre_rl ?>" size="70" maxlength="70" />                  </td>
                </tr>

                <tr>

                  <td >DNI:</td>

                  <td ><input id="txtDniRL" name="txtDniRL" type="text" value="<?php echo $dni_rl ?>" class="tahoma12" /></td>
                </tr>

                <tr>

                  <td >Correo electrónico:</td>

                  <td ><input name="txtDomRL" type="text" class="tahoma12" id="txtDomRL" value="<?php echo $domicilio_rl ?>" size="70" maxlength="70" /></td>
                </tr>
 <tr>
                  <td >Teléfono :</td>
                  <td ><input name="txtTelRL" type="text" class="tahoma12" id="txtTelRL" value="<?php echo $telefono_rl ?>" size="70" maxlength="70" /></td>
                </tr>

                <tr>

                  <td  style="text-align:center" colspan="2"><strong>Director</strong></td>
                </tr>

                <tr>

                  <td>Nombre y Apellido:</td>

                  <td><input name="txtNombreD" type="text" class="tahoma12" id="txtNombreD" value="<?php echo $nombre_d ?>" size="70" maxlength="70" />                  </td>
                </tr>

                <tr>

                  <td >DNI:</td>

                  <td ><input id="txtDniD2" name="txtDniD" type="text" value="<?php echo $dni_d ?>" class="tahoma12" /></td>
                </tr>

                <tr>

                  <td >Correo electronico :</td>

                  <td ><input name="txtDomD" type="text" class="tahoma12" id="txtDomD" value="<?php echo $domicilio_d ?>" size="70" maxlength="70" /></td>
                </tr>
               
              	<tr>

                  <td  style="text-align:center" colspan="2"><strong>Vicedirector</strong></td>
                </tr>

                <tr>

                  <td >Nombre y Apellido:</td>

                  <td ><input name="txtNombreVD" type="text" class="tahoma12" id="txtNombreVD" value="<?php echo $nombre_vd ?>" size="70" maxlength="70" />                  </td>
                </tr>

                <tr>

                  <td >DNI:</td>

                  <td ><input id="txtDniVD2" name="txtDniVD" type="text" value="<?php echo $dni_vd ?>" class="tahoma12" /></td>
                </tr>

                <tr>

                  <td >Correo electrónico:</td>

                  <td ><input name="txtDomVD" type="text" class="tahoma12" id="txtDomVD" value="<?php echo $domicilio_vd ?>" size="70" maxlength="70" /></td>
                </tr>

                <tr>

                  <td  style="text-align:center" colspan="2"><strong> Secretario Docente</strong></td>
                </tr>

                <tr>

                  <td >Nombre y Apellido:</td>

                  <td ><input name="txtNombreSD" type="text" class="tahoma12" id="txtNombreSD" value="<?php echo $nombre_sd ?>" size="70" maxlength="70" />                  </td>
                </tr>

                <tr>

                  <td >DNI:</td>

                  <td ><input id="txtDniSD2" name="txtDniSD" type="text" value="<?php echo $dni_sd ?>" class="tahoma12" /></td>
                </tr>

                <tr>

                  <td >Correo electrónico:</td>

                  <td ><input name="txtDomSD" type="text" class="tahoma12" id="txtDomSD" value="<?php echo $domicilio_sd ?>" size="70" maxlength="70" /></td>
                </tr>

                <tr>

                  <td colspan="2"  style="text-align:center"><font color="red"><?php echo $mensaje ?></font>                  </td>
				  </tr>

                <tr align="right" valign="middle"> 

                  <td colspan="2" align="center"><input name="btnguardar" type="button" class="btn" id="btnguardar" onclick="frm.action.value='G'; frm.submit();" value="GUARDAR" /></td>
                </tr>
              </table>            </td>

          <td width="78">&nbsp;</td>
        </tr>
      </table>
	    <p>
	      <input type="hidden" name="action" id="action">
	      <input name="id_per" type="hidden" id="id_per" value="<?php echo $id?>">
	        </p>
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
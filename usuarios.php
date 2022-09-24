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

$nombre=$_POST["txtNombre"];
$institucion=$_POST["cmbInst"];
$email=$_POST["txtEmail"];
$tipo_doc=$_POST["cmbTipoDoc"];
$documento=$_POST["txtDocumento"];
$usuario=$_POST["txtUsuario"];
$pass=$_POST["txtPass"];
$rpass=$_POST["txtRPass"];
$id=$_REQUEST["id_usu"];

if($_POST["action"] == "G" && $id!="")
{
	if($institucion!="" && $nombre!="" && $pass!="")
	{
		if($pass == $rpass)
		{
		mysqli_query($link,"UPDATE usuarios SET
							Nombre = '$nombre',
							IDInstitucion = '$institucion',
							Email = '$email',
							TipoDoc = $tipo_doc,
							Documento = '$documento',
							Usuario = '$usuario',
							Pass = '$pass',
							AudUsrModi='$usrmodi',
							AudFecModi='$fecmodi'
					 WHERE ID = $id");
		$mensaje = 	"Usuario actualizado";
		}
		else
		{
			$mensaje = 	" Las contrase�as no coinciden" ;
		}
	}
	else
	{
		$mensaje = 	"(*) Complete los datos";
	}
}


if($_POST["action"] == "G" && $id=="")
{
	if($institucion!="" && $nombre!="" && $pass!="")
	{
		if($pass == $rpass)
		{
			//chequeo que el usuario no exista 
			$sql = mysqli_fetch_assoc(mysqli_query($link,"SELECT count(*) as cantidad FROM usuarios WHERE Usuario=TRIM('$usuario')"));
			if ($sql["cantidad"] < 1) 
			{
			 	mysqli_query($link,"INSERT INTO usuarios (Nombre, IDInstitucion, Email, TipoDoc, Documento, Usuario, Pass, AudUsrAlta, AudFecAlta)
							VALUES ('$nombre', $institucion, '$email', $tipo_doc, '$documento', '$usuario', '$pass', '$usralta', '$fecalta')");
				$id = mysqli_insert_id($link);
				$mensaje = 	"Usuario registrado";
			}

			else

			{

			$mensaje = 	"Usuario ya existente. Ingrese otro";

			}	

		}

		else

		{

			$mensaje = 	"Las contrase�as no coinciden";

		}

	}

	else

	{

		$mensaje = 	"(*) Complete los datos";

	}

}



if($_POST["action"] == "E" && $id!="")

{

	mysqli_query($link,"UPDATE usuarios SET vigente='0' , AudUsrModi='$usrmodi', AudFecModi='$fecmodi'  WHERE ID=$id");

	mysqli_query($link,"DELETE FROM subsistemas_usuario WHERE IDUsuario=$id");

	$nombre = "";

	$institucion = "";

	$email = "";

	$tipo_doc = "";

	$documento = "";

	$usuario = "";

	$pass = "";

	$rpass = "";

	$id = "";

	$mensaje = 	"Usuario eliminado";

}



if($id != "")

{

	$sql = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM usuarios WHERE vigente='1' AND ID=$id"));

	$nombre = $sql["Nombre"];

	$institucion = $sql["IDInstitucion"];

	$email = $sql["Email"];

	$tipo_doc = $sql["TipoDoc"];

	$documento = $sql["Documento"];

	$usuario = $sql["Usuario"];

	$pass = $sql["Pass"];

	$rpass = $sql["Pass"];

	$id = $sql["ID"];

}
$inst=mysqli_query($link,"SELECT * FROM instituciones  WHERE vigente='1' ORDER BY nombre");
$inst_id=mysqli_query($link,"SELECT * FROM instituciones  WHERE vigente='1' AND ID='" .$_SESSION["Institucion"]. "' ORDER BY nombre");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->
<!--SEO -->
<meta name="Keywords" content=" " />
<meta name="description" content=" " />
<title>Fondo Solidario  |  Sistema de Gesti�n</title>
<?php include("scripts.php"); ?>
</head>
<body>
<form name="frm" id="frm" method="post" action="">
<script language="javascript" src="calendar/calendar.js"></script>
<script language="javascript">
function eliminar()
{
	if (confirm('�Est� seguro de eliminar el registro?'))
	{
		frm.action.value='E';
		frm.submit();
	}	 
}
</script>


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
	<img src="images/map.png" width="30" height="36" border="0"> <b>Usuarios - Alta y Modificaci�n</b>
	</div>
     <div class="clear2"> </div>
    <div >
 
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
        
        <tr>
          <td width="26%" height="26" align="right" >Nombre y Apellido:</td>
          <td colspan="3" align="left" class="tahoma11"><input name="txtNombre" type="text" class="tahoma12" value="<?php echo $nombre?>" size="70" maxlength="70" /></td>
        </tr>
        <tr>
          <td height="26" align="right" class="tahoma11">Instituci&oacute;n:</td>
          <td colspan="3" align="left" class="tahoma11"><!-- SI LA INSTITUCION ES JAEC LISTO TODAS-->
              <?php if ($_SESSION["Institucion"]==14) {?>
            
            <select name="cmbInst" id="cmbInst" class="tahoma12" style="width:350px ">
              <?php while($row=mysqli_fetch_assoc($inst)) { ?>
              <option value="<?php echo $row["ID"]?>" <?php if($row["ID"]==$institucion) echo "selected"?>><?php echo $row["Nombre"]?> (<?php echo $row["Localidad"]?>)</option>
              <?php } ?>
            </select>
            </td>
          <?php } ?>
          <!-- SI LA INSTITUCION NO ES JAEC LISTO  SOLO LA INSTITUCION DEL USUARIO-->
          <?php if ($_SESSION["Institucion"]!=14) {?>
                   <select name="cmbInst" id="cmbInst" class="tahoma12" style="width:350px ">
            <?php while($row=mysqli_fetch_assoc($inst_id)) { ?>
            <option value="<?php echo $row["ID"]?>" <?php if($row["ID"]==$institucion) echo "selected"?>><?php echo $row["Nombre"]?> (<?php echo $row["Localidad"]?>)</option>
            <?php } ?>
          </select>
          <?php } ?>
        </tr>
        <tr>
          <td height="26" align="right" class="tahoma11">Tipo de Documento:</td>
          <td width="24%" align="left" class="tahoma11">
              <select name="cmbTipoDoc" id="cmbTipoDoc" class="tahoma12">
                <option value="1" <?php if($tipo_doc=="1") echo "selected"?>>DNI</option>
                <option value="2" <?php if($tipo_doc=="2") echo "selected"?>>LE</option>
                <option value="3" <?php if($tipo_doc=="3") echo "selected"?>>LC</option>
            </select></td>
          <td width="21%" align="right" class="tahoma11">N&deg; Documento:</td>
          <td width="29%" align="left" class="tahoma11">
              <input name="txtDocumento" value="<?php echo $documento ?>" type="text" class="tahoma12" /></td>
        </tr>
        <tr>
          <td height="26" align="right" class="tahoma11">Email de contacto:</td>
          <td colspan="3" align="left" class="tahoma11">
              <input name="txtEmail" type="text" class="tahoma12" value="<?php echo $email ?>" size="70" maxlength="70" /></td>
        </tr>
        <tr>
          <td height="26" align="right" class="tahoma11">Nombre de usuario:</td>
          <td align="left" class="tahoma11">
              <input name="txtUsuario" type="text" class="tahoma11" value="<?php echo $usuario ?>" maxlength="10" <?php if ($id!="")  echo "readonly" ?> /></td>
          <td align="right" class="tahoma11"></td>
          <td align="left" class="tahoma11"></td>
        </tr>
        <tr>
          <td height="26" align="right" class="tahoma11">Contrase&ntilde;a:</td>
          <td align="left" class="tahoma11">
              <input name="txtPass" value="<?php echo $pass ?>" type="password" class="tahoma12" /></td>
          <td align="right" class="tahoma11">Confirmar contrase&ntilde;a:</td>
          <td align="left" class="tahoma11">
              <input name="txtRPass" value="<?php echo $rpass ?>" type="password" class="tahoma12" /></td>
        </tr>
        <tr>
          <td height="40" colspan="4" align="center" class="tahoma12"><font color="red"><?php echo $mensaje ?></font></td>
        </tr>
        <tr>
          <td height="26" colspan="4" align="center" class="tahoma11"><input name="btnguardar" type="button" class="btn" value="GUARDAR" onClick="frm.action.value='G'; frm.submit();" />
            <input name="btneliminar" type="button" class="btn" value="ELIMINAR" onClick="frm.action.value='E'; frm.submit();" />
            <input name="btnlimpiar" type="button" class="btn" value="NUEVO" onClick="window.open('usuarios.php','_self');" />          </td>
        </tr>
      </table>
	  
        <input type="hidden" name="action" id="action">

		<input name="id_usu" type="hidden" id="id_usu" value="<?php echo $id?>">

    </div>
  </div>
</div>
</div>
<div class="clear"> </div>
<?php include("pie.php"); ?>

</form>
	
</body>
</html>
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

// regla de negocios
$mensaje="(*) Complete los datos";

$nombre=$_POST["txtNombre"];
$nombre2=$_POST["txtNombre2"];
$caracter=$_POST["cmbCaracter"];
$modalidad=$_POST["txtModalidad"];
$nivel=$_POST["cmbNivel"];
$zona=$_POST["txtZona"];
$domicilio=$_POST["txtDom"];
$barrio=$_POST["txtBarrio"];
$provincia=$_POST["cmbProvincia"];
$localidad=$_POST["cmbLocalidad"];
$telefono=$_POST["txtTel"];
$email=$_POST["txtEma"];
$supervisor=$_POST["txtSup"];
$rl=$_POST["txtRL"];
$director=$_POST["txtDirector"];
$vice=$_POST["txtViceDirector"];
$secretario=$_POST["txtSecretario"];
$junta=$_POST["cmbJunta"];
$fondo=$_POST["cmbFondo"];
$id=$_REQUEST["id_inst"];

if($_POST["action"] == "G" && $id!="")
{
	if($nombre!="")
	{
		mysqli_query($link,"UPDATE instituciones SET
									Nombre = '$nombre',
									Nombre2 = '$nombre2',
									Caracter='$caracter',
									Modalidad = '$modalidad',
									Nivel = '$nivel',
									Supervisor = '$supervisor',
									Zona = '$zona',
									Domicilio = '$domicilio',
									Barrio = '$barrio',
									IDProvincia = '$provincia',
									IDLocalidad = '$localidad',
									Telefono = '$telefono',
									Email = '$email',
									Nombre_RL='$rl',
									Nombre_D='$director',
									Nombre_VD='$vice',
									Nombre_SD='$secretario',
									Junta = '$junta',
									Fondo = '$fondo',
									AudUsrModi='$usrmodi',
									AudFecModi='$fecmodi'
								WHERE ID = $id");

		$mensaje = 	"**** Institución actualizada correctamente ****";
	}
	else
	{
		$mensaje="**** Complete todos los campos ****";
	}
}

if($_POST["action"] == "G" && $id=="")
{
	if($nombre!="")
	{
      mysqli_query($link,"INSERT INTO instituciones (Nombre, Caracter, Modalidad, Nivel, Supervisor, Zona, Domicilio, Barrio, IDProvincia, IDLocalidad, Telefono, Email, Nombre_RL, Nombre_D, Nombre_VD, Nombre_SD, Junta, Fondo, AudUsrAlta, AudFecAlta, vigente ,Telefono_RL)
              VALUES ('$nombre', '$caracter', '$modalidad', '$nivel', '$supervisor', '$zona', '$domicilio', '$barrio', $provincia, '$localidad', '$telefono', '$email', '$rl', '$director', '$vice', '$secretario', '$junta', '$fondo', '$usralta', '$fecalta', '1','')");
                    $id = mysqli_insert_id($link);
               
    
		$mensaje = 	"**** Institución registrada correctamente ****";
	}
	else
	{
		$mensaje="**** Complete todos los campos ****";
	}
}

if($_POST["action"] == "E" && $id!="")
{
	//si la institucion esta asignada a alguna tabla no le permito borrar.
	$sql_usuarios = mysqli_fetch_assoc(mysqli_query($link,"SELECT count(*) as cantidad FROM usuarios WHERE IDInstitucion=$id"));
	$sql_denuncias = mysqli_fetch_assoc(mysqli_query($link,"SELECT count(*) as cantidad FROM denuncias WHERE DE_IDInstitucion=$id"));
	$sql_alumnos = mysqli_fetch_assoc(mysqli_query($link,"SELECT count(*) as cantidad FROM alumnos WHERE IDInstitucion=$id"));
	$sql_docentes = mysqli_fetch_assoc(mysqli_query($link,"SELECT count(*) as cantidad FROM denuncias_docentes WHERE DE_IDInstitucion=$id"));
	$sql_tickets = mysqli_fetch_assoc(mysqli_query($link,"SELECT count(*) as cantidad FROM tickets WHERE idinstitucion=$id"));
	if ($sql_usuarios["cantidad"] < 1 && $sql_denuncias["cantidad"] < 1 && $sql_alumnos["cantidad"] < 1 && $sql_docentes["cantidad"] < 1 && $sql_tickets["cantidad"] < 1) 
	{
	mysqli_query($link,"UPDATE instituciones SET vigente='0' , AudUsrModi='$usrmodi', AudFecModi='$fecmodi'  WHERE ID=$id");
	$nombre="";
	$nombre2="";
	$caracter="";
	$modalidad="";
	$nivel="";
	$supervisor="";
	$zona="";
	$domicilio="";
	$barrio="";
	$provincia="";
	$localidad="";
	$telefono="";
	$email="";
	$rl="";
	$director="";
	$vice="";
	$secretario="";
	$junta="";
	$fondo="";
	$id = "";
	$mensaje = 	"**** Institución eliminada correctamente ****";
	}
	else
	{
	$mensaje = 	"**** No se puede eliminar. Tiene objetos asociados ****";
	}
}

if($id != "")
{
	$row = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM instituciones WHERE vigente='1' AND ID=$id"));
	$nombre=$row["Nombre"];
	$nombre2=$row["Nombre2"];
	$caracter=$row["Caracter"];
	$modalidad=$row["Modalidad"];
	$nivel=$row["Nivel"];
	$supervisor=$row["Supervisor"];
	$zona=$row["Zona"];
	$domicilio=$row["Domicilio"];
	$barrio=$row["Barrio"];
	$provincia=$row["IDProvincia"];
	$localidad=$row["IDLocalidad"];
	$telefono=$row["Telefono"];
	$email=$row["Email"];
	$rl=$row["Nombre_RL"];
	$director=$row["Nombre_D"];
	$vice=$row["Nombre_VD"];
	$secretario=$row["Nombre_SD"];
	$junta=$row["Junta"];
	$fondo=$row["Fondo"];
	$id = $row["ID"];
}

$prv=mysqli_query($link,"SELECT * FROM provincias ORDER BY Nombre");
$loc=mysqli_query($link,"SELECT * FROM localidades ORDER BY Nombre");

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
</head>
<body>
<script language="javascript" src="calendar/calendar.js"></script>
<script language="javascript">
function eliminar()
{
	if (confirm('¿Está seguro de eliminar el registro?'))
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
	<img src="images/map.png" width="30" height="36" border="0"> <b>Instituciones - Alta y Modificación</b>
	</div>
       <div class="clear2"> </div>
    <div class="clear2"> </div>
    <div >
      <form name="frm" id="frm" action="" method="post">

	    <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="143" height="26" align="right" class="tahoma11">Nombre Instiuci&oacute;n:</td>
            <td width="399" colspan="3" align="left" class="tahoma11">
                <input name="txtNombre" type="text" class="tahoma12" id="txtNombre" value="<?php echo $nombre ?>" size="70" maxlength="70" />            </td>
          </tr>
          <tr>
            <td height="26" align="right" class="tahoma11">Alias:</td>
            <td colspan="3" align="left" class="tahoma11"><input name="txtNombre2" type="text" class="tahoma12" id="txtNombre2" value="<?php echo $nombre2 ?>" size="70" maxlength="70" /></td>
          </tr>
          <tr>
            <td height="26" align="right" class="tahoma11">Caracter:</td>
            <td colspan="3" align="left" class="tahoma11">    <select name="cmbCaracter" id="cmbCaracter" class="tahoma12" style="width:350px ">
                  <option value="" selected="selected" <?php if($caracter=="") echo "selected"?>>Sin Informaci&oacute;n</option>
					  <option value="1" <?php if($caracter=="1") echo "selected"?>>Adheridos</option>
					  <option value="2" <?php if($caracter=="2") echo "selected"?>>Congregacional - Asociaciones Confesionales</option>
					  <option value="3" <?php if($caracter=="3") echo "selected"?>>Diocesano</option>
					  <option value="4" <?php if($caracter=="4") echo "selected"?>>Parroquial</option>
                </select>            </td>
          </tr>
          <tr>
            <td height="26" align="right" class="tahoma11">Modalidad:</td>
            <td colspan="3" align="left" class="tahoma11">                <input name="txtModalidad" type="text" class="tahoma12" id="txtModalidad" value="<?php echo $modalidad ?>" size="70" maxlength="70" />            </td>
          </tr>
          <tr>
            <td height="26" align="right" class="tahoma11">Nivel:</td>
            <td colspan="3" align="left" class="tahoma11">
                <input name="cmbNivel" type="text" class="tahoma12" id="cmbNivel" value="<?php echo $nivel ?>" size="70" maxlength="70" />                  </tr>
          <tr>
            <td height="26" align="right" class="tahoma11">Zona:</td>
            <td colspan="3" align="left" class="tahoma11">
                <input name="txtZona" type="text" class="tahoma12" id="txtZona" value="<?php echo $zona ?>" size="70" maxlength="70" />            </td>
          </tr>
          <tr>
            <td height="26" align="right" class="tahoma11">Domicilio:</td>
            <td colspan="3" align="left" class="tahoma11">
                <input name="txtDom" type="text" class="tahoma12" id="txtDom" value="<?php echo $domicilio ?>" size="70" maxlength="70" />            </td>
          </tr>
          <tr>
            <td height="26" align="right" class="tahoma11">Barrio:</td>
            <td colspan="3" align="left" class="tahoma11">
                <input name="txtBarrio" type="text" class="tahoma12" id="txtBarrio" value="<?php echo $barrio ?>" size="70" maxlength="70" /></td>
          </tr>
          <tr>
            <td height="26" align="right" class="tahoma11">Localidad:</td>
            <td colspan="3" align="left" class="tahoma11"><select name="cmbLocalidad" id="cmbLocalidad" class="tahoma12" style="width:250px" >
                <?php

                    while ($row=mysqli_fetch_assoc($loc))

					{

						echo '<option value="'. $row["ID"] .'" '. (($row["ID"]==$localidad)?'selected':'') .'>'. $row["Nombre"] .'</option>';

					}

					?>
              </select>            </td>
          </tr>
          
          <tr>
            <td height="26" align="right" class="tahoma11">Provincia:</td>
            <td colspan="3" align="left" class="tahoma11">
                <select name="cmbProvincia" id="cmbProvincia" class="tahoma12" style="width:250px" >
                  <?php

                    while ($row=mysqli_fetch_assoc($prv))

					{

						echo '<option value="'. $row["ID"] .'" '. (($row["ID"]==$provincia)?'selected':'') .'>'. $row["Nombre"] .'</option>';

					}

					?>
                </select>            </td>
          </tr>
      
          <tr>
            <td height="26" align="right" class="tahoma11">Tel&eacute;fono:</td>
            <td colspan="3" align="left" class="tahoma11">
                <input name="txtTel" type="text" class="tahoma12" id="txtTel" value="<?php echo $telefono ?>" size="70" maxlength="70" />            </td>
          </tr>
          <tr>
            <td height="26" align="right" >Email:</td>
            <td colspan="3" align="left" >
                <input name="txtEma" type="text"  id="txtEma" value="<?php echo $email ?>" size="70" maxlength="70" /></td>
          </tr>
          <tr>
            <td height="26" align="right" >Supervisor:</td>
            <td colspan="3" align="left" ><input name="txtSup" type="text" id="txtSup" value="<?php echo $supervisor ?>" size="70" maxlength="70" />            </td>
          </tr>
          <tr>
            <td height="26" align="right">Representante Legal: </td>
            <td colspan="3" align="left" ><input name="txtRL" type="text"  id="txtRL" value="<?php echo $rl ?>" size="70" maxlength="70" /></td>
          </tr>
          <tr>
            <td height="26" align="right" >Director:</td>
            <td colspan="3" align="left" ><input name="txtDirector" type="text"  id="txtDirector" value="<?php echo $director ?>" size="70" maxlength="70" /></td>
          </tr>
          <tr>
            <td height="26" align="right" >Vice Director: </td>
            <td colspan="3" align="left" ><input name="txtViceDirector" type="text"  id="txtViceDirector" value="<?php echo $vice ?>" size="70" maxlength="70" /></td>
          </tr>
          <tr>
            <td height="26" align="right" >Secretario Docente:</td>
            <td colspan="3" align="left" ><input name="txtSecretario" type="text"  id="txtSecretario" value="<?php echo $secretario ?>" size="70" maxlength="70" /></td>
          </tr>
          <tr>
            <td height="26" align="right" >Junta:</td>
            <td colspan="3" align="left" >
			<select name="cmbJunta" style="width:50px">
			
            <option value="S" <?php if ($junta=="S") echo "selected"; ?>> SI </option>
			<option value="N" <?php if ($junta=="N") echo "selected"; ?>> NO </option>
			</select>            </td>
          </tr>
          <tr>
            <td height="26" align="right" class="tahoma11">Fondo:</td>
            <td colspan="3" align="left" class="tahoma11">
			<select name="cmbFondo" style="width:50px">
            <option value="S" <?php if ($fondo=="S") echo "selected"; ?>> SI </option>
			<option value="N" <?php if ($fondo=="N") echo "selected"; ?>> NO </option>
			</select>			</td>
          </tr>
          
          <tr>
            <td height="26" colspan="4" align="center" class="tahoma12"><font color="red"><?php echo $mensaje ?></font> </td>
          </tr>
          <tr>
            <td height="26" colspan="4" align="center" class="tahoma11">
			
			<input name="btnguardar" type="button" class="btn" id="btnguardar" onClick="frm.action.value='G'; frm.submit();" value="GUARDAR" />
             &nbsp;
             <input name="Submit2" type="button" class="btn" value="ELIMINAR" onClick="eliminar();" />
             &nbsp;
           <input name="Submit2" type="button" class="btn" value="NUEVA" onClick="window.open('instituciones.php','_self');" />  
		    &nbsp;
           <input name="Submit2" type="button" class="btn" value="BUSCAR" onClick="window.open('instituciones.buscar.php','_self');" />		                </td>
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
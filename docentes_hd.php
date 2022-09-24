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

$institucion=$_POST["cmbInst"];
$nombre=$_POST["txtNombre"];
$tipo_doc=$_POST["cmbTipoDoc"];
$documento=$_POST["txtDoc"];
$sexo=$_POST["cmbSexo"];
$fecha_nac=$_POST["txtFechaNac"];
$cuil=$_POST["txtCUIL"];
$cargo=$_POST["txtCargo"];
$legajo=$_POST["txtLegajo"];
$direccion=$_POST["txtDir"];
$barrio=$_POST["txtBarrio"];
$provincia=4;
$localidad=$_POST["cmbLocalidad"];

$cp=$_POST["txtCP"];
$telefono=$_POST["txtTel"];
$fecha_i=$_POST["txtFecI"];
$remuneracion=$_POST["txtRemu"];
$tareas_a=$_POST["txtTareasA"];
$usa_licencia=$_POST["r_licencia"];
$tareas_p=$_POST["r_tareas_p"];
$id=$_REQUEST["id_per"];

if($_POST["action"] == "G" && $id!="")
{
	if($institucion!="" && $nombre!="")
	{
		mysqli_query($link,"UPDATE personal SET
				IDinstitucion = '$institucion',
				Nombre = '$nombre',
				TipoDoc = $tipo_doc,
				Documento = '$documento',
				CUIL = '$cuil',
				Cargo = '$cargo',
				Legajo='$legajo',
				FechaNacimiento= '$fecha_nac',
				Sexo= '$sexo',
				Direccion = '$direccion',
				Barrio = '$barrio',
				IDProvincia = $provincia,
				Localidad = '$localidad',
				CodigoPostal = '$cp',
				Telefono = '$telefono',
				FechaIngreso = '$fecha_i',
				Remuneracion = '$remuneracion',
				Tareas = '$tareas_a',
				UsaLicencia = '$usa_licencia',
				TareasPasivas = '$tareas_p',
				AudusrModi='$usrmodi',
				AudFecModi='$fecmodi'
				WHERE ID = $id");
	$mensaje = 	"Datos actualizados";
	}
	else
	{
	$mensaje="(*) Complete los datos";

	}

}

if($_POST["action"] == "G" && $id=="")
{
	if($institucion!="" && $nombre!="")
	{
		$tmpRC=mysqli_query($link,"INSERT INTO personal (IDInstitucion, Nombre, TipoDoc, Documento, CUIL, Cargo, Legajo, FechaNacimiento, Sexo, Direccion, Barrio, IDProvincia, Localidad, CodigoPostal, Telefono, FechaIngreso, Remuneracion, Tareas, UsaLicencia, TareasPasivas, AudUsrAlta, AudFecAlta, vigente)
										VALUES ($institucion, '$nombre', $tipo_doc, '$documento', '$cuil', '$cargo', '$legajo', '$fecha_nac', '$sexo', '$direccion', '$barrio', $provincia, '$localidad', '$cp', '$telefono', '$fecha_i', '$remuneracion', '$tareas_a', '$usa_licencia', '$tareas_p', '$usralta', '$fecalta', '1')");
	if (! $tmpRC) printf("Error: %s\n", mysqli_error($link));
$id = mysqli_insert_id($link);

$mensaje = 	"Datos registrados";
	}
	else
	{
		$mensaje="(*) Complete los datos";
	}
}

if($_POST["action"] == "E" && $id!="")
{
	mysqli_query($link,"UPDATE personal SET vigente='0', AudUsrModi='$usrmodi', AudFecModi='$fecmodi' WHERE ID=$id");
	mysqli_query($link,"DELETE FROM declaraciones_juradas WHERE IDPersonal=$id");
	$institucion = "";
	$nombre = "";
	$tipo_doc = "";
	$documento = "";
	$cuil = "";
	$cargo = "";
	$legajo = "";
	$fecha_nac= "";
	$sexo= "";
	$direccion = "";
	$barrio = "";
	$provincia = "";
	$localidad = "";
	$cp = "";
	$telefono = "";
	$fecha_i = "";
	$remuneracion = "";
	$tareas_a = "";
	$usa_licencia = "";
	$tareas_p = "";
	$id = "";

	$mensaje = 	"Docente/No Docente eliminado";

}

if($id != "")
{
	$sql = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM personal WHERE vigente='1' AND ID=$id"));
	$institucion = $sql["IDInstitucion"];
	$nombre = $sql["Nombre"];
	$tipo_doc = $sql["TipoDoc"];
	$documento = $sql["Documento"];
	$cuil = $sql["CUIL"];
	$cargo= $sql["Cargo"];
	$legajo= $sql["Legajo"];
	$fecha_nac= $sql["FechaNacimiento"];
	$sexo= $sql["Sexo"];
	$direccion = $sql["Direccion"];
	$barrio = $sql["Barrio"];
	$provincia = $sql["IDProvincia"];
	$localidad = $sql["Localidad"];
	$cp = $sql["CodigoPostal"];
	$telefono = $sql["Telefono"];
	$fecha_i = $sql["FechaIngreso"];
	$remuneracion = $sql["Remuneracion"];
	$tareas_a = $sql["Tareas"];
	$usa_licencia = $sql["UsaLicencia"];
	$tareas_p = $sql["TareasPasivas"];
	$id = $sql["ID"];
}

//tablas tipos
$inst=mysqli_query($link,"SELECT * FROM instituciones WHERE vigente='1' ORDER BY nombre");
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
<title>Fondo Solidario  |  Sistema de Gestión</title>
<?php include("scripts.php"); ?>
 <link rel="stylesheet" href="css/jquery-ui.css">
  <script src="js/jquery-1.10.2.js"></script>
  <script src="js/jquery-ui.js"></script>

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
	<img src="images/map.png" width="30" height="36" border="0"> <b>Docentes y No Docentes - Alta y Modificación</b>
	</div>
       <div class="clear2"> </div>
    <div class="clear2"> </div>
    <div >
      <form name="frm" id="frm" action="" method="post">

	  <!-- inicio tabla de datos -->
	  <table width="100%"  height="100%"  border="0" cellspacing="0" cellpadding="0">
        
		<tr>
          <td height="26" colspan="2" align="left" ><!-- SI LA INSTITUCION ES JAEC LISTO TODAS-->
           <select name="cmbInst" id="cmbInst">
		   <?php while($row=mysqli_fetch_assoc($inst)) { ?>
		   <?php if ($row["ID"]==$institucion) 
		   	  { 
			  $sel="selected";
			  }
			  else
			  {
			  $sel="";
			  }			  
			  ?> 

		      <option value="<?php echo $row["ID"]?>" <?php echo $sel;?> ><?php echo $row["Nombre"]?> (<?php echo $row["Localidad"]?>)</option>

		      <?php } ?>
		      </select>

        </tr>
        <tr>
          <td colspan="2" >Nombre y Apellido:<br>
          <input name="txtNombre" type="text" id="txtNombre" value="<?php echo $nombre ?>"/>          </td>
		  
		  </tr>
        <tr>
          <td >Tipo de Documento:<br>
              <select name="cmbTipoDoc" id="cmbTipoDoc"  style="width:200px">
                <option value="1" <?php if($tipo_doc=="1") echo "selected"?>>DNI</option>
                <option value="2" <?php if($tipo_doc=="2") echo "selected"?>>LE</option>
                <option value="3" <?php if($tipo_doc=="3") echo "selected"?>>LC</option>
              </select>          </td>
          <td >N&deg; Documento:<br>
          <input name="txtDoc" id="txtDoc" value="<?php echo $documento ?>" type="text" />          </td></tr>
        <tr>
          <td >Sexo:<br>
          <select name="cmbSexo" id="cmbSexo" style="width:200px" >
            <option value="F" <?php if($sexo=="F") echo "selected"?>>Femenino</option>
            <option value="M" <?php if($sexo=="M") echo "selected"?>>Masculino</option>
          </select>          </td><td >Fecha Nacimiento:<br>
          <input name="txtFechaNac" id="txtFechaNac" value="<?php echo $fecha_nac?>" type="text" />          </td></tr>
        <tr>
          <td colspan="2" >CUIL:<br>
              <input name="txtCUIL" id="txtCUIL" value="<?php echo $cuil ?>" type="text" />          </td>
         
        </tr>
        <tr>
          <td >Cargo:<br>
              <input name="txtCargo" type="text" id="txtCargo" value="<?php echo $cargo ?>" /></td>
         <td >Legajo:<br>
                <input name="txtLegajo" id="txtLegajo" value="<?php echo $legajo?>" type="text" />          </td>
		</tr>
        <tr>
          <td colspan="2" >Domicilio:<br>
              <input name="txtDir" type="text" id="txtDir" value="<?php echo $direccion ?>" />          </td>
        </tr>
        <tr>
          <td colspan="2" >Barrio:<br>
              <input name="txtBarrio" type="text" id="txtBarrio" value="<?php echo $barrio ?>" /></td>
        </tr>
        
        <tr>
          <td >Localidad:<br>
              <input name="cmbLocalidad" type="text" id="cmbLocalidad" value="<?php echo $localidad ?>"  />          </td>
			   <td >C&oacute;digo Postal:<br>
          <input name="txtCP" id="txtCP" value="<?php echo $cp ?>" type="text" />          </td>
        </tr>
        <tr>
         <td colspan="2" >Tel&eacute;fono:<br>
          <input name="txtTel" id="txtTel" value="<?php echo $telefono ?>" type="text" />          </td></tr>
        <tr>
          <td >Fecha de Ingreso:<br>
              <input name="txtFecI" id="txtFecI" value="<?php echo $fecha_i ?>" type="text" style="width:200px" />          </td>
          <td >Remuneraci&oacute;n:<br>
          <input name="txtRemu" id="txtRemu" value="<?php echo $remuneracion ?>" type="text" />          </td></tr>
        <tr>
          <td >En Uso de licencia?:<br>
          <table border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td><input type="radio" id="r_licencia" name="r_licencia" value="S" <?php if($usa_licencia=="S") echo "checked"?> /></td>
                  <td><label>SI</label></td>
                  <td width="20">&nbsp;</td>
                  <td><input type="radio" id="r_licencia" name="r_licencia" value="N" <?php if($usa_licencia=="N") echo "checked"?>/></td>
                  <td><label>NO</label></td>
                  <td>&nbsp;</td>
                </tr>
          </table></td><td >Tareas pasivas?:<br>
          <table border="0" cellpadding="0" cellspacing="0" >
            <tr>
              <td><input type="radio" id="r_tareas_p" name="r_tareas_p" value="S" <?php if($tareas_p=="S") echo "checked"?>/></td>
                  <td><label>SI</label></td>
                  <td width="20">&nbsp;</td>
                  <td><input type="radio" id="r_tareas_p" name="r_tareas_p" value="N" <?php if($tareas_p=="N") echo "checked"?>/></td>
                  <td><label>NO</label></td>
                  <td>&nbsp;</td>
                </tr>
          </table></td></tr>
        <tr>
          <td colspan="2" >Tareas actuales:<br>
              <textarea name="txtTareasA" cols="70" rows="3" id="txtTareasA"><?php echo $tareas_a ?></textarea>          </td>
        </tr>
		
		<tr>

                  <td colspan="2" align="center" ><font color="red"><b><?php echo $mensaje ?></b></font></td>

                </tr>

		<tr>
          <td colspan="2" align="center" >
		  
		          <input name="btnguardar" type="button"  id="btnguardar" onClick="frm.action.value='G'; frm.submit();" value="GUARDAR" />

                  &nbsp;<input name="Submit" type="button" value="ELIMINAR" onClick="eliminar();" />

                  &nbsp;<input name="Submit2" type="button" value="NUEVO" onClick="window.open('docentes.php','_self');" />                  
		  </td>		</tr>
		
		
      </table>
       <input type="hidden" name="action" id="action">
       <input name="id_per" type="hidden" id="id_per" value="<?php echo $id?>">

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

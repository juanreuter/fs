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
$tipo_doc=$_POST["cmbTipoDoc"];
$documento=$_POST["txtDoc"];
$parentesco=$_POST["txtParentesco"];
$porcentaje=$_POST["txtPorcentaje"];
$id_per=$_REQUEST["id_per"];
$id=$_REQUEST["id_dj"];

if($_POST["action"] == "G" && $id!="")
{
	if($nombre!="")
	{
		mysqli_query($link,"UPDATE declaraciones_juradas SET
							Nombre = '$nombre',
							TipoDoc = $tipo_doc,
							Documento = '$documento',
							Parentesco = '$parentesco',
							Porcentaje = '$porcentaje',
							AudUsrModi='$usrmodi',
							AudFecModi='$fecmodi'
						    WHERE ID = $id");
		$mensaje = 	"Datos Actualizados";
	}
	else
	{
		$mensaje="(*) Complete los datos";
	}
}

if($_POST["action"] == "G" && $id=="")
{
	if($nombre!="")
	{
		mysqli_query($link,"INSERT INTO declaraciones_juradas (IDPersonal, Nombre, TipoDoc, Documento, Parentesco, Porcentaje, AudUsrAlta, AudFecAlta)
										VALUES ($id_per, '$nombre', $tipo_doc, '$documento', '$parentesco', '$porcentaje','$usralta','$fecalta')");
		$id = mysqli_insert_id($link);
		$mensaje = 	"Datos Actualizados";
	}
	else
	{
	$mensaje="(*) Complete los datos";
	}
}

if($id != "")
{
	$sql = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM declaraciones_juradas WHERE ID=$id"));
	$nombre = $sql["Nombre"];
	$tipo_doc = $sql["TipoDoc"];
	$documento = $sql["Documento"];
	$parentesco = $sql["Parentesco"];
	$porcentaje = $sql["Porcentaje"];
	$id = $sql["ID"];
}

if($_REQUEST["id_per"]!="")
{
	$sql_nombredoc = mysqli_fetch_assoc(mysqli_query($link,"SELECT Nombre FROM personal WHERE ID = ". $_REQUEST["id_per"] .""));
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

<script>
function listar_declaraciones_juradas(id){
	ventana="listar_declaraciones_seguro.php?id_per=" + id;
	window.open(ventana,'_self');
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
	<img src="images/map.png" width="30" height="36" border="0"> <b>Docentes y No Docentes - Beneficiarios de Seguro de Vida</b>
	</div>
   
    <div class="clear2"> </div>
    <div class="clear2"> </div>
    <div >
      <h1><b><?php if ($id =='') { ?> Agregar <?php } ?> <?php if ($id !='') { ?> Editar <?php } ?> un beneficiario para:  "<?php echo $sql_nombredoc["Nombre"]?>"</b></h1>
	  
      <form name="frm" id="frm" action="" method="post">

	  <!-- inicio tabla de datos -->
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
        
        <tr>
          <td width="26%" height="26" >Nombre y Apellido <font color="red"><b>(*)</b></font> </td>
          <td colspan="3" >
              <input name="txtNombre" type="text" value="<?php echo $nombre?>" size="70" maxlength="70" /></td>
        </tr>
        <tr>
          <td height="26" >Tipo Documento <font color="red"><b>(*)</b></font></td>
          <td width="24%" >
              <select name="cmbTipoDoc" id="cmbTipoDoc" class="tahoma12">
                <option value="1" <?php if($tipo_doc=="1") echo "selected"?>>DNI</option>
                <option value="2" <?php if($tipo_doc=="2") echo "selected"?>>LE</option>
                <option value="3" <?php if($tipo_doc=="3") echo "selected"?>>LC</option>
            </select></td>
          <td width="21%" >N&deg; Docum. <font color="red"><b>(*)</b></font></td>
          <td width="29%" >
              <input name="txtDoc" type="text" id="txtDoc" value="<?php echo $documento ?>" /></td>
        </tr>
        <tr>
          <td height="26" >Parentesco <font color="red"><b>(*)</b></font></td>
          <td >
              <input name="txtParentesco" type="text" id="txtParentesco" value="<?php echo $parentesco ?>" /></td>
          <td >Porcentaje <font color="red"><b>(*)</b></font></td>
          <td >
              <input name="txtPorcentaje" type="text" id="txtPorcentaje" value="<?php echo $porcentaje ?>" /></td>
        </tr>
        <tr>
          <td height="26" colspan="4" align="center" class="tahoma12"><font color="red"><b><?php echo $mensaje ?></b></font></td>
        </tr>
        <tr>
          <td height="26" colspan="4" align="center" class="tahoma11"><input name="Submit3" type="button" class="btn" value="GUARDAR" onClick="frm.action.value='G'; frm.submit();" />
            &nbsp;
            <input name="Submit4" type="button" class="btn" value="LISTAR" onClick="listar_declaraciones_juradas(<?php echo $id_per?>);" />
            &nbsp;
            <input name="Submit2" type="button" class="btn" value="NUEVA" onClick="window.open('docentes_seguro.php?id_per=<?php echo $id_per ?>','_self');" />          </td>
        </tr>
      </table>
      <input type="hidden" name="action" id="action">
	  <input name="id_per" type="hidden" id="id_per" value="<?php echo $id_per ?>">
	  <input name="id_dj" type="hidden" id="id_dj" value="<?php echo $id ?>">
	  </form>
      <div class="clear2"> </div>
      <div class="clear2"> </div>
      <div class="clear2"> </div>
    </div>
  </div>
</div>
</div>
<div class="clear"> </div>
<?php include("pie.php"); ?>
</body>
</html>
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

//datos para dar de alta la orden de derivacion
$de_fecha = $_POST["txtDEFecha"];
$de_hora = $_POST["txtDEHora"];
$de_detalle= $_POST["txtDEDetalle"];
$de_derivacion= $_POST["r_DEDerivacion"];
$de_centro = $_POST["cmbCentro"];
$de_centroparticular = $_POST["txtcentropart"];
$id=$_POST["id_der"];
if ($id=="") 
{
$id=$_REQUEST["id"];
}

$id_den=$_POST["id_den"];

/************************************************************************************************************************
ACCIONES
************************************************************************************************************************/
if($_POST["action"] == "G" && $id!="")
{
	if($id!="") 
	{
		mysqli_query($link,"UPDATE denuncias_derivaciones SET
						Fecha = '$de_fecha',
						Hora = '$de_hora',
						Derivacion = '$de_derivacion',
						IDCentro = $de_centro,
						CentroParticular = '$de_centroparticular',
						Diagnostico= '$de_detalle',
						AudUsrModi='$usrmodi',
						AudFecModi='$fecmodi'
					 WHERE ID = $id");
		$mensaje = 	"**** Derivaci�n actualizada correctamente ****";
		header("location:denuncias.derivaciones.listar.php?id_denuncia=$id_den");
	}
	else
	{
		$mensaje = 	"**** Complete todos los campos ****";
	}
}

//INSERT
if($_POST["action"] == "G" && $id=="")
{
	if($id_den!="")
	{
		mysqli_query($link,"INSERT INTO denuncias_derivaciones (IDDenuncia, IDCentro,CentroParticular, Fecha, Hora, Derivacion, Diagnostico, AudUsrAlta, AudFecAlta, AudUsrModi, AudFecModi, vigente)
					VALUES ($id_den, $de_centro, '$de_centroparticular', '$de_fecha', '$de_hora', '$de_derivacion', '$de_detalle', '$usralta', '$fecalta', '$usrmodi', '$fecmodi', '1')");
		$id = mysqli_insert_id($link);
		
		$mensaje = 	"**** Derivaci�n registrada correctamente ****";
		header("location:denuncias.derivaciones.listar.php?id_denuncia=$id_den");
	}
	else
	{
		$mensaje = 	"**** Complete todos los campos ****";
	}
}

if($_POST["action"] == "E" && $id!="")
{
	mysqli_query($link,"UPDATE denuncias_derivaciones SET vigente='0', AudUsrModi='$usrmodi', AudFecModi='$fecmodi' WHERE ID=$id");
	$de_fecha = "";
	$de_hora = "";
	$de_detalle= "";
	$de_derivacion= "";
	$de_centro = "";
	$de_centroparticular = "";
	$id = "";
	$id_denuncia = "";
	$mensaje = 	"**** Orden eliminada correctamente ****";
	header("location:denuncias.derivaciones.listar.php?id_denuncia=$id_den");
}


if($id != "")
{
	$sql = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM denuncias_derivaciones WHERE vigente='1' AND ID=$id"));
	$de_fecha = $sql["Fecha"];
	$de_hora = $sql["Hora"];
	$de_detalle= $sql["Diagnostico"];
	$de_derivacion= $sql["Derivacion"];
	$de_centro = $sql["IDCentro"];
	$de_centroparticular = $sql["CentroParticular"];
}
//TABLAS TIPOS
$de_inst_id=mysqli_query($link,"SELECT * FROM instituciones  WHERE vigente='1' AND ID='" .$_SESSION["Institucion"]. "' ORDER BY nombre");
$acc_cen=mysqli_query($link,"SELECT * FROM derivaciones_centros ORDER BY nombre");

//datos de la denuncia para escribir encabezado
$id_den=$_REQUEST["id_denuncia"];
$sql = mysqli_fetch_assoc(mysqli_query($link,"SELECT a.ID, a.ACC_Nombre, a.DA_Fecha, b.Nombre FROM denuncias a, instituciones b WHERE a.DE_IDInstitucion=b.ID AND a.vigente='1' AND a.ID=$id_den"));
$id_denuncia = $sql["ID"];
$nombre = $sql["ACC_Nombre"];
$institucion=$sql["Nombre"];
$fecha=$sql["DA_Fecha"];
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
	<img src="images/map.png" width="30" height="36" border="0"> <b>Derivaciones M�dicas para la <a href="denuncias.php?id_den=<?php echo $id_den?>">Denuncia N� <?php echo $id_den ?></a></b>
	</div>
    
	
    <div >
    
      <div class="clear2"> </div>
	  <div class="clear2"> </div>

	 <table width="100%" >


                <tr>

                  <td width="16%" ><div align="right">Accidentado:</div></td>

                  <td colspan="3" align="left" class="tahoma11"><?php echo $nombre ?></td>

                </tr>

                <tr>

                  <td align="right" >Fecha:</td>

                  <td width="52%" align="left" ><?php echo $fecha ?></td>

                  <td width="7%" align="right" >&nbsp;</td>

                  <td width="25%" align="left" >&nbsp;</td>

                </tr>

                <tr>

                  <td height="26" align="right" class="tahoma11">Instituci&oacute;n:</td>

                  <td colspan="3" align="left" class="tahoma11"><?php echo $institucion ?></td>

                </tr>

				 

				

                <tr>

                  <td colspan="4" align="center" bgcolor="#999999"><b>DATOS ORDEN DE DERIVACION</b></td>

                </tr>

                <tr>

                  <td align="right">Fecha:</td>

                  <td align="left" >
				<?php require_once('calendar/classes/tc_calendar.php'); ?>

			<?php 
			$myCalendar = new tc_calendar("txtDEFecha", true, false);
			$myCalendar->setIcon("calendar/images/iconCalendar.gif");
			if ($de_fecha!='')
			{
			$myCalendar->setDateYMD($de_fecha);
			}
			else
			{
			$myCalendar->setDate(date('d'), date('m'), date('Y'));
			}
			$myCalendar->setPath("calendar/");
			$myCalendar->setYearInterval(2015, 2022);
			$myCalendar->dateAllow('2015-01-01', '2022-12-31');
			$myCalendar->setDateFormat('j F Y');
			$myCalendar->setAlignment('left', 'bottom');
			$myCalendar->writeScript();
			?>
                  </td>

                  <td align="right" >Hora:</td>

                  <td align="left" >

                  <input id="txtDEHora" name="txtDEHora" type="text" value="<?php echo $de_hora ?>" />

                  </td>

                </tr>

                <tr>

                  <td align="right" >Derivaci�n: </td>

                  <td colspan="3" align="left">

				  <table border="0" cellpadding="0" cellspacing="0"  width="100%">

                    <tr>

                      <td>

                      <input type="radio" id="r_DEDerivacion" name="r_DEDerivacion" value="FS" <?php if($de_derivacion=="FS") echo "checked"?>/>

                      </td>

                      <td><label>RED P.M. del FSCR</label></td>

                      <td width="20">&nbsp;</td>

                      <td>

                      <input type="radio" id="r_DEDerivacion" name="r_DEDerivacion" value="PA" <?php if($de_derivacion=="PA") echo "checked"?>/>

                      </td>

                      <td><label>Particular Autorizada por los Padres</label></td>

                      

                      </tr>

                  </table>				  </td>

                </tr>

                <tr>

                  <td height="26" align="right" class="tahoma11">Red: </td>

                  <td colspan="3" align="left" class="tahoma11">

				  <select name="cmbCentro" id="cmbCentro" style="width:350px ">

                   <?php while($row=mysqli_fetch_assoc($acc_cen)) { ?>

                    <option value="<?php echo $row["ID"]?>" <?php if($row["ID"]==$de_centro) echo "selected"?>><?php echo $row["Nombre"]?></option>

                    <?php } ?>

                  	</select>

				  </td>

                </tr>

                <tr>

                  <td height="26" align="right" class="tahoma11">Particular: </td>

                  <td colspan="3" align="left" class="tahoma11"><input name="txtcentropart" type="text" class="tahoma12" id="txtcentropart" style="width:350px " value="<?php echo $de_centroparticular ?>" size="50" /></td>

                </tr>

                <tr>

                  <td height="26" align="right" class="tahoma11">&nbsp;</td>

                  <td colspan="3" align="left" class="tahoma11">

                  Diagn&oacute;stico y Tratamiento o Indicaciones a seguir:<br>
                  
                  <textarea name="txtDEDetalle" cols="50" rows="7" class="tahoma12" id="txtDEDetalle" style="width:350px "><?php echo $de_detalle ?></textarea>

                  </td>

                </tr>

                <tr>

                  <td height="26" colspan="4" align="center" class="tahoma12"><font color="red"><?php echo $mensaje ?></font></td>

                </tr>

                <tr>

                  <td height="26" colspan="4" align="center" class="tahoma11">

                 
				  <?php if ($id_den !="" ){?>	
				  <input name="Submit1" type="button" value="LISTAR" onClick="window.open('denuncias.derivaciones.listar.php?id_denuncia=<?php echo $id_den?>', '_self');" />
				 &nbsp;<input name="Submit2" type="button"  value="NUEVA" onClick="window.open('denuncias.derivaciones.php?id_denuncia=<?php echo $id_den?>', '_self');" />
				<?php } ?>	  
				  &nbsp;<input name="Submit3" type="button" class="btn" value="GUARDAR" onClick="frm.action.value='G'; frm.submit();" />

                  &nbsp;<input name="Submit" type="button" class="btn" value="ELIMINAR" onClick="eliminar();" />

&nbsp;              

        		<input type="hidden" name="action" id="action">

				<input name="id_den" type="hidden" id="id_den" value="<?php echo $id_denuncia?>">

				<input name="id_der" type="hidden" id="id_der" value="<?php echo $id?>">

    </td>

                </tr>


	</table>
	
           		  
    </div>
  </div>
</div>
</div>
<div class="clear"> </div>
<?php include("pie.php"); ?>

</form>
	
</body>
</html>
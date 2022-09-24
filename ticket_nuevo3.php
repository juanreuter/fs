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

$idinstitucion=$_REQUEST["id_ins"];
$idtipoticket=$_POST["cmbTipo"];
$idtipoestado=$_POST["cmbEstado"];
$fecha=$_POST["txtFecha"];
$titulo=$_POST["txtTitulo"];
$observaciones=$_POST["txtObservaciones"];
$archivo=$_FILES['fileArchivo']['name'];
if ($_POST["id_tic"]!="") {
$id=$_POST["id_tic"];
}
if ($_REQUEST["id_tic"]!="") {
$id=$_REQUEST["id_tic"];
}


if($_POST["action"] == "EA" && $id!="")
{
		mysqli_query($link,"UPDATE tickets SET
									archivo = '',
									AudUsrModi='$usrmodi',
									AudFecModi='$fecmodi'
								WHERE idticket = $id");

$mensaje = 	"Ticket N° "  .$id. " actualizado correctamente";
}


if($_POST["action"] == "G" && $id!="")
{
	if($titulo!="")
	{
		mysqli_query($link,"UPDATE tickets SET
									idtipoticket= '$idtipoticket',
									idestado='$idtipoestado',
									fecha = '$fecha',
									titulo = '$titulo',
									observaciones = '$observaciones',
									archivo = '$archivo',
									AudUsrModi='$usrmodi',
									AudFecModi='$fecmodi'
								WHERE idticket = $id");

		move_uploaded_file($_FILES['fileArchivo']['tmp_name'], "archivos_tickets/".$archivo);
		$mensaje = 	"Ticket N° "  .$id. " actualizado correctamente";
	}
	else
	{
		$mensaje="**** Complete todos los campos ****";
	}
}

if($_POST["action"] == "G" && $id=="")
{
	if($titulo!="")
	{
	mysqli_query($link,"INSERT INTO tickets(idinstitucion, idtipoticket, idestado, fecha, titulo, observaciones, archivo, AudUsrAlta, AudFecAlta, vigente)
					VALUES ('$idinstitucion', '$idtipoticket', '$idtipoestado', '$fecha', '$titulo', '$observaciones', '$archivo', '$usralta', '$fecalta', '1')");
		$id = mysqli_insert_id($link);
		move_uploaded_file($_FILES['fileArchivo']['tmp_name'], "archivos_tickets/".$archivo);

		$mensaje = 	"Ticket N° "  .$id. " registrado correctamente";
	}
	else
	{
		$mensaje="**** Complete todos los campos ****";
	}
}

if($id != "")
{
	$row = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM tickets WHERE vigente='1' AND idticket=$id"));
	$idinstitucion=$row["idinstitucion"];
	$idtipoticket=$row["idtipoticket"];
	$idtipoestado=$row["idestado"];
	$fecha=$row["fecha"];
	$titulo=$row["titulo"];
	$observaciones=$row["observaciones"];
	$archivo=$row["archivo"];
	$id = $row["idticket"];
}

$tipoticket=mysqli_query($link,"SELECT * FROM tickets_tipos ORDER BY tipoticket");
$estado=mysqli_query($link,"SELECT * FROM tickets_estados ORDER BY estado");
$sql_nombreinst = mysqli_fetch_assoc(mysqli_query($link,"SELECT Nombre FROM instituciones WHERE ID = ". $idinstitucion ."", $link));
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
function eliminar_archivo(id)
{

	frm.action.value='EA';
	frm.id_tic.value=id;
	frm.submit();
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
	<img src="images/map.png" width="30" height="36" border="0"> <b>Nuevo eTicket - Datos del eTicket</b>
	</div>
       <div class="clear2"> </div>
    <div class="clear2"> </div>
    <div >
      <form name="frm" id="frm" action="" method="post"  enctype="multipart/form-data">

	    <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="143" height="26" align="right" >Nombre Instiuci&oacute;n:</td>
            <td width="399"  align="left" ><?php echo $sql_nombreinst["Nombre"] ?></td>
          </tr>
          <tr>
            <td height="26" align="right" >Fecha del eTicket: </td>
            <td  align="left" >
			    <?php require_once('calendar/classes/tc_calendar.php'); ?>
              <?php 
			$myCalendar = new tc_calendar("txtFecha", true, false);
			$myCalendar->setIcon("calendar/images/iconCalendar.gif");
			if ($fecha!='')
			{
			$myCalendar->setDateYMD($fecha);
			}
			else
			{
			$myCalendar->setDate(date('d'), date('m'), date('Y'));
			}
			$myCalendar->setPath("calendar/");
			$myCalendar->setYearInterval(2015, 2019);
			$myCalendar->dateAllow('2015-01-01', '2019-12-31');
			$myCalendar->setDateFormat('j F Y');
			$myCalendar->setAlignment('left', 'bottom');
			$myCalendar->writeScript();
			?>
			
			</td>
          </tr>
          <tr>
            <td height="26" align="right" >Tipo de eTicket:</td>
            <td  align="left" >
			<select name="cmbTipo" id="cmbTipo" style="width:250px ">
                <?php while($row=mysqli_fetch_assoc($tipoticket)) { ?>
                <option value="<?php echo $row["idtipoticket"]?>" <?php if($row["idtipoticket"]==$idtipoticket) echo "selected"?>><?php echo $row["tipoticket"]?></option>
                <?php } ?>
              </select>
			</td>
          </tr>
		   <tr>
            <td height="26" align="right" >Estado del eTicket:</td>
            <td  align="left" >
			<select name="cmbEstado" id="cmbEstado" style="width:250px ">
                <?php while($row=mysqli_fetch_assoc($estado)) { ?>
                <option value="<?php echo $row["idestado"]?>" <?php if($row["idestado"]==$idtipoestado) echo "selected"?>><?php echo $row["estado"]?></option>
                <?php } ?>
              </select>
			
			</td>
          </tr>
          
          <tr>
            <td height="26" align="right" class="tahoma11">Título/Asunto:</td>
            <td  align="left" class="tahoma11"><input name="txtTitulo" type="text" id="txtTitulo" value="<?php echo $titulo?>" size="70" /></td>
          </tr>
          
          <tr>
            
            <td align="left" colspan="2" >Observaciones: <br> <textarea name="txtObservaciones" rows="5" ><?php echo $observaciones?></textarea></td>
          </tr>
          
		    
			<?php if($archivo == '')
			{
			?> 
			<tr>
            <td height="26" align="right" >Archivo Adjunto:</td>
			<td align="left" >
			<input name="fileArchivo" type="file" id="fileArchivo"  />
			</td>
            </tr>
          <?php } else { ?>
		  <tr>
            <td height="26" align="right" >Archivo Adjunto:</td>
			<td align="left" >
		    <a href="archivos_tickets/<?php echo $archivo ?>" target="_blank"><?php echo $archivo ;?></a> <strong><a href="#" onClick="eliminar_archivo(<?php echo $id?>)">[eliminar adjunto]</a></strong>
			</td>
            </tr>
		<?php } ?>  
         
          
          <tr>
            <td height="26" colspan="4" align="center" class="tahoma12"><font color="red"><?php echo $mensaje ?></font> </td>
          </tr>
          <tr>
            <td height="26" colspan="4" align="center" class="tahoma11">
			
			<input name="btnguardar" type="button" class="btn" id="btnguardar" onClick="frm.action.value='G'; frm.submit();" value="GUARDAR" />
             &nbsp;
           <input name="Submit2" type="button" class="btn" value="NUEVO" onClick="window.open('ticket_nuevo1.php','_self');" />  
		    &nbsp;
           <input name="Submit2" type="button" class="btn" value="LISTAR" onClick="window.open('listar_tickets.php','_self');" />		                </td>
          </tr>
        </table>
	    <p>
	      <input type="hidden" name="action" id="action">
	      <input name="id_tic" type="hidden" id="id_tic" value="<?php echo $id?>">
		  <input name="id_ins" type="hidden" id="id_ins" value="<?php echo $idinstitucion?>">
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
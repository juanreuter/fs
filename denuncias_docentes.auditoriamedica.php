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
$mensaje="Complete los datos";

$observaciones= $_POST["txtObservaciones"];

$estado= $_POST["cmbEstado"];

// viene de la pagina de listar_denuncias_docentes_auditoriamedica // iddenuncia

$id = $_REQUEST["id_den"];

$id_auditoria = $_REQUEST["id_aud"];



//datos del archivo

$archivo=$HTTP_POST_FILES['fileArchivo']['name'];

$tipo_archivo=$HTTP_POST_FILES['fileArchivo']['type'];

$tamano_archivo=$HTTP_POST_FILES['fileArchivo']['size'];

/************************************************************************************************************************

ACCIONES - GUARDO DATOS DE LA AUDITORIA

************************************************************************************************************************/

if($_POST["action"] == "G" && $id_auditoria!="")

{

		mysqli_query($link,"UPDATE auditoriamedica_docentes SET

						Observaciones = '$observaciones',

						IDEstadoAuditoria = $estado,

						AudUsrModi='$usrmodi',

						AudFecModi='$fecmodi'

					 WHERE IDAuditoria = $id_auditoria");

		$mensaje = 	"Auditoria actualizada";

			// pregunto si cargo el archivo

			if($archivo!="")

			{

				mysqli_query($link,"INSERT INTO auditoriamedica_docentes_adjuntos(IDAuditoriamedica, AudUsrAlta, AudFecAlta)

							 VALUES ($id_auditoria, '$usralta', '$fecalta')");

				$id = mysqli_insert_id($link);

				if(move_uploaded_file($HTTP_POST_FILES['fileArchivo']['tmp_name'], "archivos_auditoria/".$archivo))

				{

					$sql="UPDATE auditoriamedica_docentes_adjuntos set Archivo='$archivo' WHERE IDAdjunto=$id";

					$r=mysqli_query($link,$sql);

					$mensaje = 	"Auditoria actualizada";

				}

				else

				{

					$mensaje = 	"Se produjo un error al subir el archivo";

				}

			}



		

}



//eliminar adjuntos

if($_POST["action"] == "E")

{

	mysqli_query($link,"DELETE FROM auditoriamedica_docentes_adjuntos WHERE IDAdjunto=". $_POST["id_adjunto"]);

}





//

if($id != "")

{

	$sql = mysqli_query($link,"SELECT IDAuditoria, Observaciones, IDEstadoAuditoria, FechaEnvio, ACC_Nombre, ACC_Telefono, instituciones.Nombre as NombreInst FROM auditoriamedica_docentes, denuncias_docentes, instituciones WHERE auditoriamedica_docentes.IDDenuncia=denuncias_docentes.ID AND instituciones.ID=denuncias_docentes.DE_IDInstitucion AND auditoriamedica_docentes.IDDenuncia=$id");

	if($row=mysqli_fetch_assoc($sql)){ 	

		$observaciones = $row["Observaciones"];

		$estado = $row["IDEstadoAuditoria"];

		$fechaenvio = $row["FechaEnvio"];

		$accidentado = $row["ACC_Nombre"];

		$telefono = $row["ACC_Telefono"];

		$institucion = $row["NombreInst"];

		$id_auditoria = $row["IDAuditoria"];

	}

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
<script language="javascript">

function eliminar(id)

{

	if (confirm('¿Está seguro de eliminar el registro?'))

	{

		frm.action.value="E";

		frm.id_adjunto.value= id;		

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
	<img src="images/map.png" width="30" height="36" border="0"> <b>Lista de Denuncias con pedido de Auditoría Médica</b>
	</div>
    <div >
  
      <form name="frm" id="frm" action="" method="post"  enctype="multipart/form-data">

	  <!-- inicio tabla de datos -->
	  <table width="95%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="26" colspan="4" align="left" class="tahoma11"><p>Accidentado: <?php echo $accidentado ?></p>
              <p>Instituci&oacute;n: <?php echo $institucion ?></p>
            </td>
        </tr>
        <tr>
          <td width="374" colspan="3" align="left" class="tahoma11">Observaciones:<br>
              <textarea name="txtObservaciones" cols="50" rows="7" class="tahoma12" id="txtObservaciones" style="width:350px "><?php echo $observaciones ?></textarea></td>
        </tr>
        <tr>
          <td colspan="3" align="left" class="tahoma11">Estado de la Auditor&iacute;a:<br>
            <select name="cmbEstado" id="cmbEstado" class="tahoma12" style="width:120px ">
                <option value="1" <?php if($estado=="1") echo "selected"?>>En Proceso</option>
                <option value="2" <?php if($estado=="2") echo "selected"?>>Completada</option>
                <option value="3" <?php if($estado=="3") echo "selected"?>>Anulada</option>
				<option value="4" <?php if($estado=="4") echo "selected"?>>Interrumpida</option>
              </select>
          </td>
        </tr>
        <tr>
          <td colspan="3" align="left" class="tahoma11">Archivo Adjunto:<br>
            <input name="fileArchivo" type="file" class="tahoma12" id="fileArchivo"  />
          </td>
        </tr>
        <?php  // listo los archivos asociados

				$sql = mysqli_query($link,"SELECT * FROM auditoriamedica_docentes_adjuntos WHERE IDAuditoriamedica=$id_auditoria");

				?>
        <tr>
          <td height="26" colspan="4" align="center" class="tahoma12"><div align="left"><b>Listado de Archivos Asociados</b></div></td>
        </tr>
        <?php while($row =  mysqli_fetch_assoc($sql)){?>
        <tr>
          <td height="26" colspan="4" align="left" class="tahoma12">* <a href="../archivos_auditoria/<?php echo $row["Archivo"]?>" target="_blank" title="abrir archivo"><?php echo $row["Archivo"]?></a> &nbsp;&nbsp;&nbsp; (<a href="javascript:eliminar('<?php echo $row["IDAdjunto"]?>');">eliminar archivo</a>)</td>
        </tr>
        <?php } ?>
        <tr>
          <td height="26" colspan="4" align="center" class="tahoma12"><font color="red"><?php echo $mensaje ?></font></td>
        </tr>
        <tr>
          <td height="26" colspan="4" align="center" class="tahoma11"><input name="Submit3" type="button" class="btn" value="GUARDAR" onClick="frm.action.value='G'; frm.submit();" />
            &nbsp; </td>
        </tr>
      </table>
	   <input type="hidden" name="action" id="action">

		<input name="id_den" type="hidden" id="id_den" value="<?php echo $id?>">

		<input name="id_aud" type="hidden" id="id_aud" value="<?php echo $id_auditoria?>">

        <input type="hidden" name="id_adjunto" id="id_adjunto">

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
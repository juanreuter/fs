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

if($_POST['accion']=="guardar")
{
	//datos del archivo
	$archivo=$HTTP_POST_FILES['strarchivo']['name'];
	echo $archivo;
	$tipo_archivo=$HTTP_POST_FILES['strarchivo']['type'];
	$tamano_archivo=$HTTP_POST_FILES['strarchivo']['size'];
   	if ($_POST["nivel"] == 'Inicial')
	{
	mysqli_query($link,"UPDATE fi_inicial SET archivo_adjunto='$archivo', AudUsrModi='$usrmodi', AudFecModi='$fecmodi' WHERE id_ficha=".$_POST["ficha"]."");
	}

	move_uploaded_file($HTTP_POST_FILES['strarchivo']['tmp_name'], "archivos_fichas/".$archivo);
	?>
	<script>
	window.alert("Archivo actualizado!")
	window.close()
	</script>
	<?php
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

<title>Fondo Solidario  |  Sistema de Gestión</title>
</head>

<body>
<form name="frm" enctype="multipart/form-data">
 
<table>
<tr>

	                    <td><div align="right">Ficha:</div></td>

	                    <td><div align="left">

						<input name="strarchivo" type="file" id="strarchivo"  />

	                      </div></td>

	                  </tr>
<tr><td colspan="2">
<input type="button" onclick="frm.accion.value='guardar';frm.submit();" name="cmdguardar" value="Guardar" />
</td></tr>
</table>

<input type="hidden" name="accion">
<input type="hidden" name="nivel" value="<?php echo $_REQUEST["id_nivel"] ?>">
<input type="hidden" name="ficha" value="<?php echo $_REQUEST["id_fic"] ?>">



</form>
</body>
</html>

<?php
//controlo acceso y auditoria
session_start();
if(!$_SESSION["log"]) header("location:index.php");
$usrmodi=$_SESSION["Usuario"];
$fecmodi=date("Y-m-d H:i:s");
$usralta=$_SESSION["Usuario"];
$fecalta=date("Y-m-d H:i:s");
$mensaje = "Clic para cargar o imprimir los beneficiarios";
//base de datos
include ("funciones/conexion_bbdd.php");


// regla de negocios
$id_per=$_REQUEST["id_per"];

if($_POST["action"] == "E")
{
	mysqli_query($link,"DELETE FROM declaraciones_juradas WHERE ID=". $_POST["id_dj"]);
}

$declaraciones=mysqli_query($link,"SELECT * FROM declaraciones_juradas WHERE IDPersonal = ". $_REQUEST["id_per"] ." ORDER BY Nombre");


//obtengo el nombre del docente o no docente
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
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
-->
</style>
</head>
<body>
<form name="frm" id="frm" method="post" action="">
<script language="javascript" src="calendar/calendar.js"></script>
<script>
function reporte_persona(id){
	ventana="reporte_persona.php?id="+ id;
	window.open(ventana,'','width=720,height=720,top=20,left=200,scrollbars=auto,titlebar=no,location=no');
}
function eliminar(id_declaracion)
{
	if (confirm('¿Está seguro de eliminar el beneficiario?'))
	{
		frm.id_dj.value= id_declaracion;
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
	<img src="images/map.png" width="30" height="36" border="0"> <b>Docentes y No Docentes - Beneficiarios de Seguro de Vida</b>
	</div>
    <div class="clear2"> </div>
    <div >
      
	  <h1><b>Lista de Beneficiarios de: "<?php echo $sql_nombredoc["Nombre"]?>"</b></h1><br>
      <table width="95%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="47%" height="20" align="center" ><b>Nombre y Apellido</b></td>
          <td width="20%" align="center" ><b>Parentesco</b></td>
          <td width="20%" align="center" ><b>Porcentaje</b></td>
          <td width="6%" align="center" >&nbsp;</td>
          <td width="7%" align="center" >&nbsp;</td>
        </tr>
        <?php while($row =  mysqli_fetch_assoc($declaraciones)){

					$cant++;

					if($cant % 2 == 0){ $bg = 'bgcolor="#FFFFCC"'; } else { $bg = 'bgcolor="#FFFFFF"'; }

			?>
        <tr>
          <td height="20" align="center" <?php echo $bg ?> class="tahoma11"><?php echo $row["Nombre"]?></td>
          <td align="center" <?php echo $bg ?> class="tahoma11"><?php echo $row["Parentesco"]?></td>
          <td align="center" <?php echo $bg ?> class="tahoma11"><?php echo $row["Porcentaje"]?></td>
          <td align="center" <?php echo $bg ?> class="tahoma11"><a href="#"><img src="images/icon_edit.gif" border="0"  width="20" height="16" alt="editar"  title="editar" onClick="window.open('docentes_seguro.php?id_per=<?php echo $row["IDPersonal"]?>&id_dj=<?php echo $row["ID"]?>','_self');"></a> </td>
          <td align="center" <?php echo $bg ?> class="tahoma11"><a href="#"><img src="images/icon_delete.gif" border="0" width="20" height="18" alt="eliminar" title="eliminar" onClick="eliminar('<?php echo $row["ID"]?>')"></a> </td>
        </tr>
        <?php } ?>
       
      </table>
	  <table style="width:100%">
	  <tr><td style="text-align:center">
	          <input name="Submit2" type="button" value="NUEVO" onClick="window.open('docentes_seguro.php?id_per=<?php echo $id_per ?>','_self');" />     
	  </td></tr>
	  </table>
    </div>
  </div>
</div>
</div>
<div class="clear"> </div>
<?php include("pie.php"); ?>
<input type="hidden" name="action" id="action">
<input type="hidden" name="id_dj" id="id_dj">
</form>
	
</body>
</html>
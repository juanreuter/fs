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
if($_POST["action"] == "E")

{
	mysqli_query($link,"UPDATE denuncias_docentes_derivaciones SET vigente='0', AudUsrModi='$usrmodi', AudFecModi='$fecmodi' WHERE ID=". $_POST["id_der"]);
}

/////////////////////////// LISTA LAS DERIVACIONES SEGUN DENUNCIA SELECCIONADA////////////////////////

if($_REQUEST["id_denuncia"]!="")
{
	$derivaciones=mysqli_query($link,"SELECT c.ID, c.Fecha AS FechaDerivacion, d.Nombre AS Centro, c.CentroParticular as CentroParticular FROM denuncias_docentes a,  denuncias_docentes_derivaciones c, derivaciones_centros d WHERE a.ID=c.IDDenuncia AND c.IDCentro=d.ID  AND c.vigente='1' AND c.IDDenuncia = ". $_REQUEST["id_denuncia"] ." ORDER BY c.AudFecAlta DESC");
}
else
{
header("location:denuncias_docentes.derivaciones.buscar.php");
}

//datos de la denuncia para escribir encabezado
if ($id_den !="" )
{
$id_den=$_REQUEST["id_denuncia"];
$sql = mysqli_fetch_assoc(mysqli_query($link,"SELECT a.ID, a.ACC_Nombre, b.Nombre FROM denuncias_docentes a, instituciones b WHERE a.DE_IDInstitucion=b.ID AND a.vigente='1' AND a.ID=$id_den"));
$id_denuncia = $sql["ID"];
$nombre = $sql["ACC_Nombre"];
$institucion=$sql["Nombre"];
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
<form name="frm" id="frm" method="post" action="">
<script language="javascript" src="calendar/calendar.js"></script>
<script language="javascript">
function eliminar(id)
{
	if (confirm('¿Está seguro de eliminar el registro?'))
	{
		frm.action.value="E";
		frm.id_der.value= id;		
		frm.submit();
	}	 
}
function imprimir(id)
{
	ventana="orden_docente_derivacion_print.php?id="+ id;
	window.open(ventana,'','width=720,height=720,top=20,left=200,scrollbars=auto,titlebar=no,location=no');
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
    <div class="small-12 large-12 columns menunegro"> 
	
	<a href="derivaciones.ayuda.php" class="linkblanco"><img src="animacion/interior/help.png" alt="ayuda" width="16" height="16" align="middle"> Ayuda </a>
	<?php if ($id_den !="" ){?>
	<a href="denuncias_docentes.derivaciones.listar.php?id_denuncia=<?php echo $id_den?>" class="linkblanco"><img src="animacion/interior/listado.jpg" alt="listado" width="16" height="15" align="middle"> Listar Derivaciones</a>
	<a href="denuncias_docentes.derivaciones.php?id_denuncia=<?php echo $id_den?>" class="linkblanco"><img src="animacion/interior/nueva.jpg" alt="nueva" width="16" height="16" align="middle"> Nueva Derivación </a> 
	</div>
	<?php } ?>
    <div class="clear2"> </div>
    <div class="clear2"> </div>
    <div >
	<?php if ($id_den !="" ){?>
      <h1><b>Lista de Derivaciones de la Denuncia N° <?php echo $id_denuncia ?></b></h1>

      <div class="clear2"> </div>

	 <table width="100%" >

<tr>

              <td width="89%" colspan="2"><?php echo $nombre ?> - <?php echo $institucion ?></td>

              </tr>

          </table>          
<?php } ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">

            <tr>

              <td width="19%" align="center" bgcolor="#999999" ><div align="center"><strong>N° Derivación</strong></div></td>

              <td width="24%" align="center" bgcolor="#999999" ><div align="center"><strong>Centro</strong></div></td>

              <td width="12%" align="center" bgcolor="#999999" ><div align="center"><strong>Fecha</strong></div></td>

              <td width="9%" align="center" bgcolor="#999999" >&nbsp;</td>

              <td width="9%" align="center" bgcolor="#999999" >&nbsp;</td>

              <td width="9%" align="center" bgcolor="#999999" >&nbsp;</td>

            </tr>

            <?php while($row =  mysqli_fetch_assoc($derivaciones)){

					$cant++;

					if($cant % 2 == 0){ $bg = 'bgcolor="#FFFFCC"'; } else { $bg = 'bgcolor="#FFFFFF"'; }

			?>

            <tr>

              <td height="20" align="center" <?php echo $bg ?> class="tahoma11"><?php echo $row["ID"]?></td>

			  <?php 

			  // chequeo el centro si es del JAEC o PARTICULAR

			  if ($row["Centro"]=="[Sin Informacion]") 

			  {

			  $str_centro=$row["CentroParticular"];

			  }

			  else

			  {

			  $str_centro=$row["Centro"];

			  }

			  ?>	

              <td align="center" <?php echo $bg ?> ><?php echo $str_centro?></td>

              <td align="center" <?php echo $bg ?> ><?php echo $row["FechaDerivacion"]?></td>

              <td align="center" <?php echo $bg ?> > <a href="#"><img src="images/icon_edit.gif" border="0"  width="20" height="16" alt="editar" onClick="window.open('denuncias_docentes.derivaciones.php?id=<?php echo $row["ID"]?>&id_denuncia=<?php echo $id_denuncia?>','_self');" /></a> </td>

              <td align="center" <?php echo $bg ?> > <a href="javascript:eliminar('<?php echo $row["ID"]?>');"><img src="images/icon_delete.gif" border="0" width="20" height="18" alt="eliminar" /></a> </td>

              <td align="center" <?php echo $bg ?> > <a href="javascript:imprimir('<?php echo $row["ID"]?>');"><img src="images/icon-printer2.jpg" alt="imprimir" width="25" height="20" border="0" /></a></td>

            </tr>

            <?php } ?>

            <tr>

              <td  colspan="6" align="center">

              </td>

            </tr>


	</table>
	
           		  
    </div>
  </div>
</div>
</div>
<div class="clear"> </div>
<?php include("pie.php"); ?>
<input type="hidden" name="action" id="action">
<input type="hidden" name="id_der" id="id_der">
</form>
	
</body>
</html>
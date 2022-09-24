<?php
error_reporting('0');

//controlo acceso y auditoria
session_start();
if(!$_SESSION["log"]) header("location:index.php");
$usrmodi=$_SESSION["Usuario"];
$fecmodi=date("Y-m-d H:i:s");
$usralta=$_SESSION["Usuario"];
$fecalta=date("Y-m-d H:i:s");
//$mensaje = "Clic para cargar o imprimir los beneficiarios";
//base de datos
include ("funciones/conexion_bbdd.php");


// regla de negocios
if($_POST["action"] == "E")
{
	mysqli_query($link,"UPDATE personal SET vigente='0', AudUsrModi='$usrmodi', AudFecModi='$fecmodi' WHERE ID=". $_POST["id_per"]);
	mysqli_query($link,"DELETE FROM declaraciones_juradas WHERE IDPersonal=". $_POST["id_per"]);
}

//SI LA INSTITUCION ES JAEC LISTO TODAS
if ($_SESSION["Institucion"]==14) {
$personal=mysqli_query($link,"SELECT * FROM instituciones WHERE vigente='1' ORDER BY Nombre");
}
if ($_SESSION["Institucion"]!=14) {
$personal=mysqli_query($link,"SELECT * FROM instituciones WHERE vigente='1' AND ID='" . $_SESSION["Institucion"]."'");
}
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
function eliminar(id)
{
	if (confirm('¿Está seguro de eliminar el registro?'))
	{
		frm.action.value="E";
		frm.id_per.value= id;		
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
<div>
  <table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="30%" height="20" align="center" bgcolor="#999999" ><strong>Institución</strong></td>
    <td width="20%" align="center" bgcolor="#999999"  ><strong>Domicilio</strong></td>
    <td width="15%" align="center" bgcolor="#999999" ><strong>Representante Legal</strong></td>
    <td width="6%" align="center" bgcolor="#999999" >&nbsp;</td>
	<td width="6%" align="center" bgcolor="#999999" >&nbsp;</td>
   </tr>
  <?php while($row =  mysqli_fetch_assoc($personal)){

					$cant++;

					if($cant % 2 == 0){ $bg = 'bgcolor="#FFFFCC"'; } else { $bg = 'bgcolor="#FFFFFF"'; }

			?>
  <tr>
    <td height="30" align="center" <?php echo $bg ?> class="tahoma11"><?php echo $row["Nombre"]?></td>
    <td align="center" <?php echo $bg ?> class="tahoma11"><?php echo $row["Domicilio"]?></td>
    <td align="center" <?php echo $bg ?> class="tahoma11"><?php echo $row["Nombre_RL"]?></td>
    <td align="center" <?php echo $bg ?> class="tahoma11"><a href="#"><img src="images/icon_edit.gif" border="0"  width="20px" height="16px" title="editar" onClick="window.open('instituciones.php?id_inst=<?php echo $row["ID"]?>','_self');"></a> </td>
   <td align="center" <?php echo $bg ?> class="tahoma11"><a href="#"><img src="images/icon_rl.jpg" border="0"  width="20px" height="16px" title="editar" onClick="window.open('instituciones_rl.php?id_inst=<?php echo $row["ID"]?>','_self');"></a> </td>
   
  </tr>
  <?php } ?>
  
  <tr>
          <td height="26" colspan="5" align="center" class="tahoma11">
            <input name="Submit2" type="button" class="btn" value="NUEVA" onClick="window.open('instituciones.php','_self');" />          </td>
        </tr>
		
  </table>
</div>
  </div>
</div>
</div>
<div class="clear"> </div>
<?php include("pie.php"); ?>
<input type="hidden" name="action" id="action">
<input type="hidden" name="id_per" id="id_per">
</form>
	
</body>
</html>
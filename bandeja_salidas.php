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

//rangos de fechas (ultimos 2 dias)
$fecha1= date('Y-m-d H:i:s',time()-(48*60*60));
$fecha2= date("Y-m-d H:i:s");

//LISTO  LAS 50 ULTIMAS SALIDAS EDUCATIVAS "INGRESADAS" 
$salidas=mysqli_query($link,"SELECT a.idsalida, a.actividad_fecha_desde, a.actividad_lugar, a.actividad_detalle, b.Nombre as NomInst, u.Nombre FROM salidas_educativas a, instituciones b, usuarios u WHERE a.vigente='1' AND a.idinstitucion= b.ID AND a.AudUsrAlta=u.Usuario ORDER BY a.AudFecAlta DESC LIMIT 50");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->
<!--SEO -->
<meta name="Keywords" content=" " />
<meta name="description" content=" " />
<title>Fondo Solidario  |  Sistema de Gesti?n</title>
<?php include("scripts.php"); ?>
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
.Estilo2 {
	color: #FF0000;

	font-weight: bold;
}
-->
</style>
</head>
<body>
<form name="frm" id="frm" method="post" action="">
<script language="javascript" src="calendar/calendar.js"></script>

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
	<img src="images/map.png" width="30" height="36" border="0"> <b>&Uacute;ltimas 50 SALIDAS EDUCATIVAS</b>
	</div>
   
    <div class="clear2"> </div>
<div>
  <table border="0" cellspacing="0" cellpadding="0"  style="width:100%">
    <tr>
      <td width="19%" height="20" align="center" ><div align="center"><strong>N&deg; Salida</strong></div></td>
      <td width="24%" align="center" ><div align="center"><strong>Instituci&oacute;n</strong></div></td>
      <td align="center" ><div align="center"><strong>Fecha</strong></div></td>
      <td width="9%" align="center" ><strong>Lugar</strong></td>
      <td align="center" ><div align="center"><strong>Usuario de alta</strong></div></td>
      <td width="9%" align="center" >&nbsp;</td>
    </tr>
    <?php while($row =  mysqli_fetch_assoc($salidas)){ ?>
    <tr>
      <td height="20" align="center" ><?php echo substr("00000".$row["idsalida"],-5)?></td>
      <td align="center" ><?php echo $row["NomInst"]?></td>
      <td align="center" ><?php echo $row["actividad_fecha_desde"]?></td>
      <td align="center" ><?php echo $row["actividad_lugar"]?> </td>
      <td align="center" ><?php echo $row["Nombre"]?> </td>
      <td align="center" ><a href="#"><img src="images/icon_edit.gif" border="0"  width="20px" height="16px" alt="editar" onClick="window.open('salidas_educat.php?id_sal=<?php echo $row["idsalida"]?>','_self');" /></a> </td>
    </tr>
    <?php } ?>
  </table>
</div>
  </div>
</div>
</div>
<div class="clear"></div>


<?php include("pie.php"); ?>
<input type="hidden" name="action" id="action">
<input type="hidden" name="id_per" id="id_per">
</form>
	
</body>
</html>
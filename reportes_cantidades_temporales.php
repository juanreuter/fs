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

// datos del post
$mensaje="";
$reporte= $_POST["cmbReporte"];
$anio= $_POST["cmbAnio"];
$mes = $_POST["cmbMes"];
$institucion = $_POST["cmbInst"];

if ($reporte == 'A') { // REPORTE DE CANTIDAD DE DENUNCIAS POR MES

$titulo = "Cantidad de Denuncias por Mes";
if ($anio != '' )  $stranio = "Year(denuncias.AudFecAlta) = $anio" ;
if ($institucion != '' )  $strinstitucion = "DE_IDInstitucion = $institucion" ;

if ($stranio != '')  $strsql_A = "AND " . $stranio;
if ($institucion != '')  $strsql_A  = $strsql_A . " AND " . $strinstitucion;

$sql_B = "SELECT Count(*) as cantidad, Month(denuncias.AudFecAlta) as mes FROM denuncias WHERE denuncias.vigente=1 ". $strsql_A . " GROUP BY Month(denuncias.AudFecAlta) ORDER BY Month(denuncias.AudFecAlta) ASC";
$_SESSION["SQL"] = $sql_B;
$sql_A = mysqli_query($link,"SELECT Count(*) as cantidad, Month(denuncias.AudFecAlta) as mes FROM denuncias WHERE denuncias.vigente=1 ". $strsql_A . " GROUP BY Month(denuncias.AudFecAlta) ORDER BY Month(denuncias.AudFecAlta) ASC");
}

if ($reporte == 'B') { // REPORTE DE CANTIDAD DE DERIVACIONES POR MES

$titulo = "Cantidad de Derivaciones por Mes";
if ($anio != '' )  $stranio = "Year(denuncias_derivaciones.AudFecAlta) = $anio" ;
if ($institucion != '' )  $strinstitucion = "DE_IDInstitucion = $institucion" ;

if ($stranio != '')  $strsql_A = "AND " . $stranio;
if ($institucion != '')  $strsql_A  = $strsql_A . " AND " . $strinstitucion;

$sql_B = "SELECT Count(*) as cantidad, Month(denuncias_derivaciones.AudFecAlta) as mes FROM denuncias, denuncias_derivaciones WHERE denuncias.ID=denuncias_derivaciones.IDDenuncia AND denuncias.vigente=1  and denuncias_derivaciones.vigente= 1 ". $strsql_A . " GROUP BY Month(denuncias_derivaciones.AudFecAlta) ORDER BY Month(denuncias_derivaciones.AudFecAlta) ASC";

$_SESSION["SQL"] = $sql_B;
$sql_A = mysqli_query($link,"SELECT Count(*) as cantidad, Month(denuncias_derivaciones.AudFecAlta) as mes FROM denuncias, denuncias_derivaciones WHERE denuncias.ID=denuncias_derivaciones.IDDenuncia AND denuncias.vigente=1  and denuncias_derivaciones.vigente= 1 ". $strsql_A . " GROUP BY Month(denuncias_derivaciones.AudFecAlta) ORDER BY Month(denuncias_derivaciones.AudFecAlta) ASC");
}


if ($reporte == 'C') { // REPORTE DE CANTIDAD DE CONTROLES DE AUSENTISMO

$titulo = "Cantidad de Controles de Ausentismo por Mes";
if ($anio != '' )  $stranio = "Year(control_ausentismo.fecha_control) = $anio" ;
if ($institucion != '' )  $strinstitucion = "idinstitucion = $institucion" ;

if ($stranio != '')  $strsql_A = "AND " . $stranio;
if ($institucion != '')  $strsql_A  = $strsql_A . " AND " . $strinstitucion;

$sql_B = "SELECT Count(*) as cantidad, Month(control_ausentismo.fecha_control) as mes FROM control_ausentismo WHERE control_ausentismo.vigente=1 ". $strsql_A . " GROUP BY Month(control_ausentismo.fecha_control) ORDER BY Month(control_ausentismo.fecha_control) ASC";
$_SESSION["SQL"] = $sql_B;
$sql_A = mysqli_query($link,"SELECT Count(*) as cantidad, Month(control_ausentismo.fecha_control) as mes FROM control_ausentismo WHERE control_ausentismo.vigente=1 ". $strsql_A . " GROUP BY Month(control_ausentismo.fecha_control) ORDER BY Month(control_ausentismo.fecha_control) ASC");
}


//tabla tipo  instituciones
$inst=mysqli_query($link,"SELECT ID, Nombre FROM instituciones  WHERE vigente='1' ORDER BY Nombre");

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
<script>
function grafico(pagina)
{
window.open(pagina,'_blank','status=0,toolbar=0,width=600,height=500')
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
	<img src="images/map.png" width="30" height="36" border="0"> <b>Reportes Estadísticos</b>
	</div>
	<div class="clear"></div>
	<div>
	<table>
	<tr>
	<td > <img src="images/uno_1.gif"></td> 
	<td>Reporte:</td>
	<td	>
	<select name="cmbReporte" id="cmbReporte" >
    <option value="A" <?php if ($reporte == "A") echo "selected"?>>Cantidad de Denuncias por Mes</option>
	<option value="B" <?php if ($reporte == "B") echo "selected"?>>Cantidad de Derivaciones por Mes</option>
	<option value="C" <?php if ($reporte == "C") echo "selected"?>>Cantidad de Controles Solicitados por Mes</option>
	</select>              
	</td>
	</tr>
	<tr>
	<td><img src="images/dos_2.gif"></td> 
	<td>Año:</td>
	<td>
	<select name="cmbAnio" id="cmbAnio" style="width:100px" >
    <option value="" selected="selected">[Todos]</option>
	<option value="2012" <?php if ($anio == "2012") echo "selected"?>>2012</option>
	<option value="2013" <?php if ($anio == "2013") echo "selected"?>>2013</option>
    <option value="2014" <?php if ($anio == "2014") echo "selected"?>>2014</option>
	<option value="2015" <?php if ($anio == "2015") echo "selected"?>>2015</option>
	<option value="2016" <?php if ($anio == "2016") echo "selected"?>>2016</option>
	<option value="2017" <?php if ($anio == "2017") echo "selected"?>>2017</option>
	<option value="2018" <?php if ($anio == "2018") echo "selected"?>>2018</option>
	<option value="2019" <?php if ($anio == "2019") echo "selected"?>>2019</option>
	<option value="2020" <?php if ($anio == "2020") echo "selected"?>>2020</option>
	<option value="2021" <?php if ($anio == "2021") echo "selected"?>>2021</option>
	<option value="2022" <?php if ($anio == "2022") echo "selected"?>>2022</option>
    </select>              

	</td>
	</tr>
<tr>
	<td><img src="images/tres_3.gif"></td> 
	<td>Institucion:</td>
	<td>
	<select name="cmbInst" id="cmbInst">
	    <option value="">[Todas]</option>
	    <?php while($row=mysqli_fetch_assoc($inst)) { ?>
	    <option value="<?php echo $row["ID"]?>" <?php if($row["ID"]==$institucion) echo "selected"?>><?php echo $row["Nombre"]?></option>
	    <?php } ?>
	    </select>	    
	  </td>
	</tr>
<tr>
	<td><img src="images/cuatro_4.gif"></td> 
	<td>Clic:</td>
	<td>
	<input name="Submit3" type="submit" value="GENERAR REPORTE"/>
	</td>
	</tr>

</table>
<table><tr><td align="center">
<?php if ($reporte == 'A') { ?>
<table cellpadding="2" cellspacing="2" style="border:groove; border-style:outset;" >
<tr><td><b>Mes</b></td><td><b>Cantidad</b></td></tr>
<?php while($row =  mysqli_fetch_assoc($sql_A)){ ?>
<?php 
switch ($row["mes"]) 
					{
    				case "1":
     			    $stract="ENERO";
        			break;
					case "2":
     			    $stract="FEBRERO";
        			break;
					case "3":
     			    $stract="MARZO";
        			break;
					case "4":
     			    $stract="ABRIL";
        			break;
					case "5":
     			    $stract="MAYO";
        			break;
					case "6":
     			    $stract="JUNIO";
        			break;
					case "7":
     			    $stract="JULIO";
        			break;
					case "8":
     			    $stract="AGOSTO";
        			break;
					case "9":
     			    $stract="SEPTIEMBRE";
        			break;
					case "10":
     			    $stract="OCTUBRE";
        			break;
					case "11":
     			    $stract="NOVIEMBRE";
        			break;
					case "12":
     			    $stract="DICIEMBRE";
        			break;
					default:
       				$stract="SIN INFORMACION";
        			}
?>
<tr><td><?php echo $stract?></td><td><?php echo $row["cantidad"]?></td></tr>
<?php } ?>
<tr><td ><img src="images/grafico_colum.jpg"></td><td><div align="left"><a href="javascript:grafico('reportes/rep_denuncias_temporal_colum.php')">Ver Grafico</a></div></td></tr>


</table>
<?php } ?>

<?php if ($reporte == 'B') { ?>
<table cellpadding="2" cellspacing="2" style="border:groove; border-style:outset;" >
<tr><td><b>Mes</b></td><td><b>Cantidad Derivaciones</b></td></tr>
<?php while($row =  mysqli_fetch_assoc($sql_A)){ ?>
<?php 
switch ($row["mes"]) 
					{
    				case "1":
     			    $stract="ENERO";
        			break;
					case "2":
     			    $stract="FEBRERO";
        			break;
					case "3":
     			    $stract="MARZO";
        			break;
					case "4":
     			    $stract="ABRIL";
        			break;
					case "5":
     			    $stract="MAYO";
        			break;
					case "6":
     			    $stract="JUNIO";
        			break;
					case "7":
     			    $stract="JULIO";
        			break;
					case "8":
     			    $stract="AGOSTO";
        			break;
					case "9":
     			    $stract="SEPTIEMBRE";
        			break;
					case "10":
     			    $stract="OCTUBRE";
        			break;
					case "11":
     			    $stract="NOVIEMBRE";
        			break;
					case "12":
     			    $stract="DICIEMBRE";
        			break;
					default:
       				$stract="SIN INFORMACION";
        			}
?>
<tr><td><?php echo $stract?></td><td><?php echo $row["cantidad"]?></td></tr>
<?php } ?>
<tr><td ><img src="images/grafico_colum.jpg"></td><td><div align="left"><a href="javascript:grafico('reportes/rep_derivaciones_temporal_colum.php')">Ver Grafico</a></div></td></tr>


</table>
<?php } ?>


<?php if ($reporte == 'C') { ?>
<table cellpadding="2" cellspacing="2" style="border:groove; border-style:outset;" >
<tr><td><b>Mes</b></td><td><b>Cantidad</b></td></tr>
<?php while($row =  mysqli_fetch_assoc($sql_A)){ ?>
<?php 
switch ($row["mes"]) 
					{
    				case "1":
     			    $stract="ENERO";
        			break;
					case "2":
     			    $stract="FEBRERO";
        			break;
					case "3":
     			    $stract="MARZO";
        			break;
					case "4":
     			    $stract="ABRIL";
        			break;
					case "5":
     			    $stract="MAYO";
        			break;
					case "6":
     			    $stract="JUNIO";
        			break;
					case "7":
     			    $stract="JULIO";
        			break;
					case "8":
     			    $stract="AGOSTO";
        			break;
					case "9":
     			    $stract="SEPTIEMBRE";
        			break;
					case "10":
     			    $stract="OCTUBRE";
        			break;
					case "11":
     			    $stract="NOVIEMBRE";
        			break;
					case "12":
     			    $stract="DICIEMBRE";
        			break;
					default:
       				$stract="SIN INFORMACION";
        			}
?>
<tr><td><?php echo $stract?></td><td><?php echo $row["cantidad"]?></td></tr>
<?php } ?>
<tr><td ><img src="images/grafico_colum.jpg"></td><td><div align="left"><a href="javascript:grafico('reportes/rep_denuncias_temporal_colum.php')">Ver Grafico</a></div></td></tr>


</table>
<?php } ?>

</table>


	  </div>
</div>

</div>
</div>
<div class="clear"></div>


<?php include("pie.php"); ?>
</form>
	
</body>
</html>
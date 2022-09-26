<<<<<<< HEAD
<<<<<<< HEAD
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

if ($reporte == 'A') { // REPORTE DE CANTIDAD DE DENUNCIAS SEGUN ACTIVIDAD

$titulo = "Top 10 de Alumnos con más Denuncias";
if ($anio != '' )  $stranio = "Year(`DA_Fecha`) = $anio" ;
if ($mes != '' )  $strmes = "Month(`DA_Fecha`) = $mes" ;
if ($institucion != '' )  $strinstitucion = "DE_IDInstitucion = $institucion" ;

if ($stranio != '')  $strsql_A = "AND " . $stranio;
if ($strmes != '') $strsql_A  = $strsql_A . " AND " . $strmes;
if ($institucion != '')  $strsql_A  = $strsql_A . " AND " . $strinstitucion;

$sql_B = "SELECT Count(*) as cantidad, acc_nombre, nombre FROM denuncias, instituciones WHERE denuncias.de_idinstitucion=instituciones.id and denuncias.vigente=1 ". $strsql_A . " GROUP BY acc_nombre, nombre ORDER BY cantidad DESC limit 0, 10";
$_SESSION["SQL"] = $sql_B;
$sql_A = mysqli_query($link,"SELECT Count(*) as cantidad, acc_nombre, nombre FROM denuncias, instituciones WHERE denuncias.de_idinstitucion=instituciones.id and denuncias.vigente=1 ". $strsql_A . " GROUP BY acc_nombre, nombre ORDER BY cantidad DESC limit 0, 10");
}

if ($reporte == 'B') { // REPORTE DE CANTIDAD DE DENUNCIAS SEGUN ACTIVIDAD

$titulo = "Top 10 de Instituciones con más Denuncias";
if ($anio != '' )  $stranio = "Year(`DA_Fecha`) = $anio" ;
if ($mes != '' )  $strmes = "Month(`DA_Fecha`) = $mes" ;
if ($institucion != '' )  $strinstitucion = "DE_IDInstitucion = $institucion" ;

if ($stranio != '')  $strsql_A = "AND " . $stranio;
if ($strmes != '') $strsql_A  = $strsql_A . " AND " . $strmes;
if ($institucion != '')  $strsql_A  = $strsql_A . " AND " . $strinstitucion;

$sql_B = "SELECT Count(*) as cantidad, nombre FROM denuncias, instituciones WHERE denuncias.de_idinstitucion=instituciones.id and denuncias.vigente=1 ". $strsql_A . " GROUP BY nombre ORDER BY cantidad DESC limit 0, 10";
$_SESSION["SQL"] = $sql_B;
$sql_A = mysqli_query($link,"SELECT Count(*) as cantidad, nombre FROM denuncias, instituciones WHERE denuncias.de_idinstitucion=instituciones.id and denuncias.vigente=1 ". $strsql_A . " GROUP BY nombre ORDER BY cantidad DESC limit 0, 10");
}


//tabla tipo  instituciones
$inst=mysqli_query($link,"SELECT ID, Nombre FROM instituciones  WHERE vigente='1' AND ID IN (SELECT DE_IDInstitucion FROM denuncias where vigente=1) ORDER BY Nombre");

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
    <option value="A" <?php if ($reporte == "A") echo "selected"?>>Top 10 de Alumnos con más Denuncias</option>
	<option value="B" <?php if ($reporte == "B") echo "selected"?>>Top 10 de Instituciones con más Denuncias</option>
	</select>              
	</td>
	</tr>
	<tr>
	<td><img src="images/dos_2.gif"></td> 
	<td>Año / Mes:</td>
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
		
	<select name="cmbMes" id="cmbMes" style="width:200px">
    <option value="" selected="selected">[Todos]</option>
	<option value="1" <?php if ($mes == "1") echo "selected"?>>Enero</option>
	<option value="2" <?php if ($mes == "2") echo "selected"?>>Febrero</option>
    <option value="3" <?php if ($mes == "3") echo "selected"?>>Marzo</option>
	<option value="4" <?php if ($mes == "4") echo "selected"?>>Abril</option>
    <option value="5" <?php if ($mes == "5") echo "selected"?>>Mayo</option>
	<option value="6" <?php if ($mes == "6") echo "selected"?>>Junio</option>
	<option value="7" <?php if ($mes == "7") echo "selected"?>>Julio</option>
	<option value="8" <?php if ($mes == "8") echo "selected"?>>Agosto</option>
	<option value="9" <?php if ($mes == "9") echo "selected"?>>Septiembre</option>
	<option value="10" <?php if ($mes == "10") echo "selected"?>>Octubre</option>
	<option value="11" <?php if ($mes == "11") echo "selected"?>>Noviembre</option>
	<option value="12" <?php if ($mes == "12") echo "selected"?>>Diciembre</option>
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
<tr><td><b>Nombre y Apellido</b></td><td><b>Institución</b></td><td><b>Cantidad</b></td></tr>
<?php while($row =  mysqli_fetch_assoc($sql_A)){ ?>
<tr><td><?php echo $row["acc_nombre"]?></td><td><?php echo $row["nombre"]?></td><td><?php echo $row["cantidad"]?></td></tr>
<?php } ?>

</table>

<?php } ?>

<?php if ($reporte == 'B') { ?>
<table cellpadding="2" cellspacing="2" style="border:groove; border-style:outset;" >
<tr><td><b>Institución</b></td><td><b>Cantidad</b></td></tr>
<?php while($row =  mysqli_fetch_assoc($sql_A)){ ?>
<tr><td><?php echo $row["nombre"]?></td><td><?php echo $row["cantidad"]?></td></tr>
<?php } ?>

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
=======
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

if ($reporte == 'A') { // REPORTE DE CANTIDAD DE DENUNCIAS SEGUN ACTIVIDAD

$titulo = "Top 10 de Alumnos con más Denuncias";
if ($anio != '' )  $stranio = "Year(`DA_Fecha`) = $anio" ;
if ($mes != '' )  $strmes = "Month(`DA_Fecha`) = $mes" ;
if ($institucion != '' )  $strinstitucion = "DE_IDInstitucion = $institucion" ;

if ($stranio != '')  $strsql_A = "AND " . $stranio;
if ($strmes != '') $strsql_A  = $strsql_A . " AND " . $strmes;
if ($institucion != '')  $strsql_A  = $strsql_A . " AND " . $strinstitucion;

$sql_B = "SELECT Count(*) as cantidad, acc_nombre, nombre FROM denuncias, instituciones WHERE denuncias.de_idinstitucion=instituciones.id and denuncias.vigente=1 ". $strsql_A . " GROUP BY acc_nombre, nombre ORDER BY cantidad DESC limit 0, 10";
$_SESSION["SQL"] = $sql_B;
$sql_A = mysqli_query($link,"SELECT Count(*) as cantidad, acc_nombre, nombre FROM denuncias, instituciones WHERE denuncias.de_idinstitucion=instituciones.id and denuncias.vigente=1 ". $strsql_A . " GROUP BY acc_nombre, nombre ORDER BY cantidad DESC limit 0, 10");
}

if ($reporte == 'B') { // REPORTE DE CANTIDAD DE DENUNCIAS SEGUN ACTIVIDAD

$titulo = "Top 10 de Instituciones con más Denuncias";
if ($anio != '' )  $stranio = "Year(`DA_Fecha`) = $anio" ;
if ($mes != '' )  $strmes = "Month(`DA_Fecha`) = $mes" ;
if ($institucion != '' )  $strinstitucion = "DE_IDInstitucion = $institucion" ;

if ($stranio != '')  $strsql_A = "AND " . $stranio;
if ($strmes != '') $strsql_A  = $strsql_A . " AND " . $strmes;
if ($institucion != '')  $strsql_A  = $strsql_A . " AND " . $strinstitucion;

$sql_B = "SELECT Count(*) as cantidad, nombre FROM denuncias, instituciones WHERE denuncias.de_idinstitucion=instituciones.id and denuncias.vigente=1 ". $strsql_A . " GROUP BY nombre ORDER BY cantidad DESC limit 0, 10";
$_SESSION["SQL"] = $sql_B;
$sql_A = mysqli_query($link,"SELECT Count(*) as cantidad, nombre FROM denuncias, instituciones WHERE denuncias.de_idinstitucion=instituciones.id and denuncias.vigente=1 ". $strsql_A . " GROUP BY nombre ORDER BY cantidad DESC limit 0, 10");
}


//tabla tipo  instituciones
$inst=mysqli_query($link,"SELECT ID, Nombre FROM instituciones  WHERE vigente='1' AND ID IN (SELECT DE_IDInstitucion FROM denuncias where vigente=1) ORDER BY Nombre");

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
    <option value="A" <?php if ($reporte == "A") echo "selected"?>>Top 10 de Alumnos con más Denuncias</option>
	<option value="B" <?php if ($reporte == "B") echo "selected"?>>Top 10 de Instituciones con más Denuncias</option>
	</select>              
	</td>
	</tr>
	<tr>
	<td><img src="images/dos_2.gif"></td> 
	<td>Año / Mes:</td>
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
		
	<select name="cmbMes" id="cmbMes" style="width:200px">
    <option value="" selected="selected">[Todos]</option>
	<option value="1" <?php if ($mes == "1") echo "selected"?>>Enero</option>
	<option value="2" <?php if ($mes == "2") echo "selected"?>>Febrero</option>
    <option value="3" <?php if ($mes == "3") echo "selected"?>>Marzo</option>
	<option value="4" <?php if ($mes == "4") echo "selected"?>>Abril</option>
    <option value="5" <?php if ($mes == "5") echo "selected"?>>Mayo</option>
	<option value="6" <?php if ($mes == "6") echo "selected"?>>Junio</option>
	<option value="7" <?php if ($mes == "7") echo "selected"?>>Julio</option>
	<option value="8" <?php if ($mes == "8") echo "selected"?>>Agosto</option>
	<option value="9" <?php if ($mes == "9") echo "selected"?>>Septiembre</option>
	<option value="10" <?php if ($mes == "10") echo "selected"?>>Octubre</option>
	<option value="11" <?php if ($mes == "11") echo "selected"?>>Noviembre</option>
	<option value="12" <?php if ($mes == "12") echo "selected"?>>Diciembre</option>
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
<tr><td><b>Nombre y Apellido</b></td><td><b>Institución</b></td><td><b>Cantidad</b></td></tr>
<?php while($row =  mysqli_fetch_assoc($sql_A)){ ?>
<tr><td><?php echo $row["acc_nombre"]?></td><td><?php echo $row["nombre"]?></td><td><?php echo $row["cantidad"]?></td></tr>
<?php } ?>

</table>

<?php } ?>

<?php if ($reporte == 'B') { ?>
<table cellpadding="2" cellspacing="2" style="border:groove; border-style:outset;" >
<tr><td><b>Institución</b></td><td><b>Cantidad</b></td></tr>
<?php while($row =  mysqli_fetch_assoc($sql_A)){ ?>
<tr><td><?php echo $row["nombre"]?></td><td><?php echo $row["cantidad"]?></td></tr>
<?php } ?>

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
>>>>>>> 64483f4e4592a7d8cfa1980d291de5bef1badd92
=======
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

if ($reporte == 'A') { // REPORTE DE CANTIDAD DE DENUNCIAS SEGUN ACTIVIDAD

$titulo = "Top 10 de Alumnos con más Denuncias";
if ($anio != '' )  $stranio = "Year(`DA_Fecha`) = $anio" ;
if ($mes != '' )  $strmes = "Month(`DA_Fecha`) = $mes" ;
if ($institucion != '' )  $strinstitucion = "DE_IDInstitucion = $institucion" ;

if ($stranio != '')  $strsql_A = "AND " . $stranio;
if ($strmes != '') $strsql_A  = $strsql_A . " AND " . $strmes;
if ($institucion != '')  $strsql_A  = $strsql_A . " AND " . $strinstitucion;

$sql_B = "SELECT Count(*) as cantidad, acc_nombre, nombre FROM denuncias, instituciones WHERE denuncias.de_idinstitucion=instituciones.id and denuncias.vigente=1 ". $strsql_A . " GROUP BY acc_nombre, nombre ORDER BY cantidad DESC limit 0, 10";
$_SESSION["SQL"] = $sql_B;
$sql_A = mysqli_query($link,"SELECT Count(*) as cantidad, acc_nombre, nombre FROM denuncias, instituciones WHERE denuncias.de_idinstitucion=instituciones.id and denuncias.vigente=1 ". $strsql_A . " GROUP BY acc_nombre, nombre ORDER BY cantidad DESC limit 0, 10");
}

if ($reporte == 'B') { // REPORTE DE CANTIDAD DE DENUNCIAS SEGUN ACTIVIDAD

$titulo = "Top 10 de Instituciones con más Denuncias";
if ($anio != '' )  $stranio = "Year(`DA_Fecha`) = $anio" ;
if ($mes != '' )  $strmes = "Month(`DA_Fecha`) = $mes" ;
if ($institucion != '' )  $strinstitucion = "DE_IDInstitucion = $institucion" ;

if ($stranio != '')  $strsql_A = "AND " . $stranio;
if ($strmes != '') $strsql_A  = $strsql_A . " AND " . $strmes;
if ($institucion != '')  $strsql_A  = $strsql_A . " AND " . $strinstitucion;

$sql_B = "SELECT Count(*) as cantidad, nombre FROM denuncias, instituciones WHERE denuncias.de_idinstitucion=instituciones.id and denuncias.vigente=1 ". $strsql_A . " GROUP BY nombre ORDER BY cantidad DESC limit 0, 10";
$_SESSION["SQL"] = $sql_B;
$sql_A = mysqli_query($link,"SELECT Count(*) as cantidad, nombre FROM denuncias, instituciones WHERE denuncias.de_idinstitucion=instituciones.id and denuncias.vigente=1 ". $strsql_A . " GROUP BY nombre ORDER BY cantidad DESC limit 0, 10");
}


//tabla tipo  instituciones
$inst=mysqli_query($link,"SELECT ID, Nombre FROM instituciones  WHERE vigente='1' AND ID IN (SELECT DE_IDInstitucion FROM denuncias where vigente=1) ORDER BY Nombre");

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
    <option value="A" <?php if ($reporte == "A") echo "selected"?>>Top 10 de Alumnos con más Denuncias</option>
	<option value="B" <?php if ($reporte == "B") echo "selected"?>>Top 10 de Instituciones con más Denuncias</option>
	</select>              
	</td>
	</tr>
	<tr>
	<td><img src="images/dos_2.gif"></td> 
	<td>Año / Mes:</td>
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
		
	<select name="cmbMes" id="cmbMes" style="width:200px">
    <option value="" selected="selected">[Todos]</option>
	<option value="1" <?php if ($mes == "1") echo "selected"?>>Enero</option>
	<option value="2" <?php if ($mes == "2") echo "selected"?>>Febrero</option>
    <option value="3" <?php if ($mes == "3") echo "selected"?>>Marzo</option>
	<option value="4" <?php if ($mes == "4") echo "selected"?>>Abril</option>
    <option value="5" <?php if ($mes == "5") echo "selected"?>>Mayo</option>
	<option value="6" <?php if ($mes == "6") echo "selected"?>>Junio</option>
	<option value="7" <?php if ($mes == "7") echo "selected"?>>Julio</option>
	<option value="8" <?php if ($mes == "8") echo "selected"?>>Agosto</option>
	<option value="9" <?php if ($mes == "9") echo "selected"?>>Septiembre</option>
	<option value="10" <?php if ($mes == "10") echo "selected"?>>Octubre</option>
	<option value="11" <?php if ($mes == "11") echo "selected"?>>Noviembre</option>
	<option value="12" <?php if ($mes == "12") echo "selected"?>>Diciembre</option>
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
<tr><td><b>Nombre y Apellido</b></td><td><b>Institución</b></td><td><b>Cantidad</b></td></tr>
<?php while($row =  mysqli_fetch_assoc($sql_A)){ ?>
<tr><td><?php echo $row["acc_nombre"]?></td><td><?php echo $row["nombre"]?></td><td><?php echo $row["cantidad"]?></td></tr>
<?php } ?>

</table>

<?php } ?>

<?php if ($reporte == 'B') { ?>
<table cellpadding="2" cellspacing="2" style="border:groove; border-style:outset;" >
<tr><td><b>Institución</b></td><td><b>Cantidad</b></td></tr>
<?php while($row =  mysqli_fetch_assoc($sql_A)){ ?>
<tr><td><?php echo $row["nombre"]?></td><td><?php echo $row["cantidad"]?></td></tr>
<?php } ?>

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
>>>>>>> 64483f4e4592a7d8cfa1980d291de5bef1badd92
</html>
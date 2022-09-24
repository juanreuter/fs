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

$id_usu=$_REQUEST["id_usu"];

$subsistemas = mysqli_query($link,"SELECT * FROM subsistemas WHERE Tipo='WEBSITE'  ORDER BY Orden");
// GUARDAR DELETE and INSERT
if($_POST["action"] == "G")
{
	mysqli_query($link,"DELETE FROM usuarios_subsistemas WHERE IDUsuario=$id_usu");
	while($row=mysqli_fetch_assoc($subsistemas))
	{
	$check = "rS".$row['ID'];
	$sub_usu=$_POST["$check"];
	if ($sub_usu != '') mysqli_query($link,"INSERT INTO usuarios_subsistemas (IDUsuario, IDSubsistema) VALUES ($id_usu, '$sub_usu')");
	}
}

// CONSULTA PARA CHEQUEAR LOS SUBSISTEMAS DEL USUARIO
if($id_usu != "")
{
$sql = mysqli_query($link,"SELECT * FROM usuarios_subsistemas WHERE IDUsuario=$id_usu");
}

$subsistemas = mysqli_query($link,"SELECT * FROM subsistemas WHERE Tipo='WEBSITE'  ORDER BY seccion, Orden");

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
	<img src="images/map.png" width="30" height="36" border="0"> <b>Usuarios - Subsistemas Asignados </b>
	</div>
    <div class="clear2"> </div>
    <div >
      <table width="95%" border="0" cellspacing="0" cellpadding="0">
        <tr>
         <td align="center" >&nbsp;</td>

		  <td align="center" >&nbsp;</td>
          <td align="center" >&nbsp;</td>
        </tr>
       <?php while ($row=mysqli_fetch_assoc($subsistemas)) 
		{ 
		//$sub_usu=$_POST["$check"]; 
		?>

        <tr> 

          <td width="43" height="20" align="right" valign="middle">
		  <input type="checkbox" name="rS<?php echo $row["ID"]?>" value="<?php echo $row["ID"]?>" 
		  <?php
		  $strchk="";
		  $sql = mysqli_query($link,"SELECT * FROM usuarios_subsistemas WHERE IDUsuario=$id_usu AND IDSubsistema=".$row["ID"]."");
 		  if (mysqli_num_rows($sql) > 0) $strchk="checked"; 
		  ?>
		  <?php echo $strchk; ?> />
		  </td>

          <td width="499" height="20" align="right" valign="middle"><div align="left">&nbsp;&nbsp;<b><?php echo $row["seccion"]?></b> - <?php echo $row["Nombre"]?> </div></td>

          <td width="78">&nbsp;</td>

        </tr>

        <?php }?>
 <tr>

          <td height="20" align="right" valign="middle"><div align="left"></div></td>

          <td height="20" align="right" valign="middle"><div align="center">

            <input name="Submit" type="button" class="btn" value="GUARDAR" onClick="frm.action.value='G';frm.submit();">

          </div></td>

          <td>&nbsp;</td>

        </tr>
	
      </table>
    </div>
  </div>
</div>
</div>
<div class="clear"> </div>
<?php include("pie.php"); ?>

          <input type="hidden" name="action" id="action">
		  <input name="id_usu" type="hidden" id="id_usu" value="<?php echo $id_usu?>">
       	  <input name="id_sub" type="hidden" id="id_sub" value="<?php echo $id?>">

</form>
	
</body>
</html>
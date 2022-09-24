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
$denuncias=mysqli_query($link,"SELECT denuncias_docentes.ID as IDDenuncia, ACC_Nombre, ACC_Junta, ACC_JuntaHora, ACC_Telefono, Nombre as NomInst, DE_DiagnosticoPres, Descripcion as Especialidad FROM denuncias_docentes , instituciones, especialidades WHERE ACC_Junta <> '0000-00-00' AND ACC_Junta >= curdate() AND denuncias_docentes.DE_IDInstitucion = instituciones.ID  AND especialidades.IDEspecialidad= denuncias_docentes.ACC_IDEspecialidad AND denuncias_docentes.vigente=1 ORDER BY Acc_Junta ASC");

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
.Estilo1 {color: #FFFFFF}
.modalDialog {
	position: fixed;
	font-family: Arial, Helvetica, sans-serif;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
	background: rgba(0,0,0,0.8);
	z-index: 99999;
	opacity:0;
	-webkit-transition: opacity 400ms ease-in;
	-moz-transition: opacity 400ms ease-in;
	transition: opacity 400ms ease-in;
	pointer-events: none;
}
.modalDialog:target {
	opacity:1;
	pointer-events: auto;
}

.modalDialog > div {
	width: 400px;
	position: relative;
	margin: 10% auto;
	padding: 5px 20px 13px 20px;
	border-radius: 10px;
	background: #fff;
	background: -moz-linear-gradient(#fff, #999);
	background: -webkit-linear-gradient(#fff, #999);
	background: -o-linear-gradient(#fff, #999);
}
.close {
	background: #606061;
	color: #FFFFFF;
	line-height: 25px;
	position: absolute;
	right: -12px;
	text-align: center;
	top: -10px;
	width: 24px;
	text-decoration: none;
	font-weight: bold;
	-webkit-border-radius: 12px;
	-moz-border-radius: 12px;
	border-radius: 12px;
	-moz-box-shadow: 1px 1px 3px #000;
	-webkit-box-shadow: 1px 1px 3px #000;
	box-shadow: 1px 1px 3px #000;
}

.close:hover { background: #00d9ff; }

</style>
</head>
<body>
<form name="frm" id="frm" method="post" action="">
<script language="javascript" src="calendar/calendar.js"></script>
<script>
function calendario()
{
window.open('agenda/agenda-junta.php')
}
</script>
  <script>
  $(function() {
    $( document ).tooltip({
      position: {
        my: "center bottom-20",
        at: "center top",
        using: function( position, feedback ) {
          $( this ).css( position );
          $( "<div>" )
            .addClass( "arrow" )
            .addClass( feedback.vertical )
            .addClass( feedback.horizontal )
            .appendTo( this );
        }
      }
    });
  });
  </script>
<style>
  .ui-tooltip, .arrow:after {
    background: black;
    border: 2px solid white;
  }
  .ui-tooltip {
    padding: 10px 20px;
    color: white;
    border-radius: 20px;
    font: bold 14px "Helvetica Neue", Sans-Serif;
    text-transform: uppercase;
    box-shadow: 0 0 7px black;
  }
  .arrow {
    width: 70px;
    height: 16px;
    overflow: hidden;
    position: absolute;
    left: 50%;
    margin-left: -35px;
    bottom: -16px;
  }
  .arrow.top {
    top: -16px;
    bottom: auto;
  }
  .arrow.left {
    left: 20%;
  }
  .arrow:after {
    content: "";
    position: absolute;
    left: 20px;
    top: -20px;
    width: 25px;
    height: 25px;
    box-shadow: 6px 5px 9px -9px black;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
  }
  .arrow.top:after {
    bottom: -20px;
    top: auto;
  }
  </style>
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
	<img src="images/map.png" width="30" height="36" border="0"> <b>Calendarización de Juntas Médicas Pendientes</b> (<a href="listar_denuncias_docentes_juntas_ant.php" target="_self">ver anteriores</a>)
	</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    
	<td width="20%" align="center" ><div align="center"><strong>Denuncia</strong></div></td>
	<td width="20%" align="center" ><div align="center"><strong>Nombre</strong></div></td>
    <td width="15%" align="center" ><div align="center"><strong>Fecha y Hora</strong></div></td>
	<td width="20%" align="center" ><div align="center"><strong>Especialidad</strong></div></td>
    <td width="25%" align="center" ><div align="center"><strong>Institución</strong></div></td>
    <td width="10%" align="center" ><div align="center"><strong>Ver diagnóstico</strong></div></td>
  </tr>
  <?php while($row =  mysqli_fetch_assoc($denuncias)){

					$cant++;

					if($cant % 2 == 0){ $bg = 'bgcolor="#FFFFCC"'; } else { $bg = 'bgcolor="#FFFFFF"'; }

			?>
  <tr>
    <td align="center"  ><a href="denuncias_docentes.php?id_den=<?php echo $row["IDDenuncia"]?>"><?php echo substr("00000".$row["IDDenuncia"],-5)?></a></td>
	<td align="center" ><?php echo $row["ACC_Nombre"]?></td>
    <td align="center" ><?php echo $row["ACC_Junta"]?>  <?php if ($row["ACC_JuntaHora"] <> '00:00:00') echo $row["ACC_JuntaHora"]; ?></td>
    <td align="center" ><?php echo $row["Especialidad"]?></td>
	<td align="center" ><?php echo $row["NomInst"]?></td>
    <td align="center" ><a href="#"> <img src="images/comentario.png" title="<?php echo $row["DE_DiagnosticoPres"]; ?>" border="0" width="20" height="25" /></a></td>
  </tr>
  <?php } ?>
  <tr>
    <td height="40" colspan="6" align="center" class="tahoma11"><input name="Submit3" type="button" value="VER CALENDARIO" onClick="calendario();"  /></td>
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
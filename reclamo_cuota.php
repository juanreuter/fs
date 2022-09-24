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
$mensaje="Complete el motivo del Reclamo y haga clic en Enviar";

//datos para dar de alta la orden de derivacion
$rec_motivo= $_POST["txtmotivo"];
$str_id = $_REQUEST["id_rec"]; 
$str_tipo = $_REQUEST["id_tipo"]; 
if ($str_tipo=='ccu') $tipo='Cuota Pactada Fondo Solidario';
if ($str_tipo=='cde') $tipo='Devolución Préstamos';
if ($str_tipo=='cac') $tipo='A Cuenta';
if ($str_tipo=='cap') $tipo='Aporte a la Junta';
if ($str_tipo=='cso') $tipo='Aporte Salud Ocupacional';
if ($str_tipo=='cae') $tipo='Aporte Ayuda Escolar';


/************************************************************************************************************************
ACCIONES
************************************************************************************************************************/
if($_POST["action"] == "G")
{
	// ************* envio por mail datos de la nueva denuncia

		//$destinatario = "cobranzas@jaeccba.org.ar";
		$destinatario = "lorena.abatidaga@gmail.com"; 
		$asunto = "Reclamo - Recibo"; 
		$correo_alta_persona = $_SESSION["Nombre_Usuario"];
		$correo_alta_fecha = date("Y-m-d H:i:s");
		$correo_id_denuncia = date("Y-m-d H:i:s");
	

		// selecciono el nombre de la Institucion

		$nombre_institucion = mysqli_fetch_assoc(mysqli_query($link,"SELECT Nombre, Telefono FROM instituciones WHERE ID='" . $_SESSION["Institucion"]."'"));

		$correo_institucion = $nombre_institucion["Nombre"];
		$correo_telefono = $nombre_institucion["Telefono"];

		$cuerpo = 'Nº Recibo: '.$str_id.  '<br> Usuario_Alta: '.$correo_alta_persona.  '<br> Fecha_Alta: '.$correo_alta_fecha.  '<br> Institución: '.$correo_institucion.  '<br> Teléfono Institución: '.$correo_telefono.  '<br> Motivo Reclamo: '.$rec_motivo ; 


		//para el envío en formato HTML 
		$headers = "MIME-Version: 1.0\r\n"; 
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
	

		//dirección del remitente 

		$headers .= "From: sistemas@jaeccba.org.ar\r\n";

		//direcciones que recibirán copia oculta 
		mail($destinatario,$asunto,$cuerpo,$headers);

		// **************** fin envio de datos por correo

		$mensaje = 	"Reclamo Enviado. Pronto nos contactaremos con Ud.";


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




<div class="row" id="Cont">
<div class="small-12 large-12 columns">
  <div class="small-12 large-8 columns ">
  <div class="small-12 large-12 columns  menutitulo"> 
	<img src="images/map.png" width="30" height="36" border="0"> <b>Reclamo para el Recibo N° <?php echo $str_id ?></b>	</div>
    
	
    <div >
    
  
	 <table width="100%" >

 

                  <td width="16%" align="right" >Tipo:</td>

                  <td width="52%" align="left" ><?php echo $tipo?></td>

                  <td width="7%" align="right" >&nbsp;</td>

                  <td width="25%" align="left" >&nbsp;</td>
                </tr>

                <tr>

                  <td height="26" align="right" class="tahoma11">&nbsp;</td>

                  <td colspan="3" align="left" class="tahoma11">Motivo del Reclamo :<br>
                  
                  <textarea name="txtmotivo" cols="50" rows="7" class="tahoma12" id="txtmotivo" style="width:350px "><?php echo $rec_motivo?></textarea>                  </td>
                </tr>

                <tr>

                  <td height="26" colspan="4" align="center" class="tahoma12"><font color="red"><?php echo $mensaje ?></font></td>
                </tr>

                <tr>

                  <td height="26" colspan="4" align="center" class="tahoma11">&nbsp;&nbsp;<input name="Submit3" type="button" class="btn" value="ENVIAR RECLAMO" onClick="frm.action.value='G'; frm.submit();" />

&nbsp;
&nbsp;              

        		<input type="hidden" name="action" id="action">

				<input name="id_rec" type="hidden" id="id_rec" value="<?php echo $str_id?>">    </td>
                </tr>
	</table>
	
           		  
    </div>
  </div>
</div>
</div>
<div class="clear"> </div>
<?php include("pie.php"); ?>

</form>
	
</body>
</html>
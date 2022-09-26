<<<<<<< HEAD
<<<<<<< HEAD
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

// regla de negocios
$mensaje="Complete los datos";
$idtiposalida = $_POST["cmbSalida"];
$de_institucion = $_POST["cmbDEInst"];
$actividad_lugar = $_POST["txtActividadLugar"];
$actividad_detalle = $_POST["txtActividadDetalle"];
$actividad_fecha_desde = $_POST["txtActividadFechaDesde"];
$actividad_fecha_hasta = $_POST["txtActividadFechaHasta"];
if ($actividad_fecha_hasta =="")
{
$actividad_fecha_hasta = $actividad_fecha_desde; 
}

$actividad_destinatarios = $_POST["txtActividadDestinatarios"];
$actividad_alumnos = $_POST["txtActividadAlumnos"];
$responsable_nombre = $_POST["txtResponsableNombre"];
$responsable_dni = $_POST["txtResponsableDNI"];
$responsable_cargo = $_POST["txtResponsableCargo"];
$responsable_contacto = $_POST["txtResponsableContacto"];
$docentes = $_POST["txtDocentes"];
$responsable_otro = $_POST["txtOtrosResponsables"];


$transporte_empresa = $_POST["txtTransporteEmpresa"];
$transporte_responsables = $_POST["txtTransporteResponsables"];
$transporte_vehiculo = $_POST["txtTransporteVehiculo"];
$transporte_autorizacion = $_POST["txtTransporteAutorizacion"];
$transporte_seguro = $_POST["txtTransporteSeguro"];
$seguro_poliza = $_POST["txtSeguroPoliza"];


$id=$_REQUEST["id_sal"];

/************************************************************************************************************************
ACCIONES
************************************************************************************************************************/

if($_POST["action"] == "G" && $id!="")
{
	if($de_institucion!="" && $actividad_detalle!="" && $actividad_lugar!="" && $actividad_fecha_desde!="")
	{
	
		mysqli_query($link,"UPDATE salidas_educativas SET
		                idtiposalida= $idtiposalida,
						idinstitucion = $de_institucion,
						actividad_fecha_desde = '$actividad_fecha_desde',
						actividad_fecha_hasta = '$actividad_fecha_hasta',
						actividad_lugar = '$actividad_lugar',
						actividad_detalle = '$actividad_detalle',
						actividad_destinatario = '$actividad_destinatarios',
						actividad_alumnos = '$actividad_alumnos',
						responsable_nombre = '$responsable_nombre',
						responsable_dni = '$responsable_dni',
						responsable_cargo = '$responsable_cargo',
						responsable_contacto = '$responsable_contacto',
						docentesotros1 = '$docentes',
						responsablesotros1 = '$responsable_otro',
						transporte_empresa = '$transporte_empresa',
						transporte_vehiculo = '$transporte_vehiculo',
						transporte_responsables = '$transporte_responsables',
						transporte_autorizacion = '$transporte_autorizacion',
						transporte_seguro= '$transporte_seguro',
						seguro_poliza = '$seguro_poliza',
						vigente='1',
						AudFecModi = '$fecmodi',
						AudUsrModi = '$usrmodi'
						WHERE idsalida = $id");
						
					?>
					<script>
					window.alert("EL FORMULARIO HA SIDO ACTUALIZADO CORRECTAMENTE!");
					window.open('salidas_educat.php?id_sal=<?php echo $id?>','_self');
				
					</script>
					<?php
					}
					else
					{
					?>
					<script>
					window.alert("DEBE COMPLETAR TODOS LOS DATOS!");
					</script>
					<?php
					}
	}

if($_POST["action"] == "G" && $id=="")
{
	if($de_institucion!="" && $actividad_detalle!="" && $actividad_lugar!="" && $actividad_fecha_desde!="")
	{
		 mysqli_query($link,"INSERT INTO salidas_educativas (idtiposalida, idinstitucion, actividad_fecha_desde, actividad_fecha_hasta,  actividad_lugar, actividad_detalle, actividad_destinatario, actividad_alumnos, responsable_nombre, responsable_dni,  responsable_cargo, responsable_contacto, docentesotros1, responsablesotros1, transporte_empresa, transporte_vehiculo, transporte_responsables, transporte_autorizacion, transporte_seguro, seguro_poliza, vigente,  AudFecAlta, AudUsrAlta ,actividad_grupo,responsable_domicilio,AudFecModi,AudUsrModi) VALUES ($idtiposalida, $de_institucion, '$actividad_fecha_desde', '$actividad_fecha_hasta', '$actividad_lugar', '$actividad_detalle', '$actividad_destinatarios', '$actividad_alumnos', '$responsable_nombre', '$responsable_dni', '$responsable_cargo', '$responsable_contacto','$docentes', '$responsable_otro', '$transporte_empresa', '$transporte_vehiculo', '$transporte_responsables', '$transporte_autorizacion', '$transporte_seguro', '$seguro_poliza', '1', '$fecalta', '$usralta','','',now(),'')");
			$id = mysqli_insert_id($link);
	 
		// ************* envio por mail datos de la salida educativa

		//$destinatario = "nasifiruela@arnet.com.ar";
		$destinatario = "lorena.abatiidaga@gmail.com"; 
		$asunto = "Sistema de Gesti�n - Salidas Educativas"; 
		$correo_alta_persona = $_SESSION["Nombre_Usuario"];
		$correo_alta_fecha = date("Y-m-d H:i:s");
		$correo_id_denuncia = date("Y-m-d H:i:s");
	

		// selecciono el nombre de la Institucion

		$nombre_institucion = mysqli_fetch_assoc(mysqli_query($link,"SELECT Nombre, Telefono FROM instituciones WHERE ID='" . $_SESSION["Institucion"]."'"));
		$correo_institucion = $nombre_institucion["Nombre"];
		$correo_telefono = $nombre_institucion["Telefono"];

		// selecciono el tipo de salida
		$nombre_salida = mysqli_fetch_assoc(mysqli_query($link,"SELECT descripcion FROM salidas_tipos WHERE idsalidatipo='" . $idtiposalida."'"));
		$correo_salida= $nombre_salida["descripcion"];
		
		
		$cuerpo = 'N� Salida: '.$id.  '<br> Usuario_Alta: '.$correo_alta_persona.  '<br> Fecha_Alta: '.$correo_alta_fecha. '<br> Tipo de Salida: '.$correo_salida. '<br> Instituci�n: '.$correo_institucion.  '<br>   Fecha de la Actividad: '.$actividad_fecha_desde.  '<br> Lugar: '.$actividad_lugar.  '<br> Detalle: '.$actividad_detalle.  '<br> Responsable: '.$responsable_nombre.  '<br> Contacto: '.$responsable_contacto.  '<br> Transporte: '.$transporte_empresa.  '<br>'; 


		//para el env�o en formato HTML 
		$headers = "MIME-Version: 1.0\r\n"; 
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
	

		//direcci�n del remitente 

		$headers .= "From: salidas@jaeccba.org.ar\r\n";

		//direcciones que recibir�n copia oculta 
		//$headers .= "Bcc: lorena.abatidaga@gmail.com\r\n"; 
		mail($destinatario,$asunto,$cuerpo,$headers);

		// **************** fin envio de datos por correo

			?>
					<script>
					window.alert("EL FORMULARIO HA SIDO REGISTRADO CORRECTAMENTE!");
					window.open('salidas_educat.php?id_sal=<?php echo $id?>','_self');
					</script>
					<?php
	}

	else

	{

		?>
					<script>
					window.alert("DEBE COMPLETAR TODOS LOS DATOS!");
					</script>
					<?php

	}

}

if($id != "")
{
$sql = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM salidas_educativas WHERE vigente='1' AND idsalida=$id"));
$idtiposalida = $sql["idtiposalida"];
$de_institucion = $sql["idinstitucion"];
$actividad_detalle = $sql["actividad_detalle"];
$actividad_lugar = $sql["actividad_lugar"];
$actividad_fecha_desde = $sql["actividad_fecha_desde"];
$actividad_fecha_hasta = $sql["actividad_fecha_hasta"];
$actividad_destinatarios = $sql["actividad_destinatario"];
$actividad_alumnos = $sql["actividad_alumnos"];

$responsable_nombre = $sql["responsable_nombre"];
$responsable_dni = $sql["responsable_dni"];
$responsable_cargo = $sql["responsable_cargo"];
$responsable_contacto = $sql["responsable_contacto"];
$docentes = $sql["docentesotros1"];
$responsable_otro = $sql["responsablesotros1"];

$transporte_empresa = $sql["transporte_empresa"];
$transporte_vehiculo = $sql["transporte_vehiculo"];
$transporte_responsables = $sql["transporte_responsables"];
$transporte_autorizacion = $sql["transporte_autorizacion"];
$transporte_seguro = $sql["transporte_seguro"];
$seguro_poliza = $sql["seguro_poliza"];


$id=$sql["idsalida"];
}

//tabla tipo  instituciones
$de_inst=mysqli_query($link,"SELECT * FROM instituciones  WHERE vigente='1' ORDER BY nombre");
$de_inst_id=mysqli_query($link,"SELECT * FROM instituciones  WHERE vigente='1' AND ID='" .$_SESSION["Institucion"]. "' ORDER BY nombre");
$de_tiposalida=mysqli_query($link,"SELECT * FROM salidas_tipos ORDER BY idsalidatipo");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->
<!--SEO -->
<meta name="Keywords" content=" " />
<meta name="description" content=" " />
<title>Fondo Solidario  |  Sistema de Gesti�n</title>
<?php include("scripts.php"); ?>
 <style type="text/css">
        #main { margin: 0px auto; border:solid 1px #b2b3b5; -moz-border-radius:10px; padding:20px; background-color:#f6f6f6;}
        #header { text-align:center; border-bottom:solid 1px #b2b3b5; margin: 0 0 20px 0; }
        fieldset { border:none; width:320px;}
        legend { font-size:18px; margin:0px; padding:10px 0px; color:#b0232a; font-weight:bold;}
        label { display:block; margin:15px 0 5px;}
        input[type=text], input[type=password] { width:600px; padding:5px; border:solid 1px #000;}
        .prev, .next { background-color:#b0232a; padding:5px 10px; color:#fff; text-decoration:none;}
        .save { background-color:#gg232a; padding:15px 15px; text-align:center; font-size:16px; color:#000; text-decoration:none;}
        .prev:hover, .next:hover { background-color:#000; text-decoration:none;}
        .prev { float:left;}
        .next { float:right;}
        #steps { list-style:none; width:100%; overflow:hidden; margin:0px; padding:0px;}
        #steps li {font-size:24px; float:left; padding:20px; color:#b0b1b3;}
        #steps li span {font-size:15px; display:block;}
        #steps li.current { color:#000;}
        #makeWizard { background-color:#b0232a; color:#fff; padding:5px 10px; text-decoration:none; font-size:18px;}
        #makeWizard:hover { background-color:#000;}
    </style>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/formToWizard.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#SignupForm").formToWizard({ submitButton: 'SaveAccount' })
        });
    </script>
</head>
<body>
<script language="javascript">

function guardar()
{
	if (SignupForm.txtActividadDetalle.value == "" && SignupForm.txtActividadLugar.value == "" && SignupForm.txtActividadFechaDesde.value == "" )
	{
	window.alert("DETALLE, LUGAR y FECHA de la ACTIVIDAD son datos obligatorios!")
	SignupForm.txtActividadDetalle.focus();
	}	
	else
	{
		SignupForm.action.value='G';
		SignupForm.submit();
	}	 
}


</script>
<script language="javascript" src="calendar/calendar.js"></script>
<div id="Cabecera">
  <?php include("top.php"); ?>
</div>
<div id="Menin">
  <div class="row">
    <?php include("menu.php"); ?>
    <div class="clear"> </div>
    <div class="large-12 columns " >
 
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
	<img src="images/map.png" width="30" height="36" border="0"> <b>Salidas  - Alta y Modificaci�n</b>	</div>
    
	<div class="clear2"> </div>
    <div >
		<form id="SignupForm" name="SignupForm" method="post">
	    <!-- DATOS DE LA ACTIVIDAD -->
        <fieldset>
          <legend>Actividad</legend>
		  <label for="Institucion">Tipo de Salida</label>
	      <select name="cmbSalida" id="cmbSalida">
	      <?php while($row1=mysqli_fetch_assoc($de_tiposalida)) { ?>
	      <option value="<?php echo $row1["idsalidatipo"]?>" <?php if($row1["idsalidatipo"]==$idtiposalida) echo "selected"?>><?php echo $row1["descripcion"]?></option>
	      <?php } ?>
	      </select>
		  <!-- SI LA INSTITUCION ES JAEC LISTO  TODAS LAS INSTITUCIONES -->
		  <?php if ($_SESSION["Institucion"]==14) {?>
	      <label for="Institucion">Instituci�n</label>
	      <select name="cmbDEInst" id="cmbDEInst">
	      <?php while($row=mysqli_fetch_assoc($de_inst)) { ?>
	      <option value="<?php echo $row["ID"]?>" <?php if($row["ID"]==$de_institucion) echo "selected"?>><?php echo $row["Nombre"]?></option>
	      <?php } ?>
	      </select>	    
		  <?php } ?>
          <!-- SI LA INSTITUCION NO ES JAEC LISTO  SOLO LA INSTITUCION DEL USUARIO-->
          <?php if ($_SESSION["Institucion"]!=14) {?>
     	  <label for="Institucion">Instituci�n</label>
		  <select name="cmbDEInst" id="cmbDEInst">
		  <?php while($row=mysqli_fetch_assoc($de_inst_id)) { ?>
		  <option value="<?php echo $row["ID"]?>" <?php if($row["ID"]==$de_institucion) echo "selected"?>><?php echo $row["Nombre"]?></option>
		  <?php } ?>
		  </select>
	 	 <?php } ?>
	 	 <label for="ActividadLugar">Lugar</label>
         <input id="txtActividadLugar" name="txtActividadLugar" type="text" value="<?php echo $actividad_lugar?>"/>
         <label for="ActividadDetalle">Descripci�n</label>
         <textarea name="txtActividadDetalle" id="txtActividadDetalle" ><?php echo $actividad_detalle ?></textarea>
		 <label for="ActividadFechaDesde">Fecha Desde</label>
         <?php require_once('calendar/classes/tc_calendar.php'); ?>
         <?php 
		$myCalendar = new tc_calendar("txtActividadFechaDesde", true, false);
		$myCalendar->setIcon("calendar/images/iconCalendar.gif");
		if ($actividad_fecha_desde!='')
		{
		$myCalendar->setDateYMD($actividad_fecha_desde);
		}
		else
		{
		$myCalendar->setDate(date('d'), date('m'), date('Y'));
		}
		$myCalendar->setPath("calendar/");
		$myCalendar->setYearInterval(2015, 2022);
		$myCalendar->dateAllow('2015-01-01', '2022-12-31');
		$myCalendar->setDateFormat('j F Y');
		$myCalendar->setAlignment('left', 'bottom');
		$myCalendar->writeScript();
		?>
		<br />
		<label for="ActividadFechaHasta">Fecha Hasta</label>
         <?php require_once('calendar/classes/tc_calendar.php'); ?>
         <?php 
		$myCalendar = new tc_calendar("txtActividadFechaHasta", true, false);
		$myCalendar->setIcon("calendar/images/iconCalendar.gif");
		if ($actividad_fecha_hasta!='')
		{
		$myCalendar->setDateYMD($actividad_fecha_hasta);
		}
		else
		{
		$myCalendar->setDate(date('d'), date('m'), date('Y'));
		}
		$myCalendar->setPath("calendar/");
		$myCalendar->setYearInterval(2015, 2022);
		$myCalendar->dateAllow('2015-01-01', '2022-12-31');
		$myCalendar->setDateFormat('j F Y');
		$myCalendar->setAlignment('left', 'bottom');
		$myCalendar->writeScript();
		?>
	    </fieldset>
		
		
		<!-- DATOS DE DESTINATARIOS Y RESPONSABLES  -->
        <fieldset>
            <legend>Destinatarios y Responsables</legend>
            <label for="ActividadDestinatarios">Destinatarios</label>
            <input id="txtActividadDestinatarios" name="txtActividadDestinatarios" type="text" value="<?php echo $actividad_destinatarios?>" />
            <label for="ActividadAlumnos">Cantidad de Alumnos</label>
            <input id="txtActividadAlumnos" name="txtActividadAlumnos" type="text" value="<?php echo $actividad_alumnos?>" />
			<label for="ResponsableNombre">Nombre del Responsable</label>
			<input id="txtResponsableNombre" name="txtResponsableNombre" type="text" value="<?php echo $responsable_nombre?>" />
			<label for="ResponsableDNI">DNI</label>
			<input id="txtResponsableDNI" name="txtResponsableDNI" type="text" value="<?php echo $responsable_dni?>" />
			<label for="ResponsableCargo">Cargo o Funci�n del Responsable</label>
			<input id="txtResponsableCargo" name="txtResponsableCargo" type="text" value="<?php echo $responsable_cargo?>" />
			<label for="ResponsableContacto">Contacto con el Responsable</label>
			<input id="txtResponsableContacto" name="txtResponsableContacto" type="text" value="<?php echo $responsable_contacto?>" />
			<label for="Docentes">Otros Docentes</label>
			<textarea name="txtDocentes" id="txtDocentes" ><?php echo $docentes ?></textarea>
			<label for="OtrosResponsables">Otros Responsables</label>
			<textarea name="txtOtrosResponsables" id="txtOtrosResponsables" ><?php echo $responsable_otros ?></textarea>
			
			
			
        </fieldset>



        <fieldset>
            <legend>Transporte y Autorizaci�n</legend>
            <label for="TransporteEmpresa">Empresa de Transporte</label>
            <input id="txtTransporteEmpresa" name="txtTransporteEmpresa" type="text" value="<?php echo $transporte_empresa?>" />
            <label for="TransporteResponsables">Responsables del Veh�culo</label>
            <input id="txtTransporteResponsables" name="txtTransporteResponsables" type="text" value="<?php echo $transporte_responsables?>" />
		    <label for="TransporteVehiculo">Veh�culo del Transporte</label>
			<input id="txtTransporteVehiculo" name="txtTransporteVehiculo" type="text" value="<?php echo $transporte_vehiculo?>" />
            <label for="TransporteAutorizacion">Autorizaci�n</label>
            <input id="txtTransporteAutorizacion" name="txtTransporteAutorizacion" type="text" value="<?php echo $transporte_autorizacion?>" />
            <label for="TransporteSeguro">Seguro y Registro</label>
            <input id="txtTransporteSeguro" name="txtTransporteSeguro" type="text" value="<?php echo $transporte_seguro?>" />
            <label for="SeguroPoliza">Responsabilidad Civil. N� de P�liza</label>
            <input id="txtSeguroPoliza" name="txtSeguroPoliza" type="text" value="<?php echo $seguro_poliza?>" />
        </fieldset>
		<br><br>
		<p align="center">  
		<input name="SaveAccount" id="SaveAccount" type="button" value="GUARDAR" onClick="guardar();" class="save"  />
		<!--<input id="SaveAccount" type="submit" value="Submit form" class="save" />-->
        </p>
      	<input type="hidden" name="action" id="action">
		<input name="id_sal" type="hidden" id="id_sal" value="<?php echo $id?>">

	   </form>
     
      <div class="clear2"> </div>
    </div>
  </div>
</div>
</div>
<div class="clear"> </div>
<?php include("pie.php"); ?>
</body>
=======
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

// regla de negocios
$mensaje="Complete los datos";
$idtiposalida = $_POST["cmbSalida"];
$de_institucion = $_POST["cmbDEInst"];
$actividad_lugar = $_POST["txtActividadLugar"];
$actividad_detalle = $_POST["txtActividadDetalle"];
$actividad_fecha_desde = $_POST["txtActividadFechaDesde"];
$actividad_fecha_hasta = $_POST["txtActividadFechaHasta"];
if ($actividad_fecha_hasta =="")
{
$actividad_fecha_hasta = $actividad_fecha_desde; 
}

$actividad_destinatarios = $_POST["txtActividadDestinatarios"];
$actividad_alumnos = $_POST["txtActividadAlumnos"];
$responsable_nombre = $_POST["txtResponsableNombre"];
$responsable_dni = $_POST["txtResponsableDNI"];
$responsable_cargo = $_POST["txtResponsableCargo"];
$responsable_contacto = $_POST["txtResponsableContacto"];
$docentes = $_POST["txtDocentes"];
$responsable_otro = $_POST["txtOtrosResponsables"];


$transporte_empresa = $_POST["txtTransporteEmpresa"];
$transporte_responsables = $_POST["txtTransporteResponsables"];
$transporte_vehiculo = $_POST["txtTransporteVehiculo"];
$transporte_autorizacion = $_POST["txtTransporteAutorizacion"];
$transporte_seguro = $_POST["txtTransporteSeguro"];
$seguro_poliza = $_POST["txtSeguroPoliza"];


$id=$_REQUEST["id_sal"];

/************************************************************************************************************************
ACCIONES
************************************************************************************************************************/

if($_POST["action"] == "G" && $id!="")
{
	if($de_institucion!="" && $actividad_detalle!="" && $actividad_lugar!="" && $actividad_fecha_desde!="")
	{
	
		mysqli_query($link,"UPDATE salidas_educativas SET
		                idtiposalida= $idtiposalida,
						idinstitucion = $de_institucion,
						actividad_fecha_desde = '$actividad_fecha_desde',
						actividad_fecha_hasta = '$actividad_fecha_hasta',
						actividad_lugar = '$actividad_lugar',
						actividad_detalle = '$actividad_detalle',
						actividad_destinatario = '$actividad_destinatarios',
						actividad_alumnos = '$actividad_alumnos',
						responsable_nombre = '$responsable_nombre',
						responsable_dni = '$responsable_dni',
						responsable_cargo = '$responsable_cargo',
						responsable_contacto = '$responsable_contacto',
						docentesotros1 = '$docentes',
						responsablesotros1 = '$responsable_otro',
						transporte_empresa = '$transporte_empresa',
						transporte_vehiculo = '$transporte_vehiculo',
						transporte_responsables = '$transporte_responsables',
						transporte_autorizacion = '$transporte_autorizacion',
						transporte_seguro= '$transporte_seguro',
						seguro_poliza = '$seguro_poliza',
						vigente='1',
						AudFecModi = '$fecmodi',
						AudUsrModi = '$usrmodi'
						WHERE idsalida = $id");
						
					?>
					<script>
					window.alert("EL FORMULARIO HA SIDO ACTUALIZADO CORRECTAMENTE!");
					window.open('salidas_educat.php?id_sal=<?php echo $id?>','_self');
				
					</script>
					<?php
					}
					else
					{
					?>
					<script>
					window.alert("DEBE COMPLETAR TODOS LOS DATOS!");
					</script>
					<?php
					}
	}

if($_POST["action"] == "G" && $id=="")
{
	if($de_institucion!="" && $actividad_detalle!="" && $actividad_lugar!="" && $actividad_fecha_desde!="")
	{
		 mysqli_query($link,"INSERT INTO salidas_educativas (idtiposalida, idinstitucion, actividad_fecha_desde, actividad_fecha_hasta,  actividad_lugar, actividad_detalle, actividad_destinatario, actividad_alumnos, responsable_nombre, responsable_dni,  responsable_cargo, responsable_contacto, docentesotros1, responsablesotros1, transporte_empresa, transporte_vehiculo, transporte_responsables, transporte_autorizacion, transporte_seguro, seguro_poliza, vigente,  AudFecAlta, AudUsrAlta ,actividad_grupo,responsable_domicilio,AudFecModi,AudUsrModi) VALUES ($idtiposalida, $de_institucion, '$actividad_fecha_desde', '$actividad_fecha_hasta', '$actividad_lugar', '$actividad_detalle', '$actividad_destinatarios', '$actividad_alumnos', '$responsable_nombre', '$responsable_dni', '$responsable_cargo', '$responsable_contacto','$docentes', '$responsable_otro', '$transporte_empresa', '$transporte_vehiculo', '$transporte_responsables', '$transporte_autorizacion', '$transporte_seguro', '$seguro_poliza', '1', '$fecalta', '$usralta','','',now(),'')");
			$id = mysqli_insert_id($link);
	 
		// ************* envio por mail datos de la salida educativa

		//$destinatario = "nasifiruela@arnet.com.ar";
		$destinatario = "lorena.abatiidaga@gmail.com"; 
		$asunto = "Sistema de Gesti�n - Salidas Educativas"; 
		$correo_alta_persona = $_SESSION["Nombre_Usuario"];
		$correo_alta_fecha = date("Y-m-d H:i:s");
		$correo_id_denuncia = date("Y-m-d H:i:s");
	

		// selecciono el nombre de la Institucion

		$nombre_institucion = mysqli_fetch_assoc(mysqli_query($link,"SELECT Nombre, Telefono FROM instituciones WHERE ID='" . $_SESSION["Institucion"]."'"));
		$correo_institucion = $nombre_institucion["Nombre"];
		$correo_telefono = $nombre_institucion["Telefono"];

		// selecciono el tipo de salida
		$nombre_salida = mysqli_fetch_assoc(mysqli_query($link,"SELECT descripcion FROM salidas_tipos WHERE idsalidatipo='" . $idtiposalida."'"));
		$correo_salida= $nombre_salida["descripcion"];
		
		
		$cuerpo = 'N� Salida: '.$id.  '<br> Usuario_Alta: '.$correo_alta_persona.  '<br> Fecha_Alta: '.$correo_alta_fecha. '<br> Tipo de Salida: '.$correo_salida. '<br> Instituci�n: '.$correo_institucion.  '<br>   Fecha de la Actividad: '.$actividad_fecha_desde.  '<br> Lugar: '.$actividad_lugar.  '<br> Detalle: '.$actividad_detalle.  '<br> Responsable: '.$responsable_nombre.  '<br> Contacto: '.$responsable_contacto.  '<br> Transporte: '.$transporte_empresa.  '<br>'; 


		//para el env�o en formato HTML 
		$headers = "MIME-Version: 1.0\r\n"; 
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
	

		//direcci�n del remitente 

		$headers .= "From: salidas@jaeccba.org.ar\r\n";

		//direcciones que recibir�n copia oculta 
		//$headers .= "Bcc: lorena.abatidaga@gmail.com\r\n"; 
		mail($destinatario,$asunto,$cuerpo,$headers);

		// **************** fin envio de datos por correo

			?>
					<script>
					window.alert("EL FORMULARIO HA SIDO REGISTRADO CORRECTAMENTE!");
					window.open('salidas_educat.php?id_sal=<?php echo $id?>','_self');
					</script>
					<?php
	}

	else

	{

		?>
					<script>
					window.alert("DEBE COMPLETAR TODOS LOS DATOS!");
					</script>
					<?php

	}

}

if($id != "")
{
$sql = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM salidas_educativas WHERE vigente='1' AND idsalida=$id"));
$idtiposalida = $sql["idtiposalida"];
$de_institucion = $sql["idinstitucion"];
$actividad_detalle = $sql["actividad_detalle"];
$actividad_lugar = $sql["actividad_lugar"];
$actividad_fecha_desde = $sql["actividad_fecha_desde"];
$actividad_fecha_hasta = $sql["actividad_fecha_hasta"];
$actividad_destinatarios = $sql["actividad_destinatario"];
$actividad_alumnos = $sql["actividad_alumnos"];

$responsable_nombre = $sql["responsable_nombre"];
$responsable_dni = $sql["responsable_dni"];
$responsable_cargo = $sql["responsable_cargo"];
$responsable_contacto = $sql["responsable_contacto"];
$docentes = $sql["docentesotros1"];
$responsable_otro = $sql["responsablesotros1"];

$transporte_empresa = $sql["transporte_empresa"];
$transporte_vehiculo = $sql["transporte_vehiculo"];
$transporte_responsables = $sql["transporte_responsables"];
$transporte_autorizacion = $sql["transporte_autorizacion"];
$transporte_seguro = $sql["transporte_seguro"];
$seguro_poliza = $sql["seguro_poliza"];


$id=$sql["idsalida"];
}

//tabla tipo  instituciones
$de_inst=mysqli_query($link,"SELECT * FROM instituciones  WHERE vigente='1' ORDER BY nombre");
$de_inst_id=mysqli_query($link,"SELECT * FROM instituciones  WHERE vigente='1' AND ID='" .$_SESSION["Institucion"]. "' ORDER BY nombre");
$de_tiposalida=mysqli_query($link,"SELECT * FROM salidas_tipos ORDER BY idsalidatipo");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->
<!--SEO -->
<meta name="Keywords" content=" " />
<meta name="description" content=" " />
<title>Fondo Solidario  |  Sistema de Gesti�n</title>
<?php include("scripts.php"); ?>
 <style type="text/css">
        #main { margin: 0px auto; border:solid 1px #b2b3b5; -moz-border-radius:10px; padding:20px; background-color:#f6f6f6;}
        #header { text-align:center; border-bottom:solid 1px #b2b3b5; margin: 0 0 20px 0; }
        fieldset { border:none; width:320px;}
        legend { font-size:18px; margin:0px; padding:10px 0px; color:#b0232a; font-weight:bold;}
        label { display:block; margin:15px 0 5px;}
        input[type=text], input[type=password] { width:600px; padding:5px; border:solid 1px #000;}
        .prev, .next { background-color:#b0232a; padding:5px 10px; color:#fff; text-decoration:none;}
        .save { background-color:#gg232a; padding:15px 15px; text-align:center; font-size:16px; color:#000; text-decoration:none;}
        .prev:hover, .next:hover { background-color:#000; text-decoration:none;}
        .prev { float:left;}
        .next { float:right;}
        #steps { list-style:none; width:100%; overflow:hidden; margin:0px; padding:0px;}
        #steps li {font-size:24px; float:left; padding:20px; color:#b0b1b3;}
        #steps li span {font-size:15px; display:block;}
        #steps li.current { color:#000;}
        #makeWizard { background-color:#b0232a; color:#fff; padding:5px 10px; text-decoration:none; font-size:18px;}
        #makeWizard:hover { background-color:#000;}
    </style>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/formToWizard.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#SignupForm").formToWizard({ submitButton: 'SaveAccount' })
        });
    </script>
</head>
<body>
<script language="javascript">

function guardar()
{
	if (SignupForm.txtActividadDetalle.value == "" && SignupForm.txtActividadLugar.value == "" && SignupForm.txtActividadFechaDesde.value == "" )
	{
	window.alert("DETALLE, LUGAR y FECHA de la ACTIVIDAD son datos obligatorios!")
	SignupForm.txtActividadDetalle.focus();
	}	
	else
	{
		SignupForm.action.value='G';
		SignupForm.submit();
	}	 
}


</script>
<script language="javascript" src="calendar/calendar.js"></script>
<div id="Cabecera">
  <?php include("top.php"); ?>
</div>
<div id="Menin">
  <div class="row">
    <?php include("menu.php"); ?>
    <div class="clear"> </div>
    <div class="large-12 columns " >
 
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
	<img src="images/map.png" width="30" height="36" border="0"> <b>Salidas  - Alta y Modificaci�n</b>	</div>
    
	<div class="clear2"> </div>
    <div >
		<form id="SignupForm" name="SignupForm" method="post">
	    <!-- DATOS DE LA ACTIVIDAD -->
        <fieldset>
          <legend>Actividad</legend>
		  <label for="Institucion">Tipo de Salida</label>
	      <select name="cmbSalida" id="cmbSalida">
	      <?php while($row1=mysqli_fetch_assoc($de_tiposalida)) { ?>
	      <option value="<?php echo $row1["idsalidatipo"]?>" <?php if($row1["idsalidatipo"]==$idtiposalida) echo "selected"?>><?php echo $row1["descripcion"]?></option>
	      <?php } ?>
	      </select>
		  <!-- SI LA INSTITUCION ES JAEC LISTO  TODAS LAS INSTITUCIONES -->
		  <?php if ($_SESSION["Institucion"]==14) {?>
	      <label for="Institucion">Instituci�n</label>
	      <select name="cmbDEInst" id="cmbDEInst">
	      <?php while($row=mysqli_fetch_assoc($de_inst)) { ?>
	      <option value="<?php echo $row["ID"]?>" <?php if($row["ID"]==$de_institucion) echo "selected"?>><?php echo $row["Nombre"]?></option>
	      <?php } ?>
	      </select>	    
		  <?php } ?>
          <!-- SI LA INSTITUCION NO ES JAEC LISTO  SOLO LA INSTITUCION DEL USUARIO-->
          <?php if ($_SESSION["Institucion"]!=14) {?>
     	  <label for="Institucion">Instituci�n</label>
		  <select name="cmbDEInst" id="cmbDEInst">
		  <?php while($row=mysqli_fetch_assoc($de_inst_id)) { ?>
		  <option value="<?php echo $row["ID"]?>" <?php if($row["ID"]==$de_institucion) echo "selected"?>><?php echo $row["Nombre"]?></option>
		  <?php } ?>
		  </select>
	 	 <?php } ?>
	 	 <label for="ActividadLugar">Lugar</label>
         <input id="txtActividadLugar" name="txtActividadLugar" type="text" value="<?php echo $actividad_lugar?>"/>
         <label for="ActividadDetalle">Descripci�n</label>
         <textarea name="txtActividadDetalle" id="txtActividadDetalle" ><?php echo $actividad_detalle ?></textarea>
		 <label for="ActividadFechaDesde">Fecha Desde</label>
         <?php require_once('calendar/classes/tc_calendar.php'); ?>
         <?php 
		$myCalendar = new tc_calendar("txtActividadFechaDesde", true, false);
		$myCalendar->setIcon("calendar/images/iconCalendar.gif");
		if ($actividad_fecha_desde!='')
		{
		$myCalendar->setDateYMD($actividad_fecha_desde);
		}
		else
		{
		$myCalendar->setDate(date('d'), date('m'), date('Y'));
		}
		$myCalendar->setPath("calendar/");
		$myCalendar->setYearInterval(2015, 2022);
		$myCalendar->dateAllow('2015-01-01', '2022-12-31');
		$myCalendar->setDateFormat('j F Y');
		$myCalendar->setAlignment('left', 'bottom');
		$myCalendar->writeScript();
		?>
		<br />
		<label for="ActividadFechaHasta">Fecha Hasta</label>
         <?php require_once('calendar/classes/tc_calendar.php'); ?>
         <?php 
		$myCalendar = new tc_calendar("txtActividadFechaHasta", true, false);
		$myCalendar->setIcon("calendar/images/iconCalendar.gif");
		if ($actividad_fecha_hasta!='')
		{
		$myCalendar->setDateYMD($actividad_fecha_hasta);
		}
		else
		{
		$myCalendar->setDate(date('d'), date('m'), date('Y'));
		}
		$myCalendar->setPath("calendar/");
		$myCalendar->setYearInterval(2015, 2022);
		$myCalendar->dateAllow('2015-01-01', '2022-12-31');
		$myCalendar->setDateFormat('j F Y');
		$myCalendar->setAlignment('left', 'bottom');
		$myCalendar->writeScript();
		?>
	    </fieldset>
		
		
		<!-- DATOS DE DESTINATARIOS Y RESPONSABLES  -->
        <fieldset>
            <legend>Destinatarios y Responsables</legend>
            <label for="ActividadDestinatarios">Destinatarios</label>
            <input id="txtActividadDestinatarios" name="txtActividadDestinatarios" type="text" value="<?php echo $actividad_destinatarios?>" />
            <label for="ActividadAlumnos">Cantidad de Alumnos</label>
            <input id="txtActividadAlumnos" name="txtActividadAlumnos" type="text" value="<?php echo $actividad_alumnos?>" />
			<label for="ResponsableNombre">Nombre del Responsable</label>
			<input id="txtResponsableNombre" name="txtResponsableNombre" type="text" value="<?php echo $responsable_nombre?>" />
			<label for="ResponsableDNI">DNI</label>
			<input id="txtResponsableDNI" name="txtResponsableDNI" type="text" value="<?php echo $responsable_dni?>" />
			<label for="ResponsableCargo">Cargo o Funci�n del Responsable</label>
			<input id="txtResponsableCargo" name="txtResponsableCargo" type="text" value="<?php echo $responsable_cargo?>" />
			<label for="ResponsableContacto">Contacto con el Responsable</label>
			<input id="txtResponsableContacto" name="txtResponsableContacto" type="text" value="<?php echo $responsable_contacto?>" />
			<label for="Docentes">Otros Docentes</label>
			<textarea name="txtDocentes" id="txtDocentes" ><?php echo $docentes ?></textarea>
			<label for="OtrosResponsables">Otros Responsables</label>
			<textarea name="txtOtrosResponsables" id="txtOtrosResponsables" ><?php echo $responsable_otros ?></textarea>
			
			
			
        </fieldset>



        <fieldset>
            <legend>Transporte y Autorizaci�n</legend>
            <label for="TransporteEmpresa">Empresa de Transporte</label>
            <input id="txtTransporteEmpresa" name="txtTransporteEmpresa" type="text" value="<?php echo $transporte_empresa?>" />
            <label for="TransporteResponsables">Responsables del Veh�culo</label>
            <input id="txtTransporteResponsables" name="txtTransporteResponsables" type="text" value="<?php echo $transporte_responsables?>" />
		    <label for="TransporteVehiculo">Veh�culo del Transporte</label>
			<input id="txtTransporteVehiculo" name="txtTransporteVehiculo" type="text" value="<?php echo $transporte_vehiculo?>" />
            <label for="TransporteAutorizacion">Autorizaci�n</label>
            <input id="txtTransporteAutorizacion" name="txtTransporteAutorizacion" type="text" value="<?php echo $transporte_autorizacion?>" />
            <label for="TransporteSeguro">Seguro y Registro</label>
            <input id="txtTransporteSeguro" name="txtTransporteSeguro" type="text" value="<?php echo $transporte_seguro?>" />
            <label for="SeguroPoliza">Responsabilidad Civil. N� de P�liza</label>
            <input id="txtSeguroPoliza" name="txtSeguroPoliza" type="text" value="<?php echo $seguro_poliza?>" />
        </fieldset>
		<br><br>
		<p align="center">  
		<input name="SaveAccount" id="SaveAccount" type="button" value="GUARDAR" onClick="guardar();" class="save"  />
		<!--<input id="SaveAccount" type="submit" value="Submit form" class="save" />-->
        </p>
      	<input type="hidden" name="action" id="action">
		<input name="id_sal" type="hidden" id="id_sal" value="<?php echo $id?>">

	   </form>
     
      <div class="clear2"> </div>
    </div>
  </div>
</div>
</div>
<div class="clear"> </div>
<?php include("pie.php"); ?>
</body>
>>>>>>> 64483f4e4592a7d8cfa1980d291de5bef1badd92
=======
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

// regla de negocios
$mensaje="Complete los datos";
$idtiposalida = $_POST["cmbSalida"];
$de_institucion = $_POST["cmbDEInst"];
$actividad_lugar = $_POST["txtActividadLugar"];
$actividad_detalle = $_POST["txtActividadDetalle"];
$actividad_fecha_desde = $_POST["txtActividadFechaDesde"];
$actividad_fecha_hasta = $_POST["txtActividadFechaHasta"];
if ($actividad_fecha_hasta =="")
{
$actividad_fecha_hasta = $actividad_fecha_desde; 
}

$actividad_destinatarios = $_POST["txtActividadDestinatarios"];
$actividad_alumnos = $_POST["txtActividadAlumnos"];
$responsable_nombre = $_POST["txtResponsableNombre"];
$responsable_dni = $_POST["txtResponsableDNI"];
$responsable_cargo = $_POST["txtResponsableCargo"];
$responsable_contacto = $_POST["txtResponsableContacto"];
$docentes = $_POST["txtDocentes"];
$responsable_otro = $_POST["txtOtrosResponsables"];


$transporte_empresa = $_POST["txtTransporteEmpresa"];
$transporte_responsables = $_POST["txtTransporteResponsables"];
$transporte_vehiculo = $_POST["txtTransporteVehiculo"];
$transporte_autorizacion = $_POST["txtTransporteAutorizacion"];
$transporte_seguro = $_POST["txtTransporteSeguro"];
$seguro_poliza = $_POST["txtSeguroPoliza"];


$id=$_REQUEST["id_sal"];

/************************************************************************************************************************
ACCIONES
************************************************************************************************************************/

if($_POST["action"] == "G" && $id!="")
{
	if($de_institucion!="" && $actividad_detalle!="" && $actividad_lugar!="" && $actividad_fecha_desde!="")
	{
	
		mysqli_query($link,"UPDATE salidas_educativas SET
		                idtiposalida= $idtiposalida,
						idinstitucion = $de_institucion,
						actividad_fecha_desde = '$actividad_fecha_desde',
						actividad_fecha_hasta = '$actividad_fecha_hasta',
						actividad_lugar = '$actividad_lugar',
						actividad_detalle = '$actividad_detalle',
						actividad_destinatario = '$actividad_destinatarios',
						actividad_alumnos = '$actividad_alumnos',
						responsable_nombre = '$responsable_nombre',
						responsable_dni = '$responsable_dni',
						responsable_cargo = '$responsable_cargo',
						responsable_contacto = '$responsable_contacto',
						docentesotros1 = '$docentes',
						responsablesotros1 = '$responsable_otro',
						transporte_empresa = '$transporte_empresa',
						transporte_vehiculo = '$transporte_vehiculo',
						transporte_responsables = '$transporte_responsables',
						transporte_autorizacion = '$transporte_autorizacion',
						transporte_seguro= '$transporte_seguro',
						seguro_poliza = '$seguro_poliza',
						vigente='1',
						AudFecModi = '$fecmodi',
						AudUsrModi = '$usrmodi'
						WHERE idsalida = $id");
						
					?>
					<script>
					window.alert("EL FORMULARIO HA SIDO ACTUALIZADO CORRECTAMENTE!");
					window.open('salidas_educat.php?id_sal=<?php echo $id?>','_self');
				
					</script>
					<?php
					}
					else
					{
					?>
					<script>
					window.alert("DEBE COMPLETAR TODOS LOS DATOS!");
					</script>
					<?php
					}
	}

if($_POST["action"] == "G" && $id=="")
{
	if($de_institucion!="" && $actividad_detalle!="" && $actividad_lugar!="" && $actividad_fecha_desde!="")
	{
		 mysqli_query($link,"INSERT INTO salidas_educativas (idtiposalida, idinstitucion, actividad_fecha_desde, actividad_fecha_hasta,  actividad_lugar, actividad_detalle, actividad_destinatario, actividad_alumnos, responsable_nombre, responsable_dni,  responsable_cargo, responsable_contacto, docentesotros1, responsablesotros1, transporte_empresa, transporte_vehiculo, transporte_responsables, transporte_autorizacion, transporte_seguro, seguro_poliza, vigente,  AudFecAlta, AudUsrAlta ,actividad_grupo,responsable_domicilio,AudFecModi,AudUsrModi) VALUES ($idtiposalida, $de_institucion, '$actividad_fecha_desde', '$actividad_fecha_hasta', '$actividad_lugar', '$actividad_detalle', '$actividad_destinatarios', '$actividad_alumnos', '$responsable_nombre', '$responsable_dni', '$responsable_cargo', '$responsable_contacto','$docentes', '$responsable_otro', '$transporte_empresa', '$transporte_vehiculo', '$transporte_responsables', '$transporte_autorizacion', '$transporte_seguro', '$seguro_poliza', '1', '$fecalta', '$usralta','','',now(),'')");
			$id = mysqli_insert_id($link);
	 
		// ************* envio por mail datos de la salida educativa

		//$destinatario = "nasifiruela@arnet.com.ar";
		$destinatario = "lorena.abatiidaga@gmail.com"; 
		$asunto = "Sistema de Gesti�n - Salidas Educativas"; 
		$correo_alta_persona = $_SESSION["Nombre_Usuario"];
		$correo_alta_fecha = date("Y-m-d H:i:s");
		$correo_id_denuncia = date("Y-m-d H:i:s");
	

		// selecciono el nombre de la Institucion

		$nombre_institucion = mysqli_fetch_assoc(mysqli_query($link,"SELECT Nombre, Telefono FROM instituciones WHERE ID='" . $_SESSION["Institucion"]."'"));
		$correo_institucion = $nombre_institucion["Nombre"];
		$correo_telefono = $nombre_institucion["Telefono"];

		// selecciono el tipo de salida
		$nombre_salida = mysqli_fetch_assoc(mysqli_query($link,"SELECT descripcion FROM salidas_tipos WHERE idsalidatipo='" . $idtiposalida."'"));
		$correo_salida= $nombre_salida["descripcion"];
		
		
		$cuerpo = 'N� Salida: '.$id.  '<br> Usuario_Alta: '.$correo_alta_persona.  '<br> Fecha_Alta: '.$correo_alta_fecha. '<br> Tipo de Salida: '.$correo_salida. '<br> Instituci�n: '.$correo_institucion.  '<br>   Fecha de la Actividad: '.$actividad_fecha_desde.  '<br> Lugar: '.$actividad_lugar.  '<br> Detalle: '.$actividad_detalle.  '<br> Responsable: '.$responsable_nombre.  '<br> Contacto: '.$responsable_contacto.  '<br> Transporte: '.$transporte_empresa.  '<br>'; 


		//para el env�o en formato HTML 
		$headers = "MIME-Version: 1.0\r\n"; 
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
	

		//direcci�n del remitente 

		$headers .= "From: salidas@jaeccba.org.ar\r\n";

		//direcciones que recibir�n copia oculta 
		//$headers .= "Bcc: lorena.abatidaga@gmail.com\r\n"; 
		mail($destinatario,$asunto,$cuerpo,$headers);

		// **************** fin envio de datos por correo

			?>
					<script>
					window.alert("EL FORMULARIO HA SIDO REGISTRADO CORRECTAMENTE!");
					window.open('salidas_educat.php?id_sal=<?php echo $id?>','_self');
					</script>
					<?php
	}

	else

	{

		?>
					<script>
					window.alert("DEBE COMPLETAR TODOS LOS DATOS!");
					</script>
					<?php

	}

}

if($id != "")
{
$sql = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM salidas_educativas WHERE vigente='1' AND idsalida=$id"));
$idtiposalida = $sql["idtiposalida"];
$de_institucion = $sql["idinstitucion"];
$actividad_detalle = $sql["actividad_detalle"];
$actividad_lugar = $sql["actividad_lugar"];
$actividad_fecha_desde = $sql["actividad_fecha_desde"];
$actividad_fecha_hasta = $sql["actividad_fecha_hasta"];
$actividad_destinatarios = $sql["actividad_destinatario"];
$actividad_alumnos = $sql["actividad_alumnos"];

$responsable_nombre = $sql["responsable_nombre"];
$responsable_dni = $sql["responsable_dni"];
$responsable_cargo = $sql["responsable_cargo"];
$responsable_contacto = $sql["responsable_contacto"];
$docentes = $sql["docentesotros1"];
$responsable_otro = $sql["responsablesotros1"];

$transporte_empresa = $sql["transporte_empresa"];
$transporte_vehiculo = $sql["transporte_vehiculo"];
$transporte_responsables = $sql["transporte_responsables"];
$transporte_autorizacion = $sql["transporte_autorizacion"];
$transporte_seguro = $sql["transporte_seguro"];
$seguro_poliza = $sql["seguro_poliza"];


$id=$sql["idsalida"];
}

//tabla tipo  instituciones
$de_inst=mysqli_query($link,"SELECT * FROM instituciones  WHERE vigente='1' ORDER BY nombre");
$de_inst_id=mysqli_query($link,"SELECT * FROM instituciones  WHERE vigente='1' AND ID='" .$_SESSION["Institucion"]. "' ORDER BY nombre");
$de_tiposalida=mysqli_query($link,"SELECT * FROM salidas_tipos ORDER BY idsalidatipo");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->
<!--SEO -->
<meta name="Keywords" content=" " />
<meta name="description" content=" " />
<title>Fondo Solidario  |  Sistema de Gesti�n</title>
<?php include("scripts.php"); ?>
 <style type="text/css">
        #main { margin: 0px auto; border:solid 1px #b2b3b5; -moz-border-radius:10px; padding:20px; background-color:#f6f6f6;}
        #header { text-align:center; border-bottom:solid 1px #b2b3b5; margin: 0 0 20px 0; }
        fieldset { border:none; width:320px;}
        legend { font-size:18px; margin:0px; padding:10px 0px; color:#b0232a; font-weight:bold;}
        label { display:block; margin:15px 0 5px;}
        input[type=text], input[type=password] { width:600px; padding:5px; border:solid 1px #000;}
        .prev, .next { background-color:#b0232a; padding:5px 10px; color:#fff; text-decoration:none;}
        .save { background-color:#gg232a; padding:15px 15px; text-align:center; font-size:16px; color:#000; text-decoration:none;}
        .prev:hover, .next:hover { background-color:#000; text-decoration:none;}
        .prev { float:left;}
        .next { float:right;}
        #steps { list-style:none; width:100%; overflow:hidden; margin:0px; padding:0px;}
        #steps li {font-size:24px; float:left; padding:20px; color:#b0b1b3;}
        #steps li span {font-size:15px; display:block;}
        #steps li.current { color:#000;}
        #makeWizard { background-color:#b0232a; color:#fff; padding:5px 10px; text-decoration:none; font-size:18px;}
        #makeWizard:hover { background-color:#000;}
    </style>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/formToWizard.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#SignupForm").formToWizard({ submitButton: 'SaveAccount' })
        });
    </script>
</head>
<body>
<script language="javascript">

function guardar()
{
	if (SignupForm.txtActividadDetalle.value == "" && SignupForm.txtActividadLugar.value == "" && SignupForm.txtActividadFechaDesde.value == "" )
	{
	window.alert("DETALLE, LUGAR y FECHA de la ACTIVIDAD son datos obligatorios!")
	SignupForm.txtActividadDetalle.focus();
	}	
	else
	{
		SignupForm.action.value='G';
		SignupForm.submit();
	}	 
}


</script>
<script language="javascript" src="calendar/calendar.js"></script>
<div id="Cabecera">
  <?php include("top.php"); ?>
</div>
<div id="Menin">
  <div class="row">
    <?php include("menu.php"); ?>
    <div class="clear"> </div>
    <div class="large-12 columns " >
 
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
	<img src="images/map.png" width="30" height="36" border="0"> <b>Salidas  - Alta y Modificaci�n</b>	</div>
    
	<div class="clear2"> </div>
    <div >
		<form id="SignupForm" name="SignupForm" method="post">
	    <!-- DATOS DE LA ACTIVIDAD -->
        <fieldset>
          <legend>Actividad</legend>
		  <label for="Institucion">Tipo de Salida</label>
	      <select name="cmbSalida" id="cmbSalida">
	      <?php while($row1=mysqli_fetch_assoc($de_tiposalida)) { ?>
	      <option value="<?php echo $row1["idsalidatipo"]?>" <?php if($row1["idsalidatipo"]==$idtiposalida) echo "selected"?>><?php echo $row1["descripcion"]?></option>
	      <?php } ?>
	      </select>
		  <!-- SI LA INSTITUCION ES JAEC LISTO  TODAS LAS INSTITUCIONES -->
		  <?php if ($_SESSION["Institucion"]==14) {?>
	      <label for="Institucion">Instituci�n</label>
	      <select name="cmbDEInst" id="cmbDEInst">
	      <?php while($row=mysqli_fetch_assoc($de_inst)) { ?>
	      <option value="<?php echo $row["ID"]?>" <?php if($row["ID"]==$de_institucion) echo "selected"?>><?php echo $row["Nombre"]?></option>
	      <?php } ?>
	      </select>	    
		  <?php } ?>
          <!-- SI LA INSTITUCION NO ES JAEC LISTO  SOLO LA INSTITUCION DEL USUARIO-->
          <?php if ($_SESSION["Institucion"]!=14) {?>
     	  <label for="Institucion">Instituci�n</label>
		  <select name="cmbDEInst" id="cmbDEInst">
		  <?php while($row=mysqli_fetch_assoc($de_inst_id)) { ?>
		  <option value="<?php echo $row["ID"]?>" <?php if($row["ID"]==$de_institucion) echo "selected"?>><?php echo $row["Nombre"]?></option>
		  <?php } ?>
		  </select>
	 	 <?php } ?>
	 	 <label for="ActividadLugar">Lugar</label>
         <input id="txtActividadLugar" name="txtActividadLugar" type="text" value="<?php echo $actividad_lugar?>"/>
         <label for="ActividadDetalle">Descripci�n</label>
         <textarea name="txtActividadDetalle" id="txtActividadDetalle" ><?php echo $actividad_detalle ?></textarea>
		 <label for="ActividadFechaDesde">Fecha Desde</label>
         <?php require_once('calendar/classes/tc_calendar.php'); ?>
         <?php 
		$myCalendar = new tc_calendar("txtActividadFechaDesde", true, false);
		$myCalendar->setIcon("calendar/images/iconCalendar.gif");
		if ($actividad_fecha_desde!='')
		{
		$myCalendar->setDateYMD($actividad_fecha_desde);
		}
		else
		{
		$myCalendar->setDate(date('d'), date('m'), date('Y'));
		}
		$myCalendar->setPath("calendar/");
		$myCalendar->setYearInterval(2015, 2022);
		$myCalendar->dateAllow('2015-01-01', '2022-12-31');
		$myCalendar->setDateFormat('j F Y');
		$myCalendar->setAlignment('left', 'bottom');
		$myCalendar->writeScript();
		?>
		<br />
		<label for="ActividadFechaHasta">Fecha Hasta</label>
         <?php require_once('calendar/classes/tc_calendar.php'); ?>
         <?php 
		$myCalendar = new tc_calendar("txtActividadFechaHasta", true, false);
		$myCalendar->setIcon("calendar/images/iconCalendar.gif");
		if ($actividad_fecha_hasta!='')
		{
		$myCalendar->setDateYMD($actividad_fecha_hasta);
		}
		else
		{
		$myCalendar->setDate(date('d'), date('m'), date('Y'));
		}
		$myCalendar->setPath("calendar/");
		$myCalendar->setYearInterval(2015, 2022);
		$myCalendar->dateAllow('2015-01-01', '2022-12-31');
		$myCalendar->setDateFormat('j F Y');
		$myCalendar->setAlignment('left', 'bottom');
		$myCalendar->writeScript();
		?>
	    </fieldset>
		
		
		<!-- DATOS DE DESTINATARIOS Y RESPONSABLES  -->
        <fieldset>
            <legend>Destinatarios y Responsables</legend>
            <label for="ActividadDestinatarios">Destinatarios</label>
            <input id="txtActividadDestinatarios" name="txtActividadDestinatarios" type="text" value="<?php echo $actividad_destinatarios?>" />
            <label for="ActividadAlumnos">Cantidad de Alumnos</label>
            <input id="txtActividadAlumnos" name="txtActividadAlumnos" type="text" value="<?php echo $actividad_alumnos?>" />
			<label for="ResponsableNombre">Nombre del Responsable</label>
			<input id="txtResponsableNombre" name="txtResponsableNombre" type="text" value="<?php echo $responsable_nombre?>" />
			<label for="ResponsableDNI">DNI</label>
			<input id="txtResponsableDNI" name="txtResponsableDNI" type="text" value="<?php echo $responsable_dni?>" />
			<label for="ResponsableCargo">Cargo o Funci�n del Responsable</label>
			<input id="txtResponsableCargo" name="txtResponsableCargo" type="text" value="<?php echo $responsable_cargo?>" />
			<label for="ResponsableContacto">Contacto con el Responsable</label>
			<input id="txtResponsableContacto" name="txtResponsableContacto" type="text" value="<?php echo $responsable_contacto?>" />
			<label for="Docentes">Otros Docentes</label>
			<textarea name="txtDocentes" id="txtDocentes" ><?php echo $docentes ?></textarea>
			<label for="OtrosResponsables">Otros Responsables</label>
			<textarea name="txtOtrosResponsables" id="txtOtrosResponsables" ><?php echo $responsable_otros ?></textarea>
			
			
			
        </fieldset>



        <fieldset>
            <legend>Transporte y Autorizaci�n</legend>
            <label for="TransporteEmpresa">Empresa de Transporte</label>
            <input id="txtTransporteEmpresa" name="txtTransporteEmpresa" type="text" value="<?php echo $transporte_empresa?>" />
            <label for="TransporteResponsables">Responsables del Veh�culo</label>
            <input id="txtTransporteResponsables" name="txtTransporteResponsables" type="text" value="<?php echo $transporte_responsables?>" />
		    <label for="TransporteVehiculo">Veh�culo del Transporte</label>
			<input id="txtTransporteVehiculo" name="txtTransporteVehiculo" type="text" value="<?php echo $transporte_vehiculo?>" />
            <label for="TransporteAutorizacion">Autorizaci�n</label>
            <input id="txtTransporteAutorizacion" name="txtTransporteAutorizacion" type="text" value="<?php echo $transporte_autorizacion?>" />
            <label for="TransporteSeguro">Seguro y Registro</label>
            <input id="txtTransporteSeguro" name="txtTransporteSeguro" type="text" value="<?php echo $transporte_seguro?>" />
            <label for="SeguroPoliza">Responsabilidad Civil. N� de P�liza</label>
            <input id="txtSeguroPoliza" name="txtSeguroPoliza" type="text" value="<?php echo $seguro_poliza?>" />
        </fieldset>
		<br><br>
		<p align="center">  
		<input name="SaveAccount" id="SaveAccount" type="button" value="GUARDAR" onClick="guardar();" class="save"  />
		<!--<input id="SaveAccount" type="submit" value="Submit form" class="save" />-->
        </p>
      	<input type="hidden" name="action" id="action">
		<input name="id_sal" type="hidden" id="id_sal" value="<?php echo $id?>">

	   </form>
     
      <div class="clear2"> </div>
    </div>
  </div>
</div>
</div>
<div class="clear"> </div>
<?php include("pie.php"); ?>
</body>
>>>>>>> 64483f4e4592a7d8cfa1980d291de5bef1badd92
</html>
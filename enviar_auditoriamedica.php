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

$id=$_REQUEST["id_denuncia"];

// ************* grabo los datos de auditoria medica en "denuncias" //  no le grabo datos de usuario y fecha de modificacion

mysqli_query($link,"UPDATE denuncias SET Enviado_Auditoriamedica='1' WHERE ID=$id");

// ************* grabo los datos de auditoria medica en "auditoriamedica"

mysqli_query($link,"INSERT INTO auditoriamedica (IDDenuncia, FechaEnvio,IDEstadoAuditoria, AudUsrAlta, AudFecAlta)	VALUES ($id, '$fecalta', '1', '$usralta', '$fecalta')");

$id_auditoriamedica = mysqli_insert_id($link);



// ************* envio por mail datos de la auditoria medica

$destinatario = "auditoria@jaeccba.org.ar"; 

$asunto = "Sistema de Gestión - Auditoria Medica"; 

$correo_alta_fecha = date("Y-m-d H:i:s");



//selecciono los datos de la denuncia que voy a enviar

$datos_denuncia = mysqli_fetch_assoc(mysqli_query($link,"SELECT ACC_Nombre, ACC_Domicilio, ACC_Telefono, ACC_Barrio, ACC_Localidad, DA_Hecho, DE_IDInstitucion FROM denuncias WHERE ID='" . $id ."'"));

$nombre_accidentado= $datos_denuncia["ACC_Nombre"];

$domicilio_accidentado = $datos_denuncia["ACC_Domicilio"];

$telefono_accidentado = $datos_denuncia["ACC_Telefono"];

$barrio_accidentado = $datos_denuncia["ACC_Barrio"];

$localidad_accidentado = $datos_denuncia["ACC_Localidad"];

$hecho_accidentado = $datos_denuncia["DA_Hecho"];

$id_institucion = $datos_denuncia["DE_IDInstitucion"];



//selecciono los datos de la emergencia

$datos_emergencia = mysqli_fetch_assoc(mysqli_query($Link,"SELECT AM_Diagnostico, AM_Empresa FROM denuncias_emergencias  WHERE IDDenuncia='" . $id ."'"));

$diag_emergencia = $datos_emergencia["AM_Diagnostico"];

$empresa_emergencia = $datos_emergencia["AM_Empresa"];



// selecciono el nombre de la Institucion de las DENUNCIA

$nombre_institucion = mysqli_fetch_assoc(mysqli_query($link,"SELECT Nombre, Telefono FROM instituciones WHERE ID='" . $id_institucion ."'"));

$correo_institucion = $nombre_institucion["Nombre"];

$correo_telefono = $nombre_institucion["Telefono"];

		

$cuerpo = 'Nº Denuncia: '.$id.  '<br>  Institución: '.$correo_institucion.  '<br> Contacto con la Institución: '.$correo_telefono.  '<br> Nombre del Accidentado: '.$nombre_accidentado.  '<br> Domicilio del Accidentado: '.$domicilio_accidentado.  '<br> Teléfono del Accidentado: '.$telefono_accidentado.  '<br> Barrio del Accidentado: '.$barrio_accidentado.  '<br> Localidad del Accidentado: '.$localidad_accidentado.  '<br> Descripción del Accidente: '.$hecho_accidentado.  '<br> Servicio de Emergencia: '.$empresa_emergencia.  '<br> Diagnóstico: '.$diag_emergencia.  '<br> '; 



//para el envío en formato HTML 

$headers = "MIME-Version: 1.0\r\n"; 

$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 



//dirección del remitente 

//$headers .= "From:" & echo  $_POST["txtNombre"] & "<" & echo $_POST["txtEmail"] & ">\r\n"; 

$headers .= "From: sistemas@jaeccba.org.ar\r\n";

//direcciones que recibirán copia oculta 

$headers .= "Bcc: gabycanepa90@hotmail.com \r\n"; 



mail($destinatario,$asunto,$cuerpo,$headers);



// **************** fin envio de datos por correo





?>





<script language="javascript">

	ventana="denuncias.buscar.php";

	window.open(ventana,'_self');

</script>
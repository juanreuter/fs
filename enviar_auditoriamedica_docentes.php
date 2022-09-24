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

// ************* grabo los datos de auditoria medica en "denuncias_docentes" //  no le grabo datos de usuario y fecha de modificacion

mysqli_query($Link,"UPDATE denuncias_docentes SET Enviado_Auditoriamedica='1' WHERE ID=$id");

// ************* grabo los datos de auditoria medica en "auditoriamedica_docentes"

mysqli_query($Link,"INSERT INTO auditoriamedica_docentes (IDDenuncia, FechaEnvio,IDEstadoAuditoria, AudUsrAlta, AudFecAlta)	VALUES ($id, '$fecalta', '1', '$usralta', '$fecalta')");

$id_auditoriamedica = mysqli_insert_id($link);
// ************* envio por mail datos de la auditoria medica
$destinatario = "auditoria@jaeccba.org.ar"; 
//$destinatario = "lorena.abatidaga@gmail.com"; 
$asunto = "Sistema de Gestion - Auditoria Medica Salud Ocupacional"; 
$correo_alta_fecha = date("Y-m-d H:i:s");
//selecciono los datos de la denuncia que voy a enviar
$datos_denuncia = mysqli_fetch_assoc(mysqli_query($link,"SELECT ACC_Nombre, ACC_Domicilio, ACC_Telefono, ACC_Barrio, ACC_Localidad, DE_DiagnosticoPres, Nombre, Nombre_RL, Domicilio_RL, Telefono FROM denuncias_docentes, instituciones WHERE denuncias_docentes.DE_IDInstitucion=instituciones.ID AND denuncias_docentes.ID='" . $id ."'"));
$nombre_accidentado= $datos_denuncia["ACC_Nombre"];
$nombre_rl= $datos_denuncia["Nombre_RL"];
$correo_rl= $datos_denuncia["Domicilio_RL"];
$telefono_institucion= $datos_denuncia["Telefono"];
$domicilio_accidentado = $datos_denuncia["ACC_Domicilio"];
$telefono_accidentado = $datos_denuncia["ACC_Telefono"];
$barrio_accidentado = $datos_denuncia["ACC_Barrio"];
$localidad_accidentado = $datos_denuncia["ACC_Localidad"];
$diagnostico_accidentado = $datos_denuncia["DE_DiagnosticoPres"];
$id_institucion = $datos_denuncia["DE_IDInstitucion"];
$nombre_institucion = $datos_denuncia["Nombre"];



$cuerpo = 'Nº Denuncia: '.$id.  '<br>  Institución: '.$nombre_institucion.  '<br> Contacto con la Institución: '.$telefono_institucion.  '<br> Nombre del Accidentado: '.$nombre_accidentado.  '<br> Domicilio del Accidentado: '.$domicilio_accidentado.  '<br> Teléfono del Accidentado: '.$telefono_accidentado.  '<br> Barrio del Accidentado: '.$barrio_accidentado.  '<br> Localidad del Accidentado: '.$localidad_accidentado.  '<br> Diagnóstico Presuntivo: '.$diagnostico_accidentado. '<br>  Nombre Rep. Legal: '.$nombre_rl. '<br>  Correo Rep. Legal: '.$correo_rl. '<br>'; 


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

	ventana="denuncias_docentes.buscar.php";

	window.open(ventana,'_self');

</script>




<?php
//controlo acceso y auditoria//////////////////////////////////
session_start();
if(!$_SESSION["log"]) header("location:index.php");
$usrmodi=$_SESSION["Usuario"];
$fecmodi=date("Y-m-d H:i:s");
$usralta=$_SESSION["Usuario"];
$fecalta=date("Y-m-d H:i:s");
///////////////////////////////////////////////////


include ("funciones/conexion_bbdd.php");
$mensaje="";
$nrodni=trim($_REQUEST["dni"]);
$nrodni=str_replace(".","",$nrodni);
// si la institucion es JAEC selecciono alumno de cualquier institucion
if ($_SESSION["Institucion"]==14) {
// busco el alumno de cualquier Institucion por su nº de documento
$sql_alumnos = mysqli_query($link,"SELECT * FROM alumnos WHERE Documento='" . $nrodni. "'");
}
else
{

// busco el alumno de la institucion del usuario logueado por su nº de documento

$sql_alumnos = mysqli_query($link,"SELECT * FROM alumnos WHERE IDInstitucion='" .$_SESSION["Institucion"]."' and Documento='" . $nrodni. "'");

}





while($row=mysqli_fetch_assoc($sql_alumnos )) 

{

$strnombre=$row["Nombre"]; 

$strfechanac=$row["FechaNacimiento"]; 

$strdomicilio=$row["Domicilio"]; 

$strbarrio=$row["Barrio"]; 

$strlocalidad=$row["Localidad"]; 

$strtelefono=$row["Telefono"]; 

$strobrasocial=$row["ObraSocial"]; 

$strnroafiliado=$row["NroAfiliado"]; 

}

?>



<script language="javascript">

window.opener.frm.txtAccNombre.value="<?php echo $strnombre ?>";

window.opener.frm.txtAccDocumento.value="<?php echo $nrodni ?>";

window.opener.frm.txtAccFechaNac.value="<?php echo $strfechanac ?>";

window.opener.frm.txtAccDomicilio.value="<?php echo $strdomicilio ?>";

window.opener.frm.txtAccBarrio.value="<?php echo $strbarrio ?>";

window.opener.frm.cmbAccLocalidad.value="<?php echo $strlocalidad ?>";

window.opener.frm.txtAccTelefono.value="<?php echo $strtelefono ?>";

window.opener.frm.txtAccOS.value="<?php echo $strobrasocial ?>";

window.opener.frm.txtAccNAfiliado.value="<?php echo $strnroafiliado ?>";

if (window.opener.frm.txtAccNombre.value == "")

{

window.alert("NO SE ENCONTRO EL ALUMNO SOLICITADO")

}

window.close();

</script>






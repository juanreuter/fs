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
// si la institucion es JAEC selecciono personal de cualquier institucion
if ($_SESSION["Institucion"]==14) {
// busco el personal de cualquier Institucion por su nº de documento
$sql_personal = mysqli_query($link,"SELECT * FROM personal WHERE Documento='" . $nrodni. "'");
}
else
{
// busco el personal de la institucion del usuario logueado por su nº de documento
$sql_personal = mysqli_query($link,"SELECT * FROM personal WHERE IDInstitucion='" .$_SESSION["Institucion"]."' and Documento='" . $nrodni. "'");
}

while($row=mysqli_fetch_assoc($sql_personal)) 
{
$strnombre=$row["Nombre"]; 
$strfechanac=$row["FechaNacimiento"]; 
$strdomicilio=$row["Direccion"]; 
$strbarrio=$row["Barrio"]; 
$strlocalidad=$row["Localidad"]; 
$strtelefono=$row["Telefono"];
$strcargo=$row["Cargo"];

}

?>



<script language="javascript">

window.opener.frm.txtAccNombre.value="<?php echo $strnombre ?>";
window.opener.frm.txtAccDocumento.value="<?php echo $nrodni ?>";
window.opener.frm.txtAccFechaNac.value="<?php echo $strfechanac ?>";
window.opener.frm.txtAccDomicilio.value="<?php echo $strdomicilio ?>";
window.opener.frm.txtAccTelefono.value="<?php echo $strtelefono ?>";
window.opener.frm.txtAccCargo.value="<?php echo $strcargo?>";

if (window.opener.frm.txtAccNombre.value == "")
{
window.alert("NO SE ENCONTRO EL PERSONAL SOLICITADO, COMPLETE LOS DATOS")
}
window.close();
</script>






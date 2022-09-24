<?php
//controlo acceso y auditoria
session_start();
if(!$_SESSION["log"]) header("location:index.php");
$usrmodi=$_SESSION["Usuario"];
$fecmodi=date("Y-m-d H:i:s");
$usralta=$_SESSION["Usuario"];
$fecalta=date("Y-m-d H:i:s");
$id_usuario=$_SESSION["ID_Usuario"];
//base de datos
include ("funciones/conexion_bbdd.php");
// regla de negocios
$subsistemas_menu = mysqli_query($link,"SELECT ID,  seccion, Nombre, url, destacar FROM usuarios_subsistemas, subsistemas   WHERE usuarios_subsistemas.IDSubsistema = subsistemas.ID AND usuarios_subsistemas.IDUsuario=$id_usuario ORDER BY seccion, orden");
?>

<?php $strseccion = ""; ?> 
<?php 	while($row=mysqli_fetch_assoc($subsistemas_menu)) { ?>
	<?php if ($strseccion != $row["seccion"]) { ?> 
		<div class="intete"> <a class="linkdenuncias"><?php echo $row["seccion"]?></a> </div>
		<?php $strseccion = $row["seccion"]; ?>
	<?php }  ?>
<div class="intete" > <a href="<?php echo $row["url"]?>"><?php echo $row["Nombre"]?></a> <?php if ($row["destacar"] == 'S') echo "<b> ¡Nuevo! </b>" ?> </div>
<?php }?>



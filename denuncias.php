<<<<<<< HEAD
<?php
//error_reporting('0');

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
$mensaje="(*) Complete los datos";
$de_institucion = $_POST["cmbDEInst"];
$acc_categoria = $_POST["cmbCategoria"];
$acc_nombre = $_POST["txtAccNombre"];
$acc_tipodoc = $_POST["cmbAccTipoDoc"];
$acc_documento = $_POST["txtAccDocumento"];
$acc_fechanac = $_POST["txtAccFechaNac"];
$acc_domicilio = $_POST["txtAccDomicilio"];
$acc_barrio = $_POST["txtAccBarrio"];
$acc_provincia = $_POST["cmbAccProvincia"];
$acc_localidad = $_POST["cmbAccLocalidad"];
$acc_telefono = $_POST["txtAccTelefono"];
$acc_obrasocial = $_POST["txtAccOS"];
$acc_nafiliado = $_POST["txtAccNAfiliado"];
$da_fecha = $_POST["txtDAFecha"];
$da_hora = $_POST["txtDAHora"];
$da_horario = $_POST["r_DAHorario"];
$da_detalleactividad = $_POST["txtDAActividad"];
$da_actividad = $_POST["r_DAActividad"];
$da_hecho = $_POST["txtDAHecho"];
$l_lugar = $_POST["r_LLugar"];
$l_espaciofisico = $_POST["cmbLEFisico"];
$l_responsables = $_POST["txtLResponsable"];
$l_testigos = $_POST["txtLTestigos"];

$id=$_REQUEST["id_den"];

/************************************************************************************************************************
ACCIONES
************************************************************************************************************************/

if($_POST["action"] == "G" && $id!="")
{

	if($de_institucion!="" && $acc_documento!="" && $acc_nombre!="" && $da_fecha!="")
	{
		mysqli_query($link,"UPDATE denuncias SET
						DE_IDInstitucion = $de_institucion,
						ACC_Nombre = '$acc_nombre',
						ACC_TipoDoc = 1,
						ACC_Documento = '$acc_documento',
						ACC_FechaNac = '$acc_fechanac',
						ACC_Domicilio = '$acc_domicilio',
						ACC_Barrio = '$acc_barrio',
						ACC_IDProvincia = 4,
						ACC_Localidad = '$acc_localidad',
						ACC_Telefono = '$acc_telefono',
						ACC_ObraSocial = '$acc_obrasocial',
						ACC_NAfiliado = '$acc_nafiliado',
						DA_Fecha = '$da_fecha',
						DA_Hora = '$da_hora',
						DA_Horario = '$da_horario',
						DA_DetalleActividad = '$da_detalleactividad',
						DA_Actividad = '$da_actividad',
						DA_Hecho = '$da_hecho',
						L_Lugar = '$l_lugar',
						L_EspacioFisico = $l_espaciofisico,
						L_Responsables = '$l_responsables',
						L_Testigos = '$l_testigos',
						id_categoria=$acc_categoria,
						AudUsrModi='$usrmodi',
						AudFecModi='$fecmodi'
					 WHERE ID = $id"); // removed $link raghvendra on 14-03-2020
		$mensaje = 	"Denuncia actualizada";
	}
	else
	{
		$mensaje = 	"(*) Complete los datos"; // added (*) raghvendra on 14-03-2020
	}
}

if($_POST["action"] == "G" && $id=="")
{
  
	if($de_institucion!="" && $acc_documento!="" && $acc_nombre!=""  && $da_fecha!="")
  {  
    
		 mysqli_query($link,"INSERT INTO denuncias (DE_IDInstitucion, ACC_Nombre, ACC_TipoDoc, ACC_Documento, ACC_FechaNac, ACC_Domicilio, ACC_Barrio, ACC_IDProvincia, ACC_Localidad, ACC_Telefono, ACC_ObraSocial, ACC_NAfiliado, DA_Fecha, DA_Hora, DA_Horario, DA_DetalleActividad, DA_Actividad, DA_Hecho, L_Lugar, L_EspacioFisico, L_Responsables, L_Testigos, AudUsrAlta, AudFecAlta, AudUsrModi, AudFecModi, id_categoria, vigente ,Enviado_Seguro) 

					VALUES ($de_institucion, '$acc_nombre', 1, '$acc_documento', '$acc_fechanac', '$acc_domicilio', '$acc_barrio', 4, '$acc_localidad', '$acc_telefono', '$acc_obrasocial', '$acc_nafiliado','$da_fecha', '$da_hora', '$da_horario', '$da_detalleactividad', '$da_actividad', '$da_hecho', '$l_lugar', $l_espaciofisico, '$l_responsables', '$l_testigos', '$usralta', '$fecalta', '$usrmodi', '$fecmodi', $acc_categoria, '1' ,0)");//added Enviado_Seguro raghvendra on 14-03-2020
               $id = mysqli_insert_id($link); // removed $$link aded $link raghvendra on 14-03-2020
          
     
		// inserto datos del alumno en la tabla ALUMNOS si no EXISTE
		$acc_documento = str_replace(".","",$acc_documento);
		$sql_alumnos = mysqli_fetch_assoc(mysqli_query($link,"SELECT count(*) as cantidad FROM alumnos WHERE IDInstitucion=$de_institucion AND Documento='$acc_documento' AND Nombre='$acc_nombre'"));

		if ($sql_alumnos["cantidad"] < 1) 

		{

		mysqli_query($link,"INSERT INTO alumnos (IDInstitucion, Nombre, Documento, FechaNacimiento, Domicilio, Barrio, Localidad, Telefono, ObraSocial, NroAfiliado, AudUsrAlta, AudFecAlta, AudUsrModi, AudFecModi, vigente)

					VALUES ($de_institucion, '$acc_nombre', '$acc_documento', '$acc_fechanac', '$acc_domicilio', '$acc_barrio', '$acc_localidad', '$acc_telefono', '$acc_obrasocial', '$acc_nafiliado', '$usralta', '$fecalta', '$usrmodi', '$fecmodi', '1')");

		}			

		// ************* envio por mail datos de la nueva denuncia

		$destinatario = "denuncias@jaeccba.org.ar"; 
		$asunto = "Sistema de Gesti�n - Nueva Denuncia"; 
		$correo_alta_persona = $_SESSION["Nombre_Usuario"];
		$correo_alta_fecha = date("Y-m-d H:i:s");
		$correo_id_denuncia = date("Y-m-d H:i:s");
	

		// selecciono el nombre de la Institucion

		$nombre_institucion = mysqli_fetch_assoc(mysqli_query($link,"SELECT Nombre, Telefono FROM instituciones WHERE ID='" . $_SESSION["Institucion"]."'"));

		$correo_institucion = $nombre_institucion["Nombre"];
		$correo_telefono = $nombre_institucion["Telefono"];

		$cuerpo = 'N� Denuncia: '.$id.  '<br> Usuario_Alta: '.$correo_alta_persona.  '<br> Fecha_Alta: '.$correo_alta_fecha.  '<br> Instituci�n: '.$correo_institucion.  '<br>   con la Instituci�n: '.$correo_telefono.  '<br> Nombre del Accidentado: '.$acc_nombre.  '<br> Personal Responsable: '.$l_responsables.  '<br> <a href="http://www.jaeccba.org.ar/fs">Acceda al sistema para m�s detalles</a>'; 


		//para el env�o en formato HTML 
		$headers = "MIME-Version: 1.0\r\n"; 
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
	

		//direcci�n del remitente 

		$headers .= "From: sistemas@jaeccba.org.ar\r\n";

		//direcciones que recibir�n copia oculta 
		//$headers .= "Bcc: nasifiruela@arnet.com.ar\r\n"; 
		mail($destinatario,$asunto,$cuerpo,$headers);

		// **************** fin envio de datos por correo

		$mensaje = 	"Denuncia registrada";
	}

	else

	{

		$mensaje = 	"(*) Complete los datos";

	}

}

if($_POST["action"] == "E" && $id!="")

{
	mysqli_query($link,"UPDATE denuncias SET vigente='0', AudUsrModi='$usrmodi', AudFecModi='$fecmodi' WHERE ID=$id");
	mysqli_query($link,"UPDATE denuncias_emergencias SET vigente='0', AudUsrModi='$usrmodi', AudFecModi='$fecmodi' WHERE IDDenuncia=$id");
	mysqli_query($link,"UPDATE denuncias_derivaciones SET vigente='0', AudUsrModi='$usrmodi', AudFecModi='$fecmodi' WHERE IDDenuncia=$id");

	$de_institucion = "";
	$acc_categoria = "";
	$acc_nombre = "";
	$acc_tipodoc = "";
	$acc_documento = "";
	$acc_fechanac = "";
	$acc_domicilio = "";
	$acc_barrio = "";
	$acc_provincia = "";
	$acc_localidad = "";
	$acc_telefono = "";
	$acc_obrasocial = "";
	$acc_nafiliado = "";
	$da_fecha = "";
	$da_hora = "";
	$da_horario = "";
	$da_detallectividad = "";
	$da_actividad = "";
	$da_hecho = "";
	$l_lugar = "";
	$l_espaciofisico = "";
	$l_responsables = "";
	$l_testigos = "";
	$id = "";

	$mensaje = 	"Denuncia eliminada";
}

if($id != "")
{
	$sql = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM denuncias WHERE vigente='1' AND ID=$id"));
	$de_institucion = $sql["DE_IDInstitucion"];
	$acc_categoria = $sql["id_categoria"];
	$acc_nombre = $sql["ACC_Nombre"];
	$acc_tipodoc = $sql["ACC_TipoDoc"];
	$acc_documento = $sql["ACC_Documento"];
	$acc_fechanac = $sql["ACC_FechaNac"];
	$acc_domicilio = $sql["ACC_Domicilio"];
	$acc_barrio = $sql["ACC_Barrio"];
	$acc_provincia = $sql["ACC_IDProvincia"];
	$acc_localidad = $sql["ACC_Localidad"];
	$acc_telefono = $sql["ACC_Telefono"];
	$acc_obrasocial = $sql["ACC_ObraSocial"];
	$acc_nafiliado = $sql["ACC_NAfiliado"];
	$da_fecha = $sql["DA_Fecha"];
	$da_hora = $sql["DA_Hora"];
	$da_horario = $sql["DA_Horario"];
	$da_detallectividad = $sql["DA_DetalleActividad"];
	$da_actividad = $sql["DA_Actividad"];
	$da_hecho = $sql["DA_Hecho"];
	$l_lugar = $sql["L_Lugar"];
	$l_espaciofisico = $sql["L_EspacioFisico"];
	$l_responsables = $sql["L_Responsables"];
	$l_testigos = $sql["L_Testigos"];
}

//tabla tipo  instituciones
$de_inst=mysqli_query($link,"SELECT * FROM instituciones  WHERE vigente='1' ORDER BY nombre");
$de_inst_id=mysqli_query($link,"SELECT * FROM instituciones  WHERE vigente='1' AND ID='" .$_SESSION["Institucion"]. "' ORDER BY nombre");
//$acc_prv=mysql_query("SELECT * FROM provincias  ORDER BY nombre", $link);
$esp_fisicos=mysqli_query($link,"SELECT * FROM espacios_fisicos where vigente='1' ORDER BY descripcion");
$acc_cat=mysqli_query($link,"SELECT * FROM denuncias_categorias  ORDER BY id_categoria");

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
</head>
<body>
<script language="javascript" src="calendar/calendar.js"></script>
<script language="javascript">
function BuscarAlumno()
{
intDNI=window.frm.txtAccDocumento.value;
url="buscar_alumnos.php?dni=" + intDNI;
window.open(url,'_blank','status=0,toolbar=0,width=10,height=10')
}
function emergencias (id_emer)
{
url="denuncias.emergencias.php?id_den=" + id_emer;
window.open(url,'_self');
}
function derivaciones (id_deri)
{
url="denuncias.derivaciones.php?id_denuncia=" + id_deri;
window.open(url,'_self');
}

function eliminar()
{
	if (confirm('�Est� seguro de eliminar la denuncia?'))
	{
		frm.action.value='E';
		frm.submit();
	}	 
}
function guardar()
{
 
	if (frm.txtAccDocumento.value == "" || frm.txtAccNombre.value == "" || frm.txtDAFecha.value == "" )
	{
	window.alert("DNI, NOMBRE y FECHA DEL ACCIDENTE son datos obligatorios!")
	frm.txtAccDocumento.focus();
	}	
	else
	{
		frm.action.value='G';
		frm.submit();
	}	 
}


</script>

<div id="Cabecera">
  <?php include("top.php"); ?>
</div>
<div id="Menin">
  <div class="row">
    <?php include("menu.php"); ?>
    <div class="clear"> </div>
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
	<img src="images/map.png" width="30" height="36" border="0"> <b>Denuncia de Accidente - Alta y Modificaci�n</b>
	</div>
    
	<div class="clear2"> </div>
    <div >

      <form name="frm" id="frm" action="" method="post">

	  <!-- inicio tabla de datos -->
	  <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <!-- SI LA INSTITUCION ES JAEC LISTO TODAS-->
          <?php if ($_SESSION["Institucion"]==14) {?>
          <td width="48%" colspan="2" >Indique la Intituci�n:<br>
              <select name="cmbDEInst" id="cmbDEInst"  style="width:500px">
                <?php while($row=mysqli_fetch_assoc($de_inst)) { ?>
                <option value="<?php echo $row["ID"]?>" <?php if($row["ID"]==$de_institucion) echo "selected"?>><?php echo $row["Nombre"]?></option>
                <?php } ?>
              </select>
          </td>
          <?php } ?>
          <!-- SI LA INSTITUCION NO ES JAEC LISTO  SOLO LA INSTITUCION DEL USUARIO-->
          <?php if ($_SESSION["Institucion"]!=14) {?>
          <td width="39%" colspan="2" ><select name="cmbDEInst" id="cmbDEInst"  style="width:500px">
              <?php while($row=mysqli_fetch_assoc($de_inst_id)) { ?>
              <option value="<?php echo $row["ID"]?>" <?php if($row["ID"]==$de_institucion) echo "selected"?>><?php echo $row["Nombre"]?></option>
              <?php } ?>
            </select>
          </td>
          <?php } ?>
        </tr>
        <tr>
          <td >Gravedad del Accidente: <br>
              <select name="cmbCategoria" id="cmbCategoria" style="width:150px ">
                <?php while($row=mysqli_fetch_assoc($acc_cat)) { ?>
                <option value="<?php echo $row["id_categoria"]?>" <?php if($row["id_categoria"]==$acc_categoria) echo "selected"?>><?php echo $row["categoria"]?></option>
                <?php } ?>
              </select>
          </td>
          <td valign="middle" >D N I: <br>
              <input name="txtAccDocumento" id="txtAccDocumento" value="<?php echo $acc_documento ?>" type="text" style="width:150px "/>
            <a href="javascript:BuscarAlumno()"> <img src="images/buscar.jpg" border="0"></a></td>
        </tr>
        <tr>
          <td colspan="2" >Nombre y Apellido del Alumno Accidentado: <br>
              <input id="txtAccNombre" name="txtAccNombre" type="text" value="<?php echo $acc_nombre ?>" size="70" maxlength="70" />
          </td>
        </tr>
        <tr>
          <td colspan="2" >Fecha de nacimiento<br>
              <input id="txtAccFechaNac" name="txtAccFechaNac" type="text" value="<?php echo $acc_fechanac ?>" style="width:150px" />
          </td>
        </tr>
        <tr>
          <td colspan="2" >Domicilio<br>
              <input id="txtAccDomicilio" name="txtAccDomicilio" type="text" value="<?php echo $acc_domicilio ?>"  size="70" maxlength="70" />
          </td>
        </tr>
        <tr>
          <td colspan="2" >Barrio:<br>
              <input id="txtAccBarrio" name="txtAccBarrio" type="text" value="<?php echo $acc_barrio ?>" size="70" maxlength="70"/>
          </td>
        </tr>
        <tr>
          <td colspan="2" >Localidad:<br>
              <input name="cmbAccLocalidad" type="text" id="cmbAccLocalidad" value="<?php echo $acc_localidad ?>" size="70" maxlength="70" />
          </td>
        </tr>
        <tr>
          <td colspan="2" >Tel�fono:<br>
              <input id="txtAccTelefono" name="txtAccTelefono" type="text" value="<?php echo $acc_telefono ?>" />
          </td>
        </tr>
        <tr>
          <td colspan="2" >Obra Social:<br>
              <input id="txtAccOS" name="txtAccOS" type="text" value="<?php echo $acc_obrasocial ?>" size="70" maxlength="70" />
          </td>
        </tr>
        <tr>
          <td colspan="2" >N�mero de Afiliado:<br>
              <input id="txtAccNAfiliado" name="txtAccNAfiliado" type="text" value="<?php echo $acc_nafiliado ?>" />
          </td>
        </tr>
        <tr>
          <td > Fecha del Accidente:<br>
              <?php require_once('calendar/classes/tc_calendar.php'); ?>
              <?php 
			$myCalendar = new tc_calendar("txtDAFecha", true, false);
			$myCalendar->setIcon("calendar/images/iconCalendar.gif");
			if ($da_fecha!='')
			{
			$myCalendar->setDateYMD($da_fecha);
			}
			else
			{
			$myCalendar->setDate(date('d'), date('m'), date('Y'));
			}
			$myCalendar->setPath("calendar/");
			$myCalendar->setYearInterval(2009, 2022);
			$myCalendar->dateAllow('2009-01-01', '2022-12-31');
			$myCalendar->setDateFormat('j F Y');
			$myCalendar->setAlignment('left', 'bottom');
			$myCalendar->writeScript();
			?>
          </td>
          <td >Hora del Accidente:<br>
              <input id="txtDAHora" name="txtDAHora" type="text" value="<?php echo $da_hora ?>"/></td>
        </tr>
        <tr>
          <td colspan="2" >Horario:<br>
              <table border="0" cellpadding="0" cellspacing="0" >
                <tr>
                  <td><input type="radio" id="r_DAHorario" name="r_DAHorario" value="HP" <?php if($da_horario=="HP") echo "checked"?> />
                  </td>
                  <td><label>Programado</label></td>
                  <td width="20">&nbsp;</td>
                  <td><input type="radio" id="r_DAHorario" name="r_DAHorario" value="CT" <?php if($da_horario=="CT") echo "checked"?>/>
                  </td>
                  <td><label>Contra turno</label></td>
                  <td>&nbsp;</td>
                  <td><input type="radio" id="r_DAHorario" name="r_DAHorario" value="HE" <?php if($da_horario=="HE") echo "checked"?> />
                  </td>
                  <td><label>Excepcional</label></td>
                </tr>
            </table></td>
        </tr>
        <tr>
          <td colspan="2" >Detalles de la Actividad:<br>
              <textarea name="txtDAActividad"  id="txtDAActividad" ><?php echo $da_detalleactividad ?></textarea>
          </td>
        </tr>
        <tr>
          <td colspan="2" >Actividad:<br>
              <table border="0" cellpadding="0" cellspacing="0" >
                <tr>
                  <td><input type="radio" id="r_DAActividad" name="r_DAActividad" value="AH" <?php if($da_actividad=="AH") echo "checked"?> />
                  </td>
                  <td><label>Habitual</label></td>
                  <td width="20">&nbsp;</td>
                  <td><input type="radio" id="r_DAActividad" name="r_DAActividad" value="SP" <?php if($da_actividad=="SP") echo "checked"?>/>
                  </td>
                  <td><label>Programada</label></td>
                  <td>&nbsp;</td>
                  <td><input type="radio" id="r_DAActividad" name="r_DAActividad" value="AE" <?php if($da_actividad=="AE") echo "checked"?> />
                  </td>
                  <td><label>Extra programada</label></td>
                  <td width="20">&nbsp;</td>
                  <td><input type="radio" id="r_DAActividad" name="r_DAActividad" value="O" <?php if($da_actividad=="O") echo "checked"?> />
                  </td>
                  <td><label>Otras</label></td>
                </tr>
            </table></td>
        </tr>
        <tr>
          <td colspan="2" >Hecho o Circunstancia 
            que produce el accidente:<br>
                          <textarea name="txtDAHecho" id="txtDAHecho" ><?php echo $da_hecho ?></textarea>
          </td>
        </tr>
        <tr>
          <td colspan="2" ><table border="0" cellpadding="0" cellspacing="0" >
              <tr>
                <td><input type="radio" id="r_LLugar" name="r_LLugar" value="AI" <?php if($l_lugar=="AI") echo "checked"?> />
                </td>
                <td><label>En de la instituci�n (D)</label></td>
                <td width="20">&nbsp;</td>
                <td><input type="radio" id="r_LLugar" name="r_LLugar" value="FI" <?php if($l_lugar=="FI") echo "checked"?>/>
                </td>
                <td><label>Fuera de la instituci�n (F)</label></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td colspan="2" >Espacio f�sico:<br>
              <select name="cmbLEFisico" id="cmbLEFisico" >
                <?php while($row=mysqli_fetch_assoc($esp_fisicos)) { ?>
                <option value="<?php echo $row["ID"]?>" <?php if($row["ID"]==$l_espaciofisico) echo "selected"?>><?php echo $row["Descripcion"]?> - <?php echo $row["Lugar"]?></option>
                <?php } ?>
              </select>
          </td>
        </tr>
        <tr>
          <td colspan="2" >Personal responsable:<br>
              <textarea name="txtLResponsable"  id="txtLResponsable" ><?php echo $l_responsables ?></textarea>
          </td>
        </tr>
        <tr>
          <td colspan="2" >Testigos:<br>
              <textarea name="txtLTestigos" id="txtLTestigos" ><?php echo $l_testigos ?></textarea></td>
        </tr>
        <tr>
          <td align="center" colspan="2" ><h1 style="color:red;"><b><?php echo $mensaje ?></b></h1></td>
        </tr>
        <tr>
          <td align="center" colspan="2"><?php if ($id !="" ){?>
              <input name="Submit4" type="button"  value="DERIVACIONES" onClick="derivaciones('<?php echo $id?>');" />
            &nbsp;
            <input name="Submit1" type="button"  value="EMERGENCIA" onClick="emergencias('<?php echo $id?>');" />
            <?php }?>
            &nbsp;
            <input name="Submit3" type="button" value="GUARDAR" onClick="guardar();"  />
            &nbsp;
            <input name="Submit" type="button"  value="ELIMINAR" onClick="eliminar();" />
            &nbsp;
            <input name="Submit2" type="button" value="NUEVA DENUNCIA" onClick="window.open('denuncias.php','_self');" />
          </td>
        </tr>
      </table>
	  <input type="hidden" name="action" id="action">
		<input name="id_den" type="hidden" id="id_den" value="<?php echo $id?>">

	  </form>
      <div class="clear2"> </div>
      <div class="clear2"> </div>
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
//error_reporting('0');

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
$mensaje="(*) Complete los datos";
$de_institucion = $_POST["cmbDEInst"];
$acc_categoria = $_POST["cmbCategoria"];
$acc_nombre = $_POST["txtAccNombre"];
$acc_tipodoc = $_POST["cmbAccTipoDoc"];
$acc_documento = $_POST["txtAccDocumento"];
$acc_fechanac = $_POST["txtAccFechaNac"];
$acc_domicilio = $_POST["txtAccDomicilio"];
$acc_barrio = $_POST["txtAccBarrio"];
$acc_provincia = $_POST["cmbAccProvincia"];
$acc_localidad = $_POST["cmbAccLocalidad"];
$acc_telefono = $_POST["txtAccTelefono"];
$acc_obrasocial = $_POST["txtAccOS"];
$acc_nafiliado = $_POST["txtAccNAfiliado"];
$da_fecha = $_POST["txtDAFecha"];
$da_hora = $_POST["txtDAHora"];
$da_horario = $_POST["r_DAHorario"];
$da_detalleactividad = $_POST["txtDAActividad"];
$da_actividad = $_POST["r_DAActividad"];
$da_hecho = $_POST["txtDAHecho"];
$l_lugar = $_POST["r_LLugar"];
$l_espaciofisico = $_POST["cmbLEFisico"];
$l_responsables = $_POST["txtLResponsable"];
$l_testigos = $_POST["txtLTestigos"];

$id=$_REQUEST["id_den"];

/************************************************************************************************************************
ACCIONES
************************************************************************************************************************/

if($_POST["action"] == "G" && $id!="")
{

	if($de_institucion!="" && $acc_documento!="" && $acc_nombre!="" && $da_fecha!="")
	{
		mysqli_query($link,"UPDATE denuncias SET
						DE_IDInstitucion = $de_institucion,
						ACC_Nombre = '$acc_nombre',
						ACC_TipoDoc = 1,
						ACC_Documento = '$acc_documento',
						ACC_FechaNac = '$acc_fechanac',
						ACC_Domicilio = '$acc_domicilio',
						ACC_Barrio = '$acc_barrio',
						ACC_IDProvincia = 4,
						ACC_Localidad = '$acc_localidad',
						ACC_Telefono = '$acc_telefono',
						ACC_ObraSocial = '$acc_obrasocial',
						ACC_NAfiliado = '$acc_nafiliado',
						DA_Fecha = '$da_fecha',
						DA_Hora = '$da_hora',
						DA_Horario = '$da_horario',
						DA_DetalleActividad = '$da_detalleactividad',
						DA_Actividad = '$da_actividad',
						DA_Hecho = '$da_hecho',
						L_Lugar = '$l_lugar',
						L_EspacioFisico = $l_espaciofisico,
						L_Responsables = '$l_responsables',
						L_Testigos = '$l_testigos',
						id_categoria=$acc_categoria,
						AudUsrModi='$usrmodi',
						AudFecModi='$fecmodi'
					 WHERE ID = $id"); // removed $link raghvendra on 14-03-2020
		$mensaje = 	"Denuncia actualizada";
	}
	else
	{
		$mensaje = 	"(*) Complete los datos"; // added (*) raghvendra on 14-03-2020
	}
}

if($_POST["action"] == "G" && $id=="")
{
  
	if($de_institucion!="" && $acc_documento!="" && $acc_nombre!=""  && $da_fecha!="")
  {  
    
		 mysqli_query($link,"INSERT INTO denuncias (DE_IDInstitucion, ACC_Nombre, ACC_TipoDoc, ACC_Documento, ACC_FechaNac, ACC_Domicilio, ACC_Barrio, ACC_IDProvincia, ACC_Localidad, ACC_Telefono, ACC_ObraSocial, ACC_NAfiliado, DA_Fecha, DA_Hora, DA_Horario, DA_DetalleActividad, DA_Actividad, DA_Hecho, L_Lugar, L_EspacioFisico, L_Responsables, L_Testigos, AudUsrAlta, AudFecAlta, AudUsrModi, AudFecModi, id_categoria, vigente ,Enviado_Seguro) 

					VALUES ($de_institucion, '$acc_nombre', 1, '$acc_documento', '$acc_fechanac', '$acc_domicilio', '$acc_barrio', 4, '$acc_localidad', '$acc_telefono', '$acc_obrasocial', '$acc_nafiliado','$da_fecha', '$da_hora', '$da_horario', '$da_detalleactividad', '$da_actividad', '$da_hecho', '$l_lugar', $l_espaciofisico, '$l_responsables', '$l_testigos', '$usralta', '$fecalta', '$usrmodi', '$fecmodi', $acc_categoria, '1' ,0)");//added Enviado_Seguro raghvendra on 14-03-2020
               $id = mysqli_insert_id($link); // removed $$link aded $link raghvendra on 14-03-2020
          
     
		// inserto datos del alumno en la tabla ALUMNOS si no EXISTE
		$acc_documento = str_replace(".","",$acc_documento);
		$sql_alumnos = mysqli_fetch_assoc(mysqli_query($link,"SELECT count(*) as cantidad FROM alumnos WHERE IDInstitucion=$de_institucion AND Documento='$acc_documento' AND Nombre='$acc_nombre'"));

		if ($sql_alumnos["cantidad"] < 1) 

		{

		mysqli_query($link,"INSERT INTO alumnos (IDInstitucion, Nombre, Documento, FechaNacimiento, Domicilio, Barrio, Localidad, Telefono, ObraSocial, NroAfiliado, AudUsrAlta, AudFecAlta, AudUsrModi, AudFecModi, vigente)

					VALUES ($de_institucion, '$acc_nombre', '$acc_documento', '$acc_fechanac', '$acc_domicilio', '$acc_barrio', '$acc_localidad', '$acc_telefono', '$acc_obrasocial', '$acc_nafiliado', '$usralta', '$fecalta', '$usrmodi', '$fecmodi', '1')");

		}			

		// ************* envio por mail datos de la nueva denuncia

		$destinatario = "denuncias@jaeccba.org.ar"; 
		$asunto = "Sistema de Gesti�n - Nueva Denuncia"; 
		$correo_alta_persona = $_SESSION["Nombre_Usuario"];
		$correo_alta_fecha = date("Y-m-d H:i:s");
		$correo_id_denuncia = date("Y-m-d H:i:s");
	

		// selecciono el nombre de la Institucion

		$nombre_institucion = mysqli_fetch_assoc(mysqli_query($link,"SELECT Nombre, Telefono FROM instituciones WHERE ID='" . $_SESSION["Institucion"]."'"));

		$correo_institucion = $nombre_institucion["Nombre"];
		$correo_telefono = $nombre_institucion["Telefono"];

		$cuerpo = 'N� Denuncia: '.$id.  '<br> Usuario_Alta: '.$correo_alta_persona.  '<br> Fecha_Alta: '.$correo_alta_fecha.  '<br> Instituci�n: '.$correo_institucion.  '<br>   con la Instituci�n: '.$correo_telefono.  '<br> Nombre del Accidentado: '.$acc_nombre.  '<br> Personal Responsable: '.$l_responsables.  '<br> <a href="http://www.jaeccba.org.ar/fs">Acceda al sistema para m�s detalles</a>'; 


		//para el env�o en formato HTML 
		$headers = "MIME-Version: 1.0\r\n"; 
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
	

		//direcci�n del remitente 

		$headers .= "From: sistemas@jaeccba.org.ar\r\n";

		//direcciones que recibir�n copia oculta 
		//$headers .= "Bcc: nasifiruela@arnet.com.ar\r\n"; 
		mail($destinatario,$asunto,$cuerpo,$headers);

		// **************** fin envio de datos por correo

		$mensaje = 	"Denuncia registrada";
	}

	else

	{

		$mensaje = 	"(*) Complete los datos";

	}

}

if($_POST["action"] == "E" && $id!="")

{
	mysqli_query($link,"UPDATE denuncias SET vigente='0', AudUsrModi='$usrmodi', AudFecModi='$fecmodi' WHERE ID=$id");
	mysqli_query($link,"UPDATE denuncias_emergencias SET vigente='0', AudUsrModi='$usrmodi', AudFecModi='$fecmodi' WHERE IDDenuncia=$id");
	mysqli_query($link,"UPDATE denuncias_derivaciones SET vigente='0', AudUsrModi='$usrmodi', AudFecModi='$fecmodi' WHERE IDDenuncia=$id");

	$de_institucion = "";
	$acc_categoria = "";
	$acc_nombre = "";
	$acc_tipodoc = "";
	$acc_documento = "";
	$acc_fechanac = "";
	$acc_domicilio = "";
	$acc_barrio = "";
	$acc_provincia = "";
	$acc_localidad = "";
	$acc_telefono = "";
	$acc_obrasocial = "";
	$acc_nafiliado = "";
	$da_fecha = "";
	$da_hora = "";
	$da_horario = "";
	$da_detallectividad = "";
	$da_actividad = "";
	$da_hecho = "";
	$l_lugar = "";
	$l_espaciofisico = "";
	$l_responsables = "";
	$l_testigos = "";
	$id = "";

	$mensaje = 	"Denuncia eliminada";
}

if($id != "")
{
	$sql = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM denuncias WHERE vigente='1' AND ID=$id"));
	$de_institucion = $sql["DE_IDInstitucion"];
	$acc_categoria = $sql["id_categoria"];
	$acc_nombre = $sql["ACC_Nombre"];
	$acc_tipodoc = $sql["ACC_TipoDoc"];
	$acc_documento = $sql["ACC_Documento"];
	$acc_fechanac = $sql["ACC_FechaNac"];
	$acc_domicilio = $sql["ACC_Domicilio"];
	$acc_barrio = $sql["ACC_Barrio"];
	$acc_provincia = $sql["ACC_IDProvincia"];
	$acc_localidad = $sql["ACC_Localidad"];
	$acc_telefono = $sql["ACC_Telefono"];
	$acc_obrasocial = $sql["ACC_ObraSocial"];
	$acc_nafiliado = $sql["ACC_NAfiliado"];
	$da_fecha = $sql["DA_Fecha"];
	$da_hora = $sql["DA_Hora"];
	$da_horario = $sql["DA_Horario"];
	$da_detallectividad = $sql["DA_DetalleActividad"];
	$da_actividad = $sql["DA_Actividad"];
	$da_hecho = $sql["DA_Hecho"];
	$l_lugar = $sql["L_Lugar"];
	$l_espaciofisico = $sql["L_EspacioFisico"];
	$l_responsables = $sql["L_Responsables"];
	$l_testigos = $sql["L_Testigos"];
}

//tabla tipo  instituciones
$de_inst=mysqli_query($link,"SELECT * FROM instituciones  WHERE vigente='1' ORDER BY nombre");
$de_inst_id=mysqli_query($link,"SELECT * FROM instituciones  WHERE vigente='1' AND ID='" .$_SESSION["Institucion"]. "' ORDER BY nombre");
//$acc_prv=mysql_query("SELECT * FROM provincias  ORDER BY nombre", $link);
$esp_fisicos=mysqli_query($link,"SELECT * FROM espacios_fisicos where vigente='1' ORDER BY descripcion");
$acc_cat=mysqli_query($link,"SELECT * FROM denuncias_categorias  ORDER BY id_categoria");

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
</head>
<body>
<script language="javascript" src="calendar/calendar.js"></script>
<script language="javascript">
function BuscarAlumno()
{
intDNI=window.frm.txtAccDocumento.value;
url="buscar_alumnos.php?dni=" + intDNI;
window.open(url,'_blank','status=0,toolbar=0,width=10,height=10')
}
function emergencias (id_emer)
{
url="denuncias.emergencias.php?id_den=" + id_emer;
window.open(url,'_self');
}
function derivaciones (id_deri)
{
url="denuncias.derivaciones.php?id_denuncia=" + id_deri;
window.open(url,'_self');
}

function eliminar()
{
	if (confirm('�Est� seguro de eliminar la denuncia?'))
	{
		frm.action.value='E';
		frm.submit();
	}	 
}
function guardar()
{
 
	if (frm.txtAccDocumento.value == "" || frm.txtAccNombre.value == "" || frm.txtDAFecha.value == "" )
	{
	window.alert("DNI, NOMBRE y FECHA DEL ACCIDENTE son datos obligatorios!")
	frm.txtAccDocumento.focus();
	}	
	else
	{
		frm.action.value='G';
		frm.submit();
	}	 
}


</script>

<div id="Cabecera">
  <?php include("top.php"); ?>
</div>
<div id="Menin">
  <div class="row">
    <?php include("menu.php"); ?>
    <div class="clear"> </div>
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
	<img src="images/map.png" width="30" height="36" border="0"> <b>Denuncia de Accidente - Alta y Modificaci�n</b>
	</div>
    
	<div class="clear2"> </div>
    <div >

      <form name="frm" id="frm" action="" method="post">

	  <!-- inicio tabla de datos -->
	  <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <!-- SI LA INSTITUCION ES JAEC LISTO TODAS-->
          <?php if ($_SESSION["Institucion"]==14) {?>
          <td width="48%" colspan="2" >Indique la Intituci�n:<br>
              <select name="cmbDEInst" id="cmbDEInst"  style="width:500px">
                <?php while($row=mysqli_fetch_assoc($de_inst)) { ?>
                <option value="<?php echo $row["ID"]?>" <?php if($row["ID"]==$de_institucion) echo "selected"?>><?php echo $row["Nombre"]?></option>
                <?php } ?>
              </select>
          </td>
          <?php } ?>
          <!-- SI LA INSTITUCION NO ES JAEC LISTO  SOLO LA INSTITUCION DEL USUARIO-->
          <?php if ($_SESSION["Institucion"]!=14) {?>
          <td width="39%" colspan="2" ><select name="cmbDEInst" id="cmbDEInst"  style="width:500px">
              <?php while($row=mysqli_fetch_assoc($de_inst_id)) { ?>
              <option value="<?php echo $row["ID"]?>" <?php if($row["ID"]==$de_institucion) echo "selected"?>><?php echo $row["Nombre"]?></option>
              <?php } ?>
            </select>
          </td>
          <?php } ?>
        </tr>
        <tr>
          <td >Gravedad del Accidente: <br>
              <select name="cmbCategoria" id="cmbCategoria" style="width:150px ">
                <?php while($row=mysqli_fetch_assoc($acc_cat)) { ?>
                <option value="<?php echo $row["id_categoria"]?>" <?php if($row["id_categoria"]==$acc_categoria) echo "selected"?>><?php echo $row["categoria"]?></option>
                <?php } ?>
              </select>
          </td>
          <td valign="middle" >D N I: <br>
              <input name="txtAccDocumento" id="txtAccDocumento" value="<?php echo $acc_documento ?>" type="text" style="width:150px "/>
            <a href="javascript:BuscarAlumno()"> <img src="images/buscar.jpg" border="0"></a></td>
        </tr>
        <tr>
          <td colspan="2" >Nombre y Apellido del Alumno Accidentado: <br>
              <input id="txtAccNombre" name="txtAccNombre" type="text" value="<?php echo $acc_nombre ?>" size="70" maxlength="70" />
          </td>
        </tr>
        <tr>
          <td colspan="2" >Fecha de nacimiento<br>
              <input id="txtAccFechaNac" name="txtAccFechaNac" type="text" value="<?php echo $acc_fechanac ?>" style="width:150px" />
          </td>
        </tr>
        <tr>
          <td colspan="2" >Domicilio<br>
              <input id="txtAccDomicilio" name="txtAccDomicilio" type="text" value="<?php echo $acc_domicilio ?>"  size="70" maxlength="70" />
          </td>
        </tr>
        <tr>
          <td colspan="2" >Barrio:<br>
              <input id="txtAccBarrio" name="txtAccBarrio" type="text" value="<?php echo $acc_barrio ?>" size="70" maxlength="70"/>
          </td>
        </tr>
        <tr>
          <td colspan="2" >Localidad:<br>
              <input name="cmbAccLocalidad" type="text" id="cmbAccLocalidad" value="<?php echo $acc_localidad ?>" size="70" maxlength="70" />
          </td>
        </tr>
        <tr>
          <td colspan="2" >Tel�fono:<br>
              <input id="txtAccTelefono" name="txtAccTelefono" type="text" value="<?php echo $acc_telefono ?>" />
          </td>
        </tr>
        <tr>
          <td colspan="2" >Obra Social:<br>
              <input id="txtAccOS" name="txtAccOS" type="text" value="<?php echo $acc_obrasocial ?>" size="70" maxlength="70" />
          </td>
        </tr>
        <tr>
          <td colspan="2" >N�mero de Afiliado:<br>
              <input id="txtAccNAfiliado" name="txtAccNAfiliado" type="text" value="<?php echo $acc_nafiliado ?>" />
          </td>
        </tr>
        <tr>
          <td > Fecha del Accidente:<br>
              <?php require_once('calendar/classes/tc_calendar.php'); ?>
              <?php 
			$myCalendar = new tc_calendar("txtDAFecha", true, false);
			$myCalendar->setIcon("calendar/images/iconCalendar.gif");
			if ($da_fecha!='')
			{
			$myCalendar->setDateYMD($da_fecha);
			}
			else
			{
			$myCalendar->setDate(date('d'), date('m'), date('Y'));
			}
			$myCalendar->setPath("calendar/");
			$myCalendar->setYearInterval(2009, 2022);
			$myCalendar->dateAllow('2009-01-01', '2022-12-31');
			$myCalendar->setDateFormat('j F Y');
			$myCalendar->setAlignment('left', 'bottom');
			$myCalendar->writeScript();
			?>
          </td>
          <td >Hora del Accidente:<br>
              <input id="txtDAHora" name="txtDAHora" type="text" value="<?php echo $da_hora ?>"/></td>
        </tr>
        <tr>
          <td colspan="2" >Horario:<br>
              <table border="0" cellpadding="0" cellspacing="0" >
                <tr>
                  <td><input type="radio" id="r_DAHorario" name="r_DAHorario" value="HP" <?php if($da_horario=="HP") echo "checked"?> />
                  </td>
                  <td><label>Programado</label></td>
                  <td width="20">&nbsp;</td>
                  <td><input type="radio" id="r_DAHorario" name="r_DAHorario" value="CT" <?php if($da_horario=="CT") echo "checked"?>/>
                  </td>
                  <td><label>Contra turno</label></td>
                  <td>&nbsp;</td>
                  <td><input type="radio" id="r_DAHorario" name="r_DAHorario" value="HE" <?php if($da_horario=="HE") echo "checked"?> />
                  </td>
                  <td><label>Excepcional</label></td>
                </tr>
            </table></td>
        </tr>
        <tr>
          <td colspan="2" >Detalles de la Actividad:<br>
              <textarea name="txtDAActividad"  id="txtDAActividad" ><?php echo $da_detalleactividad ?></textarea>
          </td>
        </tr>
        <tr>
          <td colspan="2" >Actividad:<br>
              <table border="0" cellpadding="0" cellspacing="0" >
                <tr>
                  <td><input type="radio" id="r_DAActividad" name="r_DAActividad" value="AH" <?php if($da_actividad=="AH") echo "checked"?> />
                  </td>
                  <td><label>Habitual</label></td>
                  <td width="20">&nbsp;</td>
                  <td><input type="radio" id="r_DAActividad" name="r_DAActividad" value="SP" <?php if($da_actividad=="SP") echo "checked"?>/>
                  </td>
                  <td><label>Programada</label></td>
                  <td>&nbsp;</td>
                  <td><input type="radio" id="r_DAActividad" name="r_DAActividad" value="AE" <?php if($da_actividad=="AE") echo "checked"?> />
                  </td>
                  <td><label>Extra programada</label></td>
                  <td width="20">&nbsp;</td>
                  <td><input type="radio" id="r_DAActividad" name="r_DAActividad" value="O" <?php if($da_actividad=="O") echo "checked"?> />
                  </td>
                  <td><label>Otras</label></td>
                </tr>
            </table></td>
        </tr>
        <tr>
          <td colspan="2" >Hecho o Circunstancia 
            que produce el accidente:<br>
                          <textarea name="txtDAHecho" id="txtDAHecho" ><?php echo $da_hecho ?></textarea>
          </td>
        </tr>
        <tr>
          <td colspan="2" ><table border="0" cellpadding="0" cellspacing="0" >
              <tr>
                <td><input type="radio" id="r_LLugar" name="r_LLugar" value="AI" <?php if($l_lugar=="AI") echo "checked"?> />
                </td>
                <td><label>En de la instituci�n (D)</label></td>
                <td width="20">&nbsp;</td>
                <td><input type="radio" id="r_LLugar" name="r_LLugar" value="FI" <?php if($l_lugar=="FI") echo "checked"?>/>
                </td>
                <td><label>Fuera de la instituci�n (F)</label></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td colspan="2" >Espacio f�sico:<br>
              <select name="cmbLEFisico" id="cmbLEFisico" >
                <?php while($row=mysqli_fetch_assoc($esp_fisicos)) { ?>
                <option value="<?php echo $row["ID"]?>" <?php if($row["ID"]==$l_espaciofisico) echo "selected"?>><?php echo $row["Descripcion"]?> - <?php echo $row["Lugar"]?></option>
                <?php } ?>
              </select>
          </td>
        </tr>
        <tr>
          <td colspan="2" >Personal responsable:<br>
              <textarea name="txtLResponsable"  id="txtLResponsable" ><?php echo $l_responsables ?></textarea>
          </td>
        </tr>
        <tr>
          <td colspan="2" >Testigos:<br>
              <textarea name="txtLTestigos" id="txtLTestigos" ><?php echo $l_testigos ?></textarea></td>
        </tr>
        <tr>
          <td align="center" colspan="2" ><h1 style="color:red;"><b><?php echo $mensaje ?></b></h1></td>
        </tr>
        <tr>
          <td align="center" colspan="2"><?php if ($id !="" ){?>
              <input name="Submit4" type="button"  value="DERIVACIONES" onClick="derivaciones('<?php echo $id?>');" />
            &nbsp;
            <input name="Submit1" type="button"  value="EMERGENCIA" onClick="emergencias('<?php echo $id?>');" />
            <?php }?>
            &nbsp;
            <input name="Submit3" type="button" value="GUARDAR" onClick="guardar();"  />
            &nbsp;
            <input name="Submit" type="button"  value="ELIMINAR" onClick="eliminar();" />
            &nbsp;
            <input name="Submit2" type="button" value="NUEVA DENUNCIA" onClick="window.open('denuncias.php','_self');" />
          </td>
        </tr>
      </table>
	  <input type="hidden" name="action" id="action">
		<input name="id_den" type="hidden" id="id_den" value="<?php echo $id?>">

	  </form>
      <div class="clear2"> </div>
      <div class="clear2"> </div>
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
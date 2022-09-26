<<<<<<< HEAD
<<<<<<< HEAD
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
$mensaje="(*) Datos Obligatorios";
$de_institucion = $_POST["cmbDEInst"];
$acc_nombre = $_POST["txtAccNombre"];
$acc_tipodoc = $_POST["cmbAccTipoDoc"];
$acc_documento = $_POST["txtAccDocumento"];
$acc_fechanac = $_POST["txtAccFechaNac"];
$acc_sexo= $_POST["cmbAccSexo"];
$acc_cargo= $_POST["txtAccCargo"];
$acc_domicilio = $_POST["txtAccDomicilio"];
$acc_barrio = "";
$acc_provincia = "4";
$acc_localidad = "";
$acc_telefono = $_POST["txtAccTelefono"];
$de_fecha = $fecalta;
$acc_inicio = $_POST["txtACCInicio"];
$acc_junta = $_POST["txtACCJunta"];
$acc_juntahora = $_POST["txtAccJuntaHora"];
$acc_especialidad = $_POST["cmbDEEspecialidad"];
$de_diagnostico= $_POST["txtDEDiagnostico"];
$de_observaciones= $_POST["txtDEObservaciones"];
$acc_solicitud= $_POST["r_AccSolicitud"];
$acc_aporte= $_POST["r_AccAporte"];
$acc_art= $_POST["r_AccArt"];
$acc_seguimiento= $_POST["r_AccSeguimiento"];
if ($acc_seguimiento == "") 
{
$acc_seguimiento='J';
}
$acc_estado= $_POST["cmbEstado"];
$id=$_REQUEST["id_den"];

//datos del archivo
$archivo=$HTTP_POST_FILES['fileArchivo']['name'];
$tipo_archivo=$HTTP_POST_FILES['fileArchivo']['type'];
$tamano_archivo=$HTTP_POST_FILES['fileArchivo']['size'];


/************************************************************************************************************************
ACCIONES
************************************************************************************************************************/
if($_POST["action"] == "G" && $id!="")
{
	if($de_institucion!="" && $acc_documento!="" && $acc_nombre!="" && $de_fecha!="")
	{
		mysqli_query($link,"UPDATE denuncias_docentes SET
						DE_IDInstitucion = $de_institucion,
						ACC_Nombre = '$acc_nombre',
						ACC_TipoDoc = 1,
						ACC_Documento = '$acc_documento',
		  				ACC_Sexo = '$acc_sexo',
						ACC_FechaNac = '$acc_fechanac',
						ACC_Cargo = '$acc_cargo',
						ACC_Domicilio = '$acc_domicilio',
						ACC_Barrio = '$acc_barrio',
						ACC_IDProvincia = 4,
						ACC_Localidad = '$acc_localidad',
						ACC_Telefono = '$acc_telefono',
						ACC_Art = '$acc_art',
						ACC_Inicio = '$acc_inicio',
						ACC_Junta = '$acc_junta',
						ACC_JuntaHora = '$acc_juntahora',
						ACC_Solicitud= '$acc_solicitud',
						ACC_Aporte = '$acc_aporte',
						DE_Fecha = '$de_fecha',
						DE_DiagnosticoPres = '$de_diagnostico',
						DE_Observaciones = '$de_observaciones',
						ACC_Seguimiento= '$acc_seguimiento',
						ACC_Estado = '$acc_estado',
						ACC_IDEspecialidad = '$acc_especialidad',
						AudUsrModi='$usrmodi',
						AudFecModi='$fecmodi'
					 WHERE ID = $id");
		$mensaje = 	"Formulario de Salud Ocupacional actualizado";
		?>
		<script>
		window.alert("El formulario ha sido modificado correctamente");
		</script>
		<?php
		
		//*************** pregunto si cargo el archivo
			if($archivo!="")
			{
				mysqli_query($link,"INSERT INTO denuncias_docentes_adjuntos(IDDenunciaDocente, AudUsrAlta, AudFecAlta)
							 VALUES ($id, '$usralta', '$fecalta')");
				$id_adjunto = mysqli_insert_id($link);
				if(move_uploaded_file($HTTP_POST_FILES['fileArchivo']['tmp_name'], "archivos_docentes/".$archivo))
				{
					$sql="UPDATE denuncias_docentes_adjuntos set Archivo='$archivo' WHERE IDAdjunto=$id_adjunto";
					$r=mysqli_query($link, $sql);
					$mensaje = 	"Archivos cargados";
				}
				else
				{
					$mensaje = 	"Se produjo un error al subir el archivo";
				}
			}
	
		
	}
	else
	{
		$mensaje = 	"(*) Datos Obligatorios";
	}
}

if($_POST["action"] == "G" && $id=="")
{
		
	if($de_institucion!="" && $acc_documento!="" && $acc_nombre!=""  && $de_fecha!="")
	{
		// verifico que no existe ingresada algun formulario para la misma persona ABIERTO por cada INSTITUCION
		//$str = "SELECT count(*) as cantidad FROM denuncias_docentes WHERE DE_IDInstitucion=$de_institucion AND ACC_Documento='$acc_documento' AND ACC_Estado='A'";
		//echo $str; 
		$sql_formulario = mysqli_fetch_assoc(mysqli_query($link,"SELECT count(*) as cantidad FROM denuncias_docentes WHERE DE_IDInstitucion=$de_institucion AND ACC_Documento='$acc_documento' AND ACC_Estado='A'"));
		if ($sql_formulario["cantidad"] < 1) 
		{ 
			?>
			<script>
			window.alert("NO EXISTE");
			</script>
	    	<?php
			
			mysqli_query($link,"INSERT INTO denuncias_docentes (DE_IDInstitucion, ACC_Nombre, ACC_TipoDoc, ACC_Documento, ACC_Sexo, ACC_FechaNac , ACC_Cargo, ACC_Domicilio, ACC_Barrio, ACC_IDProvincia, ACC_Localidad, ACC_Telefono, ACC_Art, ACC_Inicio, ACC_Junta, ACC_JuntaHora, ACC_Solicitud, ACC_Aporte, DE_Fecha, ACC_IDEspecialidad, DE_DiagnosticoPres, DE_Observaciones, ACC_Seguimiento,  ACC_Estado, Enviado_AuditoriaMedica, AudUsrAlta, AudFecAlta, AudUsrModi, AudFecModi, vigente) VALUES ('$de_institucion', '$acc_nombre', 1, '$acc_documento', '$acc_sexo',  '$acc_fechanac', '$acc_cargo', '$acc_domicilio', '$acc_barrio', 4, '$acc_localidad', '$acc_telefono', '$acc_art', '$acc_inicio', '$acc_junta', '$acc_juntahora', '$acc_solicitud', '$acc_aporte', '$de_fecha', '$acc_especialidad', '$de_diagnostico', '$de_observaciones', '$acc_seguimiento',  'A', '1','$usralta', '$fecalta', '$usrmodi', '$fecmodi','1')");
				$id = mysqli_insert_id($link);
				// inserto datos a la auditoria medica // pasa derecho a auditoria
				
				mysqli_query($link,"INSERT INTO auditoriamedica_docentes (IDDenuncia, FechaEnvio,IDEstadoAuditoria, AudUsrAlta, AudFecAlta)	VALUES ($id, '$fecalta', '1', '$usralta', '$fecalta')");
			
				// inserto datos del personal en la tabla PERSONAL si no EXISTE
				$acc_documento = str_replace(".","",$acc_documento);
				$sql_personal = mysqli_fetch_assoc(mysqli_query($link,"SELECT count(*) as cantidad FROM personal WHERE IDInstitucion=$de_institucion AND Documento='$acc_documento' AND Nombre='$acc_nombre'"));
		
				if ($sql_personal["cantidad"] < 1) 
		
				{
		
				mysqli_query($link,"INSERT INTO personal (IDInstitucion, Nombre, TipoDoc, Documento, Direccion, Localidad, IDProvincia,  Telefono, Barrio, FechaNacimiento, Cargo, AudUsrAlta, AudFecAlta, AudUsrModi, AudFecModi, vigente)
		
							VALUES ($de_institucion, '$acc_nombre', '1', '$acc_documento', '$acc_domicilio', '$acc_localidad', '4', '$acc_telefono', '$acc_barrio',  '$acc_fechanac',  '$acc_cargo', '$usralta', '$fecalta', '$usrmodi', '$fecmodi', '1')");
		
				}			
				
				$destinatario = "saludocupacional@jaeccba.org.ar"; 
				$asunto = "Sistema de Gestión - Nuevo Formulario de Salud Ocupacional"; 
				$correo_alta_persona = $_SESSION["Nombre_Usuario"];
				$correo_alta_fecha = date("Y-m-d H:i:s");
				$correo_id_denuncia = date("Y-m-d H:i:s");
			
		
				// selecciono el nombre de la Institucion
				$nombre_institucion = mysqli_fetch_assoc(mysqli_query($link,"SELECT Nombre, Telefono FROM instituciones WHERE ID='" . $_SESSION["Institucion"]."'"));
				$correo_institucion = $nombre_institucion["Nombre"];
				$correo_telefono = $nombre_institucion["Telefono"];
		
				// selecciono el nombre de la Especialidad				
			    $nombre_especialidad = mysqli_fetch_assoc(mysqli_query($link,"SELECT Descripcion FROM especialidades WHERE IDEspecialidad='".$acc_especialidad."'"));	
				$correo_especialidad = $nombre_especialidad["Descripcion"];
		
				// selecciono el tipo de Seguimiento
				if ($acc_seguimiento == 'J')  
				{
				$correo_seguimiento ='PARA JUNTA MEDICA';
				}
				if ($acc_seguimiento == 'I')  
				{
				$correo_seguimiento ='PARA SEGUIMIENTO INSTITUCIONAL';
				}
				
				
				$cuerpo = 'Nº Solicitud: '.$id.  '<br> Usuario_Alta: '.$correo_alta_persona.  '<br> Fecha_Alta: '.$correo_alta_fecha.  '<br> Institución: '.$correo_institucion.  '<br>   Teléfono: '.$correo_telefono.  '<br> Nombre del Accidentado: '.$acc_nombre.  '<br> Fecha próxima Junta Médica: '.$acc_junta.  '<br> Hora próxima Junta Médica: '.$acc_juntahora.  '<br> Especialidad: '.$correo_especialidad.  '<br> <strong>Seguimiento de la Denuncia: '.$correo_seguimiento.  '</strong><br> <a href="http://www.jaeccba.org.ar/fs">Acceda al sistema para más detalles</a>'; 
				//para el envío en formato HTML 
				$headers = "MIME-Version: 1.0\r\n"; 
				$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
				//dirección del remitente 
				$headers .= "From: saludocupacional@jaeccba.org.ar\r\n";
				//direcciones que recibirán copia oculta 
				$headers .= "Bcc: lorena.abatidaga@gmail.com\r\n"; 
				mail($destinatario,$asunto,$cuerpo,$headers);
				// **************** fin envio de datos por correo
				$mensaje = 	"Formulario Registrado. El formulario ha sido enviado por correo"  ;
				?>
				<script>
				window.alert("El formulario ha sido registrado y enviado por correo electónico a JAEC");
				</script>
				<?php
			}
			else
			{
			?>
			<script>
			window.alert("YA EXISTE UNA SOLICITUD PARA ESTA PERSONA EN ESTADO ABIERTA. NO PODRA GENERAR UNA NUEVA HASTA CERRAR LA ANTERIOR");
			</script>
	    	<?php
			}
	}
	else

	{

		$mensaje = 	"(*) Datos Obligatorios";

	}

}

//eliminar adjuntos

if($_POST["action"] == "EA")
{
	mysqli_query($link,"DELETE FROM denuncias_docentes_adjuntos WHERE IDAdjunto=". $_POST["id_adjunto"]);
}

if($_POST["action"] == "E" && $id!="")

{
	mysqli_query($link,"UPDATE denuncias_docentes SET vigente='0', AudUsrModi='$usrmodi', AudFecModi='$fecmodi' WHERE ID=$id");

	$de_institucion = "";
	$acc_nombre = "";
	$acc_tipodoc = "";
	$acc_documento = "";
	$acc_fechanac = "";
	$acc_sexo = "";
	$acc_cargo= "";
	$acc_domicilio = "";
	$acc_barrio = "";
	$acc_provincia = "";
	$acc_localidad = "";
	$acc_telefono = "";
	$de_fecha = "";
	$de_diagnostico = "";
	$de_observaciones = "";
	$acc_estado="";
	$acc_aporte= "";
	$acc_solicitud = "";
	$acc_seguimiento = "";
	$acc_art = "";
	$acc_inicio= "";
	$acc_junta= "";
	$acc_juntahora= "";
	$acc_especialidad = "";
	$id = "";

	$mensaje = 	"Formulario de Salud Ocupacional eliminado";
}

if($id != "")
{
	$sql = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM denuncias_docentes WHERE vigente='1' AND ID=$id"));
	$de_institucion = $sql["DE_IDInstitucion"];
	$acc_nombre = $sql["ACC_Nombre"];
	$acc_tipodoc = $sql["ACC_TipoDoc"];
	$acc_documento = $sql["ACC_Documento"];
	$acc_sexo= $sql["ACC_Sexo"];
	$acc_fechanac = $sql["ACC_FechaNac"];
	$acc_cargo= $sql["ACC_Cargo"];
	$acc_domicilio = $sql["ACC_Domicilio"];
	$acc_barrio = $sql["ACC_Barrio"];
	$acc_provincia = $sql["ACC_IDProvincia"];
	$acc_localidad = $sql["ACC_Localidad"];
	$acc_telefono = $sql["ACC_Telefono"];
	$acc_art= $sql["ACC_Art"];
	$acc_inicio= $sql["ACC_Inicio"];
	$acc_junta= $sql["ACC_Junta"];
	$acc_juntahora= $sql["ACC_JuntaHora"];
	$acc_aporte= $sql["ACC_Aporte"];
	$acc_solicitud = $sql["ACC_Solicitud"];
	$de_fecha = $sql["DE_Fecha"];
	$de_diagnostico = $sql["DE_DiagnosticoPres"];
	$de_observaciones = $sql["DE_Observaciones"];
	$acc_seguimiento = $sql["ACC_Seguimiento"];
	$acc_estado = $sql["ACC_Estado"];
	$acc_especialidad= $sql["ACC_IDEspecialidad"];
	$id=$sql["ID"];
}

//tabla tipo  instituciones
$de_inst=mysqli_query($link,"SELECT * FROM instituciones  WHERE vigente='1' ORDER BY nombre");
$de_inst_id=mysqli_query($link,"SELECT * FROM instituciones  WHERE vigente='1' AND ID='" .$_SESSION["Institucion"]. "' ORDER BY nombre");
$de_esp=mysqli_query($link,"SELECT * FROM especialidades ORDER BY Descripcion");

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
<script language="javascript" src="calendar/calendar.js"></script>
<script language="javascript">
function BuscarPersonal()
{
intDNI=window.frm.txtAccDocumento.value;
url="buscar_personal.php?dni=" + intDNI;
window.open(url,'_blank','status=0,toolbar=0,width=10,height=10,left=300, top=100')
}
function eliminar()
{
	if (confirm('¿Está seguro de eliminar el Formulario de Salud Ocupacional?'))
	{
		frm.action.value='E';
		frm.submit();
	}	 
}

function eliminar_archivos(id)
{
	if (confirm('¿Está seguro de eliminar el registro?'))
	{
		frm.action.value="EA";
		frm.id_adjunto.value= id;		
		frm.submit();
	}	 
}

function guardar()
{
	if (frm.txtAccDocumento.value == "" && frm.txtAccNombre.value == "")
	{
	window.alert("DNI, NOMBRE y FECHA DEL FORMULARIO DE SALUD son datos obligatorios!")
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
	<img src="images/map.png" width="30" height="36" border="0"> <b>Formulario Carpetas y Juntas Medicas</b>
	</div>
   
    <div class="clear2"> </div>
    <div >
         <form name="frm" id="frm" action="" method="post" enctype="multipart/form-data">

	  <!-- inicio tabla de datos -->
	  <table width="100%" cellpadding="0" cellspacing="0">
      <?php if ($id != "" ) { ?>
	  <tr>
	  
	  <td colspan="2" style="text-align:left; font-size:20px"><strong>Solicitud N°: <?php echo $id;?> - 
	  <?php if ($acc_estado=='A') { ?> 
	  <font color="#009900" ><?php echo "Abierta";?></font>
	  <?php } ?>
	  <?php if ($acc_estado=='C') { ?> 
	  <font color="#0033CC"><?php echo "Cerrada";?></font>
	  <?php } ?>
	  
	  </strong> </td>
	  </tr>
      <?php } ?>
	  <tr>
      <!-- SI LA INSTITUCION ES JAEC LISTO TODAS-->
	  <?php if ($_SESSION["Institucion"]==14) {?>
	  <td width="48%" colspan="2" >Indique la Intitución:<br>
	  <select name="cmbDEInst" id="cmbDEInst" style="width:500px">
	    <?php while($row=mysqli_fetch_assoc($de_inst)) { ?>
	    <option value="<?php echo $row["ID"]?>" <?php if($row["ID"]==$de_institucion) echo "selected"?>><?php echo $row["Nombre"]?></option>
	    <?php } ?>
	    </select>	    </td><?php } ?>
      <!-- SI LA INSTITUCION NO ES JAEC LISTO  SOLO LA INSTITUCION DEL USUARIO-->
      <?php if ($_SESSION["Institucion"]!=14) {?>
      <td width="39%">
		  <select name="cmbDEInst" id="cmbDEInst" style="width:500px">
		  <?php while($row=mysqli_fetch_assoc($de_inst_id)) { ?>
		  <option value="<?php echo $row["ID"]?>" <?php if($row["ID"]==$de_institucion) echo "selected"?>><?php echo $row["Nombre"]?></option>
		  <?php } ?>
		  </select>		  </td>
	  <?php } ?>
	  </tr>
      
      <tr>
       <td valign="middle" >DNI Docente <font color="red"><b>(*)</b></font> <br>
        <input name="txtAccDocumento" id="txtAccDocumento" value="<?php echo $acc_documento ?>" type="text" style="width:150px "/> <a href="javascript:BuscarPersonal()"> <img src="images/buscar.jpg" border="0"></a></td>
      </tr>
      
	  <tr>
	    <td colspan="2" ><strong><u>DATOS DEL BENEFICIARIO</u></strong> </td>
	    </tr>
	  <tr>
      <td colspan="2" >Nombre y Apellido del Docente Accidentado <font color="red"><b>(*)</b></font><br>
      <input id="txtAccNombre" name="txtAccNombre" type="text" value="<?php echo $acc_nombre ?>" size="70" maxlength="70" />	  </td></tr>
      
      <tr>
      <td >Fecha de nacimiento<br>
      <input id="txtAccFechaNac" name="txtAccFechaNac" type="text" value="<?php echo $acc_fechanac ?>" style="width:150px" />	  </td>
      <td >Sexo<br>
        <select name="cmbAccSexo" id="cmbAccSexo" >
          <option value="F" <?php if($acc_sexo=="F") echo "selected"?>>Femenino</option>
          <option value="M" <?php if($acc_sexo=="M") echo "selected"?>>Masculino</option>
        </select></td>
      </tr>
      
      <tr>
        <td colspan="2" >Cargo<br>
          <input name="txtAccCargo" type="text" id="txtAccCargo" value="<?php echo $acc_cargo?>" size="70" maxlength="70" /></td>
      </tr>
      
      <tr>
        <td colspan="2" ><strong><u>DATOS DE RESIDENCIA </u></strong></td>
      </tr>
      <tr>
      <td colspan="2" >Domicilio<br>
      <input id="txtAccDomicilio" name="txtAccDomicilio" type="text" value="<?php echo $acc_domicilio ?>"  size="70" maxlength="70" />      </td></tr>
      <tr>
      <td colspan="2" >Tel&eacute;fono o Contacto<br>
        <input id="txtAccTelefono" name="txtAccTelefono" type="text" value="<?php echo $acc_telefono ?>" /></td>
      </tr>
      <tr>
        <td colspan="2" ><strong><u>DATOS DE LA LICENCIA </u></strong></td>
      </tr>
      
    
                <tr>
                  <td colspan="2" ><strong><i>Tipo de Solicitud</i></strong><br>
                    <table border="0" cellpadding="0" cellspacing="0" >
                      <tr>
                        <td><input type="radio" id="r_AccSolicitud" name="r_AccSolicitud" value="P" <?php if($acc_solicitud=="P") echo "checked"?> />                        </td>
                        <td><label>Primera vez </label></td>
                        <td width="20">&nbsp;</td>
                        <td><input type="radio" id="r_AccSolicitud" name="r_AccSolicitud" value="R" <?php if($acc_solicitud=="R") echo "checked"?>/>                        </td>
                        <td><label>Renovaci&oacute;n</label></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td ><strong><i>Aporte</i></strong><br>
                    <table border="0" cellpadding="0" cellspacing="0" >
                      <tr>
                        <td><input type="radio" id="r_AccAporte" name="r_AccAporte" value="S" <?php if($acc_aporte=="S") echo "checked"?> />                        </td>
                        <td><label>SI</label></td>
                        <td width="20">&nbsp;</td>
                        <td><input type="radio" id="r_AccAporte" name="r_AccAporte" value="N" <?php if($acc_aporte=="N") echo "checked"?>/>                        </td>
                        <td><label>NO</label></td>
                      </tr>
                  </table></td>
                  <td ><strong><i>A.R.T</i></strong><br>
                    <table border="0" cellpadding="0" cellspacing="0" >
                      <tr>
                        <td><input type="radio" id="r_AccArt" name="r_AccArt" value="S" <?php if($acc_art=="S") echo "checked"?> />                        </td>
                        <td><label>SI</label></td>
                        <td width="20">&nbsp;</td>
                        <td><input type="radio" id="r_AccArt" name="r_AccArt" value="N" <?php if($acc_art=="N") echo "checked"?>/>                        </td>
                        <td><label>NO</label></td>
                      </tr>
                  </table></td>
                </tr>
               
			   <tr>
                  <td colspan="2" ><strong><i>Seguimiento de la denuncia</i></strong> <br>
                    <table border="0" cellpadding="0" cellspacing="0" >
                      <tr>
                        <td><input type="radio" id="r_AccSeguimiento" name="r_AccSeguimiento" value="I" <?php if($acc_seguimiento=="I") echo "checked"?> />                        </td>
                        <td><label>Para seguimiento Institucional</label></td>
                        <td width="20">&nbsp;</td>
                        <td><input type="radio" id="r_AccSeguimiento" name="r_AccSeguimiento" value="J" <?php if($acc_seguimiento=="J") echo "checked"?>/>                        </td>
                        <td><label>Para Junta Médica</label></td>
                      </tr>
               </table></td>
            </tr>
			    <tr>
                  <td colspan="2" >Fecha de Inicio de la licencia<br>
                    <?php require_once('calendar/classes/tc_calendar.php'); ?>
                  <?php 
			$myCalendar = new tc_calendar("txtACCInicio", true, false);
			$myCalendar->setIcon("calendar/images/iconCalendar.gif");
			if ($acc_inicio!='')
			{
			$myCalendar->setDateYMD($acc_inicio);
			}
			else
			{
			//$myCalendar->setDate(date('d'), date('m'), date('Y'));
			}
			$myCalendar->setPath("calendar/");
			$myCalendar->setYearInterval(2014, 2022);
			$myCalendar->dateAllow('2014-01-01', '2022-12-31');
			$myCalendar->setDateFormat('j F Y');
			$myCalendar->setAlignment('left', 'bottom');
			$myCalendar->writeScript();
			?></td>
                </tr>
	<tr>
                  <td >Fecha de próxima junta médica<br>
                    <?php require_once('calendar/classes/tc_calendar.php'); ?>
                  <?php 
			$myCalendar = new tc_calendar("txtACCJunta", true, false);
			$myCalendar->setIcon("calendar/images/iconCalendar.gif");
			if ($acc_junta!='')
			{
			$myCalendar->setDateYMD($acc_junta);
			}
			else
			{
			//$myCalendar->setDate(date('d'), date('m'), date('Y'));
			}
			$myCalendar->setPath("calendar/");
			$myCalendar->setYearInterval(2014, 2022);
			$myCalendar->dateAllow('2014-01-01', '2022-12-31');
			$myCalendar->setDateFormat('j F Y');
			$myCalendar->setAlignment('left', 'bottom');
			$myCalendar->writeScript();
			?></td>
                  <td >Hora de pr&oacute;xima junta m&eacute;dica<br>
				  <input  type="time" name="txtAccJuntaHora" value="<?php echo $acc_juntahora?>" step="1" style="width:150px" /></td>
      
				  </td>
	</tr>			
                <tr>
                  <td colspan="2" >Especialidad<br>
				  <select name="cmbDEEspecialidad" id="cmbDEEspecialidad">
	    <?php while($row=mysqli_fetch_assoc($de_esp)) { ?>
	    <option value="<?php echo $row["IDEspecialidad"]?>" <?php if($row["IDEspecialidad"]==$acc_especialidad) echo "selected"?>><?php echo $row["Descripcion"]?></option>
	    <?php } ?>
	    </select>				  </td>
                </tr>
                <tr>

                  <td colspan="2" >Diagn&oacute;stico Presuntivo <br>
                  <textarea name="txtDEDiagnostico"  id="txtDEDiagnostico" ><?php echo $de_diagnostico ?></textarea>                  </td></tr>
				  
				  <tr>

                  <td colspan="2" >Observaciones <br>
                  <textarea name="txtDEObservaciones"  id="txtDEObservaciones" ><?php echo $de_observaciones?></textarea>                  </td></tr>
			 
	        <tr><td colspan="2">Estado de la solicitud <br>
				   <select name="cmbEstado" id="cmbEstado" tyle="width:120px ">
        		<option value="A" <?php if($acc_estado=="A") echo "selected"?>>Abierta/En trámite</option>
                <option value="C" <?php if($acc_estado=="C") echo "selected"?>>Cerrada/Finalizada</option>
              </select>
			</td></tr>	  
		 <?php if ($id != '' )  { ?>
		 <tr>
          <td colspan="2" align="left" class="tahoma11">Archivo Adjunto:<br>
            <input name="fileArchivo" type="file" class="tahoma12" id="fileArchivo"  />          </td>
        </tr>
        
		
		<?php  // listo los archivos asociados

				$sql = mysqli_query($link,"SELECT * FROM denuncias_docentes_adjuntos WHERE IDDenunciaDocente=$id");

				?>
        
		
		
		
		<tr>
          <td height="26" colspan="4" align="center" class="tahoma12"><div align="left"><b>Listado de Archivos Asociados</b></div></td>
        </tr>
        <?php while($row =  mysqli_fetch_assoc($sql)){?>
        <tr>
          <td height="26" colspan="4" align="left" class="tahoma12">* <a href="archivos_docentes/<?php echo $row["Archivo"]?>" target="_blank" title="abrir archivo"><?php echo $row["Archivo"]?></a> &nbsp;&nbsp;&nbsp; (<a href="javascript:eliminar_archivos('<?php echo $row["IDAdjunto"]?>');">eliminar archivo</a>)</td>
        </tr>
        <?php } ?>
		<?php } ?>
		
                <tr>
                  <td align="center" colspan="2"><h1><b><font color="red"><?php echo $mensaje ?></font></b></h1></td>
                </tr>
                <tr>

                  <td align="center" colspan="2">

                  <input name="Submit3" type="button" value="GUARDAR" onClick="guardar();"  />
			      &nbsp;<input name="Submit" type="button"  value="ELIMINAR" onClick="eliminar();" />
				  &nbsp;<input name="Submit2" type="button" value="NUEVO FORMULARIO" onClick="window.open('denuncias_docentes.php','_self');" />				  </td>
                </tr>
          </table>
	   	<input type="hidden" name="action" id="action">
		<input type="hidden" name="id_den" id="id_den" value="<?php echo $id?>">
 		<input type="hidden" name="id_adjunto" id="id_adjunto">

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
$mensaje="(*) Datos Obligatorios";
$de_institucion = $_POST["cmbDEInst"];
$acc_nombre = $_POST["txtAccNombre"];
$acc_tipodoc = $_POST["cmbAccTipoDoc"];
$acc_documento = $_POST["txtAccDocumento"];
$acc_fechanac = $_POST["txtAccFechaNac"];
$acc_sexo= $_POST["cmbAccSexo"];
$acc_cargo= $_POST["txtAccCargo"];
$acc_domicilio = $_POST["txtAccDomicilio"];
$acc_barrio = "";
$acc_provincia = "4";
$acc_localidad = "";
$acc_telefono = $_POST["txtAccTelefono"];
$de_fecha = $fecalta;
$acc_inicio = $_POST["txtACCInicio"];
$acc_junta = $_POST["txtACCJunta"];
$acc_juntahora = $_POST["txtAccJuntaHora"];
$acc_especialidad = $_POST["cmbDEEspecialidad"];
$de_diagnostico= $_POST["txtDEDiagnostico"];
$de_observaciones= $_POST["txtDEObservaciones"];
$acc_solicitud= $_POST["r_AccSolicitud"];
$acc_aporte= $_POST["r_AccAporte"];
$acc_art= $_POST["r_AccArt"];
$acc_seguimiento= $_POST["r_AccSeguimiento"];
if ($acc_seguimiento == "") 
{
$acc_seguimiento='J';
}
$acc_estado= $_POST["cmbEstado"];
$id=$_REQUEST["id_den"];

//datos del archivo
$archivo=$HTTP_POST_FILES['fileArchivo']['name'];
$tipo_archivo=$HTTP_POST_FILES['fileArchivo']['type'];
$tamano_archivo=$HTTP_POST_FILES['fileArchivo']['size'];


/************************************************************************************************************************
ACCIONES
************************************************************************************************************************/
if($_POST["action"] == "G" && $id!="")
{
	if($de_institucion!="" && $acc_documento!="" && $acc_nombre!="" && $de_fecha!="")
	{
		mysqli_query($link,"UPDATE denuncias_docentes SET
						DE_IDInstitucion = $de_institucion,
						ACC_Nombre = '$acc_nombre',
						ACC_TipoDoc = 1,
						ACC_Documento = '$acc_documento',
		  				ACC_Sexo = '$acc_sexo',
						ACC_FechaNac = '$acc_fechanac',
						ACC_Cargo = '$acc_cargo',
						ACC_Domicilio = '$acc_domicilio',
						ACC_Barrio = '$acc_barrio',
						ACC_IDProvincia = 4,
						ACC_Localidad = '$acc_localidad',
						ACC_Telefono = '$acc_telefono',
						ACC_Art = '$acc_art',
						ACC_Inicio = '$acc_inicio',
						ACC_Junta = '$acc_junta',
						ACC_JuntaHora = '$acc_juntahora',
						ACC_Solicitud= '$acc_solicitud',
						ACC_Aporte = '$acc_aporte',
						DE_Fecha = '$de_fecha',
						DE_DiagnosticoPres = '$de_diagnostico',
						DE_Observaciones = '$de_observaciones',
						ACC_Seguimiento= '$acc_seguimiento',
						ACC_Estado = '$acc_estado',
						ACC_IDEspecialidad = '$acc_especialidad',
						AudUsrModi='$usrmodi',
						AudFecModi='$fecmodi'
					 WHERE ID = $id");
		$mensaje = 	"Formulario de Salud Ocupacional actualizado";
		?>
		<script>
		window.alert("El formulario ha sido modificado correctamente");
		</script>
		<?php
		
		//*************** pregunto si cargo el archivo
			if($archivo!="")
			{
				mysqli_query($link,"INSERT INTO denuncias_docentes_adjuntos(IDDenunciaDocente, AudUsrAlta, AudFecAlta)
							 VALUES ($id, '$usralta', '$fecalta')");
				$id_adjunto = mysqli_insert_id($link);
				if(move_uploaded_file($HTTP_POST_FILES['fileArchivo']['tmp_name'], "archivos_docentes/".$archivo))
				{
					$sql="UPDATE denuncias_docentes_adjuntos set Archivo='$archivo' WHERE IDAdjunto=$id_adjunto";
					$r=mysqli_query($link, $sql);
					$mensaje = 	"Archivos cargados";
				}
				else
				{
					$mensaje = 	"Se produjo un error al subir el archivo";
				}
			}
	
		
	}
	else
	{
		$mensaje = 	"(*) Datos Obligatorios";
	}
}

if($_POST["action"] == "G" && $id=="")
{
		
	if($de_institucion!="" && $acc_documento!="" && $acc_nombre!=""  && $de_fecha!="")
	{
		// verifico que no existe ingresada algun formulario para la misma persona ABIERTO por cada INSTITUCION
		//$str = "SELECT count(*) as cantidad FROM denuncias_docentes WHERE DE_IDInstitucion=$de_institucion AND ACC_Documento='$acc_documento' AND ACC_Estado='A'";
		//echo $str; 
		$sql_formulario = mysqli_fetch_assoc(mysqli_query($link,"SELECT count(*) as cantidad FROM denuncias_docentes WHERE DE_IDInstitucion=$de_institucion AND ACC_Documento='$acc_documento' AND ACC_Estado='A'"));
		if ($sql_formulario["cantidad"] < 1) 
		{ 
			?>
			<script>
			window.alert("NO EXISTE");
			</script>
	    	<?php
			
			mysqli_query($link,"INSERT INTO denuncias_docentes (DE_IDInstitucion, ACC_Nombre, ACC_TipoDoc, ACC_Documento, ACC_Sexo, ACC_FechaNac , ACC_Cargo, ACC_Domicilio, ACC_Barrio, ACC_IDProvincia, ACC_Localidad, ACC_Telefono, ACC_Art, ACC_Inicio, ACC_Junta, ACC_JuntaHora, ACC_Solicitud, ACC_Aporte, DE_Fecha, ACC_IDEspecialidad, DE_DiagnosticoPres, DE_Observaciones, ACC_Seguimiento,  ACC_Estado, Enviado_AuditoriaMedica, AudUsrAlta, AudFecAlta, AudUsrModi, AudFecModi, vigente) VALUES ('$de_institucion', '$acc_nombre', 1, '$acc_documento', '$acc_sexo',  '$acc_fechanac', '$acc_cargo', '$acc_domicilio', '$acc_barrio', 4, '$acc_localidad', '$acc_telefono', '$acc_art', '$acc_inicio', '$acc_junta', '$acc_juntahora', '$acc_solicitud', '$acc_aporte', '$de_fecha', '$acc_especialidad', '$de_diagnostico', '$de_observaciones', '$acc_seguimiento',  'A', '1','$usralta', '$fecalta', '$usrmodi', '$fecmodi','1')");
				$id = mysqli_insert_id($link);
				// inserto datos a la auditoria medica // pasa derecho a auditoria
				
				mysqli_query($link,"INSERT INTO auditoriamedica_docentes (IDDenuncia, FechaEnvio,IDEstadoAuditoria, AudUsrAlta, AudFecAlta)	VALUES ($id, '$fecalta', '1', '$usralta', '$fecalta')");
			
				// inserto datos del personal en la tabla PERSONAL si no EXISTE
				$acc_documento = str_replace(".","",$acc_documento);
				$sql_personal = mysqli_fetch_assoc(mysqli_query($link,"SELECT count(*) as cantidad FROM personal WHERE IDInstitucion=$de_institucion AND Documento='$acc_documento' AND Nombre='$acc_nombre'"));
		
				if ($sql_personal["cantidad"] < 1) 
		
				{
		
				mysqli_query($link,"INSERT INTO personal (IDInstitucion, Nombre, TipoDoc, Documento, Direccion, Localidad, IDProvincia,  Telefono, Barrio, FechaNacimiento, Cargo, AudUsrAlta, AudFecAlta, AudUsrModi, AudFecModi, vigente)
		
							VALUES ($de_institucion, '$acc_nombre', '1', '$acc_documento', '$acc_domicilio', '$acc_localidad', '4', '$acc_telefono', '$acc_barrio',  '$acc_fechanac',  '$acc_cargo', '$usralta', '$fecalta', '$usrmodi', '$fecmodi', '1')");
		
				}			
				
				$destinatario = "saludocupacional@jaeccba.org.ar"; 
				$asunto = "Sistema de Gestión - Nuevo Formulario de Salud Ocupacional"; 
				$correo_alta_persona = $_SESSION["Nombre_Usuario"];
				$correo_alta_fecha = date("Y-m-d H:i:s");
				$correo_id_denuncia = date("Y-m-d H:i:s");
			
		
				// selecciono el nombre de la Institucion
				$nombre_institucion = mysqli_fetch_assoc(mysqli_query($link,"SELECT Nombre, Telefono FROM instituciones WHERE ID='" . $_SESSION["Institucion"]."'"));
				$correo_institucion = $nombre_institucion["Nombre"];
				$correo_telefono = $nombre_institucion["Telefono"];
		
				// selecciono el nombre de la Especialidad				
			    $nombre_especialidad = mysqli_fetch_assoc(mysqli_query($link,"SELECT Descripcion FROM especialidades WHERE IDEspecialidad='".$acc_especialidad."'"));	
				$correo_especialidad = $nombre_especialidad["Descripcion"];
		
				// selecciono el tipo de Seguimiento
				if ($acc_seguimiento == 'J')  
				{
				$correo_seguimiento ='PARA JUNTA MEDICA';
				}
				if ($acc_seguimiento == 'I')  
				{
				$correo_seguimiento ='PARA SEGUIMIENTO INSTITUCIONAL';
				}
				
				
				$cuerpo = 'Nº Solicitud: '.$id.  '<br> Usuario_Alta: '.$correo_alta_persona.  '<br> Fecha_Alta: '.$correo_alta_fecha.  '<br> Institución: '.$correo_institucion.  '<br>   Teléfono: '.$correo_telefono.  '<br> Nombre del Accidentado: '.$acc_nombre.  '<br> Fecha próxima Junta Médica: '.$acc_junta.  '<br> Hora próxima Junta Médica: '.$acc_juntahora.  '<br> Especialidad: '.$correo_especialidad.  '<br> <strong>Seguimiento de la Denuncia: '.$correo_seguimiento.  '</strong><br> <a href="http://www.jaeccba.org.ar/fs">Acceda al sistema para más detalles</a>'; 
				//para el envío en formato HTML 
				$headers = "MIME-Version: 1.0\r\n"; 
				$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
				//dirección del remitente 
				$headers .= "From: saludocupacional@jaeccba.org.ar\r\n";
				//direcciones que recibirán copia oculta 
				$headers .= "Bcc: lorena.abatidaga@gmail.com\r\n"; 
				mail($destinatario,$asunto,$cuerpo,$headers);
				// **************** fin envio de datos por correo
				$mensaje = 	"Formulario Registrado. El formulario ha sido enviado por correo"  ;
				?>
				<script>
				window.alert("El formulario ha sido registrado y enviado por correo electónico a JAEC");
				</script>
				<?php
			}
			else
			{
			?>
			<script>
			window.alert("YA EXISTE UNA SOLICITUD PARA ESTA PERSONA EN ESTADO ABIERTA. NO PODRA GENERAR UNA NUEVA HASTA CERRAR LA ANTERIOR");
			</script>
	    	<?php
			}
	}
	else

	{

		$mensaje = 	"(*) Datos Obligatorios";

	}

}

//eliminar adjuntos

if($_POST["action"] == "EA")
{
	mysqli_query($link,"DELETE FROM denuncias_docentes_adjuntos WHERE IDAdjunto=". $_POST["id_adjunto"]);
}

if($_POST["action"] == "E" && $id!="")

{
	mysqli_query($link,"UPDATE denuncias_docentes SET vigente='0', AudUsrModi='$usrmodi', AudFecModi='$fecmodi' WHERE ID=$id");

	$de_institucion = "";
	$acc_nombre = "";
	$acc_tipodoc = "";
	$acc_documento = "";
	$acc_fechanac = "";
	$acc_sexo = "";
	$acc_cargo= "";
	$acc_domicilio = "";
	$acc_barrio = "";
	$acc_provincia = "";
	$acc_localidad = "";
	$acc_telefono = "";
	$de_fecha = "";
	$de_diagnostico = "";
	$de_observaciones = "";
	$acc_estado="";
	$acc_aporte= "";
	$acc_solicitud = "";
	$acc_seguimiento = "";
	$acc_art = "";
	$acc_inicio= "";
	$acc_junta= "";
	$acc_juntahora= "";
	$acc_especialidad = "";
	$id = "";

	$mensaje = 	"Formulario de Salud Ocupacional eliminado";
}

if($id != "")
{
	$sql = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM denuncias_docentes WHERE vigente='1' AND ID=$id"));
	$de_institucion = $sql["DE_IDInstitucion"];
	$acc_nombre = $sql["ACC_Nombre"];
	$acc_tipodoc = $sql["ACC_TipoDoc"];
	$acc_documento = $sql["ACC_Documento"];
	$acc_sexo= $sql["ACC_Sexo"];
	$acc_fechanac = $sql["ACC_FechaNac"];
	$acc_cargo= $sql["ACC_Cargo"];
	$acc_domicilio = $sql["ACC_Domicilio"];
	$acc_barrio = $sql["ACC_Barrio"];
	$acc_provincia = $sql["ACC_IDProvincia"];
	$acc_localidad = $sql["ACC_Localidad"];
	$acc_telefono = $sql["ACC_Telefono"];
	$acc_art= $sql["ACC_Art"];
	$acc_inicio= $sql["ACC_Inicio"];
	$acc_junta= $sql["ACC_Junta"];
	$acc_juntahora= $sql["ACC_JuntaHora"];
	$acc_aporte= $sql["ACC_Aporte"];
	$acc_solicitud = $sql["ACC_Solicitud"];
	$de_fecha = $sql["DE_Fecha"];
	$de_diagnostico = $sql["DE_DiagnosticoPres"];
	$de_observaciones = $sql["DE_Observaciones"];
	$acc_seguimiento = $sql["ACC_Seguimiento"];
	$acc_estado = $sql["ACC_Estado"];
	$acc_especialidad= $sql["ACC_IDEspecialidad"];
	$id=$sql["ID"];
}

//tabla tipo  instituciones
$de_inst=mysqli_query($link,"SELECT * FROM instituciones  WHERE vigente='1' ORDER BY nombre");
$de_inst_id=mysqli_query($link,"SELECT * FROM instituciones  WHERE vigente='1' AND ID='" .$_SESSION["Institucion"]. "' ORDER BY nombre");
$de_esp=mysqli_query($link,"SELECT * FROM especialidades ORDER BY Descripcion");

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
<script language="javascript" src="calendar/calendar.js"></script>
<script language="javascript">
function BuscarPersonal()
{
intDNI=window.frm.txtAccDocumento.value;
url="buscar_personal.php?dni=" + intDNI;
window.open(url,'_blank','status=0,toolbar=0,width=10,height=10,left=300, top=100')
}
function eliminar()
{
	if (confirm('¿Está seguro de eliminar el Formulario de Salud Ocupacional?'))
	{
		frm.action.value='E';
		frm.submit();
	}	 
}

function eliminar_archivos(id)
{
	if (confirm('¿Está seguro de eliminar el registro?'))
	{
		frm.action.value="EA";
		frm.id_adjunto.value= id;		
		frm.submit();
	}	 
}

function guardar()
{
	if (frm.txtAccDocumento.value == "" && frm.txtAccNombre.value == "")
	{
	window.alert("DNI, NOMBRE y FECHA DEL FORMULARIO DE SALUD son datos obligatorios!")
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
	<img src="images/map.png" width="30" height="36" border="0"> <b>Formulario Carpetas y Juntas Medicas</b>
	</div>
   
    <div class="clear2"> </div>
    <div >
         <form name="frm" id="frm" action="" method="post" enctype="multipart/form-data">

	  <!-- inicio tabla de datos -->
	  <table width="100%" cellpadding="0" cellspacing="0">
      <?php if ($id != "" ) { ?>
	  <tr>
	  
	  <td colspan="2" style="text-align:left; font-size:20px"><strong>Solicitud N°: <?php echo $id;?> - 
	  <?php if ($acc_estado=='A') { ?> 
	  <font color="#009900" ><?php echo "Abierta";?></font>
	  <?php } ?>
	  <?php if ($acc_estado=='C') { ?> 
	  <font color="#0033CC"><?php echo "Cerrada";?></font>
	  <?php } ?>
	  
	  </strong> </td>
	  </tr>
      <?php } ?>
	  <tr>
      <!-- SI LA INSTITUCION ES JAEC LISTO TODAS-->
	  <?php if ($_SESSION["Institucion"]==14) {?>
	  <td width="48%" colspan="2" >Indique la Intitución:<br>
	  <select name="cmbDEInst" id="cmbDEInst" style="width:500px">
	    <?php while($row=mysqli_fetch_assoc($de_inst)) { ?>
	    <option value="<?php echo $row["ID"]?>" <?php if($row["ID"]==$de_institucion) echo "selected"?>><?php echo $row["Nombre"]?></option>
	    <?php } ?>
	    </select>	    </td><?php } ?>
      <!-- SI LA INSTITUCION NO ES JAEC LISTO  SOLO LA INSTITUCION DEL USUARIO-->
      <?php if ($_SESSION["Institucion"]!=14) {?>
      <td width="39%">
		  <select name="cmbDEInst" id="cmbDEInst" style="width:500px">
		  <?php while($row=mysqli_fetch_assoc($de_inst_id)) { ?>
		  <option value="<?php echo $row["ID"]?>" <?php if($row["ID"]==$de_institucion) echo "selected"?>><?php echo $row["Nombre"]?></option>
		  <?php } ?>
		  </select>		  </td>
	  <?php } ?>
	  </tr>
      
      <tr>
       <td valign="middle" >DNI Docente <font color="red"><b>(*)</b></font> <br>
        <input name="txtAccDocumento" id="txtAccDocumento" value="<?php echo $acc_documento ?>" type="text" style="width:150px "/> <a href="javascript:BuscarPersonal()"> <img src="images/buscar.jpg" border="0"></a></td>
      </tr>
      
	  <tr>
	    <td colspan="2" ><strong><u>DATOS DEL BENEFICIARIO</u></strong> </td>
	    </tr>
	  <tr>
      <td colspan="2" >Nombre y Apellido del Docente Accidentado <font color="red"><b>(*)</b></font><br>
      <input id="txtAccNombre" name="txtAccNombre" type="text" value="<?php echo $acc_nombre ?>" size="70" maxlength="70" />	  </td></tr>
      
      <tr>
      <td >Fecha de nacimiento<br>
      <input id="txtAccFechaNac" name="txtAccFechaNac" type="text" value="<?php echo $acc_fechanac ?>" style="width:150px" />	  </td>
      <td >Sexo<br>
        <select name="cmbAccSexo" id="cmbAccSexo" >
          <option value="F" <?php if($acc_sexo=="F") echo "selected"?>>Femenino</option>
          <option value="M" <?php if($acc_sexo=="M") echo "selected"?>>Masculino</option>
        </select></td>
      </tr>
      
      <tr>
        <td colspan="2" >Cargo<br>
          <input name="txtAccCargo" type="text" id="txtAccCargo" value="<?php echo $acc_cargo?>" size="70" maxlength="70" /></td>
      </tr>
      
      <tr>
        <td colspan="2" ><strong><u>DATOS DE RESIDENCIA </u></strong></td>
      </tr>
      <tr>
      <td colspan="2" >Domicilio<br>
      <input id="txtAccDomicilio" name="txtAccDomicilio" type="text" value="<?php echo $acc_domicilio ?>"  size="70" maxlength="70" />      </td></tr>
      <tr>
      <td colspan="2" >Tel&eacute;fono o Contacto<br>
        <input id="txtAccTelefono" name="txtAccTelefono" type="text" value="<?php echo $acc_telefono ?>" /></td>
      </tr>
      <tr>
        <td colspan="2" ><strong><u>DATOS DE LA LICENCIA </u></strong></td>
      </tr>
      
    
                <tr>
                  <td colspan="2" ><strong><i>Tipo de Solicitud</i></strong><br>
                    <table border="0" cellpadding="0" cellspacing="0" >
                      <tr>
                        <td><input type="radio" id="r_AccSolicitud" name="r_AccSolicitud" value="P" <?php if($acc_solicitud=="P") echo "checked"?> />                        </td>
                        <td><label>Primera vez </label></td>
                        <td width="20">&nbsp;</td>
                        <td><input type="radio" id="r_AccSolicitud" name="r_AccSolicitud" value="R" <?php if($acc_solicitud=="R") echo "checked"?>/>                        </td>
                        <td><label>Renovaci&oacute;n</label></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td ><strong><i>Aporte</i></strong><br>
                    <table border="0" cellpadding="0" cellspacing="0" >
                      <tr>
                        <td><input type="radio" id="r_AccAporte" name="r_AccAporte" value="S" <?php if($acc_aporte=="S") echo "checked"?> />                        </td>
                        <td><label>SI</label></td>
                        <td width="20">&nbsp;</td>
                        <td><input type="radio" id="r_AccAporte" name="r_AccAporte" value="N" <?php if($acc_aporte=="N") echo "checked"?>/>                        </td>
                        <td><label>NO</label></td>
                      </tr>
                  </table></td>
                  <td ><strong><i>A.R.T</i></strong><br>
                    <table border="0" cellpadding="0" cellspacing="0" >
                      <tr>
                        <td><input type="radio" id="r_AccArt" name="r_AccArt" value="S" <?php if($acc_art=="S") echo "checked"?> />                        </td>
                        <td><label>SI</label></td>
                        <td width="20">&nbsp;</td>
                        <td><input type="radio" id="r_AccArt" name="r_AccArt" value="N" <?php if($acc_art=="N") echo "checked"?>/>                        </td>
                        <td><label>NO</label></td>
                      </tr>
                  </table></td>
                </tr>
               
			   <tr>
                  <td colspan="2" ><strong><i>Seguimiento de la denuncia</i></strong> <br>
                    <table border="0" cellpadding="0" cellspacing="0" >
                      <tr>
                        <td><input type="radio" id="r_AccSeguimiento" name="r_AccSeguimiento" value="I" <?php if($acc_seguimiento=="I") echo "checked"?> />                        </td>
                        <td><label>Para seguimiento Institucional</label></td>
                        <td width="20">&nbsp;</td>
                        <td><input type="radio" id="r_AccSeguimiento" name="r_AccSeguimiento" value="J" <?php if($acc_seguimiento=="J") echo "checked"?>/>                        </td>
                        <td><label>Para Junta Médica</label></td>
                      </tr>
               </table></td>
            </tr>
			    <tr>
                  <td colspan="2" >Fecha de Inicio de la licencia<br>
                    <?php require_once('calendar/classes/tc_calendar.php'); ?>
                  <?php 
			$myCalendar = new tc_calendar("txtACCInicio", true, false);
			$myCalendar->setIcon("calendar/images/iconCalendar.gif");
			if ($acc_inicio!='')
			{
			$myCalendar->setDateYMD($acc_inicio);
			}
			else
			{
			//$myCalendar->setDate(date('d'), date('m'), date('Y'));
			}
			$myCalendar->setPath("calendar/");
			$myCalendar->setYearInterval(2014, 2022);
			$myCalendar->dateAllow('2014-01-01', '2022-12-31');
			$myCalendar->setDateFormat('j F Y');
			$myCalendar->setAlignment('left', 'bottom');
			$myCalendar->writeScript();
			?></td>
                </tr>
	<tr>
                  <td >Fecha de próxima junta médica<br>
                    <?php require_once('calendar/classes/tc_calendar.php'); ?>
                  <?php 
			$myCalendar = new tc_calendar("txtACCJunta", true, false);
			$myCalendar->setIcon("calendar/images/iconCalendar.gif");
			if ($acc_junta!='')
			{
			$myCalendar->setDateYMD($acc_junta);
			}
			else
			{
			//$myCalendar->setDate(date('d'), date('m'), date('Y'));
			}
			$myCalendar->setPath("calendar/");
			$myCalendar->setYearInterval(2014, 2022);
			$myCalendar->dateAllow('2014-01-01', '2022-12-31');
			$myCalendar->setDateFormat('j F Y');
			$myCalendar->setAlignment('left', 'bottom');
			$myCalendar->writeScript();
			?></td>
                  <td >Hora de pr&oacute;xima junta m&eacute;dica<br>
				  <input  type="time" name="txtAccJuntaHora" value="<?php echo $acc_juntahora?>" step="1" style="width:150px" /></td>
      
				  </td>
	</tr>			
                <tr>
                  <td colspan="2" >Especialidad<br>
				  <select name="cmbDEEspecialidad" id="cmbDEEspecialidad">
	    <?php while($row=mysqli_fetch_assoc($de_esp)) { ?>
	    <option value="<?php echo $row["IDEspecialidad"]?>" <?php if($row["IDEspecialidad"]==$acc_especialidad) echo "selected"?>><?php echo $row["Descripcion"]?></option>
	    <?php } ?>
	    </select>				  </td>
                </tr>
                <tr>

                  <td colspan="2" >Diagn&oacute;stico Presuntivo <br>
                  <textarea name="txtDEDiagnostico"  id="txtDEDiagnostico" ><?php echo $de_diagnostico ?></textarea>                  </td></tr>
				  
				  <tr>

                  <td colspan="2" >Observaciones <br>
                  <textarea name="txtDEObservaciones"  id="txtDEObservaciones" ><?php echo $de_observaciones?></textarea>                  </td></tr>
			 
	        <tr><td colspan="2">Estado de la solicitud <br>
				   <select name="cmbEstado" id="cmbEstado" tyle="width:120px ">
        		<option value="A" <?php if($acc_estado=="A") echo "selected"?>>Abierta/En trámite</option>
                <option value="C" <?php if($acc_estado=="C") echo "selected"?>>Cerrada/Finalizada</option>
              </select>
			</td></tr>	  
		 <?php if ($id != '' )  { ?>
		 <tr>
          <td colspan="2" align="left" class="tahoma11">Archivo Adjunto:<br>
            <input name="fileArchivo" type="file" class="tahoma12" id="fileArchivo"  />          </td>
        </tr>
        
		
		<?php  // listo los archivos asociados

				$sql = mysqli_query($link,"SELECT * FROM denuncias_docentes_adjuntos WHERE IDDenunciaDocente=$id");

				?>
        
		
		
		
		<tr>
          <td height="26" colspan="4" align="center" class="tahoma12"><div align="left"><b>Listado de Archivos Asociados</b></div></td>
        </tr>
        <?php while($row =  mysqli_fetch_assoc($sql)){?>
        <tr>
          <td height="26" colspan="4" align="left" class="tahoma12">* <a href="archivos_docentes/<?php echo $row["Archivo"]?>" target="_blank" title="abrir archivo"><?php echo $row["Archivo"]?></a> &nbsp;&nbsp;&nbsp; (<a href="javascript:eliminar_archivos('<?php echo $row["IDAdjunto"]?>');">eliminar archivo</a>)</td>
        </tr>
        <?php } ?>
		<?php } ?>
		
                <tr>
                  <td align="center" colspan="2"><h1><b><font color="red"><?php echo $mensaje ?></font></b></h1></td>
                </tr>
                <tr>

                  <td align="center" colspan="2">

                  <input name="Submit3" type="button" value="GUARDAR" onClick="guardar();"  />
			      &nbsp;<input name="Submit" type="button"  value="ELIMINAR" onClick="eliminar();" />
				  &nbsp;<input name="Submit2" type="button" value="NUEVO FORMULARIO" onClick="window.open('denuncias_docentes.php','_self');" />				  </td>
                </tr>
          </table>
	   	<input type="hidden" name="action" id="action">
		<input type="hidden" name="id_den" id="id_den" value="<?php echo $id?>">
 		<input type="hidden" name="id_adjunto" id="id_adjunto">

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
=======
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
$mensaje="(*) Datos Obligatorios";
$de_institucion = $_POST["cmbDEInst"];
$acc_nombre = $_POST["txtAccNombre"];
$acc_tipodoc = $_POST["cmbAccTipoDoc"];
$acc_documento = $_POST["txtAccDocumento"];
$acc_fechanac = $_POST["txtAccFechaNac"];
$acc_sexo= $_POST["cmbAccSexo"];
$acc_cargo= $_POST["txtAccCargo"];
$acc_domicilio = $_POST["txtAccDomicilio"];
$acc_barrio = "";
$acc_provincia = "4";
$acc_localidad = "";
$acc_telefono = $_POST["txtAccTelefono"];
$de_fecha = $fecalta;
$acc_inicio = $_POST["txtACCInicio"];
$acc_junta = $_POST["txtACCJunta"];
$acc_juntahora = $_POST["txtAccJuntaHora"];
$acc_especialidad = $_POST["cmbDEEspecialidad"];
$de_diagnostico= $_POST["txtDEDiagnostico"];
$de_observaciones= $_POST["txtDEObservaciones"];
$acc_solicitud= $_POST["r_AccSolicitud"];
$acc_aporte= $_POST["r_AccAporte"];
$acc_art= $_POST["r_AccArt"];
$acc_seguimiento= $_POST["r_AccSeguimiento"];
if ($acc_seguimiento == "") 
{
$acc_seguimiento='J';
}
$acc_estado= $_POST["cmbEstado"];
$id=$_REQUEST["id_den"];

//datos del archivo
$archivo=$HTTP_POST_FILES['fileArchivo']['name'];
$tipo_archivo=$HTTP_POST_FILES['fileArchivo']['type'];
$tamano_archivo=$HTTP_POST_FILES['fileArchivo']['size'];


/************************************************************************************************************************
ACCIONES
************************************************************************************************************************/
if($_POST["action"] == "G" && $id!="")
{
	if($de_institucion!="" && $acc_documento!="" && $acc_nombre!="" && $de_fecha!="")
	{
		mysqli_query($link,"UPDATE denuncias_docentes SET
						DE_IDInstitucion = $de_institucion,
						ACC_Nombre = '$acc_nombre',
						ACC_TipoDoc = 1,
						ACC_Documento = '$acc_documento',
		  				ACC_Sexo = '$acc_sexo',
						ACC_FechaNac = '$acc_fechanac',
						ACC_Cargo = '$acc_cargo',
						ACC_Domicilio = '$acc_domicilio',
						ACC_Barrio = '$acc_barrio',
						ACC_IDProvincia = 4,
						ACC_Localidad = '$acc_localidad',
						ACC_Telefono = '$acc_telefono',
						ACC_Art = '$acc_art',
						ACC_Inicio = '$acc_inicio',
						ACC_Junta = '$acc_junta',
						ACC_JuntaHora = '$acc_juntahora',
						ACC_Solicitud= '$acc_solicitud',
						ACC_Aporte = '$acc_aporte',
						DE_Fecha = '$de_fecha',
						DE_DiagnosticoPres = '$de_diagnostico',
						DE_Observaciones = '$de_observaciones',
						ACC_Seguimiento= '$acc_seguimiento',
						ACC_Estado = '$acc_estado',
						ACC_IDEspecialidad = '$acc_especialidad',
						AudUsrModi='$usrmodi',
						AudFecModi='$fecmodi'
					 WHERE ID = $id");
		$mensaje = 	"Formulario de Salud Ocupacional actualizado";
		?>
		<script>
		window.alert("El formulario ha sido modificado correctamente");
		</script>
		<?php
		
		//*************** pregunto si cargo el archivo
			if($archivo!="")
			{
				mysqli_query($link,"INSERT INTO denuncias_docentes_adjuntos(IDDenunciaDocente, AudUsrAlta, AudFecAlta)
							 VALUES ($id, '$usralta', '$fecalta')");
				$id_adjunto = mysqli_insert_id($link);
				if(move_uploaded_file($HTTP_POST_FILES['fileArchivo']['tmp_name'], "archivos_docentes/".$archivo))
				{
					$sql="UPDATE denuncias_docentes_adjuntos set Archivo='$archivo' WHERE IDAdjunto=$id_adjunto";
					$r=mysqli_query($link, $sql);
					$mensaje = 	"Archivos cargados";
				}
				else
				{
					$mensaje = 	"Se produjo un error al subir el archivo";
				}
			}
	
		
	}
	else
	{
		$mensaje = 	"(*) Datos Obligatorios";
	}
}

if($_POST["action"] == "G" && $id=="")
{
		
	if($de_institucion!="" && $acc_documento!="" && $acc_nombre!=""  && $de_fecha!="")
	{
		// verifico que no existe ingresada algun formulario para la misma persona ABIERTO por cada INSTITUCION
		//$str = "SELECT count(*) as cantidad FROM denuncias_docentes WHERE DE_IDInstitucion=$de_institucion AND ACC_Documento='$acc_documento' AND ACC_Estado='A'";
		//echo $str; 
		$sql_formulario = mysqli_fetch_assoc(mysqli_query($link,"SELECT count(*) as cantidad FROM denuncias_docentes WHERE DE_IDInstitucion=$de_institucion AND ACC_Documento='$acc_documento' AND ACC_Estado='A'"));
		if ($sql_formulario["cantidad"] < 1) 
		{ 
			?>
			<script>
			window.alert("NO EXISTE");
			</script>
	    	<?php
			
			mysqli_query($link,"INSERT INTO denuncias_docentes (DE_IDInstitucion, ACC_Nombre, ACC_TipoDoc, ACC_Documento, ACC_Sexo, ACC_FechaNac , ACC_Cargo, ACC_Domicilio, ACC_Barrio, ACC_IDProvincia, ACC_Localidad, ACC_Telefono, ACC_Art, ACC_Inicio, ACC_Junta, ACC_JuntaHora, ACC_Solicitud, ACC_Aporte, DE_Fecha, ACC_IDEspecialidad, DE_DiagnosticoPres, DE_Observaciones, ACC_Seguimiento,  ACC_Estado, Enviado_AuditoriaMedica, AudUsrAlta, AudFecAlta, AudUsrModi, AudFecModi, vigente) VALUES ('$de_institucion', '$acc_nombre', 1, '$acc_documento', '$acc_sexo',  '$acc_fechanac', '$acc_cargo', '$acc_domicilio', '$acc_barrio', 4, '$acc_localidad', '$acc_telefono', '$acc_art', '$acc_inicio', '$acc_junta', '$acc_juntahora', '$acc_solicitud', '$acc_aporte', '$de_fecha', '$acc_especialidad', '$de_diagnostico', '$de_observaciones', '$acc_seguimiento',  'A', '1','$usralta', '$fecalta', '$usrmodi', '$fecmodi','1')");
				$id = mysqli_insert_id($link);
				// inserto datos a la auditoria medica // pasa derecho a auditoria
				
				mysqli_query($link,"INSERT INTO auditoriamedica_docentes (IDDenuncia, FechaEnvio,IDEstadoAuditoria, AudUsrAlta, AudFecAlta)	VALUES ($id, '$fecalta', '1', '$usralta', '$fecalta')");
			
				// inserto datos del personal en la tabla PERSONAL si no EXISTE
				$acc_documento = str_replace(".","",$acc_documento);
				$sql_personal = mysqli_fetch_assoc(mysqli_query($link,"SELECT count(*) as cantidad FROM personal WHERE IDInstitucion=$de_institucion AND Documento='$acc_documento' AND Nombre='$acc_nombre'"));
		
				if ($sql_personal["cantidad"] < 1) 
		
				{
		
				mysqli_query($link,"INSERT INTO personal (IDInstitucion, Nombre, TipoDoc, Documento, Direccion, Localidad, IDProvincia,  Telefono, Barrio, FechaNacimiento, Cargo, AudUsrAlta, AudFecAlta, AudUsrModi, AudFecModi, vigente)
		
							VALUES ($de_institucion, '$acc_nombre', '1', '$acc_documento', '$acc_domicilio', '$acc_localidad', '4', '$acc_telefono', '$acc_barrio',  '$acc_fechanac',  '$acc_cargo', '$usralta', '$fecalta', '$usrmodi', '$fecmodi', '1')");
		
				}			
				
				$destinatario = "saludocupacional@jaeccba.org.ar"; 
				$asunto = "Sistema de Gestión - Nuevo Formulario de Salud Ocupacional"; 
				$correo_alta_persona = $_SESSION["Nombre_Usuario"];
				$correo_alta_fecha = date("Y-m-d H:i:s");
				$correo_id_denuncia = date("Y-m-d H:i:s");
			
		
				// selecciono el nombre de la Institucion
				$nombre_institucion = mysqli_fetch_assoc(mysqli_query($link,"SELECT Nombre, Telefono FROM instituciones WHERE ID='" . $_SESSION["Institucion"]."'"));
				$correo_institucion = $nombre_institucion["Nombre"];
				$correo_telefono = $nombre_institucion["Telefono"];
		
				// selecciono el nombre de la Especialidad				
			    $nombre_especialidad = mysqli_fetch_assoc(mysqli_query($link,"SELECT Descripcion FROM especialidades WHERE IDEspecialidad='".$acc_especialidad."'"));	
				$correo_especialidad = $nombre_especialidad["Descripcion"];
		
				// selecciono el tipo de Seguimiento
				if ($acc_seguimiento == 'J')  
				{
				$correo_seguimiento ='PARA JUNTA MEDICA';
				}
				if ($acc_seguimiento == 'I')  
				{
				$correo_seguimiento ='PARA SEGUIMIENTO INSTITUCIONAL';
				}
				
				
				$cuerpo = 'Nº Solicitud: '.$id.  '<br> Usuario_Alta: '.$correo_alta_persona.  '<br> Fecha_Alta: '.$correo_alta_fecha.  '<br> Institución: '.$correo_institucion.  '<br>   Teléfono: '.$correo_telefono.  '<br> Nombre del Accidentado: '.$acc_nombre.  '<br> Fecha próxima Junta Médica: '.$acc_junta.  '<br> Hora próxima Junta Médica: '.$acc_juntahora.  '<br> Especialidad: '.$correo_especialidad.  '<br> <strong>Seguimiento de la Denuncia: '.$correo_seguimiento.  '</strong><br> <a href="http://www.jaeccba.org.ar/fs">Acceda al sistema para más detalles</a>'; 
				//para el envío en formato HTML 
				$headers = "MIME-Version: 1.0\r\n"; 
				$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
				//dirección del remitente 
				$headers .= "From: saludocupacional@jaeccba.org.ar\r\n";
				//direcciones que recibirán copia oculta 
				$headers .= "Bcc: lorena.abatidaga@gmail.com\r\n"; 
				mail($destinatario,$asunto,$cuerpo,$headers);
				// **************** fin envio de datos por correo
				$mensaje = 	"Formulario Registrado. El formulario ha sido enviado por correo"  ;
				?>
				<script>
				window.alert("El formulario ha sido registrado y enviado por correo electónico a JAEC");
				</script>
				<?php
			}
			else
			{
			?>
			<script>
			window.alert("YA EXISTE UNA SOLICITUD PARA ESTA PERSONA EN ESTADO ABIERTA. NO PODRA GENERAR UNA NUEVA HASTA CERRAR LA ANTERIOR");
			</script>
	    	<?php
			}
	}
	else

	{

		$mensaje = 	"(*) Datos Obligatorios";

	}

}

//eliminar adjuntos

if($_POST["action"] == "EA")
{
	mysqli_query($link,"DELETE FROM denuncias_docentes_adjuntos WHERE IDAdjunto=". $_POST["id_adjunto"]);
}

if($_POST["action"] == "E" && $id!="")

{
	mysqli_query($link,"UPDATE denuncias_docentes SET vigente='0', AudUsrModi='$usrmodi', AudFecModi='$fecmodi' WHERE ID=$id");

	$de_institucion = "";
	$acc_nombre = "";
	$acc_tipodoc = "";
	$acc_documento = "";
	$acc_fechanac = "";
	$acc_sexo = "";
	$acc_cargo= "";
	$acc_domicilio = "";
	$acc_barrio = "";
	$acc_provincia = "";
	$acc_localidad = "";
	$acc_telefono = "";
	$de_fecha = "";
	$de_diagnostico = "";
	$de_observaciones = "";
	$acc_estado="";
	$acc_aporte= "";
	$acc_solicitud = "";
	$acc_seguimiento = "";
	$acc_art = "";
	$acc_inicio= "";
	$acc_junta= "";
	$acc_juntahora= "";
	$acc_especialidad = "";
	$id = "";

	$mensaje = 	"Formulario de Salud Ocupacional eliminado";
}

if($id != "")
{
	$sql = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM denuncias_docentes WHERE vigente='1' AND ID=$id"));
	$de_institucion = $sql["DE_IDInstitucion"];
	$acc_nombre = $sql["ACC_Nombre"];
	$acc_tipodoc = $sql["ACC_TipoDoc"];
	$acc_documento = $sql["ACC_Documento"];
	$acc_sexo= $sql["ACC_Sexo"];
	$acc_fechanac = $sql["ACC_FechaNac"];
	$acc_cargo= $sql["ACC_Cargo"];
	$acc_domicilio = $sql["ACC_Domicilio"];
	$acc_barrio = $sql["ACC_Barrio"];
	$acc_provincia = $sql["ACC_IDProvincia"];
	$acc_localidad = $sql["ACC_Localidad"];
	$acc_telefono = $sql["ACC_Telefono"];
	$acc_art= $sql["ACC_Art"];
	$acc_inicio= $sql["ACC_Inicio"];
	$acc_junta= $sql["ACC_Junta"];
	$acc_juntahora= $sql["ACC_JuntaHora"];
	$acc_aporte= $sql["ACC_Aporte"];
	$acc_solicitud = $sql["ACC_Solicitud"];
	$de_fecha = $sql["DE_Fecha"];
	$de_diagnostico = $sql["DE_DiagnosticoPres"];
	$de_observaciones = $sql["DE_Observaciones"];
	$acc_seguimiento = $sql["ACC_Seguimiento"];
	$acc_estado = $sql["ACC_Estado"];
	$acc_especialidad= $sql["ACC_IDEspecialidad"];
	$id=$sql["ID"];
}

//tabla tipo  instituciones
$de_inst=mysqli_query($link,"SELECT * FROM instituciones  WHERE vigente='1' ORDER BY nombre");
$de_inst_id=mysqli_query($link,"SELECT * FROM instituciones  WHERE vigente='1' AND ID='" .$_SESSION["Institucion"]. "' ORDER BY nombre");
$de_esp=mysqli_query($link,"SELECT * FROM especialidades ORDER BY Descripcion");

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
<script language="javascript" src="calendar/calendar.js"></script>
<script language="javascript">
function BuscarPersonal()
{
intDNI=window.frm.txtAccDocumento.value;
url="buscar_personal.php?dni=" + intDNI;
window.open(url,'_blank','status=0,toolbar=0,width=10,height=10,left=300, top=100')
}
function eliminar()
{
	if (confirm('¿Está seguro de eliminar el Formulario de Salud Ocupacional?'))
	{
		frm.action.value='E';
		frm.submit();
	}	 
}

function eliminar_archivos(id)
{
	if (confirm('¿Está seguro de eliminar el registro?'))
	{
		frm.action.value="EA";
		frm.id_adjunto.value= id;		
		frm.submit();
	}	 
}

function guardar()
{
	if (frm.txtAccDocumento.value == "" && frm.txtAccNombre.value == "")
	{
	window.alert("DNI, NOMBRE y FECHA DEL FORMULARIO DE SALUD son datos obligatorios!")
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
	<img src="images/map.png" width="30" height="36" border="0"> <b>Formulario Carpetas y Juntas Medicas</b>
	</div>
   
    <div class="clear2"> </div>
    <div >
         <form name="frm" id="frm" action="" method="post" enctype="multipart/form-data">

	  <!-- inicio tabla de datos -->
	  <table width="100%" cellpadding="0" cellspacing="0">
      <?php if ($id != "" ) { ?>
	  <tr>
	  
	  <td colspan="2" style="text-align:left; font-size:20px"><strong>Solicitud N°: <?php echo $id;?> - 
	  <?php if ($acc_estado=='A') { ?> 
	  <font color="#009900" ><?php echo "Abierta";?></font>
	  <?php } ?>
	  <?php if ($acc_estado=='C') { ?> 
	  <font color="#0033CC"><?php echo "Cerrada";?></font>
	  <?php } ?>
	  
	  </strong> </td>
	  </tr>
      <?php } ?>
	  <tr>
      <!-- SI LA INSTITUCION ES JAEC LISTO TODAS-->
	  <?php if ($_SESSION["Institucion"]==14) {?>
	  <td width="48%" colspan="2" >Indique la Intitución:<br>
	  <select name="cmbDEInst" id="cmbDEInst" style="width:500px">
	    <?php while($row=mysqli_fetch_assoc($de_inst)) { ?>
	    <option value="<?php echo $row["ID"]?>" <?php if($row["ID"]==$de_institucion) echo "selected"?>><?php echo $row["Nombre"]?></option>
	    <?php } ?>
	    </select>	    </td><?php } ?>
      <!-- SI LA INSTITUCION NO ES JAEC LISTO  SOLO LA INSTITUCION DEL USUARIO-->
      <?php if ($_SESSION["Institucion"]!=14) {?>
      <td width="39%">
		  <select name="cmbDEInst" id="cmbDEInst" style="width:500px">
		  <?php while($row=mysqli_fetch_assoc($de_inst_id)) { ?>
		  <option value="<?php echo $row["ID"]?>" <?php if($row["ID"]==$de_institucion) echo "selected"?>><?php echo $row["Nombre"]?></option>
		  <?php } ?>
		  </select>		  </td>
	  <?php } ?>
	  </tr>
      
      <tr>
       <td valign="middle" >DNI Docente <font color="red"><b>(*)</b></font> <br>
        <input name="txtAccDocumento" id="txtAccDocumento" value="<?php echo $acc_documento ?>" type="text" style="width:150px "/> <a href="javascript:BuscarPersonal()"> <img src="images/buscar.jpg" border="0"></a></td>
      </tr>
      
	  <tr>
	    <td colspan="2" ><strong><u>DATOS DEL BENEFICIARIO</u></strong> </td>
	    </tr>
	  <tr>
      <td colspan="2" >Nombre y Apellido del Docente Accidentado <font color="red"><b>(*)</b></font><br>
      <input id="txtAccNombre" name="txtAccNombre" type="text" value="<?php echo $acc_nombre ?>" size="70" maxlength="70" />	  </td></tr>
      
      <tr>
      <td >Fecha de nacimiento<br>
      <input id="txtAccFechaNac" name="txtAccFechaNac" type="text" value="<?php echo $acc_fechanac ?>" style="width:150px" />	  </td>
      <td >Sexo<br>
        <select name="cmbAccSexo" id="cmbAccSexo" >
          <option value="F" <?php if($acc_sexo=="F") echo "selected"?>>Femenino</option>
          <option value="M" <?php if($acc_sexo=="M") echo "selected"?>>Masculino</option>
        </select></td>
      </tr>
      
      <tr>
        <td colspan="2" >Cargo<br>
          <input name="txtAccCargo" type="text" id="txtAccCargo" value="<?php echo $acc_cargo?>" size="70" maxlength="70" /></td>
      </tr>
      
      <tr>
        <td colspan="2" ><strong><u>DATOS DE RESIDENCIA </u></strong></td>
      </tr>
      <tr>
      <td colspan="2" >Domicilio<br>
      <input id="txtAccDomicilio" name="txtAccDomicilio" type="text" value="<?php echo $acc_domicilio ?>"  size="70" maxlength="70" />      </td></tr>
      <tr>
      <td colspan="2" >Tel&eacute;fono o Contacto<br>
        <input id="txtAccTelefono" name="txtAccTelefono" type="text" value="<?php echo $acc_telefono ?>" /></td>
      </tr>
      <tr>
        <td colspan="2" ><strong><u>DATOS DE LA LICENCIA </u></strong></td>
      </tr>
      
    
                <tr>
                  <td colspan="2" ><strong><i>Tipo de Solicitud</i></strong><br>
                    <table border="0" cellpadding="0" cellspacing="0" >
                      <tr>
                        <td><input type="radio" id="r_AccSolicitud" name="r_AccSolicitud" value="P" <?php if($acc_solicitud=="P") echo "checked"?> />                        </td>
                        <td><label>Primera vez </label></td>
                        <td width="20">&nbsp;</td>
                        <td><input type="radio" id="r_AccSolicitud" name="r_AccSolicitud" value="R" <?php if($acc_solicitud=="R") echo "checked"?>/>                        </td>
                        <td><label>Renovaci&oacute;n</label></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td ><strong><i>Aporte</i></strong><br>
                    <table border="0" cellpadding="0" cellspacing="0" >
                      <tr>
                        <td><input type="radio" id="r_AccAporte" name="r_AccAporte" value="S" <?php if($acc_aporte=="S") echo "checked"?> />                        </td>
                        <td><label>SI</label></td>
                        <td width="20">&nbsp;</td>
                        <td><input type="radio" id="r_AccAporte" name="r_AccAporte" value="N" <?php if($acc_aporte=="N") echo "checked"?>/>                        </td>
                        <td><label>NO</label></td>
                      </tr>
                  </table></td>
                  <td ><strong><i>A.R.T</i></strong><br>
                    <table border="0" cellpadding="0" cellspacing="0" >
                      <tr>
                        <td><input type="radio" id="r_AccArt" name="r_AccArt" value="S" <?php if($acc_art=="S") echo "checked"?> />                        </td>
                        <td><label>SI</label></td>
                        <td width="20">&nbsp;</td>
                        <td><input type="radio" id="r_AccArt" name="r_AccArt" value="N" <?php if($acc_art=="N") echo "checked"?>/>                        </td>
                        <td><label>NO</label></td>
                      </tr>
                  </table></td>
                </tr>
               
			   <tr>
                  <td colspan="2" ><strong><i>Seguimiento de la denuncia</i></strong> <br>
                    <table border="0" cellpadding="0" cellspacing="0" >
                      <tr>
                        <td><input type="radio" id="r_AccSeguimiento" name="r_AccSeguimiento" value="I" <?php if($acc_seguimiento=="I") echo "checked"?> />                        </td>
                        <td><label>Para seguimiento Institucional</label></td>
                        <td width="20">&nbsp;</td>
                        <td><input type="radio" id="r_AccSeguimiento" name="r_AccSeguimiento" value="J" <?php if($acc_seguimiento=="J") echo "checked"?>/>                        </td>
                        <td><label>Para Junta Médica</label></td>
                      </tr>
               </table></td>
            </tr>
			    <tr>
                  <td colspan="2" >Fecha de Inicio de la licencia<br>
                    <?php require_once('calendar/classes/tc_calendar.php'); ?>
                  <?php 
			$myCalendar = new tc_calendar("txtACCInicio", true, false);
			$myCalendar->setIcon("calendar/images/iconCalendar.gif");
			if ($acc_inicio!='')
			{
			$myCalendar->setDateYMD($acc_inicio);
			}
			else
			{
			//$myCalendar->setDate(date('d'), date('m'), date('Y'));
			}
			$myCalendar->setPath("calendar/");
			$myCalendar->setYearInterval(2014, 2022);
			$myCalendar->dateAllow('2014-01-01', '2022-12-31');
			$myCalendar->setDateFormat('j F Y');
			$myCalendar->setAlignment('left', 'bottom');
			$myCalendar->writeScript();
			?></td>
                </tr>
	<tr>
                  <td >Fecha de próxima junta médica<br>
                    <?php require_once('calendar/classes/tc_calendar.php'); ?>
                  <?php 
			$myCalendar = new tc_calendar("txtACCJunta", true, false);
			$myCalendar->setIcon("calendar/images/iconCalendar.gif");
			if ($acc_junta!='')
			{
			$myCalendar->setDateYMD($acc_junta);
			}
			else
			{
			//$myCalendar->setDate(date('d'), date('m'), date('Y'));
			}
			$myCalendar->setPath("calendar/");
			$myCalendar->setYearInterval(2014, 2022);
			$myCalendar->dateAllow('2014-01-01', '2022-12-31');
			$myCalendar->setDateFormat('j F Y');
			$myCalendar->setAlignment('left', 'bottom');
			$myCalendar->writeScript();
			?></td>
                  <td >Hora de pr&oacute;xima junta m&eacute;dica<br>
				  <input  type="time" name="txtAccJuntaHora" value="<?php echo $acc_juntahora?>" step="1" style="width:150px" /></td>
      
				  </td>
	</tr>			
                <tr>
                  <td colspan="2" >Especialidad<br>
				  <select name="cmbDEEspecialidad" id="cmbDEEspecialidad">
	    <?php while($row=mysqli_fetch_assoc($de_esp)) { ?>
	    <option value="<?php echo $row["IDEspecialidad"]?>" <?php if($row["IDEspecialidad"]==$acc_especialidad) echo "selected"?>><?php echo $row["Descripcion"]?></option>
	    <?php } ?>
	    </select>				  </td>
                </tr>
                <tr>

                  <td colspan="2" >Diagn&oacute;stico Presuntivo <br>
                  <textarea name="txtDEDiagnostico"  id="txtDEDiagnostico" ><?php echo $de_diagnostico ?></textarea>                  </td></tr>
				  
				  <tr>

                  <td colspan="2" >Observaciones <br>
                  <textarea name="txtDEObservaciones"  id="txtDEObservaciones" ><?php echo $de_observaciones?></textarea>                  </td></tr>
			 
	        <tr><td colspan="2">Estado de la solicitud <br>
				   <select name="cmbEstado" id="cmbEstado" tyle="width:120px ">
        		<option value="A" <?php if($acc_estado=="A") echo "selected"?>>Abierta/En trámite</option>
                <option value="C" <?php if($acc_estado=="C") echo "selected"?>>Cerrada/Finalizada</option>
              </select>
			</td></tr>	  
		 <?php if ($id != '' )  { ?>
		 <tr>
          <td colspan="2" align="left" class="tahoma11">Archivo Adjunto:<br>
            <input name="fileArchivo" type="file" class="tahoma12" id="fileArchivo"  />          </td>
        </tr>
        
		
		<?php  // listo los archivos asociados

				$sql = mysqli_query($link,"SELECT * FROM denuncias_docentes_adjuntos WHERE IDDenunciaDocente=$id");

				?>
        
		
		
		
		<tr>
          <td height="26" colspan="4" align="center" class="tahoma12"><div align="left"><b>Listado de Archivos Asociados</b></div></td>
        </tr>
        <?php while($row =  mysqli_fetch_assoc($sql)){?>
        <tr>
          <td height="26" colspan="4" align="left" class="tahoma12">* <a href="archivos_docentes/<?php echo $row["Archivo"]?>" target="_blank" title="abrir archivo"><?php echo $row["Archivo"]?></a> &nbsp;&nbsp;&nbsp; (<a href="javascript:eliminar_archivos('<?php echo $row["IDAdjunto"]?>');">eliminar archivo</a>)</td>
        </tr>
        <?php } ?>
		<?php } ?>
		
                <tr>
                  <td align="center" colspan="2"><h1><b><font color="red"><?php echo $mensaje ?></font></b></h1></td>
                </tr>
                <tr>

                  <td align="center" colspan="2">

                  <input name="Submit3" type="button" value="GUARDAR" onClick="guardar();"  />
			      &nbsp;<input name="Submit" type="button"  value="ELIMINAR" onClick="eliminar();" />
				  &nbsp;<input name="Submit2" type="button" value="NUEVO FORMULARIO" onClick="window.open('denuncias_docentes.php','_self');" />				  </td>
                </tr>
          </table>
	   	<input type="hidden" name="action" id="action">
		<input type="hidden" name="id_den" id="id_den" value="<?php echo $id?>">
 		<input type="hidden" name="id_adjunto" id="id_adjunto">

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
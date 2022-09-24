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


$mensaje="Complete los datos";

$am_empresa = $_POST["txtAMEmpresa"];
$am_tiempo = $_POST["txtAMTiempo"];
$am_ficha = $_POST["txtAMFicha"];
$am_valoracion = $_POST["cmbAMValoracion"];
$am_diagnostico = $_POST["txtAMDiagnostico"];
$ap_persona = $_POST["txtAPPersona"];
$ap_fecha = $_POST["txtAPFecha"];
$ap_hora = $_POST["txtAPHora"];
$af_persona = $_POST["txtAFPersona"];
$af_fecha = $_POST["txtAFFecha"];
$af_hora = $_POST["txtAFHora"];
$af_forma = $_POST["cmbAFForma"];

$id_den = $_REQUEST["id_den"];
$id = $_REQUEST["id_der"];
/************************************************************************************************************************

ACCIONES

************************************************************************************************************************/

if($_POST["action"] == "G" && $id!="")

{

	if($am_empresa!="")

	{

		mysqli_query($link,"UPDATE denuncias_docentes_emergencias SET

						AM_Empresa = '$am_empresa',

						AM_Tiempo = '$am_tiempo',

						AM_Ficha = '$am_ficha',

						AM_Valoracion = $am_valoracion,

						AM_Diagnostico = '$am_diagnostico',

						AP_Persona = '$ap_persona',

						AP_Fecha = '$ap_fecha',

						AP_Hora = '$ap_hora',

						AF_Persona = '$af_persona',

						AF_Fecha = '$af_fecha',

						AF_Hora = '$af_hora',

						AF_Forma = $af_forma,

						AudUsrModi='$usrmodi',

						AudFecModi='$fecmodi'

					 WHERE ID = $id");

		$mensaje = 	"Denuncia actualizada";

	}

	else

	{

		$mensaje = 	"Complete los datos";

	}

}



if($_POST["action"] == "G" && $id=="")

{

	if($am_empresa!="")

	{

		mysqli_query($link,"INSERT INTO denuncias_docentes_emergencias (IDDenuncia, AM_Empresa, AM_Tiempo, AM_Ficha, AM_Valoracion, AM_Diagnostico, AP_Persona, AP_Fecha, AP_Hora, AF_Persona, AF_Fecha, AF_Hora, AF_Forma, AudUsrAlta, AudFecAlta, AudUsrModi, AudFecModi, vigente)

					VALUES ($id_den, '$am_empresa', '$am_tiempo', '$am_ficha', $am_valoracion, '$am_diagnostico', '$ap_persona', '$ap_fecha', '$ap_hora', '$af_persona', '$af_fecha', '$af_hora', '$af_forma', '$usralta', '$fecalta', '$usrmodi', '$fecmodi', '1')");

	

		$id = mysqli_insert_id($link);

		

		$mensaje = 	"Denuncia actualizada";

	}

	else

	{

		$mensaje = 	"Complete los datos";

	}

}



if($_POST["action"] == "E" && $id!="")

{

	mysqli_query($link,"UPDATE denuncias_docentes_emergencias SET vigente='0', AudUsrModi='$usrmodi', AudFecModi='$fecmodi' WHERE ID=$id");

	$am_empresa = "";

	$am_tiempo = "";

	$am_ficha = "";

	$am_valoracion = "";

	$am_diagnostico = "";

	

	$ap_persona = "";

	$ap_fecha = "";

	$ap_hora = "";

	

	$af_persona = "";

	$af_fecha = "";

	$af_hora = "";

	$af_forma = "";

	

	$id = "";



	$mensaje = 	"Denuncia actualizada";

}



if($id_den != "")

{

	$sql = mysqli_query($link,"SELECT * FROM denuncias_docentes_emergencias WHERE vigente='1' AND IDDenuncia=$id_den");

	if($row=mysqli_fetch_assoc($sql)){ 	

		$am_empresa = $row["AM_Empresa"];

		$am_tiempo = $row["AM_Tiempo"];

		$am_ficha = $row["AM_Ficha"];

		$am_valoracion = $row["AM_Valoracion"];

		$am_diagnostico = $row["AM_Diagnostico"];

		

		

		$ap_persona = $row["AP_Persona"];

		$ap_fecha = $row["AP_Fecha"];

		$ap_hora = $row["AP_Hora"];

		

		$af_persona = $row["AF_Persona"];

		$af_fecha = $row["AF_Fecha"];

		$af_hora = $row["AF_Hora"];

		$af_forma = $row["AF_Forma"];

		

		$id = $row["ID"];

	}

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
<script language="javascript" src="calendar/calendar.js"></script>
<script language="javascript">

function eliminar(id)

{

	if (confirm('¿Está seguro de eliminar el registro?'))

	{

		frm.action.value='E';

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
    <div class="small-12 large-12 columns menunegro"> 
	
	<a href="denuncias_docentes.ayuda.php" class="linkblanco"><img src="animacion/interior/help.png" alt="ayuda" width="16" height="16" align="middle"> Ayuda</a>
	<?php if (id_den=="" ){?>
	<a href="denuncias_docentes.php" class="linkblanco"><img src="animacion/interior/nueva.jpg" alt="nueva" width="16" height="16" align="middle"> Nueva Denuncia </a>  
	<?php } else { ?>
	<a href="denuncias_docentes.php?id_den=<?php echo $id_den?>" class="linkblanco"><img src="animacion/interior/nueva.jpg" alt="nueva" width="16" height="16" align="middle"> Datos Denuncia </a>
	<?php } ?>
	<a href="#" class="linkblanco"><img src="animacion/interior/listado.jpg" alt="listado" width="16" height="15" align="middle"> Datos de Emergencias</a>
	</div>
    <div class="clear2"> </div>
    <div class="clear2"> </div>
    <div >
      <h1><b>Asistencia Médica de Emergencia</b> &nbsp;&nbsp;&nbsp;&nbsp;<b><font color="#FF0066"> ¡<?php echo $mensaje ?>!</font></b>  </h1>

      <form name="frm" id="frm" action="" method="post">

	  <!-- inicio tabla de datos -->
	  <table width="95%" border="0" cellspacing="0" cellpadding="0">


                <tr>
                  <td height="26" align="right" >&nbsp;</td>
                  <td colspan="3" align="left" >&nbsp;</td>
                </tr>
                <tr>

                  <td colspan="2" align="left" >Empresa:<br>
                  <input name="txtAMEmpresa" type="text" class="tahoma12" id="txtAMEmpresa" value="<?php echo $am_empresa?>" size="70" maxlength="70"  />                  </td>
                </tr>

                <tr>

                  <td colspan="2" align="left" >Tiempo esperado (en minutos):<br>
                  <input name="txtAMTiempo" type="text"  id="txtAMTiempo" value="<?php echo $am_tiempo?>" />                    </td>
                </tr>

                <tr>

                  <td colspan="2" align="left" >N&deg; de ficha cl&iacute;nica:<br>
                  <input name="txtAMFicha" type="text" class="tahoma12" id="txtAMFicha2" value="<?php echo $am_ficha?>" /></td>
                </tr>

                <tr>

                  <td colspan="2" align="left" class="tahoma11">

                  Valoración: <br>
                  <select name="cmbAMValoracion" id="cmbAMValoracion" class="tahoma12" style="width:120px ">

                    <option value="1" <?php if($am_valoracion=="1") echo "selected"?>>Gravedad</option>

                    <option value="2" <?php if($am_valoracion=="2") echo "selected"?>>Urgente</option>

                    <option value="3" <?php if($am_valoracion=="3") echo "selected"?>>Leve</option>
                  	</select>                  </td>
                </tr>

                <tr>

                  <td colspan="2" align="left" class="tahoma11">Diagn&oacute;stico y tratamiento:<br>
                  <textarea name="txtAMDiagnostico" cols="50" rows="7" class="tahoma12" id="txtAMDiagnostico" style="width:350px "><?php echo $am_diagnostico ?></textarea></td>
                </tr>

                <tr>

                  <td height="26" colspan="2" align="center" bgcolor="#999999" class="tahoma11"><span class="Estilo1">AVISO</span></td>
                </tr>

                <tr>

                  <td colspan="2" align="left" class="tahoma11">Persona avisada:<br>
                  <input name="txtAPPersona" type="text" class="tahoma12" id="txtAPPersona" value="<?php echo $ap_persona?>" size="70" maxlength="70" />                  </td>
                </tr>

                <tr>

                  <td width="131" align="left" class="tahoma11">Fecha: <br>
				  
			<?php require_once('calendar/classes/tc_calendar.php'); ?>

			<?php 
			$myCalendar = new tc_calendar("txtAPFecha", true, false);
			$myCalendar->setIcon("calendar/images/iconCalendar.gif");
			if ($ap_fecha!='')
			{
			$myCalendar->setDateYMD($ap_fecha);
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
			?>                 </td>

                  <td width="155" align="left" class="tahoma11">

                  Hora:<br>
                  <input name="txtAPHora" type="text" class="tahoma12" id="txtAPHora" value="<?php echo $ap_hora?>" />                  </td>
                </tr>

                

                <tr>

                  <td height="26" colspan="2" align="center" bgcolor="#999999" class="tahoma11"><span class="Estilo1">AVISO AL FSCR</span></td>
                </tr>

                <tr>

                  <td colspan="2" align="left" class="tahoma11">

                  Persona avisada:<br>
                  <input name="txtAFPersona" type="text" class="tahoma12" id="txtAFPersona" value="<?php echo $af_persona?>" size="70" maxlength="70"  />                  </td>
                </tr>

                <tr>

                  <td align="left" class="tahoma11">Fecha:<br>
                    <?php require_once('calendar/classes/tc_calendar.php'); ?>
                    <?php 
			        $myCalendar = new tc_calendar("txtAFFecha", true, false);
			        $myCalendar->setIcon("calendar/images/iconCalendar.gif");
			        if ($af_fecha!='')
			        {
			        $myCalendar->setDateYMD($af_fecha);
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
					?>            </td>


                  <td align="left" class="tahoma11">Hora:&nbsp;<br>
                  <input name="txtAFHora" type="text" class="tahoma12" id="txtAFHora3" value="<?php echo $af_hora?>" /></td>
                </tr>

                <tr>


                  <td colspan="2" align="left" class="tahoma11">

                  Forma de aviso:<br>
<select name="cmbAFForma" id="cmbAFForma" class="tahoma12">

                    <option value="1" selected="selected" <?php if($af_forma=="1") echo "selected"?>>Telefónica</option>

                    <option value="2" <?php if($af_forma=="2") echo "selected"?>>Fax</option>

                    <option value="3" <?php if($af_forma=="3") echo "selected"?>>Correo electrónico</option>

                    <option value="4" <?php if($af_forma=="4") echo "selected"?>>Otro medio</option>
                  	</select>                  </td>
                </tr>

                <tr>

                  <td height="26" colspan="2" align="center" class="tahoma12"><font color="red"><?php echo $mensaje ?></font></td>
                </tr>

                <tr>

                  <td height="26" colspan="2" align="center" class="tahoma11">

                  <input name="Submit3" type="button" class="btn" value="GUARDAR" onClick="frm.action.value='G'; frm.submit();" />

                  &nbsp;<input name="Submit" type="button" class="btn" value="ELIMINAR" onClick="eliminar();"  />                  </td>
                </tr>
              </table>
	   <input type="hidden" name="action" id="action">
	   <input name="id_den" type="hidden" id="id_den" value="<?php echo $id_den?>">
       <input name="id_der" type="hidden" id="id_der" value="<?php echo $id?>">

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
</html>
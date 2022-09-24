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

		mysqli_query($link,"UPDATE denuncias_emergencias SET

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

		mysqli_query($link,"INSERT INTO denuncias_emergencias (IDDenuncia, AM_Empresa, AM_Tiempo, AM_Ficha, AM_Valoracion, AM_Diagnostico, AP_Persona, AP_Fecha, AP_Hora, AF_Persona, AF_Fecha, AF_Hora, AF_Forma, AudUsrAlta, AudFecAlta, AudUsrModi, AudFecModi, vigente)

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

	mysqli_query($link,"UPDATE denuncias_emergencias SET vigente='0', AudUsrModi='$usrmodi', AudFecModi='$fecmodi' WHERE ID=$id");

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

	$sql = mysqli_query($link,"SELECT * FROM denuncias_emergencias WHERE vigente='1' AND IDDenuncia=$id_den");

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
     <div class="small-12 large-12 columns  menutitulo"> 
	<img src="images/map.png" width="30" height="36" border="0"> <b>Asistencia Médica de Emergencia para la <a href="denuncias.php?id_den=<?php echo $id_den?>">Denuncia N° <?php echo $id_den ?></a></b>
	</div>
     <div class="clear2"> </div>
    <div >
  
      <form name="frm" id="frm" action="" method="post">

	  <!-- inicio tabla de datos -->
	  <table width="95%" border="0" cellspacing="0" cellpadding="0">


                <tr>

                  <td align="left" >Empresa:<br>
                  <input name="txtAMEmpresa" type="text" id="txtAMEmpresa" value="<?php echo $am_empresa?>"  />                  </td>
                  <td align="left" >Tiempo esperado (en minutos):<br>
                    <input name="txtAMTiempo" type="text"  id="txtAMTiempo" value="<?php echo $am_tiempo?>" /></td>
                </tr>


                <tr>

                  <td align="left" >N&deg; de ficha cl&iacute;nica:<br>
                  <input name="txtAMFicha" type="text" id="txtAMFicha2" value="<?php echo $am_ficha?>" /></td>
                  <td align="left" >Valoraci&oacute;n: <br>
                    <select name="cmbAMValoracion" id="cmbAMValoracion" style="width:120px ">
                      <option value="1" <?php if($am_valoracion=="1") echo "selected"?>>Gravedad</option>
                      <option value="2" <?php if($am_valoracion=="2") echo "selected"?>>Urgente</option>
                      <option value="3" <?php if($am_valoracion=="3") echo "selected"?>>Leve</option>
                    </select></td>
                </tr>


                <tr>

                  <td colspan="2" align="left" >Diagn&oacute;stico y tratamiento:<br>
                  <textarea name="txtAMDiagnostico" cols="50" rows="7" id="txtAMDiagnostico"><?php echo $am_diagnostico ?></textarea></td>
                </tr>

                <tr>

                  <td  colspan="2" align="center"><b>AVISO A PADRES O TUTORES </b></td>
                </tr>

                <tr>

                  <td colspan="2" align="left" >Persona avisada:<br>
                  <input name="txtAPPersona" type="text" id="txtAPPersona" value="<?php echo $ap_persona?>"/>                  </td>
                </tr>

                <tr>

                  <td  align="left" >Fecha: <br>
				  
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
			$myCalendar->setYearInterval(2015, 2022);
			$myCalendar->dateAllow('2015-01-01', '2022-12-31');
			$myCalendar->setDateFormat('j F Y');
			$myCalendar->setAlignment('left', 'bottom');
			$myCalendar->writeScript();
			?>                 </td>

                  <td align="left" >

                  Hora:<br>
                  <input name="txtAPHora" type="text" id="txtAPHora" value="<?php echo $ap_hora?>" />                  </td>
                </tr>

                

                <tr>

                  <td colspan="2" align="center" ><b>AVISO AL FSCR</b></td>
                </tr>

                <tr>

                  <td colspan="2" align="left" >

                  Persona avisada:<br>
                  <input name="txtAFPersona" type="text" id="txtAFPersona" value="<?php echo $af_persona?>" />                  </td>
                </tr>

                <tr>

                  <td align="left" >Fecha:<br>
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
					$myCalendar->setYearInterval(2015, 2022);
					$myCalendar->dateAllow('2015-01-01', '2022-12-31');
					$myCalendar->setDateFormat('j F Y');
					$myCalendar->setAlignment('left', 'bottom');
					$myCalendar->writeScript();
					?>            </td>


                  <td align="left" >Hora:<br>
                  <input name="txtAFHora" type="text" id="txtAFHora" value="<?php echo $af_hora?>" /></td>
                </tr>

                <tr>


                  <td colspan="2" align="left" >

                  Forma de aviso:<br>
<select name="cmbAFForma" id="cmbAFForma" >

                    <option value="1" selected="selected" <?php if($af_forma=="1") echo "selected"?>>Telefónica</option>

                    <option value="2" <?php if($af_forma=="2") echo "selected"?>>Fax</option>

                    <option value="3" <?php if($af_forma=="3") echo "selected"?>>Correo electrónico</option>

                    <option value="4" <?php if($af_forma=="4") echo "selected"?>>Otro medio</option>
                  	</select>                  </td>
                </tr>

                <tr>

                  <td colspan="2" align="center" ><font color="red"><?php echo $mensaje ?></font></td>
                </tr>

                <tr>

                  <td  colspan="2" align="center" >

                  
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
    </div>
  </div>
</div>
</div>
<div class="clear"> </div>
<?php include("pie.php"); ?>
</body>
</html>
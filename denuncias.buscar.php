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
$mensaje="Complete los datos y haga clic en Buscar";
if ($_REQUEST["cmdbuscar"]) 
{ // si hizo clic en buscar
	$mensaje="Resultado de la búsqueda";
	$fec_desde= $_REQUEST["txtdesde"];
	$fec_hasta= $_REQUEST["txthasta"];
	if ($fec_desde=='0000-00-00') $fec_desde='';
    if ($fec_hasta=='0000-00-00') $fec_hasta='';
	$alumno=$_REQUEST["txtalumno"];
	$documento=str_replace(".","",$_REQUEST["txtdocumento"]);
	$numero=str_replace(".","",$_REQUEST["txtnumero"]);
	$ibuscar=$_REQUEST["cmbInst"];

	if ($fec_desde!='' && $fec_hasta!='')
	{
		if ($ibuscar!= "") 
		{
			$denuncias=mysqli_query($link,"SELECT a.ID, a.ACC_Nombre, b.Nombre as NomInst, DA_Fecha, a.ACC_Telefono, a.AudUsrAlta, a.Enviado_Auditoriamedica, a.Enviado_Seguro FROM denuncias a, instituciones b WHERE a.vigente='1' AND a.DE_IDInstitucion = b.ID  AND a.DE_IDInstitucion = ".$ibuscar." and a.ACC_Nombre like '%". $alumno ."%' and a.ACC_Documento like '%".$documento."%' and DA_Fecha BETWEEN '".$fec_desde."' and '".$fec_hasta."'  ORDER BY DA_Fecha DESC LIMIT 0,50");
		}
		else
		{
			$denuncias=mysqli_query($link,"SELECT a.ID, a.ACC_Nombre, b.Nombre as NomInst, DA_Fecha, a.ACC_Telefono, a.AudUsrAlta, a.Enviado_Auditoriamedica, a.Enviado_Seguro FROM denuncias a, instituciones b  WHERE a.DE_IDInstitucion=b.ID AND a.vigente='1' AND a.ACC_Nombre like '%". $alumno ."%' and a.ACC_Documento like '%".$documento."%' and DA_Fecha BETWEEN '".$fec_desde."' and '".$fec_hasta."'  ORDER BY DA_Fecha DESC LIMIT 0,50");
		}
	}
	
	if ($fec_desde!='' && $fec_hasta=='')
	{
		if ($ibuscar!= "") 
		{
		$denuncias=mysqli_query($link,"SELECT a.ID, a.ACC_Nombre, b.Nombre as NomInst, DA_Fecha, a.ACC_Telefono, a.AudUsrAlta, a.Enviado_Auditoriamedica, a.Enviado_Seguro FROM denuncias a, instituciones b WHERE a.vigente='1' AND a.DE_IDInstitucion = b.ID  AND a.DE_IDInstitucion = ".$ibuscar." and a.ACC_Nombre like '%". $alumno ."%' and a.ACC_Documento like '%".$documento."%' and DA_Fecha >= '".$fec_desde."' ORDER BY DA_Fecha DESC LIMIT 0,50");
		}
		else
		{
		$denuncias=mysqli_query($link,"SELECT a.ID, a.ACC_Nombre, b.Nombre as NomInst, DA_Fecha, a.ACC_Telefono, a.AudUsrAlta, a.Enviado_Auditoriamedica, a.Enviado_Seguro FROM denuncias a, instituciones b WHERE a.DE_IDInstitucion=b.ID AND a.vigente='1' AND a.ACC_Nombre like '%". $alumno ."%' and a.ACC_Documento like '%".$documento."%' and DA_Fecha >= '".$fec_desde."' ORDER BY DA_Fecha DESC LIMIT 0,50");
	
		}
	}
	
	if ($fec_desde =='' && $fec_hasta!='')
	{
		if ($ibuscar!= "") 
		{
		$denuncias=mysqli_query($link,"SELECT a.ID, a.ACC_Nombre, b.Nombre as NomInst, DA_Fecha, a.ACC_Telefono, a.AudUsrAlta, a.Enviado_Auditoriamedica, a.Enviado_Seguro FROM denuncias a, instituciones b WHERE a.vigente='1' AND a.DE_IDInstitucion = b.ID  AND a.DE_IDInstitucion = ".$ibuscar." and a.ACC_Nombre like '%". $alumno ."%' and a.ACC_Documento like '%".$documento."%' and DA_Fecha <= '".$fec_hasta."' ORDER BY DA_Fecha DESC LIMIT 0,50");
		}
		else
		{
		$denuncias=mysqli_query($link,"SELECT a.ID, a.ACC_Nombre, b.Nombre as NomInst, DA_Fecha, a.ACC_Telefono, a.AudUsrAlta, a.Enviado_Auditoriamedica, a.Enviado_Seguro FROM denuncias a, instituciones b WHERE a.DE_IDInstitucion=b.ID AND a.vigente='1' AND a.ACC_Nombre like '%". $alumno ."%' and a.ACC_Documento like '%".$documento."%' and DA_Fecha <= '".$fec_hasta."' ORDER BY DA_Fecha DESC LIMIT 0,50");
		}
	}
	
	if ($fec_desde =='' && $fec_hasta=='')
	{
		if ($ibuscar!= "") 
		{
		$denuncias=mysqli_query($link,"SELECT a.ID, a.ACC_Nombre, b.Nombre as NomInst, DA_Fecha, a.ACC_Telefono, a.AudUsrAlta, a.Enviado_Auditoriamedica, a.Enviado_Seguro FROM denuncias a, instituciones b WHERE a.vigente='1' AND a.DE_IDInstitucion = b.ID  AND a.DE_IDInstitucion = ".$ibuscar." and a.ACC_Nombre like '%". $alumno ."%' and a.ACC_Documento like '%".$documento."%' ORDER BY DA_Fecha DESC LIMIT 0,50");
		}
		else
		{
	
		$denuncias=mysqli_query($link,"SELECT a.ID, a.ACC_Nombre, b.Nombre as NomInst, DA_Fecha, a.ACC_Telefono, a.AudUsrAlta, a.Enviado_Auditoriamedica, a.Enviado_Seguro FROM denuncias a, instituciones b  WHERE a.DE_IDInstitucion=b.ID AND a.vigente='1' AND a.ACC_Nombre like '%". $alumno ."%' and a.ACC_Documento like '%".$documento."%' ORDER BY DA_Fecha DESC LIMIT 0,50");
		}
	}
$filasDevueltas = mysqli_num_rows($denuncias);
if ($filasDevueltas < 1)
{
	$mensaje="No se encontraron coincidencias";
}

}

//solo listo las instituciones con alguna denuncia vigente
if ($_SESSION["Institucion"]==14)
{
$inst=mysqli_query($link,"SELECT * FROM instituciones  where vigente='1' and id in (select `DE_IDInstitucion` from denuncias where vigente=1) ORDER BY nombre");
}
else
{
//solo listo las instituciones con alguna denuncia vigente
$inst=mysqli_query($link,"SELECT * FROM instituciones  where vigente='1' and ID=".$_SESSION["Institucion"]." and id in (select `DE_IDInstitucion` from denuncias where vigente=1) ORDER BY nombre");
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
 <link rel="stylesheet" href="css/jquery-ui.css">
  <script src="js/jquery-1.10.2.js"></script>
  <script src="js/jquery-ui.js"></script>

  <style>
  .custom-combobox {
    position: relative;
    display: inline-block;
	font-size:12px;
  }
  .custom-combobox-toggle {
    position: absolute;
    top: 0;
    bottom: 0;
    margin-left: -20px;
    padding: 0;


  }
  .custom-combobox-input {
    margin: 1;
    padding: 3px 1px;
	width:450px;
	font-size:12px;
  }
  </style>
  <script>
  (function( $ ) {
    $.widget( "custom.combobox", {
      _create: function() {
        this.wrapper = $( "<span>" )
          .addClass( "custom-combobox" )
          .insertAfter( this.element );
 
        this.element.hide();
        this._createAutocomplete();
        this._createShowAllButton();
      },
 
      _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
          value = selected.val() ? selected.text() : "";
 
        this.input = $( "<input>" )
          .appendTo( this.wrapper )
          .val( value )
          .attr( "title", "" )
          .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
          .autocomplete({
            delay: 0,
            minLength: 0,
            source: $.proxy( this, "_source" )
          })
          .tooltip({
            tooltipClass: "ui-state-highlight"
          });
 
        this._on( this.input, {
          autocompleteselect: function( event, ui ) {
            ui.item.option.selected = true;
            this._trigger( "select", event, {
              item: ui.item.option
            });
          },
 
          autocompletechange: "_removeIfInvalid"
        });
      },
 
      _createShowAllButton: function() {
        var input = this.input,
          wasOpen = false;
 
        $( "<a>" )
          .attr( "tabIndex", -1 )
          .attr( "title", "Mostrar todos" )
          .tooltip()
          .appendTo( this.wrapper )
          .button({
            icons: {
              primary: "ui-icon-triangle-1-s"
            },
            text: false
          })
          .removeClass( "ui-corner-all" )
          .addClass( "custom-combobox-toggle ui-corner-right" )
          .mousedown(function() {
            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
          })
          .click(function() {
            input.focus();
 
            // Close if already visible
            if ( wasOpen ) {
              return;
            }
 
            // Pass empty string as value to search for, displaying all results
            input.autocomplete( "search", "" );
          });
      },
 
      _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
          var text = $( this ).text();
          if ( this.value && ( !request.term || matcher.test(text) ) )
            return {
              label: text,
              value: text,
              option: this
            };
        }) );
      },
 
      _removeIfInvalid: function( event, ui ) {
 
        // Selected an item, nothing to do
        if ( ui.item ) {
          return;
        }
 
        // Search for a match (case-insensitive)
        var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
        this.element.children( "option" ).each(function() {
          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
            return false;
          }
        });
 
        // Found a match, nothing to do
        if ( valid ) {
          return;
        }
 
        // Remove invalid value
        this.input
          .val( "" )
          .attr( "title", value + " no se encontraron coincidencias" )
          .tooltip( "open" );
        this.element.val( "" );
        this._delay(function() {
          this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
        this.input.autocomplete( "instance" ).term = "";
      },
 
      _destroy: function() {
        this.wrapper.remove();
        this.element.show();
      }
    });
  })( jQuery );
 
  $(function() {
    $( "#combobox" ).combobox();
    $( "#toggle" ).click(function() {
      $( "#combobox" ).toggle();
    });
  });
  </script>
</head>
<body>
<form name="frm" id="frm" method="post" action="">
<script>

function imprimir_denuncia(id){

	ventana="orden_denuncia_print.php?id="+ id;

	window.open(ventana,'','width=720,height=720,top=20,left=200,scrollbars=yes,titlebar=no,location=no');

}
function orden_derivacion(id)
{
	ventana="denuncias.derivaciones.php?id_denuncia=" + id;
	window.open(ventana,'_self');
}

function reintegro(id)

{

	ventana="listar_reintegros.php?id_denuncia=" + id;

	window.open(ventana,'_self');

}



function auditoria_medica(id)

{
	if (confirm('¿Se enviará a Auditoría Médica la Denuncia. Esta seguro?'))
	{
	ventana="enviar_auditoriamedica.php?id_denuncia=" + id;
	window.open(ventana,'_self');
	}	
}



function seguro(id)

{

	ventana="enviar_seguro.php?id_denuncia=" + id;

	window.open(ventana,'_self');

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
	<img src="images/map.png" width="30" height="36" border="0"> <b>Buscar Denuncias de Accidentes</b>
	</div>
    <div class="clear2"> </div>
    <div >
    
      <div class="clear2"> </div>

	 <?php if ($_REQUEST["cmdbuscar"]) { ?> 
	 <?php } else { 
	 ?>
	 <table width="100%" >

		  <td><div align="left">Institución: 

		  

		    </div></td>

		  <td colspan="3"><div align="left">

		    <select name="cmbInst" id="combobox">
			  <?php if ($_SESSION["Institucion"]==14) { ?>
   		      <option value="">[sin seleccionar]</option>	
		      <?php } ?>
			  <?php while($row=mysqli_fetch_assoc($inst)) { ?>

			  <?php if ($row["ID"]==$_REQUEST[cmbInst]) { 

			  $sel="selected";

			  }

			  else

			  {

			  $sel="";

			  }			  

			  ?> 

		      <option value="<?php echo $row["ID"]?>" <?php echo $sel;?>><?php echo $row["Nombre"]?> (<?php echo $row["Localidad"]?>)</option>

		      <?php } ?>
		      </select>

		    </div></td>
		  </tr>

		<tr>

		  <td height="25"><div align="left">Desde: 

		      

		    </div></td>

		  <td height="25">
		    <?php require_once('calendar/classes/tc_calendar.php');?>

		    <?php 
			$myCalendar = new tc_calendar("txtdesde", true, false);
			$myCalendar->setIcon("calendar/images/iconCalendar.gif");
			if ($fec_desde!='') {
			$myCalendar->setDateYMD($fec_desde);
			}
			$myCalendar->setPath("calendar/");
			$myCalendar->setYearInterval(2009, 2022);
			$myCalendar->dateAllow('2009-01-01', '2022-12-31');
			$myCalendar->setDateFormat('j F Y');
			$myCalendar->setAlignment('left', 'bottom');
			$myCalendar->writeScript();
			?></td>

		  <td >Hasta: </td>
		  <td ><div align="right">
		    <?php 
			$myCalendar = new tc_calendar("txthasta", true, false);
			$myCalendar->setIcon("calendar/images/iconCalendar.gif");
			if ($fec_hasta!='') {
			$myCalendar->setDateYMD($fec_hasta);
			}
			$myCalendar->setPath("calendar/");
			$myCalendar->setYearInterval(2009, 2022);
			$myCalendar->dateAllow('2009-01-01', '2022-12-31');
			$myCalendar->setDateFormat('j F Y');
			$myCalendar->setAlignment('left', 'bottom');
			$myCalendar->writeScript();
			?>

		    </div></td>
		</tr>


		<tr>

		  <td><div align="left">Alumno:

		      

		    </div></td>

		  <td colspan="3"><div align="left">

		    <input id="txtalumno" name="txtalumno" type="text" value="<?php echo $alumno ?>" class="tahoma12" size="70" maxlength="70" />

		    </div></td>
		</tr>

		<tr>

		  <td><div align="left">Documento:

		      

		    </div></td>

		  <td colspan="3"><div align="left">

		    <input name="txtdocumento" id="txtdocumento" value="<?php echo $documento ?>" type="text" style="width:150px"  />

		    </div></td>
		</tr>

		<tr>

		  <td colspan="4">&nbsp;</td>
		  </tr>

		<tr><td colspan="4"><div align="center">

		  <input name="cmdbuscar" type="submit" class="btn" value="BUSCAR" />

		  </div></td></tr></table>
		  <?php } ?>
    	  <?php if ($_REQUEST["cmdbuscar"]) { ?>

		   <table width="100%" border="0" cellspacing="0" cellpadding="0">

		  <tr>

		    <td colspan="9" align="left">
			<strong> Denuncias Totales: <?php echo $filasDevueltas?></strong> <i><?php if ($filasDevueltas >= 50) echo "Sólo se muestran los primeros 50 registro. Refine la búsqueda."; ?></i><BR />
		 </td></tr>


            <tr>

              <td align="center" bgcolor="#999999" ><div align="center"><strong>N°</strong></div></td>
			  
			  <td width="25%" align="center" bgcolor="#999999" ><div align="center"><strong>Accidentado</strong></div></td>

              <td  width="20%" align="center" bgcolor="#999999" ><div align="center"><strong>Fecha</strong></div></td>
			  <?php if ($ibuscar == "") { ?>
			  <td  width="20%" align="center" bgcolor="#999999" ><div align="center"><strong>Institucion</strong></div></td>
			  <?php }?>
			  
			  <td width="8%" align="center" bgcolor="#999999" >&nbsp;</td>

              <td width="8%" align="center" bgcolor="#999999" >&nbsp;</td>

              <td width="8%" align="center" bgcolor="#999999" >&nbsp;</td>
			   <?php // para dibujar o no la columna si es o no de JAEC - AUDITORIA MEDICA
			  if($_SESSION["Institucion"]=="14") {?>
			  <td width="8%" align="center" bgcolor="#999999" >&nbsp;</td>
			  <?php } ?>


            </tr>

            <?php while($row =  mysqli_fetch_assoc($denuncias)){
					$cant++;
					if($cant % 2 == 0){ $bg = 'bgcolor="#FFFFCC"'; } else { $bg = 'bgcolor="#FFFFFF"'; }
			?>

            <tr>

              <td align="center" <?php echo $bg ?> ><?php echo substr("00000".$row["ID"],-5)?></td>

			  <td  align="center" <?php echo $bg ?>><?php echo $row["ACC_Nombre"]?></td>

              <td  align="center" <?php echo $bg ?> ><?php echo $row["DA_Fecha"]?></td>

   			  <?php if ($ibuscar == "") { ?>
              <td  align="center" <?php echo $bg ?> ><?php echo $row["NomInst"]?></td>
			  <?php } ?>
			   	
              <td  align="center" <?php echo $bg ?> > <a href="#"><img src="images/icon_edit.gif" border="0" width="20" height="16"  onClick="window.open('denuncias.php?id_den=<?php echo $row["ID"]?>','_self');" title="editar"  /></a> </td>

              <td align="center" <?php echo $bg ?> > <a href="javascript:orden_derivacion('<?php echo $row["ID"]?>');"><img src="images/icon-derivar.jpg" border="0" width="30" height="18" title="orden de derivación" /></a> </td>

              <td align="center" <?php echo $bg ?> > <a href="javascript:imprimir_denuncia('<?php echo $row["ID"]?>');"><img src="images/icon-printer2.jpg" border="0" width="25" height="20"  title="imprimir denuncia" /></a></td>

			  <?php // para dibujar o no la columna si es o no de JAEC - AUDITORIA MEDICA
			  if($_SESSION["Institucion"]=="14") {?>
			  <td align="center" <?php echo $bg ?> > 
				  <?php // pregunto si esta enviada a auditoria
				  if ($row["Enviado_Auditoriamedica"] <> '1') {
				  ?>	
				  <a href="javascript:auditoria_medica('<?php echo $row["ID"]?>');"><img src="images/auditor_medico_off.png" border="0" title="por enviar" width="25" height="20"  /></a>
				  <?php } ?>

				  

				  <?php // pregunto si esta enviada a auditoria

				  if ($row["Enviado_Auditoriamedica"]=='1') {

				  ?>	

				  <img src="images/auditor_medico.png" title="enviada a auditoría médica" border="0" />

				  <?php } ?>			  </td>

			  <?php } ?>

            </tr>
            <?php } ?>
          </table>
    	  <?php } ?>

		  <?php // fin de la tabla?>		  
    </div>
  </div>
</div>
</div>
<div class="clear"> </div>
<?php include("pie.php"); ?>
</form>
	
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
$mensaje="Complete los datos y haga clic en Buscar";
if ($_REQUEST["cmdbuscar"]) 
{ // si hizo clic en buscar
	$mensaje="Resultado de la búsqueda";
	$fec_desde= $_REQUEST["txtdesde"];
	$fec_hasta= $_REQUEST["txthasta"];
	if ($fec_desde=='0000-00-00') $fec_desde='';
    if ($fec_hasta=='0000-00-00') $fec_hasta='';
	$alumno=$_REQUEST["txtalumno"];
	$documento=str_replace(".","",$_REQUEST["txtdocumento"]);
	$numero=str_replace(".","",$_REQUEST["txtnumero"]);
	$ibuscar=$_REQUEST["cmbInst"];

	if ($fec_desde!='' && $fec_hasta!='')
	{
		if ($ibuscar!= "") 
		{
			$denuncias=mysqli_query($link,"SELECT a.ID, a.ACC_Nombre, b.Nombre as NomInst, DA_Fecha, a.ACC_Telefono, a.AudUsrAlta, a.Enviado_Auditoriamedica, a.Enviado_Seguro FROM denuncias a, instituciones b WHERE a.vigente='1' AND a.DE_IDInstitucion = b.ID  AND a.DE_IDInstitucion = ".$ibuscar." and a.ACC_Nombre like '%". $alumno ."%' and a.ACC_Documento like '%".$documento."%' and DA_Fecha BETWEEN '".$fec_desde."' and '".$fec_hasta."'  ORDER BY DA_Fecha DESC LIMIT 0,50");
		}
		else
		{
			$denuncias=mysqli_query($link,"SELECT a.ID, a.ACC_Nombre, b.Nombre as NomInst, DA_Fecha, a.ACC_Telefono, a.AudUsrAlta, a.Enviado_Auditoriamedica, a.Enviado_Seguro FROM denuncias a, instituciones b  WHERE a.DE_IDInstitucion=b.ID AND a.vigente='1' AND a.ACC_Nombre like '%". $alumno ."%' and a.ACC_Documento like '%".$documento."%' and DA_Fecha BETWEEN '".$fec_desde."' and '".$fec_hasta."'  ORDER BY DA_Fecha DESC LIMIT 0,50");
		}
	}
	
	if ($fec_desde!='' && $fec_hasta=='')
	{
		if ($ibuscar!= "") 
		{
		$denuncias=mysqli_query($link,"SELECT a.ID, a.ACC_Nombre, b.Nombre as NomInst, DA_Fecha, a.ACC_Telefono, a.AudUsrAlta, a.Enviado_Auditoriamedica, a.Enviado_Seguro FROM denuncias a, instituciones b WHERE a.vigente='1' AND a.DE_IDInstitucion = b.ID  AND a.DE_IDInstitucion = ".$ibuscar." and a.ACC_Nombre like '%". $alumno ."%' and a.ACC_Documento like '%".$documento."%' and DA_Fecha >= '".$fec_desde."' ORDER BY DA_Fecha DESC LIMIT 0,50");
		}
		else
		{
		$denuncias=mysqli_query($link,"SELECT a.ID, a.ACC_Nombre, b.Nombre as NomInst, DA_Fecha, a.ACC_Telefono, a.AudUsrAlta, a.Enviado_Auditoriamedica, a.Enviado_Seguro FROM denuncias a, instituciones b WHERE a.DE_IDInstitucion=b.ID AND a.vigente='1' AND a.ACC_Nombre like '%". $alumno ."%' and a.ACC_Documento like '%".$documento."%' and DA_Fecha >= '".$fec_desde."' ORDER BY DA_Fecha DESC LIMIT 0,50");
	
		}
	}
	
	if ($fec_desde =='' && $fec_hasta!='')
	{
		if ($ibuscar!= "") 
		{
		$denuncias=mysqli_query($link,"SELECT a.ID, a.ACC_Nombre, b.Nombre as NomInst, DA_Fecha, a.ACC_Telefono, a.AudUsrAlta, a.Enviado_Auditoriamedica, a.Enviado_Seguro FROM denuncias a, instituciones b WHERE a.vigente='1' AND a.DE_IDInstitucion = b.ID  AND a.DE_IDInstitucion = ".$ibuscar." and a.ACC_Nombre like '%". $alumno ."%' and a.ACC_Documento like '%".$documento."%' and DA_Fecha <= '".$fec_hasta."' ORDER BY DA_Fecha DESC LIMIT 0,50");
		}
		else
		{
		$denuncias=mysqli_query($link,"SELECT a.ID, a.ACC_Nombre, b.Nombre as NomInst, DA_Fecha, a.ACC_Telefono, a.AudUsrAlta, a.Enviado_Auditoriamedica, a.Enviado_Seguro FROM denuncias a, instituciones b WHERE a.DE_IDInstitucion=b.ID AND a.vigente='1' AND a.ACC_Nombre like '%". $alumno ."%' and a.ACC_Documento like '%".$documento."%' and DA_Fecha <= '".$fec_hasta."' ORDER BY DA_Fecha DESC LIMIT 0,50");
		}
	}
	
	if ($fec_desde =='' && $fec_hasta=='')
	{
		if ($ibuscar!= "") 
		{
		$denuncias=mysqli_query($link,"SELECT a.ID, a.ACC_Nombre, b.Nombre as NomInst, DA_Fecha, a.ACC_Telefono, a.AudUsrAlta, a.Enviado_Auditoriamedica, a.Enviado_Seguro FROM denuncias a, instituciones b WHERE a.vigente='1' AND a.DE_IDInstitucion = b.ID  AND a.DE_IDInstitucion = ".$ibuscar." and a.ACC_Nombre like '%". $alumno ."%' and a.ACC_Documento like '%".$documento."%' ORDER BY DA_Fecha DESC LIMIT 0,50");
		}
		else
		{
	
		$denuncias=mysqli_query($link,"SELECT a.ID, a.ACC_Nombre, b.Nombre as NomInst, DA_Fecha, a.ACC_Telefono, a.AudUsrAlta, a.Enviado_Auditoriamedica, a.Enviado_Seguro FROM denuncias a, instituciones b  WHERE a.DE_IDInstitucion=b.ID AND a.vigente='1' AND a.ACC_Nombre like '%". $alumno ."%' and a.ACC_Documento like '%".$documento."%' ORDER BY DA_Fecha DESC LIMIT 0,50");
		}
	}
$filasDevueltas = mysqli_num_rows($denuncias);
if ($filasDevueltas < 1)
{
	$mensaje="No se encontraron coincidencias";
}

}

//solo listo las instituciones con alguna denuncia vigente
if ($_SESSION["Institucion"]==14)
{
$inst=mysqli_query($link,"SELECT * FROM instituciones  where vigente='1' and id in (select `DE_IDInstitucion` from denuncias where vigente=1) ORDER BY nombre");
}
else
{
//solo listo las instituciones con alguna denuncia vigente
$inst=mysqli_query($link,"SELECT * FROM instituciones  where vigente='1' and ID=".$_SESSION["Institucion"]." and id in (select `DE_IDInstitucion` from denuncias where vigente=1) ORDER BY nombre");
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
 <link rel="stylesheet" href="css/jquery-ui.css">
  <script src="js/jquery-1.10.2.js"></script>
  <script src="js/jquery-ui.js"></script>

  <style>
  .custom-combobox {
    position: relative;
    display: inline-block;
	font-size:12px;
  }
  .custom-combobox-toggle {
    position: absolute;
    top: 0;
    bottom: 0;
    margin-left: -20px;
    padding: 0;


  }
  .custom-combobox-input {
    margin: 1;
    padding: 3px 1px;
	width:450px;
	font-size:12px;
  }
  </style>
  <script>
  (function( $ ) {
    $.widget( "custom.combobox", {
      _create: function() {
        this.wrapper = $( "<span>" )
          .addClass( "custom-combobox" )
          .insertAfter( this.element );
 
        this.element.hide();
        this._createAutocomplete();
        this._createShowAllButton();
      },
 
      _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
          value = selected.val() ? selected.text() : "";
 
        this.input = $( "<input>" )
          .appendTo( this.wrapper )
          .val( value )
          .attr( "title", "" )
          .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
          .autocomplete({
            delay: 0,
            minLength: 0,
            source: $.proxy( this, "_source" )
          })
          .tooltip({
            tooltipClass: "ui-state-highlight"
          });
 
        this._on( this.input, {
          autocompleteselect: function( event, ui ) {
            ui.item.option.selected = true;
            this._trigger( "select", event, {
              item: ui.item.option
            });
          },
 
          autocompletechange: "_removeIfInvalid"
        });
      },
 
      _createShowAllButton: function() {
        var input = this.input,
          wasOpen = false;
 
        $( "<a>" )
          .attr( "tabIndex", -1 )
          .attr( "title", "Mostrar todos" )
          .tooltip()
          .appendTo( this.wrapper )
          .button({
            icons: {
              primary: "ui-icon-triangle-1-s"
            },
            text: false
          })
          .removeClass( "ui-corner-all" )
          .addClass( "custom-combobox-toggle ui-corner-right" )
          .mousedown(function() {
            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
          })
          .click(function() {
            input.focus();
 
            // Close if already visible
            if ( wasOpen ) {
              return;
            }
 
            // Pass empty string as value to search for, displaying all results
            input.autocomplete( "search", "" );
          });
      },
 
      _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
          var text = $( this ).text();
          if ( this.value && ( !request.term || matcher.test(text) ) )
            return {
              label: text,
              value: text,
              option: this
            };
        }) );
      },
 
      _removeIfInvalid: function( event, ui ) {
 
        // Selected an item, nothing to do
        if ( ui.item ) {
          return;
        }
 
        // Search for a match (case-insensitive)
        var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
        this.element.children( "option" ).each(function() {
          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
            return false;
          }
        });
 
        // Found a match, nothing to do
        if ( valid ) {
          return;
        }
 
        // Remove invalid value
        this.input
          .val( "" )
          .attr( "title", value + " no se encontraron coincidencias" )
          .tooltip( "open" );
        this.element.val( "" );
        this._delay(function() {
          this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
        this.input.autocomplete( "instance" ).term = "";
      },
 
      _destroy: function() {
        this.wrapper.remove();
        this.element.show();
      }
    });
  })( jQuery );
 
  $(function() {
    $( "#combobox" ).combobox();
    $( "#toggle" ).click(function() {
      $( "#combobox" ).toggle();
    });
  });
  </script>
</head>
<body>
<form name="frm" id="frm" method="post" action="">
<script>

function imprimir_denuncia(id){

	ventana="orden_denuncia_print.php?id="+ id;

	window.open(ventana,'','width=720,height=720,top=20,left=200,scrollbars=yes,titlebar=no,location=no');

}
function orden_derivacion(id)
{
	ventana="denuncias.derivaciones.php?id_denuncia=" + id;
	window.open(ventana,'_self');
}

function reintegro(id)

{

	ventana="listar_reintegros.php?id_denuncia=" + id;

	window.open(ventana,'_self');

}



function auditoria_medica(id)

{
	if (confirm('¿Se enviará a Auditoría Médica la Denuncia. Esta seguro?'))
	{
	ventana="enviar_auditoriamedica.php?id_denuncia=" + id;
	window.open(ventana,'_self');
	}	
}



function seguro(id)

{

	ventana="enviar_seguro.php?id_denuncia=" + id;

	window.open(ventana,'_self');

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
	<img src="images/map.png" width="30" height="36" border="0"> <b>Buscar Denuncias de Accidentes</b>
	</div>
    <div class="clear2"> </div>
    <div >
    
      <div class="clear2"> </div>

	 <?php if ($_REQUEST["cmdbuscar"]) { ?> 
	 <?php } else { 
	 ?>
	 <table width="100%" >

		  <td><div align="left">Institución: 

		  

		    </div></td>

		  <td colspan="3"><div align="left">

		    <select name="cmbInst" id="combobox">
			  <?php if ($_SESSION["Institucion"]==14) { ?>
   		      <option value="">[sin seleccionar]</option>	
		      <?php } ?>
			  <?php while($row=mysqli_fetch_assoc($inst)) { ?>

			  <?php if ($row["ID"]==$_REQUEST[cmbInst]) { 

			  $sel="selected";

			  }

			  else

			  {

			  $sel="";

			  }			  

			  ?> 

		      <option value="<?php echo $row["ID"]?>" <?php echo $sel;?>><?php echo $row["Nombre"]?> (<?php echo $row["Localidad"]?>)</option>

		      <?php } ?>
		      </select>

		    </div></td>
		  </tr>

		<tr>

		  <td height="25"><div align="left">Desde: 

		      

		    </div></td>

		  <td height="25">
		    <?php require_once('calendar/classes/tc_calendar.php');?>

		    <?php 
			$myCalendar = new tc_calendar("txtdesde", true, false);
			$myCalendar->setIcon("calendar/images/iconCalendar.gif");
			if ($fec_desde!='') {
			$myCalendar->setDateYMD($fec_desde);
			}
			$myCalendar->setPath("calendar/");
			$myCalendar->setYearInterval(2009, 2022);
			$myCalendar->dateAllow('2009-01-01', '2022-12-31');
			$myCalendar->setDateFormat('j F Y');
			$myCalendar->setAlignment('left', 'bottom');
			$myCalendar->writeScript();
			?></td>

		  <td >Hasta: </td>
		  <td ><div align="right">
		    <?php 
			$myCalendar = new tc_calendar("txthasta", true, false);
			$myCalendar->setIcon("calendar/images/iconCalendar.gif");
			if ($fec_hasta!='') {
			$myCalendar->setDateYMD($fec_hasta);
			}
			$myCalendar->setPath("calendar/");
			$myCalendar->setYearInterval(2009, 2022);
			$myCalendar->dateAllow('2009-01-01', '2022-12-31');
			$myCalendar->setDateFormat('j F Y');
			$myCalendar->setAlignment('left', 'bottom');
			$myCalendar->writeScript();
			?>

		    </div></td>
		</tr>


		<tr>

		  <td><div align="left">Alumno:

		      

		    </div></td>

		  <td colspan="3"><div align="left">

		    <input id="txtalumno" name="txtalumno" type="text" value="<?php echo $alumno ?>" class="tahoma12" size="70" maxlength="70" />

		    </div></td>
		</tr>

		<tr>

		  <td><div align="left">Documento:

		      

		    </div></td>

		  <td colspan="3"><div align="left">

		    <input name="txtdocumento" id="txtdocumento" value="<?php echo $documento ?>" type="text" style="width:150px"  />

		    </div></td>
		</tr>

		<tr>

		  <td colspan="4">&nbsp;</td>
		  </tr>

		<tr><td colspan="4"><div align="center">

		  <input name="cmdbuscar" type="submit" class="btn" value="BUSCAR" />

		  </div></td></tr></table>
		  <?php } ?>
    	  <?php if ($_REQUEST["cmdbuscar"]) { ?>

		   <table width="100%" border="0" cellspacing="0" cellpadding="0">

		  <tr>

		    <td colspan="9" align="left">
			<strong> Denuncias Totales: <?php echo $filasDevueltas?></strong> <i><?php if ($filasDevueltas >= 50) echo "Sólo se muestran los primeros 50 registro. Refine la búsqueda."; ?></i><BR />
		 </td></tr>


            <tr>

              <td align="center" bgcolor="#999999" ><div align="center"><strong>N°</strong></div></td>
			  
			  <td width="25%" align="center" bgcolor="#999999" ><div align="center"><strong>Accidentado</strong></div></td>

              <td  width="20%" align="center" bgcolor="#999999" ><div align="center"><strong>Fecha</strong></div></td>
			  <?php if ($ibuscar == "") { ?>
			  <td  width="20%" align="center" bgcolor="#999999" ><div align="center"><strong>Institucion</strong></div></td>
			  <?php }?>
			  
			  <td width="8%" align="center" bgcolor="#999999" >&nbsp;</td>

              <td width="8%" align="center" bgcolor="#999999" >&nbsp;</td>

              <td width="8%" align="center" bgcolor="#999999" >&nbsp;</td>
			   <?php // para dibujar o no la columna si es o no de JAEC - AUDITORIA MEDICA
			  if($_SESSION["Institucion"]=="14") {?>
			  <td width="8%" align="center" bgcolor="#999999" >&nbsp;</td>
			  <?php } ?>


            </tr>

            <?php while($row =  mysqli_fetch_assoc($denuncias)){
					$cant++;
					if($cant % 2 == 0){ $bg = 'bgcolor="#FFFFCC"'; } else { $bg = 'bgcolor="#FFFFFF"'; }
			?>

            <tr>

              <td align="center" <?php echo $bg ?> ><?php echo substr("00000".$row["ID"],-5)?></td>

			  <td  align="center" <?php echo $bg ?>><?php echo $row["ACC_Nombre"]?></td>

              <td  align="center" <?php echo $bg ?> ><?php echo $row["DA_Fecha"]?></td>

   			  <?php if ($ibuscar == "") { ?>
              <td  align="center" <?php echo $bg ?> ><?php echo $row["NomInst"]?></td>
			  <?php } ?>
			   	
              <td  align="center" <?php echo $bg ?> > <a href="#"><img src="images/icon_edit.gif" border="0" width="20" height="16"  onClick="window.open('denuncias.php?id_den=<?php echo $row["ID"]?>','_self');" title="editar"  /></a> </td>

              <td align="center" <?php echo $bg ?> > <a href="javascript:orden_derivacion('<?php echo $row["ID"]?>');"><img src="images/icon-derivar.jpg" border="0" width="30" height="18" title="orden de derivación" /></a> </td>

              <td align="center" <?php echo $bg ?> > <a href="javascript:imprimir_denuncia('<?php echo $row["ID"]?>');"><img src="images/icon-printer2.jpg" border="0" width="25" height="20"  title="imprimir denuncia" /></a></td>

			  <?php // para dibujar o no la columna si es o no de JAEC - AUDITORIA MEDICA
			  if($_SESSION["Institucion"]=="14") {?>
			  <td align="center" <?php echo $bg ?> > 
				  <?php // pregunto si esta enviada a auditoria
				  if ($row["Enviado_Auditoriamedica"] <> '1') {
				  ?>	
				  <a href="javascript:auditoria_medica('<?php echo $row["ID"]?>');"><img src="images/auditor_medico_off.png" border="0" title="por enviar" width="25" height="20"  /></a>
				  <?php } ?>

				  

				  <?php // pregunto si esta enviada a auditoria

				  if ($row["Enviado_Auditoriamedica"]=='1') {

				  ?>	

				  <img src="images/auditor_medico.png" title="enviada a auditoría médica" border="0" />

				  <?php } ?>			  </td>

			  <?php } ?>

            </tr>
            <?php } ?>
          </table>
    	  <?php } ?>

		  <?php // fin de la tabla?>		  
    </div>
  </div>
</div>
</div>
<div class="clear"> </div>
<?php include("pie.php"); ?>
</form>
	
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
$mensaje="Complete los datos y haga clic en Buscar";
if ($_REQUEST["cmdbuscar"]) 
{ // si hizo clic en buscar
	$mensaje="Resultado de la búsqueda";
	$fec_desde= $_REQUEST["txtdesde"];
	$fec_hasta= $_REQUEST["txthasta"];
	if ($fec_desde=='0000-00-00') $fec_desde='';
    if ($fec_hasta=='0000-00-00') $fec_hasta='';
	$alumno=$_REQUEST["txtalumno"];
	$documento=str_replace(".","",$_REQUEST["txtdocumento"]);
	$numero=str_replace(".","",$_REQUEST["txtnumero"]);
	$ibuscar=$_REQUEST["cmbInst"];

	if ($fec_desde!='' && $fec_hasta!='')
	{
		if ($ibuscar!= "") 
		{
			$denuncias=mysqli_query($link,"SELECT a.ID, a.ACC_Nombre, b.Nombre as NomInst, DA_Fecha, a.ACC_Telefono, a.AudUsrAlta, a.Enviado_Auditoriamedica, a.Enviado_Seguro FROM denuncias a, instituciones b WHERE a.vigente='1' AND a.DE_IDInstitucion = b.ID  AND a.DE_IDInstitucion = ".$ibuscar." and a.ACC_Nombre like '%". $alumno ."%' and a.ACC_Documento like '%".$documento."%' and DA_Fecha BETWEEN '".$fec_desde."' and '".$fec_hasta."'  ORDER BY DA_Fecha DESC LIMIT 0,50");
		}
		else
		{
			$denuncias=mysqli_query($link,"SELECT a.ID, a.ACC_Nombre, b.Nombre as NomInst, DA_Fecha, a.ACC_Telefono, a.AudUsrAlta, a.Enviado_Auditoriamedica, a.Enviado_Seguro FROM denuncias a, instituciones b  WHERE a.DE_IDInstitucion=b.ID AND a.vigente='1' AND a.ACC_Nombre like '%". $alumno ."%' and a.ACC_Documento like '%".$documento."%' and DA_Fecha BETWEEN '".$fec_desde."' and '".$fec_hasta."'  ORDER BY DA_Fecha DESC LIMIT 0,50");
		}
	}
	
	if ($fec_desde!='' && $fec_hasta=='')
	{
		if ($ibuscar!= "") 
		{
		$denuncias=mysqli_query($link,"SELECT a.ID, a.ACC_Nombre, b.Nombre as NomInst, DA_Fecha, a.ACC_Telefono, a.AudUsrAlta, a.Enviado_Auditoriamedica, a.Enviado_Seguro FROM denuncias a, instituciones b WHERE a.vigente='1' AND a.DE_IDInstitucion = b.ID  AND a.DE_IDInstitucion = ".$ibuscar." and a.ACC_Nombre like '%". $alumno ."%' and a.ACC_Documento like '%".$documento."%' and DA_Fecha >= '".$fec_desde."' ORDER BY DA_Fecha DESC LIMIT 0,50");
		}
		else
		{
		$denuncias=mysqli_query($link,"SELECT a.ID, a.ACC_Nombre, b.Nombre as NomInst, DA_Fecha, a.ACC_Telefono, a.AudUsrAlta, a.Enviado_Auditoriamedica, a.Enviado_Seguro FROM denuncias a, instituciones b WHERE a.DE_IDInstitucion=b.ID AND a.vigente='1' AND a.ACC_Nombre like '%". $alumno ."%' and a.ACC_Documento like '%".$documento."%' and DA_Fecha >= '".$fec_desde."' ORDER BY DA_Fecha DESC LIMIT 0,50");
	
		}
	}
	
	if ($fec_desde =='' && $fec_hasta!='')
	{
		if ($ibuscar!= "") 
		{
		$denuncias=mysqli_query($link,"SELECT a.ID, a.ACC_Nombre, b.Nombre as NomInst, DA_Fecha, a.ACC_Telefono, a.AudUsrAlta, a.Enviado_Auditoriamedica, a.Enviado_Seguro FROM denuncias a, instituciones b WHERE a.vigente='1' AND a.DE_IDInstitucion = b.ID  AND a.DE_IDInstitucion = ".$ibuscar." and a.ACC_Nombre like '%". $alumno ."%' and a.ACC_Documento like '%".$documento."%' and DA_Fecha <= '".$fec_hasta."' ORDER BY DA_Fecha DESC LIMIT 0,50");
		}
		else
		{
		$denuncias=mysqli_query($link,"SELECT a.ID, a.ACC_Nombre, b.Nombre as NomInst, DA_Fecha, a.ACC_Telefono, a.AudUsrAlta, a.Enviado_Auditoriamedica, a.Enviado_Seguro FROM denuncias a, instituciones b WHERE a.DE_IDInstitucion=b.ID AND a.vigente='1' AND a.ACC_Nombre like '%". $alumno ."%' and a.ACC_Documento like '%".$documento."%' and DA_Fecha <= '".$fec_hasta."' ORDER BY DA_Fecha DESC LIMIT 0,50");
		}
	}
	
	if ($fec_desde =='' && $fec_hasta=='')
	{
		if ($ibuscar!= "") 
		{
		$denuncias=mysqli_query($link,"SELECT a.ID, a.ACC_Nombre, b.Nombre as NomInst, DA_Fecha, a.ACC_Telefono, a.AudUsrAlta, a.Enviado_Auditoriamedica, a.Enviado_Seguro FROM denuncias a, instituciones b WHERE a.vigente='1' AND a.DE_IDInstitucion = b.ID  AND a.DE_IDInstitucion = ".$ibuscar." and a.ACC_Nombre like '%". $alumno ."%' and a.ACC_Documento like '%".$documento."%' ORDER BY DA_Fecha DESC LIMIT 0,50");
		}
		else
		{
	
		$denuncias=mysqli_query($link,"SELECT a.ID, a.ACC_Nombre, b.Nombre as NomInst, DA_Fecha, a.ACC_Telefono, a.AudUsrAlta, a.Enviado_Auditoriamedica, a.Enviado_Seguro FROM denuncias a, instituciones b  WHERE a.DE_IDInstitucion=b.ID AND a.vigente='1' AND a.ACC_Nombre like '%". $alumno ."%' and a.ACC_Documento like '%".$documento."%' ORDER BY DA_Fecha DESC LIMIT 0,50");
		}
	}
$filasDevueltas = mysqli_num_rows($denuncias);
if ($filasDevueltas < 1)
{
	$mensaje="No se encontraron coincidencias";
}

}

//solo listo las instituciones con alguna denuncia vigente
if ($_SESSION["Institucion"]==14)
{
$inst=mysqli_query($link,"SELECT * FROM instituciones  where vigente='1' and id in (select `DE_IDInstitucion` from denuncias where vigente=1) ORDER BY nombre");
}
else
{
//solo listo las instituciones con alguna denuncia vigente
$inst=mysqli_query($link,"SELECT * FROM instituciones  where vigente='1' and ID=".$_SESSION["Institucion"]." and id in (select `DE_IDInstitucion` from denuncias where vigente=1) ORDER BY nombre");
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
 <link rel="stylesheet" href="css/jquery-ui.css">
  <script src="js/jquery-1.10.2.js"></script>
  <script src="js/jquery-ui.js"></script>

  <style>
  .custom-combobox {
    position: relative;
    display: inline-block;
	font-size:12px;
  }
  .custom-combobox-toggle {
    position: absolute;
    top: 0;
    bottom: 0;
    margin-left: -20px;
    padding: 0;


  }
  .custom-combobox-input {
    margin: 1;
    padding: 3px 1px;
	width:450px;
	font-size:12px;
  }
  </style>
  <script>
  (function( $ ) {
    $.widget( "custom.combobox", {
      _create: function() {
        this.wrapper = $( "<span>" )
          .addClass( "custom-combobox" )
          .insertAfter( this.element );
 
        this.element.hide();
        this._createAutocomplete();
        this._createShowAllButton();
      },
 
      _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
          value = selected.val() ? selected.text() : "";
 
        this.input = $( "<input>" )
          .appendTo( this.wrapper )
          .val( value )
          .attr( "title", "" )
          .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
          .autocomplete({
            delay: 0,
            minLength: 0,
            source: $.proxy( this, "_source" )
          })
          .tooltip({
            tooltipClass: "ui-state-highlight"
          });
 
        this._on( this.input, {
          autocompleteselect: function( event, ui ) {
            ui.item.option.selected = true;
            this._trigger( "select", event, {
              item: ui.item.option
            });
          },
 
          autocompletechange: "_removeIfInvalid"
        });
      },
 
      _createShowAllButton: function() {
        var input = this.input,
          wasOpen = false;
 
        $( "<a>" )
          .attr( "tabIndex", -1 )
          .attr( "title", "Mostrar todos" )
          .tooltip()
          .appendTo( this.wrapper )
          .button({
            icons: {
              primary: "ui-icon-triangle-1-s"
            },
            text: false
          })
          .removeClass( "ui-corner-all" )
          .addClass( "custom-combobox-toggle ui-corner-right" )
          .mousedown(function() {
            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
          })
          .click(function() {
            input.focus();
 
            // Close if already visible
            if ( wasOpen ) {
              return;
            }
 
            // Pass empty string as value to search for, displaying all results
            input.autocomplete( "search", "" );
          });
      },
 
      _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
          var text = $( this ).text();
          if ( this.value && ( !request.term || matcher.test(text) ) )
            return {
              label: text,
              value: text,
              option: this
            };
        }) );
      },
 
      _removeIfInvalid: function( event, ui ) {
 
        // Selected an item, nothing to do
        if ( ui.item ) {
          return;
        }
 
        // Search for a match (case-insensitive)
        var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
        this.element.children( "option" ).each(function() {
          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
            return false;
          }
        });
 
        // Found a match, nothing to do
        if ( valid ) {
          return;
        }
 
        // Remove invalid value
        this.input
          .val( "" )
          .attr( "title", value + " no se encontraron coincidencias" )
          .tooltip( "open" );
        this.element.val( "" );
        this._delay(function() {
          this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
        this.input.autocomplete( "instance" ).term = "";
      },
 
      _destroy: function() {
        this.wrapper.remove();
        this.element.show();
      }
    });
  })( jQuery );
 
  $(function() {
    $( "#combobox" ).combobox();
    $( "#toggle" ).click(function() {
      $( "#combobox" ).toggle();
    });
  });
  </script>
</head>
<body>
<form name="frm" id="frm" method="post" action="">
<script>

function imprimir_denuncia(id){

	ventana="orden_denuncia_print.php?id="+ id;

	window.open(ventana,'','width=720,height=720,top=20,left=200,scrollbars=yes,titlebar=no,location=no');

}
function orden_derivacion(id)
{
	ventana="denuncias.derivaciones.php?id_denuncia=" + id;
	window.open(ventana,'_self');
}

function reintegro(id)

{

	ventana="listar_reintegros.php?id_denuncia=" + id;

	window.open(ventana,'_self');

}



function auditoria_medica(id)

{
	if (confirm('¿Se enviará a Auditoría Médica la Denuncia. Esta seguro?'))
	{
	ventana="enviar_auditoriamedica.php?id_denuncia=" + id;
	window.open(ventana,'_self');
	}	
}



function seguro(id)

{

	ventana="enviar_seguro.php?id_denuncia=" + id;

	window.open(ventana,'_self');

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
	<img src="images/map.png" width="30" height="36" border="0"> <b>Buscar Denuncias de Accidentes</b>
	</div>
    <div class="clear2"> </div>
    <div >
    
      <div class="clear2"> </div>

	 <?php if ($_REQUEST["cmdbuscar"]) { ?> 
	 <?php } else { 
	 ?>
	 <table width="100%" >

		  <td><div align="left">Institución: 

		  

		    </div></td>

		  <td colspan="3"><div align="left">

		    <select name="cmbInst" id="combobox">
			  <?php if ($_SESSION["Institucion"]==14) { ?>
   		      <option value="">[sin seleccionar]</option>	
		      <?php } ?>
			  <?php while($row=mysqli_fetch_assoc($inst)) { ?>

			  <?php if ($row["ID"]==$_REQUEST[cmbInst]) { 

			  $sel="selected";

			  }

			  else

			  {

			  $sel="";

			  }			  

			  ?> 

		      <option value="<?php echo $row["ID"]?>" <?php echo $sel;?>><?php echo $row["Nombre"]?> (<?php echo $row["Localidad"]?>)</option>

		      <?php } ?>
		      </select>

		    </div></td>
		  </tr>

		<tr>

		  <td height="25"><div align="left">Desde: 

		      

		    </div></td>

		  <td height="25">
		    <?php require_once('calendar/classes/tc_calendar.php');?>

		    <?php 
			$myCalendar = new tc_calendar("txtdesde", true, false);
			$myCalendar->setIcon("calendar/images/iconCalendar.gif");
			if ($fec_desde!='') {
			$myCalendar->setDateYMD($fec_desde);
			}
			$myCalendar->setPath("calendar/");
			$myCalendar->setYearInterval(2009, 2022);
			$myCalendar->dateAllow('2009-01-01', '2022-12-31');
			$myCalendar->setDateFormat('j F Y');
			$myCalendar->setAlignment('left', 'bottom');
			$myCalendar->writeScript();
			?></td>

		  <td >Hasta: </td>
		  <td ><div align="right">
		    <?php 
			$myCalendar = new tc_calendar("txthasta", true, false);
			$myCalendar->setIcon("calendar/images/iconCalendar.gif");
			if ($fec_hasta!='') {
			$myCalendar->setDateYMD($fec_hasta);
			}
			$myCalendar->setPath("calendar/");
			$myCalendar->setYearInterval(2009, 2022);
			$myCalendar->dateAllow('2009-01-01', '2022-12-31');
			$myCalendar->setDateFormat('j F Y');
			$myCalendar->setAlignment('left', 'bottom');
			$myCalendar->writeScript();
			?>

		    </div></td>
		</tr>


		<tr>

		  <td><div align="left">Alumno:

		      

		    </div></td>

		  <td colspan="3"><div align="left">

		    <input id="txtalumno" name="txtalumno" type="text" value="<?php echo $alumno ?>" class="tahoma12" size="70" maxlength="70" />

		    </div></td>
		</tr>

		<tr>

		  <td><div align="left">Documento:

		      

		    </div></td>

		  <td colspan="3"><div align="left">

		    <input name="txtdocumento" id="txtdocumento" value="<?php echo $documento ?>" type="text" style="width:150px"  />

		    </div></td>
		</tr>

		<tr>

		  <td colspan="4">&nbsp;</td>
		  </tr>

		<tr><td colspan="4"><div align="center">

		  <input name="cmdbuscar" type="submit" class="btn" value="BUSCAR" />

		  </div></td></tr></table>
		  <?php } ?>
    	  <?php if ($_REQUEST["cmdbuscar"]) { ?>

		   <table width="100%" border="0" cellspacing="0" cellpadding="0">

		  <tr>

		    <td colspan="9" align="left">
			<strong> Denuncias Totales: <?php echo $filasDevueltas?></strong> <i><?php if ($filasDevueltas >= 50) echo "Sólo se muestran los primeros 50 registro. Refine la búsqueda."; ?></i><BR />
		 </td></tr>


            <tr>

              <td align="center" bgcolor="#999999" ><div align="center"><strong>N°</strong></div></td>
			  
			  <td width="25%" align="center" bgcolor="#999999" ><div align="center"><strong>Accidentado</strong></div></td>

              <td  width="20%" align="center" bgcolor="#999999" ><div align="center"><strong>Fecha</strong></div></td>
			  <?php if ($ibuscar == "") { ?>
			  <td  width="20%" align="center" bgcolor="#999999" ><div align="center"><strong>Institucion</strong></div></td>
			  <?php }?>
			  
			  <td width="8%" align="center" bgcolor="#999999" >&nbsp;</td>

              <td width="8%" align="center" bgcolor="#999999" >&nbsp;</td>

              <td width="8%" align="center" bgcolor="#999999" >&nbsp;</td>
			   <?php // para dibujar o no la columna si es o no de JAEC - AUDITORIA MEDICA
			  if($_SESSION["Institucion"]=="14") {?>
			  <td width="8%" align="center" bgcolor="#999999" >&nbsp;</td>
			  <?php } ?>


            </tr>

            <?php while($row =  mysqli_fetch_assoc($denuncias)){
					$cant++;
					if($cant % 2 == 0){ $bg = 'bgcolor="#FFFFCC"'; } else { $bg = 'bgcolor="#FFFFFF"'; }
			?>

            <tr>

              <td align="center" <?php echo $bg ?> ><?php echo substr("00000".$row["ID"],-5)?></td>

			  <td  align="center" <?php echo $bg ?>><?php echo $row["ACC_Nombre"]?></td>

              <td  align="center" <?php echo $bg ?> ><?php echo $row["DA_Fecha"]?></td>

   			  <?php if ($ibuscar == "") { ?>
              <td  align="center" <?php echo $bg ?> ><?php echo $row["NomInst"]?></td>
			  <?php } ?>
			   	
              <td  align="center" <?php echo $bg ?> > <a href="#"><img src="images/icon_edit.gif" border="0" width="20" height="16"  onClick="window.open('denuncias.php?id_den=<?php echo $row["ID"]?>','_self');" title="editar"  /></a> </td>

              <td align="center" <?php echo $bg ?> > <a href="javascript:orden_derivacion('<?php echo $row["ID"]?>');"><img src="images/icon-derivar.jpg" border="0" width="30" height="18" title="orden de derivación" /></a> </td>

              <td align="center" <?php echo $bg ?> > <a href="javascript:imprimir_denuncia('<?php echo $row["ID"]?>');"><img src="images/icon-printer2.jpg" border="0" width="25" height="20"  title="imprimir denuncia" /></a></td>

			  <?php // para dibujar o no la columna si es o no de JAEC - AUDITORIA MEDICA
			  if($_SESSION["Institucion"]=="14") {?>
			  <td align="center" <?php echo $bg ?> > 
				  <?php // pregunto si esta enviada a auditoria
				  if ($row["Enviado_Auditoriamedica"] <> '1') {
				  ?>	
				  <a href="javascript:auditoria_medica('<?php echo $row["ID"]?>');"><img src="images/auditor_medico_off.png" border="0" title="por enviar" width="25" height="20"  /></a>
				  <?php } ?>

				  

				  <?php // pregunto si esta enviada a auditoria

				  if ($row["Enviado_Auditoriamedica"]=='1') {

				  ?>	

				  <img src="images/auditor_medico.png" title="enviada a auditoría médica" border="0" />

				  <?php } ?>			  </td>

			  <?php } ?>

            </tr>
            <?php } ?>
          </table>
    	  <?php } ?>

		  <?php // fin de la tabla?>		  
    </div>
  </div>
</div>
</div>
<div class="clear"> </div>
<?php include("pie.php"); ?>
</form>
	
</body>
>>>>>>> 64483f4e4592a7d8cfa1980d291de5bef1badd92
</html>
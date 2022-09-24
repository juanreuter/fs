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

$mensaje="Complete los datos y haga clic en Buscar";

$idinstitucion =  $_POST["cmbInst"];

if ($_REQUEST["cmdguardar"]) 
{ // si hizo clic en guardar
	$fecha = $_POST["txtFecha"];
	$idinstitucion = $_REQUEST["id_inst"];
	$idpersonal = $_POST["cmbPersonal"];
	$estado = $_POST["sltmedico"] ;//requiere medico SI-NO
	$junta = $_POST["sltjunta"] ;// requiere junta SI-NO
	$diagnostico =  $_POST["diagnostico"];
	
	
	
	//datos del archivo
	$archivo=$_FILES['fileArchivo']['name'];
	
	if ($fecha!= "" && $idinstitucion != "" && $idpersonal != "" )
		{
		mysqli_query($link,"INSERT INTO control_ausentismo (fecha_control, idpersonal, idinstitucion, estado_control, requiere_junta, diagnostico, archivo_adjunto, vigente, AudUsrAlta, AudFecAlta) VALUES ('$fecha', '$idpersonal', '$idinstitucion',  '$estado' , '$junta', '$diagnostico', '$archivo', '1','$usralta', '$fecmodi')");
		$id = mysqli_insert_id($link);
		
		move_uploaded_file($_FILES['fileArchivo']['tmp_name'], "archivos_control/".$archivo);
		
		// ************* envio por mail datos de la nueva denuncia
  	    $destinatario = "saludocupacional@jaeccba.org.ar"; 
		$asunto = 'Sistema de Gestion - Control de Ausentismo:' .$id ; 
		$correo_alta_persona = $_SESSION["Nombre_Usuario"];
		$correo_alta_fecha = date("Y-m-d H:i:s");
	    // selecciono los datos para el correo
		$datos_correo = mysqli_fetch_assoc(mysqli_query($link,"SELECT c.fecha_control, c.estado_control, c.requiere_junta, c.diagnostico, p.Nombre, p.Documento, p.Direccion, p.Telefono, p.Cargo, i.Nombre as NombreInst, i.Domicilio as DomicilioInst, i.Nombre_RL, i.Domicilio_RL, i.Telefono_RL FROM control_ausentismo c, personal p, instituciones i  WHERE c.idpersonal=p.id and c.idinstitucion=i.id and idcontrol='" .$id."'"));
		$cuerpo = 'Nº Control Ausentismo: '.$id.  '<br> Nombre Personal: '.$datos_correo["Nombre"].  '<br> Documento: '.$datos_correo["Documento"]. '<br> Domicilio: '.$datos_correo["Direccion"].  '<br>   Teléfono: '.$datos_correo["Telefono"].  '<br> Cargo : '.$datos_correo["Cargo"].  '<br> Institucion: '.$datos_correo["NombreInst"].  '<br> Domicilio de la Institución: '.$datos_correo["DomicilioInst"]. '<br> Representante Legal: '.$datos_correo["Nombre_RL"]. '<br> Correo Representante Legal: '.$datos_correo["Domicilio_RL"]. '<br> Teléfono Representante Legal: '.$datos_correo["Telefono_RL"]. '<br> Fecha Control: '.$datos_correo["fecha_control"]. '<br> Requiere Médico?: '.$datos_correo["estado_control"]. '<br> Requiere Junta Médica?: '.$datos_correo["requiere_junta"]. '<br> Diagnostico y Observaciones: '.$datos_correo["diagnostico"] . '<br> Usuario Alta: '.$correo_alta_persona . '<br> Fecha Alta: '.$correo_alta_fecha; 

		//para el envío en formato HTML 
		$headers = "MIME-Version: 1.0\r\n"; 
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
	

		//dirección del remitente 

		$headers .= "From: sistemas@jaeccba.org.ar\r\n";

		//direcciones que recibirán copia oculta 
		$headers .= "Bcc: gabycanepa90@hotmail.com\r\n"; 
		mail($destinatario,$asunto,$cuerpo,$headers);

		// **************** fin envio de datos por correo

		
		?>
		<script>
		window.alert("Datos registrados correctamente y enviados a JAEC!")
		</script>
		<?php
		}
		else
		{
		?>
		<script>
		window.alert("Ingrese todos los datos!")
		</script>
	<?php
		}
	
}// cierra el guardar


//listo el personal de la institucion seleccionada
$personal=mysqli_query($link,"SELECT * FROM personal where vigente='1' and IDInstitucion='$idinstitucion' ORDER BY Nombre");

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
<script language="javascript" src="calendar/calendar.js"></script>
</head>
<body>
<form name="frm" id="frm" action="" method="post"  enctype="multipart/form-data">

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
    <div class="small-12 th radius grisoscuro">
     <?php include("menu_izq.php"); ?>
    </div>
    <div class="clear2"> </div>
  </div>
  <div class="small-12 large-8 columns ">
    <div class="small-12 large-12 columns  menutitulo"> 
	<img src="images/map.png" width="30" height="36" border="0"> <b>Nueva Formulario Control de Ausentismo </b>
	</div>
    <div class="clear2"> </div>
    <div >
    
      <div class="clear2"> </div>

	 <table width="100%" >

		  <tr>
		    <td>Personal:</td>
		    <td colspan="3">
			<select name="cmbPersonal" id="combobox">
		     <option value="">[sin seleccionar]</option>	
			  <?php while($row=mysqli_fetch_assoc($personal)) { ?>
			  <?php if ($row["ID"]==$_REQUEST[cmbPersonal]) { 
			  $sel="selected";
			  }
			  else
			  {
			  $sel="";
			  }			  
			  ?> 
	      <option value="<?php echo $row["ID"]?>" <?php echo $sel;?>><?php echo $row["Nombre"]?> (<?php echo $row["Documento"]?>)</option>

		      <?php } ?>
		      </select>			</td>
		    </tr>
		  	<tr>

		  <td>Fecha Control :</td>
		  <td>
		  <?php require_once('calendar/classes/tc_calendar.php'); ?>

			<?php 
			$myCalendar = new tc_calendar("txtFecha", true, false);
			$myCalendar->setIcon("calendar/images/iconCalendar.gif");
			if ($fecha!='')
			{
			$myCalendar->setDateYMD($fecha);
			}
			else
			{
			$myCalendar->setDate(date('d'), date('m'), date('Y'));
			}
			$myCalendar->setPath("calendar/");
			$myCalendar->setYearInterval(2015, 2017);
			$myCalendar->dateAllow('2015-01-01', '2017-12-31');
			$myCalendar->setDateFormat('j F Y');
			$myCalendar->setAlignment('left', 'bottom');
			$myCalendar->writeScript();
			?>
		  </td>
		  <td></td>
		  <td></td>
		  </tr>
		  <tr>
		  <td>Requiere Médico?</td>
		  <td>
		  <select name="sltmedico" id="sltmedico" style="width:70px;">
		  <option value="SI">SI</option>
		  <option value="NO">NO</option>
		  </select>
		  </td>
		  <td><div align="right">Junta Médica?</div></td>
		  <td>
		  <select name="sltjunta" id="sltjunta" style="width:70px;">
		  <option value="SI">SI</option>
		  <option value="NO">NO</option>
		  </select>
		  </td>
		  </tr>
		  <tr>
		  <td colspan="4">
		  Diagnóstico y Observaciones:<br>
		    <textarea name="diagnostico" id="diagnostico"></textarea>
		  </td>
		  </tr>
		 <tr>
		 <td align="left" class="tahoma11">Archivo Adjunto:</td>
         <td colspan="3" ><input name="fileArchivo" type="file" id="fileArchivo"  />  </td>
        </tr>

		<tr><td colspan="4"><div align="center">
          <input name="cmdback" type="button" class="btn" value="<< ANTERIOR" onClick="window.history.back();" />
		  <input name="cmdguardar" type="submit" class="btn" value="GUARDAR" />

		  </div></td></tr></table>
          </table>

		</div>
  </div>
</div>
</div>
<div class="clear"> </div>
<?php include("pie.php"); ?>
<input name="id_inst" type="hidden" id="id_inst" value="<?php echo $idinstitucion?>">
</form>
	
</body>
</html>
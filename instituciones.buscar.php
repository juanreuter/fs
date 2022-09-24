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
	$ibuscar=$_REQUEST["cmbInst"];
	$id_inst= mysqli_query($link,"SELECT instituciones.*, localidades.Nombre as localidad FROM instituciones, localidades WHERE instituciones.vigente='1' and instituciones.ID='".$ibuscar."' and instituciones.IDLocalidad=localidades.ID");
	echo $str;
	
}
$inst = mysqli_query($link,"SELECT instituciones.*, localidades.Nombre as localidad FROM instituciones, localidades WHERE instituciones.vigente='1' and instituciones.IDLocalidad=localidades.ID ORDER BY instituciones.Nombre ");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">

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
	<img src="images/map.png" width="30" height="36" border="0"> <b>Buscar Instituciones</b>
	</div>
    <div class="clear2"> </div>
    <div >
    
      <div class="clear2"> </div>

	 <table width="100%" >

		  <td><div align="left">Institución: </div></td>

		  <td colspan="3"><div align="left">

		    <select name="cmbInst" id="combobox">
			  <?php while($row=mysqli_fetch_assoc($inst)) { ?>
			  <?php if ($row["ID"]==$_REQUEST[cmbInst]) { 
			  $sel="selected";
			  }
			  else
			  {
			  $sel="";
			  }			  
			  ?> 
		      <option value="<?php echo $row["ID"]?>" <?php echo $sel;?>><?php echo $row["Nombre"]?> (<?php echo $row["localidad"]?>)</option>
		      <?php } ?>
		      </select>

		    </div></td>
		  </tr>


		<tr>

		  <td colspan="4">&nbsp;</td>
		  </tr>

		<tr><td colspan="4"><div align="center">

		  <input name="cmdbuscar" type="submit" class="btn" value="BUSCAR" />

		  </div></td></tr></table>
		 
    	  <?php if ($_REQUEST["cmdbuscar"]) { ?>

		   <table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>

              <td align="center" bgcolor="#999999" ><div align="center"><strong>Alias</strong></div></td>
			  
			  <td width="25%" align="center" bgcolor="#999999" ><div align="center"><strong>Domicilio</strong></div></td>

              <td  width="20%" align="center" bgcolor="#999999" ><div align="center"><strong>Localidad</strong></div></td>
					
              <td width="8%" align="center" bgcolor="#999999" ><strong>Teléfono</strong></td>

              <td width="8%" align="center" bgcolor="#999999" >&nbsp;</td>
		     </tr>

            <?php while($row =  mysqli_fetch_assoc($id_inst)){	?>

            <tr>

              <td align="center"> <?php echo $row["Nombre2"] ?> </td>

			  <td  align="center"> <?php echo $row["Domicilio"] ?> </td>

              <td  align="center"> <?php echo $row["localidad"] ?> </td>

			  <td  align="center"> <?php $row["Telefono"] ?> </td>
			 
			  <td  align="center"><a href="#"><img src="images/icon_edit.gif" border="0"  width="20px" height="16px" title="editar" onClick="window.open('instituciones.php?id_inst=<?php echo $row["ID"]?>','_self');"></a></td>
			  <?php } ?>
            </tr>
            <?php } ?>
          </table>
    	  

		  <?php // fin de la tabla?>		  
    </div>
  </div>
</div>
</div>
<div class="clear"> </div>
<?php include("pie.php"); ?>
</form>
	
</body>
</html>
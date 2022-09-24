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
if($_POST["action"] == "E")
{
	mysqli_query($link,"UPDATE personal SET vigente='0', AudUsrModi='$usrmodi', AudFecModi='$fecmodi' WHERE ID=". $_POST["id_per"]);
	mysqli_query($link,"DELETE FROM declaraciones_juradas WHERE IDPersonal=". $_POST["id_per"]);
}

if($_REQUEST["id_inst"]!="")
{
	$personal=mysqli_query($link,"SELECT a.ID, a.Nombre, a.Cargo, a.FechaIngreso, a.CUIL, a.Telefono, a.FechaIngreso FROM personal a  WHERE a.vigente='1'  AND a.IDInstitucion = ". $_REQUEST["id_inst"] ." ORDER BY a.nombre");
}
else
{
	$personal=mysqli_query($link,"SELECT a.ID, a.Nombre, a.Cargo, a.FechaIngreso, a.CUIL, a.Telefono, a.FechaIngreso FROM personal a WHERE a.vigente='1'  AND a.IDInstitucion= '" . $_SESSION["Institucion"]."' ORDER BY a.nombre");
}
//obtengo el nombre de la institucion para no repetirlo en las columnas
if($_REQUEST["id_inst"]!="")
{
	$sql_nombreinst = mysqli_fetch_assoc(mysqli_query($link,"SELECT Nombre FROM instituciones WHERE ID = ". $_REQUEST["id_inst"] .""));
}
else
{
	$sql_nombreinst = mysqli_fetch_assoc(mysqli_query($link,"SELECT Nombre FROM instituciones WHERE ID= '" . $_SESSION["Institucion"]."' "));
}

$inst=mysqli_query($link,"SELECT * FROM instituciones  WHERE  instituciones.vigente='1' ORDER BY nombre");

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
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
-->
</style>
</head>
<body>
<form name="frm" id="frm" method="post" action="">
<script language="javascript" src="calendar/calendar.js"></script>
<script>
function listar_personal(){
	ventana="listar_docentes_seguro.php?id_inst=" + document.frm.cmbInst.value;
	window.open(ventana,'_self');
}

function reporte_persona(id){
	ventana="reporte_persona.php?id="+ id;
	window.open(ventana,'','width=720,height=720,top=20,left=200,scrollbars=auto,titlebar=no,location=no');
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
	<img src="images/map.png" width="30" height="36" border="0"> <b>Docentes y No Docentes - Beneficiarios de Seguro de Vida</b>
	</div>
    <div class="clear2"> </div>
    <div >
      
	  <table align="center">
       <?php if(mysqli_num_rows($inst) > 0 && $_SESSION["Institucion"]==14 ){ ?>
       <tr align="right" valign="middle">
	   <td >Institución:&nbsp;&nbsp;</td>
       <td align="left" >
       <select name="cmbInst" id="combobox">
		<!-- SI LA INSTITUCION ES JAEC LISTO TODAS SI NO ERDIRECCIONO A listar_usuarios.php--> 
						<?php if ($_SESSION["Institucion"]==14) {?>
							<?php while($row=mysqli_fetch_assoc($inst)) { ?>
							<?php 
						  if ($_REQUEST["id_inst"]=="") {
						  $strinst=$_SESSION["Institucion"];
						  }else{
						  $strinst=$_REQUEST["id_inst"];
						  }
						  ?>
						<option value="<?php echo $row["ID"]?>" <?php if($row["ID"]==$strinst) echo "selected"?>><?php echo $row["Nombre"]?> (<?php echo $row["Localidad"]?>)</option>
							<?php } ?>
						<?php } ?>
				</select>
              </td>
                  <td align="center"> 
                 	<input name="btnlistar" type="button" onClick="listar_personal();" class="btn" value="LISTAR" />
                  </td>
            </tr>
               <?php } ?>
          </table>

      <table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="28%" height="20" align="center" bgcolor="#999999" ><strong>Nombre y Apellido</strong></td>
    <td width="20%" align="center" bgcolor="#999999"  ><strong>Cargo</strong></td>
    <td width="15%" align="center" bgcolor="#999999" ><strong>CUIL</strong></td>
    <td width="20%" align="center" bgcolor="#999999" ><strong>Ingreso</strong></td>
    <td width="6%" align="center" bgcolor="#999999" >&nbsp;</td>
    <td width="6%" align="center" bgcolor="#999999" >&nbsp;</td>
  </tr>
  <?php while($row =  mysqli_fetch_assoc($personal)){

					$cant++;

					if($cant % 2 == 0){ $bg = 'bgcolor="#FFFFCC"'; } else { $bg = 'bgcolor="#FFFFFF"'; }

			?>
  <tr>
    <td height="30" align="center" <?php echo $bg ?> class="tahoma11"><?php echo $row["Nombre"]?></td>
    <td align="center" <?php echo $bg ?> class="tahoma11"><?php echo $row["Cargo"]?></td>
    <td align="center" <?php echo $bg ?> class="tahoma11"><?php echo $row["CUIL"]?></td>
    <td align="center" <?php echo $bg ?> class="tahoma11"><?php echo $row["FechaIngreso"]?></td>
    <td align="center" <?php echo $bg ?> class="tahoma11"><a href="#"><img src="images/icon_vida.gif" border="0"  width="20" height="20" alt="beneficiarios" title="beneficiarios" onClick="window.open('listar_declaraciones_seguro.php?id_per=<?php echo $row["ID"]?>','_self');"></a> </td>
    <td align="center" <?php echo $bg ?> class="tahoma11"><a href="#"><img src="images/icon-printer2.jpg" border="0" width="20" height="18" alt="imprimir"  title="imprimir" onClick="reporte_persona(<?php echo $row["ID"]?>)"></a> </td>
  </tr>
  <?php } ?>
</table>
</div>
  </div>
</div>
</div>
<div class="clear"> </div>
<?php include("pie.php"); ?>
<input type="hidden" name="action" id="action">
<input type="hidden" name="id_per" id="id_per">
</form>
	
</body>
</html>
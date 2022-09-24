<?php
error_reporting('0');

//controlo acceso y auditoria
session_start();
if(!$_SESSION["log"]) header("location:index.php");
$usrmodi=$_SESSION["Usuario"];
$fecmodi=date("Y-m-d H:i:s");
$usralta=$_SESSION["Usuario"];
$fecalta=date("Y-m-d H:i:s");
//$mensaje = "Clic para cargar o imprimir los beneficiarios";
//base de datos
include ("funciones/conexion_bbdd.php");


// regla de negocios
if($_POST["action"] == "E")
{
	mysqli_query($link,"UPDATE personal SET vigente='0', AudUsrModi='$usrmodi', AudFecModi='$fecmodi' WHERE ID=". $_POST["id_per"], $link);
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
	ventana="listar_docentes.php?id_inst=" + document.frm.cmbInst.value;
	window.open(ventana,'_self');
}

function eliminar(id)
{
	if (confirm('¿Está seguro de eliminar el registro?'))
	{
		frm.action.value="E";
		frm.id_per.value= id;		
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
	<img src="images/map.png" width="30" height="36" border="0"> <b>Docentes y No Docentes - Alta y Modificación</b>
	</div>
   
    <div class="clear2"> </div>
<div>	  
	  	  <table  style="border:none">
       <?php if(mysqli_num_rows($inst) > 0 && $_SESSION["Institucion"]==14 ){ ?>
       <tr align="right" valign="middle">
	   <td >Institución:&nbsp;&nbsp;</td>
       <td align="left" >
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

              </td>
                  <td align="center"> 
                 	<input name="btnlistar" type="button" onClick="listar_personal();" class="btn" value="LISTAR" />
                  </td>
            </tr>
               <?php } ?>
			   <tr><td style="height:50px"></td></tr>
          </table>

      <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="28%" height="20" align="center" bgcolor="#999999" ><strong>Nombre y Apellido</strong></td>
    <td width="20%" align="center" bgcolor="#999999"  ><strong>Cargo</strong></td>
    <td width="15%" align="center" bgcolor="#999999" ><strong>CUIL</strong></td>
    <td width="20%" align="center" bgcolor="#999999" ><strong>Fecha Ingreso</strong></td>
    <td width="6%" align="center" bgcolor="#999999" >&nbsp;</td>
    <td width="6%" align="center" bgcolor="#999999" >&nbsp;</td>
  </tr>
  <?php while($row =  mysqli_fetch_assoc($personal)){ ?>
  <tr>
    <td height="30" align="center" <?php echo $bg ?> class="tahoma11"><?php echo $row["Nombre"]?></td>
    <td align="center" <?php echo $bg ?> class="tahoma11"><?php echo $row["Cargo"]?></td>
    <td align="center" <?php echo $bg ?> class="tahoma11"><?php echo $row["CUIL"]?></td>
    <td align="center" <?php echo $bg ?> class="tahoma11"><?php echo $row["FechaIngreso"]?></td>
    <td align="center" <?php echo $bg ?> class="tahoma11"><a href="#"><img src="images/icon_edit.gif" border="0"  width="20px" height="16px" title="editar" onClick="window.open('docentes.php?id_per=<?php echo $row["ID"]?>','_self');"></a> </td>
    <td align="center" <?php echo $bg ?> class="tahoma11"><a href="javascript:eliminar('<?php echo $row["ID"]?>');"><img src="images/icon_delete.gif" border="0"  width="20px" height="20px" title="eliminar"></a> </td>
 
  </tr>
  <?php } ?>
  
  <tr>
          <td height="26" colspan="6" align="center" class="tahoma11">
            <input name="Submit2" type="button" class="btn" value="NUEVO" onClick="window.open('docentes.php','_self');" />          </td>
        </tr>
		
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
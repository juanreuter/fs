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

$id=$_REQUEST["id_usu"];

//////////////////////////SI HACE CLIC EN ELIMINAR ////////////////////////////////////////////////////////////////////////////

if($_REQUEST["action"]=="E" && $id!="")
{
mysqli_query($link,"UPDATE usuarios SET vigente='0', AudUsrModi='$usrmodi', AudFecModi='$fecmodi'  WHERE ID=$id");
mysqli_query($link,"DELETE FROM usuarios_subsistemas WHERE IDUsuario=$id");
}

/////////////////////////// LISTA LOS USUARIOS////////////////////////

if($_REQUEST["id_inst"]!="")
{
$usuarios=mysqli_query($link,"SELECT a.ID, a.Nombre, b.Nombre as NomInst, a.Email, a.Usuario, a.Pass FROM usuarios a, instituciones b WHERE a.vigente='1' AND b.vigente='1' AND a.IDInstitucion = b.ID AND a.IDInstitucion = '". $_REQUEST["id_inst"] ."'  ORDER BY b.Nombre, a.Nombre");
}
else
{
$usuarios=mysqli_query($link,"SELECT a.ID, a.Nombre, b.Nombre as NomInst, a.Email, a.Usuario, a.Pass FROM usuarios a, instituciones b WHERE a.vigente='1' AND b.vigente='1' AND a.IDInstitucion = b.ID AND a.IDInstitucion= '" . $_SESSION["Institucion"]."'  ORDER BY b.Nombre, a.Nombre");
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
	width:400px;
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

<script language="javascript">

function editar(id_u)
{
url="usuarios.php?id_usu=" + id_u;
window.location.href=url;
}

function subsistemas(id_u)
{
url="usuarios_subsistemas.php?id_usu=" + id_u;
window.location.href=url;
}


function listar_usuarios(){
	ventana="usuarios.listar.php?id_inst=" + document.frm.cmbInst.value;
	window.open(ventana,'_self');
}


</script>



<script language="javascript">

function eliminar(id_u)
{
	if (confirm('¿Está seguro de eliminar el registro?'))
	{
	frm.action.value='E'
	url="usuarios.listar.php?id_usu=" + id_u+"&action="+frm.action.value;
	window.location.href=url;
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
	<img src="images/map.png" width="30" height="36" border="0"> <b>Usuarios - Alta y Modificación</b>
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
                 	<input name="btnlistar" type="button" onClick="listar_usuarios();" class="btn" value="LISTAR" />
                  </td>
            </tr>
               <?php } ?>
          </table>

	  <table width="95%" border="0" cellspacing="0" cellpadding="0">
        <tr>
  		  <td align="center" ><strong>Nombre y Apellido</strong></td>
		  <td align="center" ><strong>Usuario</strong></td>
          <td align="center" >&nbsp;</td>
          <td align="center" >&nbsp;</td>
        </tr>
        <?php while($row =  mysqli_fetch_assoc($usuarios)){	?>
        <tr>
          <td align="center" ><?php echo $row["Nombre"]?></td>
          <td align="center" ><?php echo $row["Usuario"]?></td>
          <td align="center" ><a href="javascript:editar(<?php echo $row["ID"]?>);"><img src="images/icon_edit.gif" width="20px" ></a> </td>
          <td align="center" ><a href="javascript:subsistemas(<?php echo $row["ID"]?>);"><img src="images/icon_listar.gif" width="20px" ></a> </td>
          <td align="center" ><a href="javascript:eliminar(<?php echo $row["ID"]?>);"><img src="images/icon_delete.gif" width="20px" ></a> </td>
        </tr>
        <?php } ?>
        <tr>
          <td height="40" colspan="4" align="center"  >          </td>
        </tr>
		<tr>
          <td height="26" colspan="6" align="center" class="tahoma11">
            <input name="Submit2" type="button" class="btn" value="NUEVO" onClick="window.open('usuarios.php','_self');" />          </td>
        </tr>
	
      </table>
    </div>
  </div>
</div>
</div>
<div class="clear"> </div>
<?php include("pie.php"); ?>

        <input type="hidden" name="action" id="action">

        <input type="hidden" name="id_usu" id="id_usu">

</form>
	
</body>
</html>
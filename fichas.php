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

$mensaje="Complete los datos y haga clic en Buscar";
//datos del archivo
$archivo=$_FILES['fileArchivo']['name'];
//*******************************************************

if ($_REQUEST["cmdguardar"]) 
{ // si hizo clic en guardar
$nivel = $_POST["cmbNivel"];
$anio =  $_POST["cmbAnio"];
$idinstitucion =  $_POST["cmbInst"];
$id = $_POST["id_fic"];

if ($nivel == 'Inicial' && $id =='') // INSERT
{
	if ($anio != "" && $idinstitucion != "")
	{
	mysqli_query($link,"INSERT INTO fi_inicial (anio, idinstitucion, archivo_adjunto, AudUsrAlta, AudFecAlta, vigente) VALUES ('$anio', '$idinstitucion', '$archivo', '$usralta', '$fecmodi', '1')");
	$id_ficha = mysqli_insert_id($link);
	move_uploaded_file($_FILES['fileArchivo']['tmp_name'], "archivos_fichas/".$archivo);
	?>
	<script>
	window.alert("Datos registrados correctamente!")
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
}

if ($nivel == 'Inicial' && $id !='') // UPDATE
{
	if ($anio != "" && $idinstitucion != "")
	{
	mysqli_query($link,"UPDATE fi_inicial SET anio = '$anio' , idinstitucion = '$idinstitucion', archivo_adjunto = '$archivo', AudUsrAlta = '$usralta' , AudFecAlta = '$fecalta' WHERE id_ficha='$id' ");
	move_uploaded_file($_FILES['fileArchivo']['tmp_name'], "archivos_fichas/".$archivo);
	?>
	<script>
	window.alert("Datos registrados correctamente!")
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
}


if ($nivel == 'Primario' && $id =='') // INSERT 
{
	if ($anio != "" && $idinstitucion != "")
	{
	mysqli_query($link,"INSERT INTO fi_primario (anio, idinstitucion, archivo_adjunto, AudUsrAlta, AudFecAlta, vigente) VALUES ('$anio', '$idinstitucion', '$archivo', '$usralta', '$fecmodi', '1')");
	$id_ficha = mysqli_insert_id($link);
	move_uploaded_file($_FILES['fileArchivo']['tmp_name'], "archivos_fichas/".$archivo);
	?>
	<script>
	window.alert("Datos registrados correctamente!")
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
}

if ($nivel == 'Primario' && $id !='') // UPDATE
{
	if ($anio != "" && $idinstitucion != "")
	{
	mysqli_query($link,"UPDATE fi_primario SET anio = '$anio' , idinstitucion = '$idinstitucion', archivo_adjunto = '$archivo', AudUsrAlta = '$usralta' , AudFecAlta = '$fecalta' WHERE id_ficha='$id' ");
	move_uploaded_file($_FILES['fileArchivo']['tmp_name'], "archivos_fichas/".$archivo);
	?>
	<script>
	window.alert("Datos registrados correctamente!")
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
}



if ($nivel == 'Secundario' && $id =='') // INSERT 
{
	if ($anio != "" && $idinstitucion != "")
	{
	mysqli_query($link,"INSERT INTO fi_secundaria (anio, idinstitucion, archivo_adjunto, AudUsrAlta, AudFecAlta, vigente) VALUES ('$anio', '$idinstitucion', '$archivo', '$usralta', '$fecmodi', '1')");
	$id_ficha = mysqli_insert_id($link);
	move_uploaded_file($_FILES['fileArchivo']['tmp_name'], "archivos_fichas/".$archivo);
	?>
	<script>
	window.alert("Datos registrados correctamente!")
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
}

if ($nivel == 'Secundario' && $id !='') // UPDATE
{
	if ($anio != "" && $idinstitucion != "")
	{
	mysqli_query($link,"UPDATE fi_secundaria SET anio = '$anio' , idinstitucion = '$idinstitucion', archivo_adjunto = '$archivo', AudUsrAlta = '$usralta' , AudFecAlta = '$fecalta' WHERE id_ficha='$id' ");
	move_uploaded_file($_FILES['fileArchivo']['tmp_name'], "archivos_fichas/".$archivo);
	?>
	<script>
	window.alert("Datos registrados correctamente!")
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
}



if ($nivel == 'Superior' && $id =='') // INSERT 
{
	if ($anio != "" && $idinstitucion != "")
	{
	mysqli_query($link,"INSERT INTO fi_superior (anio, idinstitucion, archivo_adjunto, AudUsrAlta, AudFecAlta, vigente) VALUES ('$anio', '$idinstitucion', '$archivo', '$usralta', '$fecmodi', '1')");
	$id_ficha = mysqli_insert_id($link);
	move_uploaded_file($_FILES['fileArchivo']['tmp_name'], "archivos_fichas/".$archivo);
	?>
	<script>
	window.alert("Datos registrados correctamente!")
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
}

if ($nivel == 'Superior' && $id !='') // UPDATE
{
	if ($anio != "" && $idinstitucion != "")
	{
	mysqli_query($link,"UPDATE fi_superior SET anio = '$anio' , idinstitucion = '$idinstitucion', archivo_adjunto = '$archivo', AudUsrAlta = '$usralta' , AudFecAlta = '$fecalta' WHERE id_ficha='$id' ");
	move_uploaded_file($_FILES['fileArchivo']['tmp_name'], "archivos_fichas/".$archivo);
	?>
	<script>
	window.alert("Datos registrados correctamente!")
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
}


}// cierra el guardar

//listo las instituciones 
if ($_SESSION["Institucion"]==14)
{
$inst=mysqli_query($link,"SELECT * FROM instituciones  where vigente='1' ORDER BY nombre");
}
else
{
//listo las instituciones del usuario
$inst=mysqli_query($link,"SELECT * FROM instituciones  where vigente='1' and ID=".$_SESSION["Institucion"]." ORDER BY nombre");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">

<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->
<!--SEO -->
<meta name="Keywords" content=" " />
<meta name="description" content=" " />
<title>Fondo Solidario  |  Sistema de Gesti贸n</title>
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
	<img src="images/map.png" width="30" height="36" border="0"> <b>Nueva Ficha Institucional </b>
	</div>
    <div class="clear2"> </div>
    <div >
    
      <div class="clear2"> </div>

	 <table width="100%" >

		  <tr><td><div align="left">Institución: 
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

		  <td>Año:</td>
		  <td>
		  <select name="cmbAnio" id="cmbAnio" style="width:120px">
		  <option value="2016" <?php if ($anio=="2016") echo "selected=selected"?>>2016</option>
		  <option value="2017" <?php if ($anio=="2017") echo "selected=selected"?>>2017</option>
		  <option value="2018" <?php if ($anio=="2018") echo "selected=selected"?>>2018</option>
		  <option value="2019" <?php if ($anio=="2019") echo "selected=selected"?>>2019</option>
		  <option value="2020" <?php if ($anio=="2020") echo "selected=selected"?>>2020</option>
		  <option value="2021" <?php if ($anio=="2021") echo "selected=selected"?>>2021</option>
		  <option value="2022" <?php if ($anio=="2022") echo "selected=selected"?>>2022</option>
			  
		  </select>		  </td>
		  <td><div align="right">Nivel:</div></td>
		  <td>
		  <?php if ($id_ficha =="") {?>
		  <select name="cmbNivel" id="cmbNivel" style="width:120px">
		    <option value="Inicial" <?php if ($nivel=="Inicial") echo "selected=selected"?>   >Inicial</option>
            <option value="Primario" <?php if ($nivel=="Primario") echo "selected=selected"?> >Primario</option>
			<option value="Secundario" <?php if ($nivel=="Secundario") echo "selected=selected"?> >Secundario</option>
			<option value="Superior" <?php if ($nivel=="Superior") echo "selected=selected"?>>Superior</option>
          </select>
		  <?php } else { ?>
		<select name="cmbNivel" id="cmbNivel" style="width:120px">
		    <option value="<?php echo $nivel?>" selected=selected><?php echo $nivel?></option>
          </select>
		  <?php } ?>
		  </td>
		  	</tr>
		 <tr>
		 <td align="left" class="tahoma11">Archivo Adjunto:</td>
         <td colspan="3" ><input name="fileArchivo" type="file" id="fileArchivo"  />  
		 &nbsp;&nbsp;&nbsp;
		 	<?php if ($archivo != "") { ?>
		<a href="../archivos_fichas/<?php echo $archivo ?>" target="_blank" title="abrir archivo"><?php echo $archivo ?></a> 
		<?php } ?>
	
		 </td> 
		</tr>
		
		<tr><td colspan="4"><div align="center">

		  <input name="cmdguardar" type="submit" class="btn" value="GUARDAR" />

		  </div></td></tr></table>
          </table>

		</div>
  </div>
</div>
</div>
<div class="clear"> </div>
<?php include("pie.php"); ?>
<input type="hidden" name="action" id="action">
<input name="id_fic" type="hidden" id="id_fic" value="<?php echo $id_ficha?>">
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

$mensaje="Complete los datos y haga clic en Buscar";
//datos del archivo
$archivo=$_FILES['fileArchivo']['name'];
//*******************************************************

if ($_REQUEST["cmdguardar"]) 
{ // si hizo clic en guardar
$nivel = $_POST["cmbNivel"];
$anio =  $_POST["cmbAnio"];
$idinstitucion =  $_POST["cmbInst"];
$id = $_POST["id_fic"];

if ($nivel == 'Inicial' && $id =='') // INSERT
{
	if ($anio != "" && $idinstitucion != "")
	{
	mysqli_query($link,"INSERT INTO fi_inicial (anio, idinstitucion, archivo_adjunto, AudUsrAlta, AudFecAlta, vigente) VALUES ('$anio', '$idinstitucion', '$archivo', '$usralta', '$fecmodi', '1')");
	$id_ficha = mysqli_insert_id($link);
	move_uploaded_file($_FILES['fileArchivo']['tmp_name'], "archivos_fichas/".$archivo);
	?>
	<script>
	window.alert("Datos registrados correctamente!")
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
}

if ($nivel == 'Inicial' && $id !='') // UPDATE
{
	if ($anio != "" && $idinstitucion != "")
	{
	mysqli_query($link,"UPDATE fi_inicial SET anio = '$anio' , idinstitucion = '$idinstitucion', archivo_adjunto = '$archivo', AudUsrAlta = '$usralta' , AudFecAlta = '$fecalta' WHERE id_ficha='$id' ");
	move_uploaded_file($_FILES['fileArchivo']['tmp_name'], "archivos_fichas/".$archivo);
	?>
	<script>
	window.alert("Datos registrados correctamente!")
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
}


if ($nivel == 'Primario' && $id =='') // INSERT 
{
	if ($anio != "" && $idinstitucion != "")
	{
	mysqli_query($link,"INSERT INTO fi_primario (anio, idinstitucion, archivo_adjunto, AudUsrAlta, AudFecAlta, vigente) VALUES ('$anio', '$idinstitucion', '$archivo', '$usralta', '$fecmodi', '1')");
	$id_ficha = mysqli_insert_id($link);
	move_uploaded_file($_FILES['fileArchivo']['tmp_name'], "archivos_fichas/".$archivo);
	?>
	<script>
	window.alert("Datos registrados correctamente!")
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
}

if ($nivel == 'Primario' && $id !='') // UPDATE
{
	if ($anio != "" && $idinstitucion != "")
	{
	mysqli_query($link,"UPDATE fi_primario SET anio = '$anio' , idinstitucion = '$idinstitucion', archivo_adjunto = '$archivo', AudUsrAlta = '$usralta' , AudFecAlta = '$fecalta' WHERE id_ficha='$id' ");
	move_uploaded_file($_FILES['fileArchivo']['tmp_name'], "archivos_fichas/".$archivo);
	?>
	<script>
	window.alert("Datos registrados correctamente!")
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
}



if ($nivel == 'Secundario' && $id =='') // INSERT 
{
	if ($anio != "" && $idinstitucion != "")
	{
	mysqli_query($link,"INSERT INTO fi_secundaria (anio, idinstitucion, archivo_adjunto, AudUsrAlta, AudFecAlta, vigente) VALUES ('$anio', '$idinstitucion', '$archivo', '$usralta', '$fecmodi', '1')");
	$id_ficha = mysqli_insert_id($link);
	move_uploaded_file($_FILES['fileArchivo']['tmp_name'], "archivos_fichas/".$archivo);
	?>
	<script>
	window.alert("Datos registrados correctamente!")
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
}

if ($nivel == 'Secundario' && $id !='') // UPDATE
{
	if ($anio != "" && $idinstitucion != "")
	{
	mysqli_query($link,"UPDATE fi_secundaria SET anio = '$anio' , idinstitucion = '$idinstitucion', archivo_adjunto = '$archivo', AudUsrAlta = '$usralta' , AudFecAlta = '$fecalta' WHERE id_ficha='$id' ");
	move_uploaded_file($_FILES['fileArchivo']['tmp_name'], "archivos_fichas/".$archivo);
	?>
	<script>
	window.alert("Datos registrados correctamente!")
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
}



if ($nivel == 'Superior' && $id =='') // INSERT 
{
	if ($anio != "" && $idinstitucion != "")
	{
	mysqli_query($link,"INSERT INTO fi_superior (anio, idinstitucion, archivo_adjunto, AudUsrAlta, AudFecAlta, vigente) VALUES ('$anio', '$idinstitucion', '$archivo', '$usralta', '$fecmodi', '1')");
	$id_ficha = mysqli_insert_id($link);
	move_uploaded_file($_FILES['fileArchivo']['tmp_name'], "archivos_fichas/".$archivo);
	?>
	<script>
	window.alert("Datos registrados correctamente!")
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
}

if ($nivel == 'Superior' && $id !='') // UPDATE
{
	if ($anio != "" && $idinstitucion != "")
	{
	mysqli_query($link,"UPDATE fi_superior SET anio = '$anio' , idinstitucion = '$idinstitucion', archivo_adjunto = '$archivo', AudUsrAlta = '$usralta' , AudFecAlta = '$fecalta' WHERE id_ficha='$id' ");
	move_uploaded_file($_FILES['fileArchivo']['tmp_name'], "archivos_fichas/".$archivo);
	?>
	<script>
	window.alert("Datos registrados correctamente!")
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
}


}// cierra el guardar

//listo las instituciones 
if ($_SESSION["Institucion"]==14)
{
$inst=mysqli_query($link,"SELECT * FROM instituciones  where vigente='1' ORDER BY nombre");
}
else
{
//listo las instituciones del usuario
$inst=mysqli_query($link,"SELECT * FROM instituciones  where vigente='1' and ID=".$_SESSION["Institucion"]." ORDER BY nombre");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">

<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->
<!--SEO -->
<meta name="Keywords" content=" " />
<meta name="description" content=" " />
<title>Fondo Solidario  |  Sistema de Gesti贸n</title>
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
	<img src="images/map.png" width="30" height="36" border="0"> <b>Nueva Ficha Institucional </b>
	</div>
    <div class="clear2"> </div>
    <div >
    
      <div class="clear2"> </div>

	 <table width="100%" >

		  <tr><td><div align="left">Institución: 
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

		  <td>Año:</td>
		  <td>
		  <select name="cmbAnio" id="cmbAnio" style="width:120px">
		  <option value="2016" <?php if ($anio=="2016") echo "selected=selected"?>>2016</option>
		  <option value="2017" <?php if ($anio=="2017") echo "selected=selected"?>>2017</option>
		  <option value="2018" <?php if ($anio=="2018") echo "selected=selected"?>>2018</option>
		  <option value="2019" <?php if ($anio=="2019") echo "selected=selected"?>>2019</option>
		  <option value="2020" <?php if ($anio=="2020") echo "selected=selected"?>>2020</option>
		  <option value="2021" <?php if ($anio=="2021") echo "selected=selected"?>>2021</option>
		  <option value="2022" <?php if ($anio=="2022") echo "selected=selected"?>>2022</option>
			  
		  </select>		  </td>
		  <td><div align="right">Nivel:</div></td>
		  <td>
		  <?php if ($id_ficha =="") {?>
		  <select name="cmbNivel" id="cmbNivel" style="width:120px">
		    <option value="Inicial" <?php if ($nivel=="Inicial") echo "selected=selected"?>   >Inicial</option>
            <option value="Primario" <?php if ($nivel=="Primario") echo "selected=selected"?> >Primario</option>
			<option value="Secundario" <?php if ($nivel=="Secundario") echo "selected=selected"?> >Secundario</option>
			<option value="Superior" <?php if ($nivel=="Superior") echo "selected=selected"?>>Superior</option>
          </select>
		  <?php } else { ?>
		<select name="cmbNivel" id="cmbNivel" style="width:120px">
		    <option value="<?php echo $nivel?>" selected=selected><?php echo $nivel?></option>
          </select>
		  <?php } ?>
		  </td>
		  	</tr>
		 <tr>
		 <td align="left" class="tahoma11">Archivo Adjunto:</td>
         <td colspan="3" ><input name="fileArchivo" type="file" id="fileArchivo"  />  
		 &nbsp;&nbsp;&nbsp;
		 	<?php if ($archivo != "") { ?>
		<a href="../archivos_fichas/<?php echo $archivo ?>" target="_blank" title="abrir archivo"><?php echo $archivo ?></a> 
		<?php } ?>
	
		 </td> 
		</tr>
		
		<tr><td colspan="4"><div align="center">

		  <input name="cmdguardar" type="submit" class="btn" value="GUARDAR" />

		  </div></td></tr></table>
          </table>

		</div>
  </div>
</div>
</div>
<div class="clear"> </div>
<?php include("pie.php"); ?>
<input type="hidden" name="action" id="action">
<input name="id_fic" type="hidden" id="id_fic" value="<?php echo $id_ficha?>">
</form>
	
</body>
>>>>>>> 64483f4e4592a7d8cfa1980d291de5bef1badd92
</html>
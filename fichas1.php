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
$id = $_REQUEST["id_fic"]; 

// ELIMINAR
if($_REQUEST["action"] == "E" && $_REQUEST["id_fic"] !="" && $_REQUEST["id_nivel"] !=""  )

{
	if ($_REQUEST["id_nivel"] == 'Inicial')
	{
	mysqli_query($link,"UPDATE fi_inicial SET vigente='0', AudUsrModi='$usrmodi', AudFecModi='$fecmodi' WHERE id_ficha=".$_REQUEST["id_fic"]."");
	}
	if ($_REQUEST["id_nivel"] == 'Primario')
	{
	mysqli_query($link,"UPDATE fi_primario SET vigente='0', AudUsrModi='$usrmodi', AudFecModi='$fecmodi' WHERE id_ficha=".$_REQUEST["id_fic"]."");
	}
	if ($_REQUEST["id_nivel"] == 'Secundario')
	{
	mysqli_query($link,"UPDATE fi_secundaria SET vigente='0', AudUsrModi='$usrmodi', AudFecModi='$fecmodi' WHERE id_ficha=".$_REQUEST["id_fic"]."");
	}
	if ($_REQUEST["id_nivel"] == 'Superior')
	{
	mysqli_query($link,"UPDATE fi_superior SET vigente='0', AudUsrModi='$usrmodi', AudFecModi='$fecmodi' WHERE id_ficha=".$_REQUEST["id_fic"]."");
	}
}

$mensaje="Complete los datos y haga clic en Buscar";
if ($_REQUEST["cmdbuscar"]) 
{ // si hizo clic en buscar
	$mensaje="Resultado de la búsqueda";
	$anio= $_REQUEST["cmbAnio"];
	$nivel= $_REQUEST["cmbNivel"];
	$ibuscar=$_REQUEST["cmbInst"];

if ($nivel == "Inicial") 
	{
	if ($ibuscar!= "") 
		{
			$fichas=mysqli_query($link,"SELECT id_ficha, Nombre, anio, 'Inicial', archivo_adjunto   from fi_inicial, instituciones  WHERE fi_inicial.idinstitucion= ".$ibuscar." AND anio like '%".$anio."%' AND fi_inicial.idinstitucion=instituciones.ID AND fi_inicial.vigente=1");
		}
		else
		{
			$fichas=mysqli_query($link,"SELECT id_ficha, Nombre, anio, 'Inicial', archivo_adjunto from fi_inicial, instituciones    WHERE anio like '%".$anio."%' AND fi_inicial.idinstitucion=instituciones.ID AND fi_inicial.vigente=1");
		
		}
	}


if ($nivel == "Primario") 
	{
	if ($ibuscar!= "") 
		{
			$fichas=mysqli_query($link,"SELECT id_ficha, Nombre, anio, 'Primario', archivo_adjunto from fi_primario, instituciones    WHERE fi_primario.idinstitucion= ".$ibuscar." AND anio like '%".$anio."%' AND fi_primario.idinstitucion=instituciones.ID AND fi_primario.vigente=1");
		}
		else
		{
			$fichas=mysqli_query($link,"SELECT id_ficha, Nombre, anio, 'Primario', archivo_adjunto from fi_primario, instituciones    WHERE anio like '%".$anio."%' AND fi_primario.idinstitucion=instituciones.ID AND fi_primario.vigente=1");
		
		}
	}


if ($nivel == "Secundario") 
	{
	if ($ibuscar!= "") 
		{
			$fichas=mysqli_query($link,"SELECT id_ficha, Nombre, anio, 'Secundario', archivo_adjunto from fi_primario, instituciones    WHERE fi_secundaria.idinstitucion= ".$ibuscar." AND anio like '%".$anio."%' AND fi_secundaria.idinstitucion=instituciones.ID AND fi_secundaria.vigente=1");
		}
		else
		{
			$fichas=mysqli_query($link,"SELECT id_ficha, Nombre, anio, 'Secundario', archivo_adjunto from fi_secundaria, instituciones    WHERE anio like '%".$anio."%' AND fi_secundaria.idinstitucion=instituciones.ID AND fi_secundaria.vigente=1");
		
		}
	}

	if ($nivel == "Superior") 
	{
	if ($ibuscar!= "") 
		{
			$fichas=mysqli_query($link,"SELECT id_ficha, Nombre, anio, 'Superior', archivo_adjunto from fi_superior, instituciones    WHERE fi_superior.idinstitucion= ".$ibuscar." AND anio like '%".$anio."%' AND fi_superior.idinstitucion=instituciones.ID AND fi_superior.vigente=1");
		}
		else
		{
			$fichas=mysqli_query($link,"SELECT id_ficha, Nombre, anio, 'Superior', archivo_adjunto from fi_superior, instituciones    WHERE anio like '%".$anio."%' AND fi_superior.idinstitucion=instituciones.ID AND fi_superior.vigente=1");
		
		}
	}

if ($nivel == "") 
	{
	if ($ibuscar!= "") 
		{
			$fichas=mysqli_query($link,"SELECT id_ficha, Nombre, anio, 'Inicial', archivo_adjunto  from fi_inicial, instituciones  WHERE fi_inicial.idinstitucion= ".$ibuscar." AND anio like '%".$anio."%' AND fi_inicial.idinstitucion=instituciones.ID AND fi_inicial.vigente=1 UNION ALL SELECT id_ficha, Nombre, anio, 'Primario', archivo_adjunto  from fi_primario, instituciones  WHERE idinstitucion= ".$ibuscar." AND anio like '%".$anio."%' AND fi_primario.idinstitucion=instituciones.ID AND fi_primario.vigente=1  UNION ALL SELECT id_ficha, Nombre, anio, 'Secundario', archivo_adjunto  from fi_secundaria, instituciones  WHERE idinstitucion= ".$ibuscar." AND anio like '%".$anio."%' AND fi_secundaria.idinstitucion=instituciones.ID AND fi_secundaria.vigente=1  UNION ALL SELECT id_ficha, Nombre, anio, 'Superior', archivo_adjunto  from fi_superior, instituciones  WHERE idinstitucion= ".$ibuscar." AND anio like '%".$anio."%' AND fi_superior.idinstitucion=instituciones.ID AND fi_superior.vigente=1");
			
		}
		else
		{
			$fichas=mysqli_query($link,"SELECT id_ficha, Nombre, anio, 'Inicial', archivo_adjunto  from fi_inicial, instituciones WHERE anio like '%".$anio."%' AND fi_inicial.idinstitucion=instituciones.ID AND fi_inicial.vigente=1 UNION ALL SELECT id_ficha, Nombre, anio, 'Primario', archivo_adjunto  from fi_primario, instituciones WHERE anio like '%".$anio."%' AND fi_primario.idinstitucion=instituciones.ID AND fi_primario.vigente=1  UNION ALL SELECT id_ficha, Nombre, anio, 'Secundario', archivo_adjunto  from fi_secundaria, instituciones WHERE anio like '%".$anio."%' AND fi_secundaria.idinstitucion=instituciones.ID AND fi_secundaria.vigente=1 UNION ALL SELECT id_ficha, Nombre, anio, 'Superior', archivo_adjunto  from fi_superior, instituciones WHERE anio like '%".$anio."%' AND fi_superior.idinstitucion=instituciones.ID AND fi_superior.vigente=1");
		   
		}
	}	
	
$filasDevueltas = mysqli_num_rows($fichas);
if ($filasDevueltas < 1)
{
	$mensaje="No se encontraron coincidencias";
}

}

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
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

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
function eliminar(id, nivel)
{
	if (confirm('¿Está seguro de eliminar la ficha institucional?'))
	{
		url="fichas1.php?id_fic="+ id +"&id_nivel="+ nivel+ "&action=E";
		window.open(url,'_self')
	}	 
}

function editar(id, nivel)
{
		if (nivel == 'Inicial') 
		{
		url="fichas2.php?id_fic="+ id +"&id_nivel="+ nivel;
		}
		if (nivel == 'Primario') 
		{
		url="fichas3.php?id_fic="+ id +"&id_nivel="+ nivel;
		}
		
		window.open(url,'_self')
	}	 


</script>


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
	<img src="images/map.png" width="30" height="36" border="0"> <b>Buscar Fichas Institucionales </b>
	</div>
    <div class="clear2"> </div>
    <div >
    
      <div class="clear2"> </div>

	 <?php if ($_REQUEST["cmdbuscar"]) { ?> 
	 <?php } else { 
	 ?>
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
		  <option value="">[todos]</option>
		  <option value="2015">2015</option>
		  <option value="2016">2016</option>
		  <option value="2017">2017</option>
		  <option value="2018">2018</option>
		  <option value="2019">2019</option>
		  <option value="2020">2020</option>
		  <option value="2021">2021</option>
		  <option value="2022" selected>2022</option>
		  </select>		  </td>
		  <td><div align="right">Nivel:</div></td>
		  <td><select name="cmbNivel" id="cmbNivel" style="width:120px">
		    <option value="">[todos]</option>
			<option value="Inicial">Inicial</option>
            <option value="Primario">Primario</option>
			<option value="Secundario">Secundario</option>
			<option value="Superior">Superior</option>
          </select></td>
		  	</tr>
		

		<tr><td colspan="4"><div align="center">

		  <input name="cmdbuscar" type="submit" class="btn" value="BUSCAR" />

		  </div></td></tr></table>
		  <?php } ?>
    	  <?php if ($_REQUEST["cmdbuscar"]) { ?>

		   <table width="100%" border="0" cellspacing="0" cellpadding="0">

		  <tr>

		    <td colspan="9" align="left">
			<strong> Fichas Totales: <?php echo $filasDevueltas?></strong> <i><?php if ($filasDevueltas >= 50) echo "Sólo se muestran los primeros 50 registro. Refine la búsqueda."; ?></i><BR />
		 </td></tr>


            <tr>

       	  
			  <td width="25%" align="center" bgcolor="#999999" ><div align="center"><strong>Año</strong></div></td>

              <td  width="20%" align="center" bgcolor="#999999" ><div align="center"><strong>Nivel</strong></div></td>
			  <?php if ($ibuscar == "") { ?>
			  <td  width="20%" align="center" bgcolor="#999999" ><div align="center"><strong>Institucion</strong></div></td>
			  <?php }?>
			  
			
              <td width="8%" align="center" bgcolor="#999999" >&nbsp;</td>

			  <td width="8%" align="center" bgcolor="#999999" >&nbsp;</td>

			  <?php if ($_SESSION["Institucion"]==14) { ?>
			  <td width="8%" align="center" bgcolor="#999999" >&nbsp;</td>
			  <?php } else {?>
			  <td></td>
			  <?php } ?>
			  

            </tr>

            <?php while($row =  mysqli_fetch_assoc($fichas)){
					$cant++;
					if($cant % 2 == 0){ $bg = 'bgcolor="#FFFFCC"'; } else { $bg = 'bgcolor="#FFFFFF"'; }
				
			?>

            <tr>

        
			  <td  align="center" <?php echo $bg ?>><?php echo $row["anio"]?></td>

              <td  align="center" <?php echo $bg ?> ><?php echo $row[3] ?></td>

   			  <?php if ($ibuscar == "") { ?>
              <td  align="center" <?php echo $bg ?> ><?php echo $row["Nombre"]?></td>
			  <?php } ?>
			  
			   <td  align="center" <?php echo $bg ?> > 
			   <?php if ($row["archivo_adjunto"]!= "") { ?>
			   <a href="archivos_fichas/<?php echo $row["archivo_adjunto"]?>" target="_blank"> 
			   <?php } else { ?>
			   <a href="#">
			   <?php } ?>
			   <img src="images/icon_excel.png" border="0" width="20" height="16"  title="adjunto"  /></a> 
			   </td>
			   	
              <td  align="center" <?php echo $bg ?> > <a href="javascript:editar('<?php echo $row["id_ficha"]?>','<?php echo $row[3] ?>');"><img src="images/icon_edit.gif" border="0" width="20" height="16" title="editar ficha" /></a> 
			  </td>
		      <?php if ($_SESSION["Institucion"]==14) { ?>	
              <td align="center" <?php echo $bg ?> > <a href="javascript:eliminar('<?php echo $row["id_ficha"]?>','<?php echo $row[3] ?>');"><img src="images/icon_delete.gif" border="0" width="25" height="20"  title="eliminar ficha" /></a></td>
              <?php } else {?>
			  <td></td>
			  <?php } ?>				  

            </tr>
            <?php } ?>
			<tr><td colspan="6" style="text-align:center" >  <input name="cmdOtra" type="submit"  onClick="window.open('fichas1.php', '_self')" class="btn" value="NUEVA BUSQUEDA" /></td><tr>
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
</html>
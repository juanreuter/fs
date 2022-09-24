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

$id = $_REQUEST["id_sal"]; 



// ELIMINAR

if($_REQUEST["action"] == "E" && $id!="")





{

	mysqli_query($link,"UPDATE salidas_educativas SET vigente='0', AudUsrModi='$usrmodi', AudFecModi='$fecmodi' WHERE idsalida=$id");

}



$mensaje="Complete los datos y haga clic en Buscar";

if ($_POST["cmdbuscar"]) 

{ // si hizo clic en buscar

	$mensaje="Resultado de la búsqueda";

	$fec_desde= $_POST["txtdesde"];

	$fec_hasta= $_POST["txthasta"];

	if ($fec_desde=='0000-00-00') $fec_desde='';

    if ($fec_hasta=='0000-00-00') $fec_hasta='';

	$ibuscar=$_POST["cmbInst"];

	$idtiposalida = $_POST["cmbSalida"];



	if ($fec_desde!='' && $fec_hasta!='')

	{

		if ($ibuscar!= "")  

		{

			$salidas=mysqli_query($link,"SELECT a.idsalida, a.actividad_fecha_desde, a.actividad_lugar, a.actividad_detalle, b.Nombre as NomInst, u.Nombre FROM salidas_educativas a, instituciones b, usuarios u WHERE a.vigente='1' AND a.idinstitucion= b.ID AND a.AudUsrAlta=u.Usuario AND a.idinstitucion= ".$ibuscar." AND a.idtiposalida='".$idtiposalida."' AND a.actividad_fecha_desde BETWEEN '".$fec_desde."' and '".$fec_hasta."'  ORDER BY a.actividad_fecha_desde DESC LIMIT 0,50");

		}

		else

		{

			$salidas=mysqli_query($link,"SELECT a.idsalida, a.actividad_fecha_desde, a.actividad_lugar, a.actividad_detalle, b.Nombre as NomInst, u.Nombre FROM salidas_educativas a, instituciones b, usuarios u WHERE a.vigente='1' AND a.idinstitucion= b.ID AND a.AudUsrAlta=u.Usuario AND a.idtiposalida='".$idtiposalida."' AND a.actividad_fecha_desde BETWEEN '".$fec_desde."' and '".$fec_hasta."'  ORDER BY a.actividad_fecha_desde DESC LIMIT 0,50");

		}

	}

	

	if ($fec_desde!='' && $fec_hasta=='')

	{

		if ($ibuscar!= "") 

		{

		$salidas=mysqli_query($link,"SELECT a.idsalida, a.actividad_fecha_desde, a.actividad_lugar, a.actividad_detalle, b.Nombre as NomInst, u.Nombre FROM salidas_educativas a, instituciones b, usuarios u WHERE a.vigente='1' AND a.idinstitucion= b.ID AND a.AudUsrAlta=u.Usuario AND a.idtiposalida='".$idtiposalida."' AND a.idinstitucion= ".$ibuscar."  AND a.actividad_fecha_desde >= '".$fec_desde."' ORDER BY a.actividad_fecha_desde DESC LIMIT 0,50");

		}

		else

		{

		$salidas=mysqli_query($link,"SELECT a.idsalida, a.actividad_fecha_desde, a.actividad_lugar, a.actividad_detalle, b.Nombre as NomInst, u.Nombre FROM salidas_educativas a, instituciones b, usuarios u WHERE a.vigente='1' AND a.idtiposalida='".$idtiposalida."' AND a.idinstitucion= b.ID AND a.AudUsrAlta=u.Usuario AND a.actividad_fecha_desde >= '".$fec_desde."' ORDER BY a.actividad_fecha_desde DESC LIMIT 0,50");

	

		}

	}

	

	if ($fec_desde =='' && $fec_hasta!='')

	{

		if ($ibuscar!= "") 

		{

		$salidas=mysqli_query($link,"SELECT a.idsalida, a.actividad_fecha_desde, a.actividad_lugar, a.actividad_detalle, b.Nombre as NomInst, u.Nombre FROM salidas_educativas a, instituciones b, usuarios u WHERE a.vigente='1' AND a.idinstitucion= b.ID AND a.AudUsrAlta=u.Usuario AND a.idinstitucion= ".$ibuscar." AND a.idtiposalida='".$idtiposalida."' AND a.actividad_fecha_desde <= '".$fec_hasta."' ORDER BY a.actividad_fecha_desde DESC LIMIT 0,50");

		}

		else

		{

		$salidas=mysqli_query($link,"SELECT a.idsalida, a.actividad_fecha_desde, a.actividad_lugar, a.actividad_detalle, b.Nombre as NomInst, u.Nombre FROM salidas_educativas a, instituciones b, usuarios u WHERE a.vigente='1' AND a.idinstitucion= b.ID AND a.AudUsrAlta=u.Usuario AND a.idtiposalida='".$idtiposalida."' AND  a.actividad_fecha_desde <= '".$fec_hasta."' ORDER BY a.actividad_fecha_desde DESC LIMIT 0,50");

		}

	}

	

	if ($fec_desde =='' && $fec_hasta=='')

	{

		if ($ibuscar!= "") 

		{

		$salidas=mysqli_query($link,"SELECT a.idsalida, a.actividad_fecha_desde, a.actividad_lugar, a.actividad_detalle, b.Nombre as NomInst, u.Nombre FROM salidas_educativas a, instituciones b, usuarios u WHERE a.vigente='1' AND a.idinstitucion= b.ID AND a.AudUsrAlta=u.Usuario AND a.idtiposalida='".$idtiposalida."' AND a.idinstitucion= ".$ibuscar."  ORDER BY a.actividad_fecha_desde DESC LIMIT 0,50");

		}

		else

		{

	

		$salidas=mysqli_query($link,"SELECT a.idsalida, a.actividad_fecha_desde, a.actividad_lugar, a.actividad_detalle, b.Nombre as NomInst, u.Nombre FROM salidas_educativas a, instituciones b, usuarios u WHERE a.vigente='1' AND a.idtiposalida='".$idtiposalida."' AND a.idinstitucion= b.ID AND a.AudUsrAlta=u.Usuario ORDER BY a.AudFecAlta DESC LIMIT 0,50");

		}

	}

$filasDevueltas = mysqli_num_rows($salidas);

if ($filasDevueltas < 1)

{

	$mensaje="No se encontraron coincidencias";

}



}



//solo listo las instituciones con alguna salida vigente

if ($_SESSION["Institucion"]==14)

{

$inst=mysqli_query($link,"SELECT * FROM instituciones  where vigente='1' and id in (select `idinstitucion` from salidas_educativas where vigente=1) ORDER BY nombre");

}

else

{

//solo listo las instituciones con alguna salida vigente

$inst=mysqli_query($link,"SELECT * FROM instituciones  where vigente='1' and ID=".$_SESSION["Institucion"]." and id in (select `idinstitucion` from salidas_educativas where vigente=1) ORDER BY nombre");

}



// tipos de salidas

$de_tiposalida=mysqli_query($link,"SELECT * FROM salidas_tipos ORDER BY idsalidatipo");



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



function imprimir_salida(id){



	ventana="orden_salida_print.php?id="+ id;



	window.open(ventana,'','width=720,height=720,top=20,left=200,scrollbars=yes,titlebar=no,location=no');



}



function eliminar(id)

{

	if (confirm('¿Está seguro de eliminar el formulario de salida?'))

	{

		url="salidas.buscar.php?id_sal="+ id + "&action=E";

		window.open(url,'_self')

	}	 

}



</script>



<script language="javascript" src="calendar/calendar.js"></script>



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

	<img src="images/map.png" width="30" height="36" border="0"> <b>Buscar Salidas</b>

	</div>

    <div class="clear2"> </div>

    <div >

    

      <div class="clear2"> </div>



	 <?php if ($_REQUEST["cmdbuscar"]) { ?> 

	 <?php } else { 

	 ?>

	 <table width="100%" >



		  <tr>

		    <td>Tipo de Salida:</td>

		    <td colspan="3">

			<label for="Institucion">Tipo de Salida</label>

				<select name="cmbSalida" id="cmbSalida">

	      <?php while($row1=mysqli_fetch_assoc($de_tiposalida)) { ?>

	      <option value="<?php echo $row1["idsalidatipo"]?>" <?php if($row1["idsalidatipo"]==$idtiposalida) echo "selected"?>><?php echo $row1["descripcion"]?></option>

	      <?php } ?>

	      </select></td>

		    </tr>

		  <td><div align="left">Institución: </div></td>



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



		  <td colspan="4">&nbsp;</td>

		  </tr>



		<tr><td colspan="4"><div align="center">



		  <input name="cmdbuscar" type="submit" class="btn" value="BUSCAR" />



		  </div></td></tr></table>

		  <?php } ?>

    	  <?php if ($_REQUEST["cmdbuscar"]) { ?>



		  <table width="100%" border="0" cellspacing="0" cellpadding="0">

          <?php 

		  	$id_tiposalida = mysqli_fetch_assoc(mysqli_query($link,"SELECT descripcion FROM salidas_tipos WHERE idsalidatipo='" . $idtiposalida."'"));

		    $descripcion = $id_tiposalida["descripcion"];

		  ?>

		  <tr><td colspan="9">Tipo de Salida: "<?php echo $descripcion ?>"</td></tr>

		  <tr>



		    <td colspan="9" align="left">

			<strong> Salidas Totales: <?php echo $filasDevueltas?></strong> <i><?php if ($filasDevueltas >= 50) echo "Sólo se muestran los primeros 50 registro. Refine la búsqueda."; ?></i><BR />

		 </td></tr>





            <tr>



              <td align="center" bgcolor="#999999" ><div align="center"><strong>N°</strong></div></td>

			  

			  <td width="25%" align="center" bgcolor="#999999" ><div align="center"><strong>Fecha</strong></div></td>



              <td  width="20%" align="center" bgcolor="#999999" ><div align="center"><strong>Lugar</strong></div></td>

			  <?php if ($ibuscar == "") { ?>

			  <td  width="20%" align="center" bgcolor="#999999" ><div align="center"><strong>Institucion</strong></div></td>

			  <?php }?>

			  

			

              <td width="8%" align="center" bgcolor="#999999" >&nbsp;</td>



              <td width="8%" align="center" bgcolor="#999999" >&nbsp;</td>

			  

			  <td width="8%" align="center" bgcolor="#999999" >&nbsp;</td>

			  



            </tr>



            <?php while($row =  mysqli_fetch_assoc($salidas)){

					$cant++;

					if($cant % 2 == 0){ $bg = 'bgcolor="#FFFFCC"'; } else { $bg = 'bgcolor="#FFFFFF"'; }

			?>



            <tr>



              <td align="center" <?php echo $bg ?> ><?php echo $row["idsalida"]?></td>



			  <td  align="center" <?php echo $bg ?>><?php echo $row["actividad_fecha_desde"]?></td>



              <td  align="center" <?php echo $bg ?> ><?php echo $row["actividad_lugar"]?></td>



   			  <?php if ($ibuscar == "") { ?>

              <td  align="center" <?php echo $bg ?> ><?php echo $row["NomInst"]?></td>

			  <?php } ?>

			   	

              <td  align="center" <?php echo $bg ?> > <a href="#"><img src="images/icon_edit.gif" border="0" width="20" height="16"  onClick="window.open('salidas_educat.php?id_sal=<?php echo $row["idsalida"]?>','_self');" title="editar"  /></a> </td>



              <td align="center" <?php echo $bg ?> > <a href="javascript:eliminar('<?php echo $row["idsalida"]?>');"><img src="images/icon_delete.gif" border="0" width="25" height="20"  title="eliminar salida" /></a></td>

              

			  <td align="center" <?php echo $bg ?> > <a href="javascript:imprimir_salida('<?php echo $row["idsalida"]?>');"><img src="images/icon-printer2.jpg" border="0" width="25" height="20"  title="imprimir salida" /></a></td>

			  

			  



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

</html>
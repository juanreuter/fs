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
include ("funciones/funciones.php");
// regla de negocios
$str_anio = $_POST["cmbAnio"];
$str_inst = $_POST["cmbInst"];



//listo las instituciones 
if ($_SESSION["Institucion"]==14)
{
$inst=mysql_query("SELECT * FROM instituciones  where vigente='1' ORDER BY nombre", $link);
}
else
{
//listo las instituciones del usuario
$inst=mysql_query("SELECT * FROM instituciones  where vigente='1' and ID=".$_SESSION["Institucion"]." ORDER BY nombre", $link);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
  <script language="javascript">
function reclamar_cuota(id,tipo)
{
ventana="reclamo_cuota.php?id_rec="+ id +"&id_tipo="+ tipo + "";

window.open(ventana,'','width=720,height=720,top=20,left=200,scrollbars=yes,titlebar=no,location=no');
}
</script>

<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
.Estilo2 {
	color: #FF0000;

	font-weight: bold;
}
.Estilo4 {color: #006600}
.Estilo6 {
text-align:center;
color:#0000CC;
text-decoration:underline;

}
-->
</style>
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
	<img src="images/map.png" width="30" height="36" border="0"> <b>Estado de Cuenta  </b>
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

		  <td ><div align="left">

		     <select name="cmbInst" id="combobox">
			  <?php while($row=mysql_fetch_array($inst)) { ?>

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
		  <option value="2015">2015</option>
		  <option value="2016" selected="selected">2016</option>
		  <option value="2017">2017</option>
		  </select>		  </td>
		  	</tr>
		

		<tr><td colspan="2"><div align="center">

		  <input name="cmdbuscar" type="submit" class="btn" value="BUSCAR" />

		  </div></td></tr></table>
		  <?php } ?>
    	  <?php if ($_REQUEST["cmdbuscar"]) { ?>

		   <table width="100%" border="0" cellspacing="0" cellpadding="0">

		 

          <?php

	            	$html="";

	            	if($res=consulta_sql("select * from cobranzas_cuota, recibos where tipo_cuenta='ccu' and cobranzas_cuota.ccu_id=recibos.id_cuenta and id_inst =".$str_inst." and ccu_anio=".$str_anio."")){

	            		$html.="\n<tr bgcolor=\"#FF0000\">";

	            		$html.="\n<td height=\"26\" colspan=\"6\"><div align=\"left\" class=\"Estilo6\"> <b>Cuota pactada Fondo Solidario</b></div></td>";

	            		$html.="\n</tr>";

	            		$html.="\n<tr>";

		              $html.="\n<td width=\"15%\" height=\"26\"><div align=\"center\"><strong>N&ordm; Recibo </strong></div></td>";

			          $html.="\n<td width=\"16%\" height=\"26\"><div align=\"center\"><strong>Pago</strong></div></td>";

		              $html.="\n<td width=\"25%\" height=\"26\"><div align=\"center\"><strong>Fecha Pago </strong></div></td>";

		              $html.="\n<td width=\"26%\" height=\"26\"><div align=\"center\"><strong>Forma Pago </strong></div></td>";

		              $html.="\n<td width=\"14%\" height=\"26\"><div align=\"center\"><strong>Recibo</strong></div></td>";

		              $html.="\n<td width=\"14%\" height=\"26\"><div align=\"center\"><strong>Reclamar</strong></div></td>";

		            	$html.="\n</tr>";

		            	foreach($res as $x){

		            		if($x['ccu_forma_pago']=="E") $forma_pago="Efectivo";

		            		if($x['ccu_forma_pago']=="C") $forma_pago="Cheque";

		            		if($x['ccu_forma_pago']=="T") $forma_pago="Transferencia";

							if($x['ccu_forma_pago']=="R") $forma_pago="Reintegro";

							if($x['ccu_forma_pago']=="O") $forma_pago="Otros";

		            		$html.="\n<tr>";

			              $html.="\n<td height=\"26\"><div align=\"center\">".add_ceros($x['numero_recibo'],5)."</div></td>";

			              $html.="\n<td height=\"26\"><div align=\"center\">$ ".$x['ccu_pago']."</div></td>";

			              $html.="\n<td height=\"26\"><div align=\"center\">".$x['ccu_fecha']."</div></td>";

						  $html.="\n<td height=\"26\"><div align=\"center\">".$forma_pago."</div></td>";

					      $html.="\n<td height=\"26\"><div align=\"center\"><a href=\"recibo_cobranzas_copia.php?inst=".$x['id_inst']."&id=".$x['ccu_id']."&tipo=ccu\" target=\"_blank\"/><img src=\"images/icon-printer2.jpg\" width=\"25\" height=\"20\"  border=\"0\" /></a></div></td>";

			              $html.="\n<td height=\"26\"><div align=\"center\"><a href=\"javascript:reclamar_cuota('".add_ceros($x['numero_recibo'],5)."', 'ccu');\"><img border=\"0\" src=\"images/reclamar.png\" width=\"20\" height=\"20\" /></a></div></td>";

			              $html.="\n</tr>";

		            	}

	            	}

	            	

	            	if($res=consulta_sql("select * from cobranzas_devolucion, prestamos, recibos where tipo_cuenta='cde' and cobranzas_devolucion.cde_id=recibos.id_cuenta and id_inst =".$str_inst." and cde_anio=".$str_anio." and cde_prestamo=pre_id")){

	            		$html.="\n<tr bgcolor=\"#66CCFF\">";

			            $html.="\n<td height=\"26\" colspan=\"6\"><div align=\"left\" class=\"Estilo6\"><b>Devoluci&oacute;n pr&eacute;stamo</b> </div></td>";

			            $html.="\n</tr>";

			            $html.="\n<tr>";

	              	$html.="\n<td height=\"26\"><div align=\"center\"><strong>N&ordm; Recibo </strong></div></td>";

	              	$html.="\n<td height=\"26\"><div align=\"center\"><strong>Nº - Cuota</strong></div></td>";

	              	$html.="\n<td height=\"26\"><div align=\"center\"><strong>Pago</strong></div></td>";

	              	$html.="\n<td height=\"26\"><div align=\"center\"><strong>Fecha Pago </strong></div></td>";

	              	$html.="\n<td height=\"26\"><div align=\"center\"><strong>Forma Pago </strong></div></td>";

	              	$html.="\n<td height=\"26\"><div align=\"center\"><strong>Recibo</strong></div></td>";

	              	$html.="\n<td height=\"26\"><div align=\"center\"><strong>Reclamar</strong></div></td>";

	              	$html.="\n</tr>";

	              	foreach($res as $x){

		            		if($x['cde_forma_pago']=="E") $forma_pago="Efectivo";

		            		if($x['cde_forma_pago']=="C") $forma_pago="Cheque";

		            		if($x['cde_forma_pago']=="T") $forma_pago="Transferencia";

							if($x['ccu_forma_pago']=="R") $forma_pago="Reintegro";

							if($x['ccu_forma_pago']=="O") $forma_pago="Otros";

		            		$html.="\n<tr>";

			              $html.="\n<td height=\"26\"><div align=\"center\">".add_ceros($x['numero_recibo'],5)."</div></td>";

						  $html.="\n<td height=\"26\"><div align=\"center\">".$x['pre_numero']." - " .$x['cde_cuota']."</div></td>";

			              $html.="\n<td height=\"26\"><div align=\"center\">$ ".$x['cde_pago']."</div></td>";

			              $html.="\n<td height=\"26\"><div align=\"center\">".$x['cde_fecha']."</div></td>";

						  $html.="\n<td height=\"26\"><div align=\"center\">".$forma_pago."</div></td>";

			              $html.="\n<td height=\"26\"><div align=\"center\"><a href=\" recibo_cobranzas_copia.php?inst=".$x['id_inst']."&id=".$x['cde_id']."&tipo=cde\" target=\"_blank\"/><img src=\"images/icon-printer2.jpg\" width=\"25\" height=\"20\"  border=\"0\" /></a></div></td>";

			              $html.="\n<td height=\"26\"><div align=\"center\"><a href=\"javascript:reclamar_cuota('".add_ceros($x['numero_recibo'],5)."', 'cde');\"><img border=\"0\" src=\"images/reclamar.png\" width=\"20\" height=\"20\" /></a></div></td>";

			              $html.="\n</tr>";

			            }

	            	}


	            	if($res=consulta_sql("select * from cobranzas_a_cuenta, recibos where tipo_cuenta='cac' and cobranzas_a_cuenta.cac_id=recibos.id_cuenta and id_inst =".$str_inst." and cac_anio=".$str_anio."")){

	            		$html.="\n<tr bgcolor=\"#FFCC99\">";

		              $html.="\n<td height=\"26\" colspan=\"6\"><div align=\"left\" class=\"Estilo6\"><b>A cuenta</b> </div></td>";

		              $html.="\n</tr>";

			            $html.="\n<tr>";

	              	$html.="\n<td height=\"26\"><div align=\"center\"><strong>N&ordm; Recibo </strong></div></td>";

	              	$html.="\n<td height=\"26\"><div align=\"center\"><strong>Pago</strong></div></td>";

	              	$html.="\n<td height=\"26\"><div align=\"center\"><strong>Fecha Pago </strong></div></td>";

	              	$html.="\n<td height=\"26\"><div align=\"center\"><strong>Forma Pago </strong></div></td>";

	              	$html.="\n<td height=\"26\"><div align=\"center\"><strong>Recibo</strong></div></td>";

	              	$html.="\n<td height=\"26\"><div align=\"center\"><strong>Reclamar</strong></div></td>";

	              	$html.="\n</tr>";

	              	foreach($res as $x){

		            		if($x['cac_forma_pago']=="E") $forma_pago="Efectivo";

		            		if($x['cac_forma_pago']=="C") $forma_pago="Cheque";

		            		if($x['cac_forma_pago']=="T") $forma_pago="Transferencia";

							if($x['ccu_forma_pago']=="R") $forma_pago="Reintegro";

							if($x['ccu_forma_pago']=="O") $forma_pago="Otros";

		            	  $html.="\n<tr>";

			              $html.="\n<td height=\"26\"><div align=\"center\">".add_ceros($x['numero_recibo'],5)."</div></td>";

			              $html.="\n<td height=\"26\"><div align=\"center\">$ ".$x['cac_pago']."</div></td>";

			              $html.="\n<td height=\"26\"><div align=\"center\">".$x['cac_fecha']."</div></td>";

			              $html.="\n<td height=\"26\"><div align=\"center\">".$forma_pago."</div></td>";

			              $html.="\n<td height=\"26\"><div align=\"center\"><a href=\" recibo_cobranzas_copia.php?inst=".$x['id_inst']."&id=".$x['cac_id']."&tipo=cac\" target=\"_blank\"/><img src=\"images/icon-printer2.jpg\" width=\"25\" height=\"20\"  border=\"0\" /></a></div></td>";

			              $html.="\n<td height=\"26\"><div align=\"center\"><a href=\"javascript:reclamar_cuota('".add_ceros($x['numero_recibo'],5)."', 'cac');\"><img border=\"0\" src=\"images/reclamar.png\" width=\"20\" height=\"20\" /></a></div></td>";

			            	$html.="\n</tr>";

			            }

	            	}

	            	

	            	if($res=consulta_sql("select * from cobranzas_aporte, recibos where tipo_cuenta='cap' and cobranzas_aporte.cap_id=recibos.id_cuenta and id_inst =".$str_inst." and cap_anio=".$str_anio."")){

	            		$html.="\n<tr bgcolor=\"#FFFFCC\">";

	              	$html.="\n<td height=\"26\" colspan=\"6\"><div align=\"left\" class=\"Estilo6\"><b>Aporte  Junta</b> </div></td>";

	              	$html.="\n</tr>";

	            		$html.="\n<tr>";

	              	$html.="\n<td height=\"26\"><div align=\"center\"><strong>N&ordm; Recibo </strong></div></td>";

	              	$html.="\n<td height=\"26\"><div align=\"center\"><strong>Pago</strong></div></td>";

	              	$html.="\n<td height=\"26\"><div align=\"center\"><strong>Fecha Pago </strong></div></td>";

	              	$html.="\n<td height=\"26\"><div align=\"center\"><strong>Forma Pago </strong></div></td>";

	              	$html.="\n<td height=\"26\"><div align=\"center\"><strong>Recibo</strong></div></td>";

	              	$html.="\n<td height=\"26\"><div align=\"center\"><strong>Reclamar</strong></div></td>";

	              	$html.="\n</tr>";

	              	foreach($res as $x){

		            		if($x['cap_forma_pago']=="E") $forma_pago="Efectivo";

		            		if($x['cap_forma_pago']=="C") $forma_pago="Cheque";

		            		if($x['cap_forma_pago']=="T") $forma_pago="Transferencia";

							if($x['cap_forma_pago']=="R") $forma_pago="Reintegro";

							if($x['cap_forma_pago']=="O") $forma_pago="Otros";

		            		$html.="\n<tr>";

			              $html.="\n<td height=\"26\"><div align=\"center\">".add_ceros($x['numero_recibo'],5)."</div></td>";

			              $html.="\n<td height=\"26\"><div align=\"center\">$ ".$x['cap_pago']."</div></td>";

			              $html.="\n<td height=\"26\"><div align=\"center\">".$x['cap_fecha']."</div></td>";

			              $html.="\n<td height=\"26\"><div align=\"center\">".$forma_pago."</div></td>";

			              $html.="\n<td height=\"26\"><div align=\"center\"><a href=\" recibo_cobranzas_copia.php?inst=".$x['id_inst']."&id=".$x['cap_id']."&tipo=cap\" target=\"_blank\"/><img src=\"images/icon-printer2.jpg\" width=\"25\" height=\"20\"  border=\"0\" /></a></div></td>";

			              $html.="\n<td height=\"26\"><div align=\"center\"><a href=\"javascript:reclamar_cuota('".add_ceros($x['numero_recibo'],5)."','cap');\"><img border=\"0\" src=\"images/reclamar.png\" width=\"20\" height=\"20\" /></a></div></td>";

			            	$html.="\n</tr>";

			            }

	            	}

	
if($res=consulta_sql("select * from cobranzas_salud, recibos where tipo_cuenta='cso' and cobranzas_salud.cso_id=recibos.id_cuenta and id_inst =".$str_inst." and cso_anio=".$str_anio."")){

	            		$html.="\n<tr bgcolor=\"#FFFFCC\">";

	              	$html.="\n<td height=\"26\" colspan=\"6\"><div align=\"left\" class=\"Estilo6\"><b>Aporte  Salud Ocupacional</b> </div></td>";

	              	$html.="\n</tr>";

	            		$html.="\n<tr>";

	              	$html.="\n<td height=\"26\"><div align=\"center\"><strong>N&ordm; Recibo </strong></div></td>";

	              	$html.="\n<td height=\"26\"><div align=\"center\"><strong>Pago</strong></div></td>";

	              	$html.="\n<td height=\"26\"><div align=\"center\"><strong>Fecha Pago </strong></div></td>";

	              	$html.="\n<td height=\"26\"><div align=\"center\"><strong>Forma Pago </strong></div></td>";

	              	$html.="\n<td height=\"26\"><div align=\"center\"><strong>Recibo</strong></div></td>";

	              	$html.="\n<td height=\"26\"><div align=\"center\"><strong>Reclamar</strong></div></td>";

	              	$html.="\n</tr>";

	              	foreach($res as $x){

		            		if($x['cso_forma_pago']=="E") $forma_pago="Efectivo";

		            		if($x['cso_forma_pago']=="C") $forma_pago="Cheque";

		            		if($x['cso_forma_pago']=="T") $forma_pago="Transferencia";

							if($x['cso_forma_pago']=="R") $forma_pago="Reintegro";

							if($x['cso_forma_pago']=="O") $forma_pago="Otros";

		            		$html.="\n<tr>";

			              $html.="\n<td height=\"26\"><div align=\"center\">".add_ceros($x['numero_recibo'],5)."</div></td>";

			              $html.="\n<td height=\"26\"><div align=\"center\">$ ".$x['cso_pago']."</div></td>";

			              $html.="\n<td height=\"26\"><div align=\"center\">".$x['cso_fecha']."</div></td>";

			              $html.="\n<td height=\"26\"><div align=\"center\">".$forma_pago."</div></td>";

			              $html.="\n<td height=\"26\"><div align=\"center\"><a href=\" recibo_cobranzas_copia.php?inst=".$x['id_inst']."&id=".$x['cso_id']."&tipo=cso\" target=\"_blank\"/><img src=\"images/icon-printer2.jpg\" width=\"25\" height=\"20\"  border=\"0\" /></a></div></td>";

			              $html.="\n<td height=\"26\"><div align=\"center\"><a href=\"javascript:reclamar_cuota('".add_ceros($x['numero_recibo'],5)."','cso');\"><img border=\"0\" src=\"images/reclamar.png\" width=\"20\" height=\"20\" /></a></div></td>";

			            	$html.="\n</tr>";

			            }

	            	}
					
	
if($res=consulta_sql("select * from cobranzas_ayuda, recibos where tipo_cuenta='cae' and cobranzas_ayuda.cae_id=recibos.id_cuenta and id_inst =".$str_inst." and cae_anio=".$str_anio."")){

	            		$html.="\n<tr bgcolor=\"#FFFFCC\">";

	              	$html.="\n<td height=\"26\" colspan=\"6\"><div align=\"left\" class=\"Estilo6\"><b>Aporte Ayuda Escolar</b> </div></td>";

	              	$html.="\n</tr>";

	            		$html.="\n<tr>";

	              	$html.="\n<td height=\"26\"><div align=\"center\"><strong>N&ordm; Recibo </strong></div></td>";

	              	$html.="\n<td height=\"26\"><div align=\"center\"><strong>Pago</strong></div></td>";

	              	$html.="\n<td height=\"26\"><div align=\"center\"><strong>Fecha Pago </strong></div></td>";

	              	$html.="\n<td height=\"26\"><div align=\"center\"><strong>Forma Pago </strong></div></td>";

	              	$html.="\n<td height=\"26\"><div align=\"center\"><strong>Recibo</strong></div></td>";

	              	$html.="\n<td height=\"26\"><div align=\"center\"><strong>Reclamar</strong></div></td>";

	              	$html.="\n</tr>";

	              	foreach($res as $x){

		            		if($x['cae_forma_pago']=="E") $forma_pago="Efectivo";

		            		if($x['cae_forma_pago']=="C") $forma_pago="Cheque";

		            		if($x['cae_forma_pago']=="T") $forma_pago="Transferencia";

							if($x['cae_forma_pago']=="R") $forma_pago="Reintegro";

							if($x['cae_forma_pago']=="O") $forma_pago="Otros";

		            		$html.="\n<tr>";

			              $html.="\n<td height=\"26\"><div align=\"center\">".add_ceros($x['numero_recibo'],5)."</div></td>";

			              $html.="\n<td height=\"26\"><div align=\"center\">$ ".$x['cae_pago']."</div></td>";

			              $html.="\n<td height=\"26\"><div align=\"center\">".$x['cae_fecha']."</div></td>";

			              $html.="\n<td height=\"26\"><div align=\"center\">".$forma_pago."</div></td>";

			              $html.="\n<td height=\"26\"><div align=\"center\"><a href=\" recibo_cobranzas_copia.php?inst=".$x['id_inst']."&id=".$x['cae_id']."&tipo=cae\" target=\"_blank\"/><img src=\"images/icon-printer2.jpg\" width=\"25\" height=\"20\"  border=\"0\" /></a></div></td>";

			              $html.="\n<td height=\"26\"><div align=\"center\"><a href=\"javascript:reclamar_cuota('".add_ceros($x['numero_recibo'],5)."','cae');\"><img border=\"0\" src=\"images/reclamar.png\" width=\"20\" height=\"20\" /></a></div></td>";

			            	$html.="\n</tr>";

			            }

	            	}
	
	
	            	echo $html;
				
	            ?>
<tr><td colspan="6" style="text-align:center" >  <input name="cmdOtra" type="submit"  onClick="window.open('estado_cuenta_inst.php', '_self')" class="btn" value="NUEVA BUSQUEDA" /></td><tr>

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
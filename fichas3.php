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
$nivel = $_REQUEST["id_nivel"]; 


//GUARDAR LA INFO
if($_POST["action"] == "G" && $id!="")
{
if ($nivel == 'Primario')
{
mysqli_query($link,"UPDATE fi_primario SET
			 CUIT = '".$_POST["txtcuit"]."',
			 CUE = '".$_POST["txtcue"]."',
			 CE = '".$_POST["txtce"]."',
             confesional='".$_POST["txtconfesional"]."',
             domicilio= '".$_POST["txtdomicilio"]."',
             barrio ='".$_POST["txtbarrio"]."',
             idlocalidad ='".$_POST["txtlocalidad"]."',
             iddepartamento='".$_POST["txtdepartamento"]."',
             precinto='".$_POST["txtprecinto"]."',
             cp = '".$_POST["txtcp"]."',
             correo = '".$_POST["txtcorreo"]."',
			 telefono = '".$_POST["txttelefono"]."',
 			 fecha_apertura= '".$_POST["txtfechaapertura"]."',
             resolucion_adscripcion = '".$_POST["txtadscripcion"]."',
             categoria = '".$_POST["txtcategoria"]."',
             destino = '".$_POST["txtdestino"]."',
 			 jornada = '".$_POST["txtjornada"]."',
             turno = '".$_POST["txtturno"]."',
             horario = '".$_POST["txthorario"]."',
             aporte_estatal = '".$_POST["txtaporte"]."',
 			 zona_desfavorable = '".$_POST["txtzonadesfavorable"]."',
			 monto_matricula = '".$_POST["txtmatricula"]."',
			 monto_marzo = '".$_POST["txtmonto"]."',
			 cuotas = '".$_POST["txtcuotas"]."',
			 supervisor = '".$_POST["txtsupervisor"]."',
			 zona = '".$_POST["txtzona"]."',
			 grado1_f = '".$_POST["txtgrado1_f"]."',
			 grado1_m = '".$_POST["txtgrado1_m"]."',
			 grado1_r = '".$_POST["txtgrado1_r"]."',
			 grado1_s = '".$_POST["txtgrado1_s"]."',
			 grado1_d = '".$_POST["txtgrado1_d"]."',
			 grado2_f = '".$_POST["txtgrado2_f"]."',
			 grado2_m = '".$_POST["txtgrado2_m"]."',
			 grado2_r = '".$_POST["txtgrado2_r"]."',
			 grado2_s = '".$_POST["txtgrado2_s"]."',
			 grado2_d = '".$_POST["txtgrado2_d"]."',
			 grado3_f = '".$_POST["txtgrado3_f"]."',
			 grado3_m = '".$_POST["txtgrado3_m"]."',
			 grado3_r = '".$_POST["txtgrado3_r"]."',
			 grado3_s = '".$_POST["txtgrado3_s"]."',
			 grado3_d = '".$_POST["txtgrado3_d"]."',
			 grado4_f = '".$_POST["txtgrado4_f"]."',
			 grado4_m = '".$_POST["txtgrado4_m"]."',
			 grado4_r = '".$_POST["txtgrado4_r"]."',
			 grado4_s = '".$_POST["txtgrado4_s"]."',
			 grado4_d = '".$_POST["txtgrado4_d"]."',
			 grado5_f = '".$_POST["txtgrado5_f"]."',
			 grado5_m = '".$_POST["txtgrado5_m"]."',
			 grado5_r = '".$_POST["txtgrado5_r"]."',
			 grado5_s = '".$_POST["txtgrado5_s"]."',
			 grado5_d = '".$_POST["txtgrado5_d"]."',
			 grado6_f = '".$_POST["txtgrado6_f"]."',
			 grado6_m = '".$_POST["txtgrado6_m"]."',
			 grado6_r = '".$_POST["txtgrado6_r"]."',
			 grado6_s = '".$_POST["txtgrado6_s"]."',
			 grado6_d = '".$_POST["txtgrado6_d"]."',
			 grado1_integrados = '".$_POST["txtgrado1_integrados"]."',
			 grado2_integrados = '".$_POST["txtgrado2_integrados"]."',
			 grado3_integrados = '".$_POST["txtgrado3_integrados"]."',
			 grado4_integrados = '".$_POST["txtgrado4_integrados"]."',
			 grado5_integrados = '".$_POST["txtgrado5_integrados"]."',
			 grado6_integrados = '".$_POST["txtgrado6_integrados"]."',
			 ciclo1_matematicas= '".$_POST["txtciclo1_matematicas"]."',
			 ciclo1_lenguaoralescrita= '".$_POST["txtciclo1_lenguaoralescrita"]."',
			 ciclo1_sociales= '".$_POST["txtciclo1_sociales"]."',
			 ciclo1_naturales= '".$_POST["txtciclo1_naturales"]."',
			 ciclo1_tecno= '".$_POST["txtciclo1_tecno"]."',
			 ciclo1_identidad= '".$_POST["txtciclo1_identidad"]."',
			 ciclo1_edfisica= '".$_POST["txtciclo1_edfisica"]."',
			 ciclo1_edmusical= '".$_POST["txtciclo1_edmusical"]."',
			 ciclo1_edplastica= '".$_POST["txtciclo1_edplastica"]."',
			 ciclo1_lenguaextranjera= '".$_POST["txtciclo1_lenguaextranjera"]."',
			 ciclo1_informatica= '".$_POST["txtciclo1_informatica"]."',
			 ciclo1_teatro= '".$_POST["txtciclo1_teatro"]."',
			 ciclo1_catequesis= '".$_POST["txtciclo1_catequesis"]."',
			 ciclo1_deportes= '".$_POST["txtciclo1_deportes"]."',
			 ciclo1_bicultural= '".$_POST["txtciclo1_bicultural"]."',
			 ciclo2_matematicas= '".$_POST["txtciclo2_matematicas"]."',
			 ciclo2_lenguaoralescrita= '".$_POST["txtciclo2_lenguaoralescrita"]."',
			 ciclo2_sociales= '".$_POST["txtciclo2_sociales"]."',
			 ciclo2_naturales= '".$_POST["txtciclo2_naturales"]."',
			 ciclo2_tecno= '".$_POST["txtciclo2_tecno"]."',
			 ciclo2_identidad= '".$_POST["txtciclo2_identidad"]."',
			 ciclo2_edfisica= '".$_POST["txtciclo2_edfisica"]."',
			 ciclo2_edmusical= '".$_POST["txtciclo2_edmusical"]."',
			 ciclo2_edplastica= '".$_POST["txtciclo2_edplastica"]."',
			 ciclo2_lenguaextranjera= '".$_POST["txtciclo2_lenguaextranjera"]."',
			 ciclo2_informatica= '".$_POST["txtciclo2_informatica"]."',
			 ciclo2_teatro= '".$_POST["txtciclo2_teatro"]."',
			 ciclo2_catequesis= '".$_POST["txtciclo2_catequesis"]."',
			 ciclo2_deportes= '".$_POST["txtciclo2_deportes"]."',
			 ciclo2_bicultural= '".$_POST["txtciclo2_bicultural"]."',
			 id_representante1= '".$_POST["txtnombre_rl1"]."',
			 telefono_representante1= '".$_POST["txtcelular_rl1"]."',
			 correo_representante1= '".$_POST["txtcorreo_rl1"]."',
			 id_representante2= '".$_POST["txtnombre_rl2"]."',
			 telefono_representante2= '".$_POST["txtcelular_rl2"]."',
			 correo_representante2= '".$_POST["txtcorreo_rl2"]."',
			 id_director= '".$_POST["txtnombre_director"]."',
			 telefono_director= '".$_POST["txtcelular_director"]."',
			 correo_director= '".$_POST["txtcorreo_director"]."',
			 id_vice1= '".$_POST["txtnombre_vice1"]."',
			 telefono_vice1= '".$_POST["txtcelular_vice1"]."',
			 correo_vice1= '".$_POST["txtcorreo_vice1"]."',
			 id_vice2= '".$_POST["txtnombre_vice2"]."',
			 telefono_vice2= '".$_POST["txtcelular_vice2"]."',
			 correo_vice2= '".$_POST["txtcorreo_vice2"]."',
			 id_secretaria1= '".$_POST["txtnombre_secretaria1"]."',
			 telefono_secretaria1= '".$_POST["txtcelular_secretaria1"]."',
			 correo_secretaria1= '".$_POST["txtcorreo_secretaria1"]."',
			 id_secretaria2= '".$_POST["txtnombre_secretaria2"]."',
			 telefono_secretaria2= '".$_POST["txtcelular_secretaria2"]."',
			 correo_secretaria2= '".$_POST["txtcorreo_secretaria2"]."',
			 pf_personas_conaporte = '".$_POST["txtpf_personas_conaporte"]."',
			 pf_personas_sinaporte = '".$_POST["txtpf_personas_sinaporte"]."',
			 pf_horas_conaporte = '".$_POST["txtpf_horas_conaporte"]."',
			 pf_horas_sinaporte = '".$_POST["txtpf_horas_sinaporte"]."',
			 pc_personas_sinaporte = '".$_POST["txtpc_personas_sinaporte"]."',
			 pc_horas_sinaporte = '".$_POST["txtpc_horas_sinaporte"]."',
			 pi_personas_conaporte = '".$_POST["txtpi_personas_conaporte"]."',
			 pi_personas_sinaporte = '".$_POST["txtpi_personas_sinaporte"]."',
			 pi_horas_conaporte = '".$_POST["txtpi_horas_conaporte"]."',
			 pi_horas_sinaporte = '".$_POST["txtpi_horas_sinaporte"]."',
			 paicor_almuerzo = '".$_POST["txtpaicor_almuerzo"]."',
			 paicor_leche = '".$_POST["txtpaicor_almuerzo"]."',
			 paicor_plan = '".$_POST["txtpaicor_plan"]."',
			 seguro_cia = '".$_POST["txtseguro_cia"]."',
			 seguro_poliza = '".$_POST["txtseguro_poliza"]."',
			 seguro_vigencia = '".$_POST["txtseguro_vigencia"]."',
			 AudUsrModi='$usrmodi',
			 AudFecModi='$fecmodi'
			 WHERE id_ficha = $id");
?>
<script>
window.alert("DATOS REGISTRADOS");
url="fichas3.php?id_fic="+ <?php echo $id ?> +"&id_nivel="+ <?php echo $nivel ?>;
window.open(url,'_self')
</script>
<?php

}
}

if ($nivel == 'Primario') 
{
	$sql_ficha = mysqli_query($link,"SELECT fi_primario.*, instituciones.*, localidades.Nombre as NombreLocalidad, departamentos.Nombre as NombreDepto from fi_primario, instituciones, localidades, departamentos  WHERE id_ficha= '" .$id."' AND fi_primario.vigente=1 AND fi_primario.idinstitucion=instituciones.ID AND localidades.ID=fi_primario.idlocalidad AND departamentos.ID=fi_primario.iddepartamento");

while($row =  mysqli_fetch_assoc($sql_ficha)){
// datos de instituciones
$institucion = $row ["Nombre"];
$nombre2 = $row ["Nombre2"];
switch ($row ["Caracter"]) {
    case 1:
        $tipo = "Adheridos";
        break;
    case 2:
        $tipo = "Congregacional - Asociaciones Confesionales";
        break;
    case 3:
        $tipo = "Diocesano";
        break;
	case 4:
        $tipo = "Parroquial";
        break;
	case 5:
        $tipo = "Sin fines de lucro";
        break;
	case 6:
        $tipo = "SRL";
        break;
	case 7:
        $tipo = "Fundación";
        break;
}
$replegal = $row ["Rep_Legal"];

//dato de fichas
$anio = $row ["anio"];
$cuit = $row ["CUIT"];
$cue = $row ["CUE"];
$ce = $row ["CE"];
$confesional = $row ["confesional"];
$idlocalidad = $row ["idlocalidad"];
$localidad = $row ["NombreLocalidad"];
$iddepartamento = $row ["iddepartamento"];
$departamento = $row ["NombreDepto"];
$domicilio = $row ["domicilio"];
$barrio = $row ["barrio"];
$precinto = $row ["precinto"];
$cp = $row ["cp"];
$telefono = $row ["telefono"];
$correo = $row ["correo"];
$fecha_apertura = $row ["fecha_apertura"];
$resolucion_adscripcion = $row ["resolucion_adscripcion"];
$categoria = $row ["categoria"];
$destino = $row ["destino"];
$jornada = $row ["jornada"];
$turno = $row ["turno"];
$horario = $row ["horario"];
$aporte_estatal = $row ["aporte_estatal"];
$zona_desfavorable = $row ["zona_desfavorable"];
$monto_matricula = $row ["monto_matricula"];
$monto_marzo = $row ["monto_marzo"];
$cuotas = $row ["cuotas"];
$supervisor = $row ["supervisor"];
$zona = $row ["zona"];

// matricula
$grado1_f = $row ["grado1_f"];
$grado1_m = $row ["grado1_m"];
$grado1_r = $row ["grado1_r"];
$grado1_s = $row ["grado1_s"];
$grado1_d = $row ["grado1_d"];
$grado2_f = $row ["grado2_f"];
$grado2_m = $row ["grado2_m"];
$grado2_r = $row ["grado2_r"];
$grado2_s = $row ["grado2_s"];
$grado2_d = $row ["grado2_d"];
$grado3_f = $row ["grado3_f"];
$grado3_m = $row ["grado3_m"];
$grado3_r = $row ["grado3_r"];
$grado3_s = $row ["grado3_s"];
$grado3_d = $row ["grado3_d"];
$grado4_f = $row ["grado4_f"];
$grado4_m = $row ["grado4_m"];
$grado4_r = $row ["grado4_r"];
$grado4_s = $row ["grado4_s"];
$grado4_d = $row ["grado4_d"];
$grado5_f = $row ["grado5_f"];
$grado5_m = $row ["grado5_m"];
$grado5_r = $row ["grado5_r"];
$grado5_s = $row ["grado5_s"];
$grado5_d = $row ["grado5_d"];
$grado6_f = $row ["grado6_f"];
$grado6_m = $row ["grado6_m"];
$grado6_r = $row ["grado6_r"];
$grado6_s = $row ["grado6_s"];
$grado6_d = $row ["grado6_d"];
$grado1_integrados = $row ["grado1_integrados"];
$grado2_integrados = $row ["grado2_integrados"];
$grado3_integrados = $row ["grado3_integrados"];
$grado4_integrados = $row ["grado4_integrados"];
$grado5_integrados = $row ["grado5_integrados"];
$grado6_integrados = $row ["grado6_integrados"];

$total_f = $grado1_f + $grado2_f + $grado3_f + $grado4_f + $grado5_f + $grado6_f;
$total_m = $grado1_m + $grado2_m + $grado3_m + $grado4_m + $grado5_m + $grado6_m;
$total_r = $grado1_r + $grado2_r + $grado3_r + $grado4_r + $grado5_r + $grado6_r;
$total_s = $grado1_s + $grado2_s + $grado3_s + $grado4_s + $grado5_s + $grado6_s;
$total_d = $grado1_d + $grado2_d + $grado3_d + $grado4_d + $grado5_d + $grado6_d;
$total_integrados = $grado1_integrados + $grado2_integrados + $grado3_integrados + $grado4_integrados + $grado5_integrados + $grado6_integrados;

// estructura curricular
$ciclo1_matematicas = $row ["ciclo1_matematicas"];
$ciclo1_lenguaoralescrita = $row ["ciclo1_lenguaoralescrita"];
$ciclo1_sociales = $row ["ciclo1_sociales"];
$ciclo1_naturales = $row ["ciclo1_naturales"];
$ciclo1_tecno = $row ["ciclo1_tecno"];
$ciclo1_identidad = $row ["ciclo1_identidad"];
$ciclo1_edfisica = $row ["ciclo1_edfisica"];
$ciclo1_edmusical = $row ["ciclo1_edmusical"];
$ciclo1_edplastica = $row ["ciclo1_edplastica"];
$ciclo1_lenguaextranjera = $row ["ciclo1_lenguaextranjera"];
$ciclo1_informatica = $row ["ciclo1_informatica"];
$ciclo1_teatro = $row ["ciclo1_teatro"];
$ciclo1_catequesis = $row ["ciclo1_catequesis"];
$ciclo1_deportes = $row ["ciclo1_deportes"];
$ciclo1_bicultural = $row ["ciclo1_bicultural"];
$ciclo2_matematicas = $row ["ciclo2_matematicas"];
$ciclo2_lenguaoralescrita = $row ["ciclo2_lenguaoralescrita"];
$ciclo2_sociales = $row ["ciclo2_sociales"];
$ciclo2_naturales = $row ["ciclo2_naturales"];
$ciclo2_tecno = $row ["ciclo2_tecno"];
$ciclo2_identidad = $row ["ciclo2_identidad"];
$ciclo2_edfisica = $row ["ciclo2_edfisica"];
$ciclo2_edmusical = $row ["ciclo2_edmusical"];
$ciclo2_edplastica = $row ["ciclo2_edplastica"];
$ciclo2_lenguaextranjera = $row ["ciclo2_lenguaextranjera"];
$ciclo2_informatica = $row ["ciclo2_informatica"];
$ciclo2_teatro = $row ["ciclo2_teatro"];
$ciclo2_catequesis = $row ["ciclo2_catequesis"];
$ciclo2_deportes = $row ["ciclo2_deportes"];
$ciclo2_bicultural = $row ["ciclo2_bicultural"];

// responsables y cargos
$nombre_rl1= $row ["id_representante1"];
$nombre_rl2= $row ["id_representante2"];
$telefono_rl1 = $row ["telefono_representante1"];
$telefono_rl2 = $row ["telefono_representante2"];
$correo_rl1 = $row ["correo_representante1"];
$correo_rl2 = $row ["correo_representante2"];

$nombre_director = $row ["id_director"]; 
$telefono_director = $row ["telefono_director"];
$correo_director = $row ["correo_director"];


$nombre_vice1 = $row ["id_vice1"];
$nombre_vice2 = $row ["id_vice2"];
$telefono_vice1 = $row ["telefono_vice1"];
$telefono_vice2 = $row ["telefono_vice2"];
$correo_vice1 = $row ["correo_vice1"]; 
$correo_vice2 = $row ["correo_vice2"]; 

$nombre_secretaria1 = $row ["id_secretaria1"];
$nombre_secretaria2 = $row ["id_secretaria2"];
$telefono_secretaria1 = $row ["telefono_secretaria1"];
$telefono_secretaria2 = $row ["telefono_secretaria2"];
$correo_secretaria1 = $row ["correo_secretaria1"];
$correo_secretaria2 = $row ["correo_secretaria2"];


$pf_personas_conaporte = $row ["pf_personas_conaporte"];
$pf_personas_sinaporte =  $row ["pf_personas_sinaporte"];
$pf_horas_conaporte =  $row ["pf_horas_conaporte"];
$pf_horas_sinaporte =  $row ["pf_horas_sinaporte"];
$pc_personas_sinaporte =  $row ["pc_personas_sinaporte"];
$pc_horas_sinaporte =  $row ["pc_horas_sinaporte"];
$pi_personas_conaporte =  $row ["pi_personas_conaporte"];
$pi_personas_sinaporte =  $row ["pi_personas_sinaporte"];
$pi_horas_conaporte =  $row ["pi_horas_conaporte"];
$pi_horas_sinaporte =  $row ["pi_horas_sinaporte"];


// otros
$paicor_almuerzo= $row ["paicor_almuerzo"];
$paicor_leche= $row ["paicor_leche"];
$paicor_plan= $row ["paicor_plan"];
$seguro_cia= $row ["seguro_cia"];
$seguro_poliza= $row ["seguro_poliza"];
$seguro_vigencia= $row ["seguro_vigencia"];
}
}
// tablas tipo
$deptos =  mysqli_query($link,"SELECT * from departamentos ORDER BY Nombre");
$localidad =  mysqli_query($link,"SELECT * from localidades ORDER BY Nombre");


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
  <script>
  $(function() {
    $( "#tabs" ).tabs();
  });
  </script>
<script language="javascript">
function guardar()
{
		frm.action.value='G';
		frm.submit();
}
</script>
</head>
<body>
<form name="frm" id="frm" method="post" action="fichas3.php">
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
	<img src="images/map.png" width="30" height="36" border="0"> <b>Ficha Institucional</b>
	</div>
    <div class="clear2"> </div>
  <div id="tabs">
  <ul>
    <li><a href="#tabs-1">Establecimiento</a></li>
    <li><a href="#tabs-2">Matrícula</a></li>
    <li><a href="#tabs-3">Estructura Curricular</a></li>
	<li><a href="#tabs-4">Responsables y Cargos</a></li>
	<li><a href="#tabs-5">Otros</a></li>
  </ul>
<p> 
<strong>
<br>
Institución: <?php echo $institucion;?> <br>
Nivel: <?php echo $nivel;?> -  Año: <?php echo $anio;?>
</strong>
</p>
  <div id="tabs-1">
  <table border="1" style="width:100%">
  <tr>
  <td width="30px" rowspan="3" style="background-color:#333333; color:#FFFFFF; text-align:center; vertical-align:middle">1</td>
  <td>CUIT:</td><td ><input type="text" name="txtcuit" value="<?php echo $cuit;?>" ></td>
  </tr>
  <tr>
  <td>CUE:</td><td><input type="text" name="txtcue" value="<?php echo $cue;?>" ></td>
  </tr>
  <tr>
  <td>CE:</td><td><input name="txtce" type="text" value="<?php echo $ce;?>" ></td>
  </tr>
  </table>
 <div class="clear2"> </div>
<table border="1" style="width:100%">
  <tr>
  <td width="30px" rowspan="4" style="background-color:#000099; color:#FFFFFF; text-align:center; vertical-align:middle">2</td>
  <td  >Entidad Propietaria: <?php echo $nombre2;?></td>
  </tr>
  <tr>
  <td >Tipo: <?php echo $tipo;?> </td></tr>
  <tr>
  <td >Rep.  Legal. Designación N°: <?php echo $replegal;?> </td>
  </tr>
  <tr>
  <td>Confesional: <?php echo $confesional;?></td>
  </tr>
  </table>
 
   <div class="clear2"> </div>
  <table border="1" style="width:100%">
  <tr>
  <td width="30px" rowspan="8" style="background-color:#333333; color:#FFFFFF; text-align:center; vertical-align:middle">3</td>
  <td >Departamento: </td><td >
  <select name="txtdepartamento" id="txtdepartamento">
  <?php while($row=mysqli_fetch_assoc($deptos)) 
  { ?>
  <?php if ($row["ID"]== $iddepartamento ) { $sel="selected";  }
		else { $sel=""; } ?> 
    <option value="<?php echo $row["ID"]?>" <?php echo $sel;?>><?php echo $row["Nombre"]?> </option>
   <?php } ?>
	</select>

  </td>
  </tr>
  <tr>
  <td>Localidad: </td><td>
    <select name="txtlocalidad" id="txtlocalidad">
  <?php while($row1=mysqli_fetch_assoc($localidad)) 
  { ?>
  <?php if ($row1["ID"]== $idlocalidad) { $sel="selected";  }
		else { $sel=""; } ?> 
    <option value="<?php echo $row1["ID"]?>" <?php echo $sel;?>><?php echo $row1["Nombre"]?> </option>
   <?php } ?>
	</select>

  </td>
  </tr>
  <tr>
  <td>Precinto Policial:  </td><td><input type="text" name="txtprecinto" value="<?php echo $precinto;?>"></td>
  </tr>
  <tr>
  <td>CP:  </td><td><input type="text" name="txtcp" value="<?php echo $cp;?>" ></td>
  </tr>
  <tr>
  <td>Barrio:  </td><td><input type="text" name="txtbarrio" value="<?php echo $barrio;?>" ></td>
  </tr>
  <tr>
  <td>Domicilio:  </td><td><input type="text" name="txtdomicilio" value="<?php echo $domicilio;?>" ></td>
  </tr>
  <tr>
  <td>Teléfono:  </td><td><input type="text" name="txttelefono" value="<?php echo $telefono;?>" ></td>
  </tr>
  <tr>
  <td>Correo:  </td><td><input type="text" name="txtcorreo" value="<?php echo $correo;?>" ></td>
  </tr>
  </table>
 <div class="clear2"> </div>
 <table border="1" style="width:100%">
  <tr>
  <td width="30px" rowspan="2" style="background-color:#333333; color:#FFFFFF; text-align:center; vertical-align:middle">4</td>
  <td >Fecha apertura: </td><td ><input type="text" name="txtfechaapertura" value="<?php echo $fecha_apertura;?>" ></td>
  </tr>
  <tr>
  <td>Adscripción: </td><td><input type="text" name="txtadscripcion" value="<?php echo $resolucion_adscripcion;?>" ></td>
  </tr>
  </table>
<div class="clear2"> </div>
 <table border="1" style="width:100%" >
  <tr>
  <td width="30px" rowspan="5" style="background-color:#333333; color:#FFFFFF; text-align:center; vertical-align:middle">5</td>
  <td >Categoría:</td><td >
  
  <select name="txtcategoria" id="txtcategoria">
  <option value="Primera" <?php if ($categoria == 'Primera') echo "selected"?>>Primera</option>
  <option value="Segunda" <?php if ($categoria == 'Segunda') echo "selected"?>>Segunda</option>
  <option value="Tercera" <?php if ($categoria == 'Tercera') echo "selected"?>>Tercera</option>
  </select>

  
  </td>
  </tr>
  <tr>
  <td>Destino: </td><td>
  <select name="txtdestino" id="txtdestino">
  <option value="Mixto" <?php if ($destino== 'Mixto') echo "selected"?>>Mixto</option>
  <option value="Mujeres" <?php if ($destino == 'Mujeres') echo "selected"?>>Mujeres</option>
  <option value="Varones" <?php if ($destino == 'Varones') echo "selected"?>>Varones</option>
  </select>
</td>
  </tr>
  <tr>
  <td>Jornada: </td><td>
  <select name="txtjornada" id="txtjornada">
  <option value="Simple" <?php if ($jornada == 'Simple') echo "selected"?>>Simple</option>
  <option value="Extendida" <?php if ($jornada == 'Extendida') echo "selected"?>>Extendida</option>
  <option value="Doble Turno" <?php if ($jornada == 'Doble Turno') echo "selected"?>>Doble Turno</option>
  </select>
  </td>
  </tr>
  <tr>
  <td>Turno:</td><td>
  <select name="txtturno" id="txtturno">
  <option value="Mañana" <?php if ($turno== 'Mañana') echo "selected"?>>Mañana</option>
  <option value="Tarde" <?php if ($turno == 'Tarde') echo "selected"?>>Tarde</option>
  <option value="MT" <?php if ($turno == 'MT') echo "selected"?>>Mañana/Tarde</option>
  <option value="Completo" <?php if ($turno == 'Completo') echo "selected"?>>Completo</option>
  </select>
  
  </td>
  </tr>
  <tr>
  <td>Horario: </td><td><input type="text" name="txthorario" value="<?php echo $horario	;?>" ></td>
  </tr>
  </table>
<div class="clear2"> </div>
<table border="1" style="width:100%" >
  <tr>
  <td width="30px" rowspan="5" style="background-color:#333333; color:#FFFFFF; text-align:center; vertical-align:middle">6</td>
   <td>Aporte Estatal (%): </td><td ><input type="text" name="txtaporte" value="<?php echo $aporte_estatal	;?>" ></td>
  </tr>
  <tr>
  <td>Zona desfavorable (%): </td><td><input type="text" name="txtzonadesfavorable" value="<?php echo $zona_desfavorable	;?>" ></td>
  </tr>
  <tr>
  <td>Monto Matrícula ($): </td><td><input type="text" name="txtmatricula" value="<?php echo $monto_matricula	;?>" ></td>
  </tr>
  <tr>
  <td>Monto cuota Marzo ($): </td><td><input type="text" name="txtmonto" value="<?php echo $monto_marzo	;?>" ></td>
  </tr>
  <tr>
  <td>Cantidad de Cuotas: </td><td><input type="text" name="txtcuotas" value="<?php echo $cuotas	;?>" ></td>
  </tr>
  </table>
  
<div class="clear2"> </div>
 <table border="1" style="width:100%" >
  <tr>
  <td width="30px" rowspan="2" style="background-color:#333333; color:#FFFFFF; text-align:center; vertical-align:middle">7</td>
  <td >Supervisor: </td><td ><input type="text" name="txtsupervisor" value="<?php echo $supervisor ;?>" ></td>
  </tr>
  <tr>
  <td>Zona: </td><td><input type="text" name="txtzona" value="<?php echo $zona	;?>" ></td>
  </tr>
  </table>
  </div>
  <div id="tabs-2">
    <p>
	<table>
	<tr>
	<td rowspan="2" style="background-color:#333333; color:#FFFFFF"><div align="center">Grado 1</div></td>  
	<td><div align="center">Femenino</div></td>
	<td><div align="center">Masculino</div></td>
	<td><div align="center">Repitentes</div></td>
	<td><div align="center">Sobreedad</div></td>
	<td><div align="center">Desertor</div></td>
	<td><div align="center">Integrado</div></td>
	</tr>
	<tr>
	<td><input type="text" name="txtgrado1_f" value="<?php echo $grado1_f;?>" ></td>
	<td><input type="text" name="txtgrado1_m" value="<?php echo $grado1_m;?>" ></td>
	<td><input type="text" name="txtgrado1_r" value="<?php echo $grado1_r;?>" ></td>
	<td><input type="text" name="txtgrado1_s" value="<?php echo $grado1_s;?>" ></td>
	<td><input type="text" name="txtgrado1_d" value="<?php echo $grado1_d;?>" ></td>
	<td><input type="text" name="txtgrado1_integrados" value="<?php echo $grado1_integrados;?>" ></td>
	</tr>
	</table>
	<BR>
		<table>
	<tr>
	<td rowspan="2" style="background-color:#333333; color:#FFFFFF"><div align="center">Grado 2</div></td>  
	<td><div align="center">Femenino</div></td>
	<td><div align="center">Masculino</div></td>
	<td><div align="center">Repitentes</div></td>
	<td><div align="center">Sobreedad</div></td>
	<td><div align="center">Desertor</div></td>
	<td><div align="center">Integrado</div></td>
	</tr>
	<tr>
	<td><input type="text" name="txtgrado2_f" value="<?php echo $grado2_f;?>" ></td>
	<td><input type="text" name="txtgrado2_m" value="<?php echo $grado2_m;?>" ></td>
	<td><input type="text" name="txtgrado2_r" value="<?php echo $grado2_r;?>" ></td>
	<td><input type="text" name="txtgrado2_s" value="<?php echo $grado2_s;?>" ></td>
	<td><input type="text" name="txtgrado2_d" value="<?php echo $grado2_d;?>" ></td>
	<td><input type="text" name="txtgrado2_integrados" value="<?php echo $grado2_integrados;?>" ></td>
	</tr>
	</table>

	<BR>
		<table>
	<tr>
	<td rowspan="2" style="background-color:#333333; color:#FFFFFF"><div align="center">Grado 3</div></td>  
	<td><div align="center">Femenino</div></td>
	<td><div align="center">Masculino</div></td>
	<td><div align="center">Repitentes</div></td>
	<td><div align="center">Sobreedad</div></td>
	<td><div align="center">Desertor</div></td>
	<td><div align="center">Integrado</div></td>
	</tr>
	<tr>
	<td><input type="text" name="txtgrado3_f" value="<?php echo $grado3_f;?>" ></td>
	<td><input type="text" name="txtgrado3_m" value="<?php echo $grado3_m;?>" ></td>
	<td><input type="text" name="txtgrado3_r" value="<?php echo $grado3_r;?>" ></td>
	<td><input type="text" name="txtgrado3_s" value="<?php echo $grado3_s;?>" ></td>
	<td><input type="text" name="txtgrado3_d" value="<?php echo $grado3_d;?>" ></td>
	<td><input type="text" name="txtgrado3_integrados" value="<?php echo $grado3_integrados;?>" ></td>
	</tr>
	</table>

	<BR>
		<table>
	<tr>
	<td rowspan="2" style="background-color:#333333; color:#FFFFFF"><div align="center">Grado 4</div></td>  
	<td><div align="center">Femenino</div></td>
	<td><div align="center">Masculino</div></td>
	<td><div align="center">Repitentes</div></td>
	<td><div align="center">Sobreedad</div></td>
	<td><div align="center">Desertor</div></td>
	<td><div align="center">Integrado</div></td>
	</tr>
	<tr>
	<td><input type="text" name="txtgrado4_f" value="<?php echo $grado4_f;?>" ></td>
	<td><input type="text" name="txtgrado4_m" value="<?php echo $grado4_m;?>" ></td>
	<td><input type="text" name="txtgrado4_r" value="<?php echo $grado4_r;?>" ></td>
	<td><input type="text" name="txtgrado4_s" value="<?php echo $grado4_s;?>" ></td>
	<td><input type="text" name="txtgrado4_d" value="<?php echo $grado4_d;?>" ></td>
	<td><input type="text" name="txtgrado4_integrados" value="<?php echo $grado4_integrados;?>" ></td>
	</tr>
	</table>

	<BR>
	<table>
	<tr>
	<td rowspan="2" style="background-color:#333333; color:#FFFFFF"><div align="center">Grado 5</div></td>  
	<td><div align="center">Femenino</div></td>
	<td><div align="center">Masculino</div></td>
	<td><div align="center">Repitentes</div></td>
	<td><div align="center">Sobreedad</div></td>
	<td><div align="center">Desertor</div></td>
	<td><div align="center">Integrado</div></td>
	</tr>
	<tr>
	<td><input type="text" name="txtgrado5_f" value="<?php echo $grado5_f;?>" ></td>
	<td><input type="text" name="txtgrado5_m" value="<?php echo $grado5_m;?>" ></td>
	<td><input type="text" name="txtgrado5_r" value="<?php echo $grado5_r;?>" ></td>
	<td><input type="text" name="txtgrado5_s" value="<?php echo $grado5_s;?>" ></td>
	<td><input type="text" name="txtgrado5_d" value="<?php echo $grado5_d;?>" ></td>
	<td><input type="text" name="txtgrado5_integrados" value="<?php echo $grado5_integrados;?>" ></td>
	</tr>
	</table>
<br>
		<table>
	<tr>
	<td rowspan="2" style="background-color:#333333; color:#FFFFFF"><div align="center">Grado 6</div></td>  
	<td><div align="center">Femenino</div></td>
	<td><div align="center">Masculino</div></td>
	<td><div align="center">Repitentes</div></td>
	<td><div align="center">Sobreedad</div></td>
	<td><div align="center">Desertor</div></td>
	<td><div align="center">Integrado</div></td>
	</tr>
	<tr>
	<td><input type="text" name="txtgrado6_f" value="<?php echo $grado6_f;?>" ></td>
	<td><input type="text" name="txtgrado6_m" value="<?php echo $grado6_m;?>" ></td>
	<td><input type="text" name="txtgrado6_r" value="<?php echo $grado6_r;?>" ></td>
	<td><input type="text" name="txtgrado6_s" value="<?php echo $grado6_s;?>" ></td>
	<td><input type="text" name="txtgrado6_d" value="<?php echo $grado6_d;?>" ></td>
	<td><input type="text" name="txtgrado6_integrados" value="<?php echo $grado6_integrados;?>" ></td>
	</tr>
	</table>
<br>
	
		<table>
	<tr>
	<td rowspan="2" style="background-color:#333333; color:#FFFFFF"><div align="center">Total</div></td>  
	<td><div align="center">Femenino</div></td>
	<td><div align="center">Masculino</div></td>
	<td><div align="center">Repitentes</div></td>
	<td><div align="center">Sobreedad</div></td>
	<td><div align="center">Desertor</div></td>
	<td><div align="center">Integrado</div></td>
	</tr>
	<tr>
    <td><input type="text" name="txttotal_f" value="<?php echo $total_f;?>" ></td>
	<td><input type="text" name="txttotal_m" value="<?php echo $total_m;?>" ></td>
	<td><input type="text" name="txttotal_r" value="<?php echo $total_r;?>" ></td>
	<td><input type="text" name="txttotal_s" value="<?php echo $total_s;?>" ></td>
	<td><input type="text" name="txttotal_d" value="<?php echo $total_d;?>" ></td>
	<td><input type="text" name="txttotal_integrados" value="<?php echo $total_integrados;?>" ></td>	</tr>
	</table>
	</p>
  </div>
  <div id="tabs-3">
    <p>
	<table style="font-family:Arial, Helvetica, sans-serif; font-size:10px;">
	<tr>
	<td></td>
	<td></td>
	<td>1° Ciclo</td>
	<td>2° Ciclo</td>
	</tr>
	<tr>
	<td rowspan="9" align="center" valign="middle">Oficial</td>
	<td>Matematica</td>
	<td><input type="text" name="txtciclo1_matematicas" value="<?php echo $ciclo1_matematicas;?>" ></td>
	<td><input type="text" name="txtciclo2_matematicas" value="<?php echo $ciclo2_matematicas;?>" ></td>
	</tr>
	<tr>
	<td>Lengua Oral Escrita</td>
	<td><input type="text" name="txtciclo1_lenguaoralescrita" value="<?php echo $ciclo1_lenguaoralescrita;?>" ></td>
	<td><input type="text" name="txtciclo2_lenguaoralescrita" value="<?php echo $ciclo2_lenguaoralescrita;?>" ></td>
	</tr>
	<tr>
	<td>Sociales</td>
	<td><input type="text" name="txtciclo1_sociales" value="<?php echo $ciclo1_sociales;?>" ></td>
	<td><input type="text" name="txtciclo2_sociales" value="<?php echo $ciclo2_sociales;?>" ></td>
	</tr>
	<tr>
	<td>Naturales</td>
	<td><input type="text" name="txtciclo1_naturales" value="<?php echo $ciclo1_naturales;?>" ></td>
	<td><input type="text" name="txtciclo2_naturales" value="<?php echo $ciclo2_naturales;?>" ></td>
		</tr>
	<tr>
	<td>Tecno</td>
	<td><input type="text" name="txtciclo1_tecno" value="<?php echo $ciclo1_tecno;?>" ></td>
	<td><input type="text" name="txtciclo2_tecno" value="<?php echo $ciclo2_tecno;?>" ></td>
		</tr>
	<tr>
	<td>Identidad</td>
	<td><input type="text" name="txtciclo1_identidad" value="<?php echo $ciclo1_identidad;?>" ></td>
	<td><input type="text" name="txtciclo2_identidad" value="<?php echo $ciclo2_identidad;?>" ></td>
	</tr>
	<tr>
	<td>Ed. Física</td>
	<td><input type="text" name="txtciclo1_edfisica" value="<?php echo $ciclo1_edfisica;?>" ></td>
	<td><input type="text" name="txtciclo2_edfisica" value="<?php echo $ciclo2_edfisica;?>" ></td>
		</tr>
	<tr>
	<td>Ed. Musical</td>
	<td><input type="text" name="txtciclo1_edmusical" value="<?php echo $ciclo1_edmusical;?>" ></td>
	<td><input type="text" name="txtciclo2_edmusical" value="<?php echo $ciclo2_edmusical;?>" ></td>
	</tr>
	<tr>
	<td>Ed. Plastica</td>
	<td><input type="text" name="txtciclo1_edplastica" value="<?php echo $ciclo1_edplastica;?>" ></td>
	<td><input type="text" name="txtciclo2_edplastica" value="<?php echo $ciclo2_edplastica;?>" ></td>
	</tr>

	</table>
	<br>
	<table style="font-family:Arial, Helvetica, sans-serif; font-size:10px;">
	<tr>
	<td></td>
	<td></td>
	<td>1° Ciclo</td>
	<td>2° Ciclo</td>
	</tr>
	<tr>
	<td rowspan="3">Compl.</td>
	<td>Lengua Extranjera</td>
	<td><input type="text" name="txtciclo1_lenguaextranjera" value="<?php echo $ciclo1_lenguaextranjera;?>" ></td>
	<td><input type="text" name="txtciclo2_lenguaextranjera" value="<?php echo $ciclo2_lenguaextranjera;?>" ></td>
	</tr>
	<tr>
	<td>Informática</td>
	<td><input type="text" name="txtciclo1_informatica" value="<?php echo $ciclo1_informatica;?>" ></td>
	<td><input type="text" name="txtciclo2_informatica" value="<?php echo $ciclo2_informatica;?>" ></td>
	</tr>
	<tr>
	<td>Teatro</td>
	<td><input type="text" name="txtciclo1_teatro" value="<?php echo $ciclo1_teatro;?>" ></td>
	<td><input type="text" name="txtciclo2_teatro" value="<?php echo $ciclo2_teatro;?>" ></td>
	</tr>
	</table>
	<br>
	<table style="font-family:Arial, Helvetica, sans-serif; font-size:10px;">
	<tr>
	<td></td>
	<td></td>
	<td>1° Ciclo</td>
	<td>2° Cicilo</td>
	</tr>
	<tr>
	<td rowspan="3">Proyecto Institucional</td>
	<td>Catequesis</td>
	<td><input type="text" name="txtciclo1_catequesis" value="<?php echo $ciclo1_catequesis;?>" ></td>
	<td><input type="text" name="txtciclo2_catequesis" value="<?php echo $ciclo2_catequesis;?>" ></td>
	</tr>
	<tr>
	<td>Deportes</td>
	<td><input type="text" name="txtciclo1_deportes" value="<?php echo $ciclo1_deportes;?>" ></td>
	<td><input type="text" name="txtciclo2_deportes" value="<?php echo $ciclo2_deportes;?>" ></td>
	</tr>
	<tr>
	<td>Bicultural</td>
	<td><input type="text" name="txtciclo1_bicultural" value="<?php echo $ciclo1_bicultural;?>" ></td>
	<td><input type="text" name="txtciclo2_bicultural" value="<?php echo $ciclo2_bicultural;?>" ></td>
	</tr>
	</table>
	</p>
  </div>
   <div id="tabs-4">
    <p>
	<table>
	<tr>
	<td></td>
	<td>Nombre</td>
	<td>Celular</td>
	<td>Correo</td>
	</tr>
	<tr>
	<td>Rep. Legal  </td>
	<td><input name="txtnombre_rl1" type="text" id="txtnombre_rl1" value="<?php echo $nombre_rl1;?>" ></td>
	<td><input name="txtcelular_rl1" type="text" id="txtcelular_rl1" value="<?php echo $telefono_rl1;?>" ></td>
	<td><input name="txtcorreo_rl1" type="text"  id="txtcorreo_rl1" value="<?php echo $correo_rl1;?>" ></td>
	</tr>
	<tr>
      <td>Rep. Legal </td>
	  <td><input name="txtnombre_rl2" type="text" id="txtnombre_rl2" value="<?php echo $nombre_rl2;?>" ></td>
	  <td><input name="txtcelular_rl2" type="text" id="txtcelular_rl2" value="<?php echo $telefono_rl2;?>" ></td>
	  <td><input name="txtcorreo_rl2" type="text"  id="txtcorreo_rl2" value="<?php echo $correo_rl2;?>" ></td>
	  </tr>
	
	<tr>
	<td>Director</td>
	<td><input type="text" name="txtnombre_director" value="<?php echo $nombre_director;?>" ></td>
	<td><input type="text" name="txtcelular_director" value="<?php echo $telefono_director;?>" ></td>
	<td><input type="text" name="txtcorreo_director" value="<?php echo $correo_director;?>" ></td>
	</tr>
	<tr>
	<td>Vicedirector</td>
	<td><input type="text" name="txtnombre_vice1" value="<?php echo $nombre_vice1;?>" ></td>
	<td><input type="text" name="txtcelular_vice1" value="<?php echo $telefono_vice1;?>" ></td>
	<td><input type="text" name="txtcorreo_vice1" value="<?php echo $correo_vice1;?>" ></td>
	</tr>
	<tr>
	<td>Vicedirector</td>
	<td><input type="text" name="txtnombre_vice2" value="<?php echo $nombre_vice2;?>" ></td>
	<td><input type="text" name="txtcelular_vice2" value="<?php echo $telefono_vice2;?>" ></td>
	<td><input type="text" name="txtcorreo_vice2" value="<?php echo $correo_vice2;?>" ></td>
	</tr>
	<tr>
	<td>Sec. Docente</td>
	<td><input type="text" name="txtnombre_secretaria1" value="<?php echo $nombre_secretaria1;?>" ></td>
	<td><input type="text" name="txtcelular_secretaria1" value="<?php echo $telefono_secretaria1;?>" ></td>
	<td><input type="text" name="txtcorreo_secretaria1" value="<?php echo $correo_secretaria1;?>" ></td>
	</tr>
	<tr>
	<td>Sec. Docente</td>
	<td><input type="text" name="txtnombre_secretaria2" value="<?php echo $nombre_secretaria2;?>" ></td>
	<td><input type="text" name="txtcelular_secretaria2" value="<?php echo $telefono_secretaria2;?>" ></td>
	<td><input type="text" name="txtcorreo_secretaria2" value="<?php echo $correo_secretaria2;?>" ></td>
	</tr>
	</table>
	<br>
	<table>
	<tr>
	<td rowspan="2">Planta Funcional</td>
	<td>Per CA</td>
	<td>Per SA</td>
	<td>Hs CA</td>
	<td>Hs SA</td>
	</tr>
	<tr>
	<td><input type="text" name="txtpf_personas_conaporte" value="<?php echo $pf_personas_conaporte;?>" ></td>
	<td><input type="text" name="txtpf_personas_sinaporte" value="<?php echo $pf_personas_sinaporte;?>" ></td>
	<td><input type="text" name="txtpf_horas_conaporte" value="<?php echo $pf_horas_conaporte;?>" ></td>
	<td><input type="text" name="txtpf_horas_sinaporte" value="<?php echo $pf_horas_sinaporte;?>" ></td>
	</tr>
	</table>
	<br>
	<table style="font-family:Arial, Helvetica, sans-serif; font-size:10px; width:100%">
	<tr>
	<td rowspan="2">Planta Compl.</td>
	<td >Per SA</td>
	<td >Hs SA</td>
	</tr>
	<tr>
	<td ><input type="text" name="txtpc_personas_sinaporte" value="<?php echo $pc_personas_sinaporte;?>" ></td>
	<td ><input type="text" name="txtpc_horas_sinaporte" value="<?php echo $pc_horas_sinaporte;?>" ></td>
	</tr>
	</table>
	<br>
	<table style="font-family:Arial, Helvetica, sans-serif; font-size:10px; width:100%">
	<tr>
	<td rowspan="2">Proyecto Instituional</td>
	<td>Per CA</td>
	<td>Per SA</td>
	<td>Hs CA</td>
	<td>Hs SA</td>
	</tr>
	<tr>
	<td><input type="text" name="txtpi_personas_conaporte" value="<?php echo $pi_personas_conaporte;?>" ></td>
	<td><input type="text" name="txtpi_personas_sinaporte" value="<?php echo $pi_personas_sinaporte;?>" ></td>
	<td><input type="text" name="txtpi_horas_conaporte" value="<?php echo $pi_horas_conaporte;?>" ></td>
	<td><input type="text" name="txtpi_horas_sinaporte" value="<?php echo $pi_horas_sinaporte;?>" ></td>
	</tr>
	</table>
	</p>
  </div>
   <div id="tabs-5">
    <p>
	<table  style="font-family:Arial, Helvetica, sans-serif; font-size:10px; width:100%">
	<tr>
	<td rowspan="3" style="background-color:#333333; color:#FFFFFF; vertical-align:middle;  width:90px;"><strong>PAICOR</strong></td>
	<td>Raciones Almuerzo:</td>
	<td><input type="text" name="txtpaicor_almuerzo" value="<?php echo $paicor_almuerzo;?>" ></td>
	</tr>
	<tr>
	<td>Raciones Leche:</td>
	<td><input type="text" name="txtpaicor_leche" value="<?php echo $paicor_leche;?>" ></td>
	</tr>
	<tr>
	<td>Plan Social:</td>
	<td><input type="text" name="txtpaicor_plan" value="<?php echo $paicor_plan;?>" ></td>
	</tr>
	</table>
<br>
	<table style="font-family:Arial, Helvetica, sans-serif; font-size:10px; width:100%">
	<tr>
	<td rowspan="3" style="background-color:#333333; color:#FFFFFF; vertical-align:middle;width:90px;"><strong>RESP. CIVIL</strong></td>
	<td >Cia Prestadora</td>
	<td ><input type="text" name="txtseguro_cia" value="<?php echo $seguro_cia;?>" ></td>
	</tr>
	<tr>
	<td>Póliza N°</td>
	<td><input type="text" name="txtseguro_poliza" value="<?php echo $seguro_poliza;?>" ></td>
	</tr>
	<tr>
	<td>Vigencia</td>
	<td><input type="text" name="txtseguro_vigencia" value="<?php echo $seguro_vigencia;?>" ></td>
	</tr>
	</table>
    <br><br>
	<input type="hidden" name="action" id="action">
    <input name="id_fic" type="hidden" id="id_fic" value="<?php echo $id?>">
	<input name="id_nivel" type="hidden" id="id_nivel" value="<?php echo $nivel?>">

	<p style="text-align:center">
	<input name="Submit3" type="button" value="GUARDAR" onClick="guardar();"  />
	</p>
  </div>
</div>  
  </div>
</div>
</div>
<div class="clear"> </div>
<?php include("pie.php"); ?>

</form>
</body>
</html>
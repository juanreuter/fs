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
if ($nivel == 'Inicial')
{
mysqli_query($link,"UPDATE fi_inicial SET
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
			 sala2_f = '".$_POST["txtsala2_f"]."',
			 sala2_m = '".$_POST["txtsala2_m"]."',
			 sala2_s = '".$_POST["txtsala2_s"]."',
			 sala2_d = '".$_POST["txtsala2_d"]."',
			 sala3_f = '".$_POST["txtsala3_f"]."',
			 sala3_m = '".$_POST["txtsala3_m"]."',
			 sala3_s = '".$_POST["txtsala3_s"]."',
			 sala3_d = '".$_POST["txtsala3_d"]."',
			 sala4_f = '".$_POST["txtsala4_f"]."',
			 sala4_m = '".$_POST["txtsala4_m"]."',
			 sala4_s = '".$_POST["txtsala4_s"]."',
			 sala4_d = '".$_POST["txtsala4_d"]."',
			 sala5_f = '".$_POST["txtsala5_f"]."',
			 sala5_m = '".$_POST["txtsala5_m"]."',
			 sala5_s = '".$_POST["txtsala5_s"]."',
			 sala5_d = '".$_POST["txtsala5_d"]."',
			 sala2_integrados = '".$_POST["txtsala2_integrados"]."',
			 sala3_integrados = '".$_POST["txtsala3_integrados"]."',
			 sala4_integrados = '".$_POST["txtsala4_integrados"]."',
			 sala5_integrados = '".$_POST["txtsala5_integrados"]."',
			 sala3_iniciacion = '".$_POST["txtsala3_iniciacion"]."',
			 sala3_trabajo = '".$_POST["txtsala3_trabajo"]."',
			 sala3_merienda = '".$_POST["txtsala3_merienda"]."',
			 sala3_juego = '".$_POST["txtsala3_juego"]."',
			 sala3_experencia = '".$_POST["txtsala3_experiencia"]."',
			 sala3_narracion = '".$_POST["txtsala3_narracion"]."',
			 sala3_edfisica = '".$_POST["txtsala3_edfisica"]."',
			 sala3_edmusical = '".$_POST["txtsala3_edmusical"]."',
			 sala3_lengua = '".$_POST["txtsala3_lengua"]."',
			 sala3_informatica = '".$_POST["txtsala3_informatica"]."',
			 sala3_teatro = '".$_POST["txtsala3_teatro"]."',
			 sala3_catequesis = '".$_POST["txtsala3_catequesis"]."',
			 sala3_aplicada = '".$_POST["txtsala3_aplicada"]."',
			 sala3_bicultural = '".$_POST["txtsala3_bicultural"]."',
			 sala4_iniciacion = '".$_POST["txtsala4_iniciacion"]."',
			 sala4_trabajo = '".$_POST["txtsala4_trabajo"]."',
			 sala4_merienda = '".$_POST["txtsala4_merienda"]."',
			 sala4_juego = '".$_POST["txtsala4_juego"]."',
			 sala4_experiencia = '".$_POST["txtsala4_experiencia"]."',
			 sala4_narracion = '".$_POST["txtsala4_narracion"]."',
			 sala4_edfisica = '".$_POST["txtsala4_edfisica"]."',
			 sala4_edmusical = '".$_POST["txtsala4_edmusical"]."',
			 sala4_lengua = '".$_POST["txtsala4_lengua"]."',
			 sala4_informatica = '".$_POST["txtsala4_informatica"]."',
			 sala4_teatro = '".$_POST["txtsala4_teatro"]."',
			 sala4_catequesis = '".$_POST["txtsala4_catequesis"]."',
			 sala4_aplicada = '".$_POST["txtsala4_aplicada"]."',
			 sala4_bicultural = '".$_POST["txtsala4_bicultural"]."',
			 sala5_iniciacion = '".$_POST["txtsala5_iniciacion"]."',
			 sala5_trabajo = '".$_POST["txtsala5_trabajo"]."',
			 sala5_merienda = '".$_POST["txtsala5_merienda"]."',
			 sala5_juego = '".$_POST["txtsala5_juego"]."',
			 sala5_experiencia = '".$_POST["txtsala5_expeirencia"]."',
			 sala5_narracion = '".$_POST["txtsala5_narracion"]."',
			 sala5_edfisica = '".$_POST["txtsala5_edfisica"]."',
			 sala5_edmusical = '".$_POST["txtsala5_edmusical"]."',
			 sala5_lengua = '".$_POST["txtsala5_lengua"]."',
			 sala5_informatica = '".$_POST["txtsala5_informatica"]."',
			 sala5_teatro = '".$_POST["txtsala5_teatro"]."',
			 sala5_catequesis = '".$_POST["txtsala5_catequesis"]."',
			 sala5_aplicada = '".$_POST["txtsala5_aplicada"]."',
			 sala5_bicultural = '".$_POST["txtsala5_bicultural"]."',
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
url="fichas2.php?id_fic="+ <?php echo $id ?> +"&id_nivel="+ <?php echo $nivel ?>;
window.open(url,'_self')
</script>
<?php

}
}
if ($nivel == 'Inicial') 
{
	$sql_ficha = mysqli_query($link,"SELECT fi_inicial.*, instituciones.*, localidades.Nombre as NombreLocalidad, departamentos.Nombre as NombreDepto from fi_inicial, instituciones, localidades, departamentos  WHERE id_ficha= '" .$id."' AND fi_inicial.vigente=1 AND fi_inicial.idinstitucion=instituciones.ID AND localidades.ID=fi_inicial.idlocalidad AND departamentos.ID=fi_inicial.iddepartamento");
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
$sala2_f = $row ["sala2_f"];
$sala2_m = $row ["sala2_m"];
$sala2_s = $row ["sala2_s"];
$sala2_d = $row ["sala2_d"];
$sala2_integrados = $row ["sala2_integrados"];
$sala3_f = $row ["sala3_f"];
$sala3_m = $row ["sala3_m"];
$sala3_s = $row ["sala3_s"];
$sala3_d = $row ["sala3_d"];
$sala3_integrados = $row ["sala3_integrados"];
$sala4_f = $row ["sala4_f"];
$sala4_m = $row ["sala4_m"];
$sala4_s = $row ["sala4_s"];
$sala4_d = $row ["sala4_d"];
$sala4_integrados = $row ["sala4_integrados"];
$sala5_f = $row ["sala5_f"];
$sala5_m = $row ["sala5_m"];
$sala5_s = $row ["sala5_s"];
$sala5_d = $row ["sala5_d"];
$sala5_integrados = $row ["sala5_integrados"];
$total_f = $sala5_f + $sala4_f + $sala3_f;
$total_m = $sala5_m + $sala4_m + $sala3_m;
$total_s = $sala5_s + $sala4_s + $sala3_s;
$total_d = $sala5_d + $sala4_d + $sala3_d;
$total_integrados = $sala5_integrados + $sala4_integrados + $sala3_integrados;

// estructura curricular
$sala3_iniciacion = $row ["sala3_iniciacion"];
$sala3_trabajo = $row ["sala3_trabajo"];
$sala3_merienda = $row ["sala3_merienda"];
$sala3_juego = $row ["sala3_juego"];
$sala3_experiencia = $row ["sala3_experiencia"];
$sala3_narracion = $row ["sala3_narracion"];
$sala3_edfisica = $row ["sala3_edfisica"];
$sala3_edmusical = $row ["sala3_edmusical"];
$sala3_lengua = $row ["sala3_lengua"];
$sala3_informatica = $row ["sala3_informatica"];
$sala3_teatro = $row ["sala3_teatro"];
$sala3_catequesis = $row ["sala3_catequesis"];
$sala3_aplicada = $row ["sala3_aplicada"];
$sala3_bicultural = $row ["sala3_bicultural"];
$sala4_iniciacion = $row ["sala4_iniciacion"];
$sala4_trabajo = $row ["sala4_trabajo"];
$sala4_merienda = $row ["sala4_merienda"];
$sala4_juego = $row ["sala4_juego"];
$sala4_experiencia = $row ["sala4_experiencia"];
$sala4_narracion = $row ["sala4_narracion"];
$sala4_edfisica = $row ["sala4_edfisica"];
$sala4_edmusical = $row ["sala4_edmusical"];
$sala4_lengua = $row ["sala4_lengua"];
$sala4_informatica = $row ["sala4_informatica"];
$sala4_teatro = $row ["sala4_teatro"];
$sala4_catequesis = $row ["sala4_catequesis"];
$sala4_aplicada = $row ["sala4_aplicada"];
$sala4_bicultural = $row ["sala4_bicultural"];
$sala5_iniciacion = $row ["sala5_iniciacion"];
$sala5_trabajo = $row ["sala5_trabajo"];
$sala5_merienda = $row ["sala5_merienda"];
$sala5_juego = $row ["sala5_juego"];
$sala5_experiencia = $row ["sala5_experiencia"];
$sala5_narracion = $row ["sala5_narracion"];
$sala5_edfisica = $row ["sala5_edfisica"];
$sala5_edmusical = $row ["sala5_edmusical"];
$sala5_lengua = $row ["sala5_lengua"];
$sala5_informatica = $row ["sala5_informatica"];
$sala5_teatro = $row ["sala5_teatro"];
$sala5_catequesis = $row ["sala5_catequesis"];
$sala5_aplicada = $row ["sala5_aplicada"];
$sala5_bicultural = $row ["sala5_bicultural"];

// responsables y cargos
$id_rl= $row ["id_representante"];
$id_director= $row ["id_director"];
$id_vice1= $row ["id_vice1"];
$id_vice2= $row ["id_vice2"];
$id_secretaria1= $row ["id_secretaria1"];
$sql_rl =  mysqli_fetch_assoc(mysqli_query($link,"SELECT * from personal WHERE ID= '" .$id_rl."'"));
$sql_director =  mysqli_fetch_assoc(mysqli_query($link,"SELECT * from personal WHERE ID= '" .$id_director."'" ));
$sql_vice1 =  mysqli_fetch_assoc(mysqli_query($link,"SELECT * from personal WHERE ID= '" .$id_vice1."'"));
$sql_vice2 =  mysqli_fetch_assoc(mysqli_query($link,"SELECT * from personal WHERE ID= '" .$id_vice2."'"));
$sql_secretaria1 =  mysqli_fetch_assoc(mysqli_query($link,"SELECT * from personal WHERE ID= '" .$id_secretaria1."'"));
$nombre_rl = $sql_rl["Nombre"]; 
$telefono_rl = $sql_rl["Telefono"];
$correo_rl = $sql_rl["correo"];  
$nombre_director = $sql_director["Nombre"]; 
$telefono_director = $sql_director["Telefono"];
$correo_director = $sql_director["correo"];  
$nombre_vice1 = $sql_vice1["Nombre"]; 
$telefono_vice1 = $sql_vice1["Telefono"];
$correo_vice1 = $sql_vice1["correo"];  
$nombre_vice2 = $sql_vice2["Nombre"]; 
$telefono_vice2 = $sql_vice2["Telefono"];
$correo_vice2 = $sql_vice2["correo"];  
$nombre_secretaria1 = $sql_secretaria1["Nombre"]; 
$telefono_secretaria1 = $sql_secretaria1["Telefono"];
$correo_secretaria1 = $sql_secreetaria1["correo"];  
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
<form name="frm" id="frm" method="post" action="fichas2.php">
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
  <option value="Mañana/Tarde" <?php if ($turno == 'Mañana/Tarde') echo "selected"?>>Mañana/Tarde</option>
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
	<td rowspan="2" style="background-color:#333333; color:#FFFFFF"><div align="center">Sala 5</div></td>  
	<td><div align="center">Femenino</div></td>
	<td><div align="center">Masculino</div></td>
	<td><div align="center">Sobreedad</div></td>
	<td><div align="center">Desertor</div></td>
	<td><div align="center">Integrado</div></td>
	</tr>
	<tr>
	<td><input type="text" name="txtsala5_f" value="<?php echo $sala5_f;?>" ></td>
	<td><input type="text" name="txtsala5_m" value="<?php echo $sala5_m;?>" ></td>
	<td><input type="text" name="txtsala5_s" value="<?php echo $sala5_s;?>" ></td>
	<td><input type="text" name="txtsala5_d" value="<?php echo $sala5_d;?>" ></td>
	<td><input type="text" name="txtsala5_integrados" value="<?php echo $sala5_integrados;?>" ></td>
	</tr>
	</table>
	<BR>
		<table>
	<tr>
	<td rowspan="2" style="background-color:#333333; color:#FFFFFF"><div align="center">Sala 4</div></td>  
	<td><div align="center">Femenino</div></td>
	<td><div align="center">Masculino</div></td>
	<td><div align="center">Sobreedad</div></td>
	<td><div align="center">Desertor</div></td>
	<td><div align="center">Integrado</div></td>
	</tr>
	<tr>
	<td><input type="text" name="txtsala4_f" value="<?php echo $sala4_f;?>" ></td>
	<td><input type="text" name="txtsala4_m" value="<?php echo $sala4_m;?>" ></td>
	<td><input type="text" name="txtsala4_s" value="<?php echo $sala4_s;?>" ></td>
	<td><input type="text" name="txtsala4_d" value="<?php echo $sala4_d;?>" ></td>
	<td><input type="text" name="txtsala4_integrados" value="<?php echo $sala4_integrados;?>" ></td>
	</tr>
	</table>
	<BR>
		<table>
	<tr>
	<td rowspan="2" style="background-color:#333333; color:#FFFFFF"><div align="center">Sala 3</div></td>  
	<td><div align="center">Femenino</div></td>
	<td><div align="center">Masculino</div></td>
	<td><div align="center">Sobreedad</div></td>
	<td><div align="center">Desertor</div></td>
	<td><div align="center">Integrado</div></td>
	</tr>
	<tr>
	<td><input type="text" name="txtsala3_f" value="<?php echo $sala3_f;?>" ></td>
	<td><input type="text" name="txtsala3_m" value="<?php echo $sala3_m;?>" ></td>
	<td><input type="text" name="txtsala3_s" value="<?php echo $sala3_s;?>" ></td>
	<td><input type="text" name="txtsala3_d" value="<?php echo $sala3_d;?>" ></td>
	<td><input type="text" name="txtsala3_integrados" value="<?php echo $sala3_integrados;?>" ></td>
	</tr>
	</table>
	<BR>
		<table>
	<tr>
	<td rowspan="2" style="background-color:#333333; color:#FFFFFF"><div align="center">Sala 2</div></td>  
	<td><div align="center">Femenino</div></td>
	<td><div align="center">Masculino</div></td>
	<td><div align="center">Sobreedad</div></td>
	<td><div align="center">Desertor</div></td>
	<td><div align="center">Integrado</div></td>
	</tr>
	<tr>
    <td><input type="text" name="txtsala2_f" value="<?php echo $sala2_f;?>" ></td>
	<td><input type="text" name="txtsala2_m" value="<?php echo $sala2_m;?>" ></td>
	<td><input type="text" name="txtsala2_s" value="<?php echo $sala2_s;?>" ></td>
	<td><input type="text" name="txtsala2_d" value="<?php echo $sala2_d;?>" ></td>
	<td><input type="text" name="txtsala2_integrados" value="<?php echo $sala2_integrados;?>" ></td>
	</tr>
	</table>
	<BR>
		<table>
	<tr>
	<td rowspan="2" style="background-color:#333333; color:#FFFFFF"><div align="center">Total</div></td>  
	<td><div align="center">Femenino</div></td>
	<td><div align="center">Masculino</div></td>
	<td><div align="center">Sobreedad</div></td>
	<td><div align="center">Desertor</div></td>
	<td><div align="center">Integrado</div></td>
	</tr>
	<tr>
    <td><input type="text" name="txttotal_f" value="<?php echo $total_f;?>" ></td>
	<td><input type="text" name="txttotal_m" value="<?php echo $total_m;?>" ></td>
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
	<td>3 años</td>
	<td>4 años</td>
	<td>5 años</td>
	</tr>
	<tr>
	<td rowspan="8" align="center" valign="middle">Oficial</td>
	<td>Iniciaci&oacute;n</td>
	<td><input type="text" name="txtsala3_iniciacion" value="<?php echo $sala3_iniciacion;?>" ></td>
	<td><input type="text" name="txtsala4_iniciacion" value="<?php echo $sala4_iniciacion;?>" ></td>
	<td><input type="text" name="txtsala5_iniciacion" value="<?php echo $sala5_iniciacion;?>" ></td>
	</tr>
	<tr>
	<td>Juego-Trabajo</td>
	<td><input type="text" name="txtsala3_trabajo" value="<?php echo $sala3_trabajo;?>" ></td>
	<td><input type="text" name="txtsala4_trabajo" value="<?php echo $sala4_trabajo;?>" ></td>
	<td><input type="text" name="txtsala5_trabajo" value="<?php echo $sala5_trabajo;?>" ></td>
	</tr>
	<tr>
	<td>Merienda</td>
	<td><input type="text" name="txtsala3_merienda" value="<?php echo $sala3_merienda;?>" ></td>
	<td><input type="text" name="txtsala4_merienda" value="<?php echo $sala4_merienda;?>" ></td>
	<td><input type="text" name="txtsala5_merienda" value="<?php echo $sala5_merienda;?>" ></td>
	</tr>
	<tr>
	<td>Juego libre</td>
	<td><input type="text" name="txtsala3_juego" value="<?php echo $sala3_juego;?>" ></td>
	<td><input type="text" name="txtsala4_juego" value="<?php echo $sala4_juego;?>" ></td>
	<td><input type="text" name="txtsala5_juego" value="<?php echo $sala5_juego;?>" ></td>
	</tr>
	<tr>
	<td>Experiencia</td>
	<td><input type="text" name="txtsala3_experiencia" value="<?php echo $sala3_experiencia;?>" ></td>
	<td><input type="text" name="txtsala4_experiencia" value="<?php echo $sala4_experiencia;?>" ></td>
	<td><input type="text" name="txtsala5_experiencia" value="<?php echo $sala5_experiencia;?>" ></td>
	</tr>
	<tr>
	<td>Narración</td>
	<td><input type="text" name="txtsala3_narracion" value="<?php echo $sala3_narracion;?>" ></td>
	<td><input type="text" name="txtsala4_narracion" value="<?php echo $sala4_narracion;?>" ></td>
	<td><input type="text" name="txtsala5_narracion" value="<?php echo $sala5_narracion;?>" ></td>
	</tr>
	<tr>
	<td>Ed. Física</td>
	<td><input type="text" name="txtsala3_edfisica" value="<?php echo $sala3_edfisica;?>" ></td>
	<td><input type="text" name="txtsala4_edfisica" value="<?php echo $sala4_edfisica;?>" ></td>
	<td><input type="text" name="txtsala5_edfisica" value="<?php echo $sala5_edfisica;?>" ></td>
	</tr>
	<tr>
	<td>Ed. Musical</td>
	<td><input type="text" name="txtsala3_edmusical" value="<?php echo $sala3_edmusical;?>" ></td>
	<td><input type="text" name="txtsala4_edmusical" value="<?php echo $sala4_edmusical;?>" ></td>
	<td><input type="text" name="txtsala5_edmusical" value="<?php echo $sala5_edmusical;?>" ></td>
	</tr>
	</table>
	<br>
	<table style="font-family:Arial, Helvetica, sans-serif; font-size:10px;">
	<tr>
	<td></td>
	<td></td>
	<td>3 años</td>
	<td>4 años</td>
	<td>5 años</td>
	</tr>
	<tr>
	<td rowspan="3">Compl.</td>
	<td>Lengua Extranjera</td>
	<td><input type="text" name="txtsala3_lengua" value="<?php echo $sala3_lengua;?>" ></td>
	<td><input type="text" name="txtsala4_lengua" value="<?php echo $sala4_lengua;?>" ></td>
	<td><input type="text" name="txtsala5_lengua" value="<?php echo $sala5_lengua;?>" ></td>
	</tr>
	<tr>
	<td>Informática</td>
	<td><input type="text" name="txtsala3_informatica" value="<?php echo $sala3_informatica;?>" ></td>
	<td><input type="text" name="txtsala4_informatica" value="<?php echo $sala4_informatica;?>" ></td>
	<td><input type="text" name="txtsala5_informatica" value="<?php echo $sala5_informatica;?>" ></td>
	</tr>
	<tr>
	<td>Teatro</td>
	<td><input type="text" name="txtsala3_teatro" value="<?php echo $sala3_teatro;?>" ></td>
	<td><input type="text" name="txtsala4_teatro" value="<?php echo $sala4_teatro;?>" ></td>
	<td><input type="text" name="txtsala5_teatro" value="<?php echo $sala5_teatro;?>" ></td>

	</tr>
	</table>
	<br>
	<table style="font-family:Arial, Helvetica, sans-serif; font-size:10px;">
	<tr>
	<td></td>
	<td></td>
	<td>3 años</td>
	<td>4 años</td>
	<td>5 años</td>
	</tr>
	<tr>
	<td rowspan="3">Proyecto Institucional</td>
	<td>Catequesis</td>
	<td><input type="text" name="txtsala3_catequesis" value="<?php echo $sala3_catequesis;?>" ></td>
	<td><input type="text" name="txtsala4_catequesis" value="<?php echo $sala4_catequesis;?>" ></td>
	<td><input type="text" name="txtsala5_catequesis" value="<?php echo $sala5_catequesis;?>" ></td>
	</tr>
	<tr>
	<td>Informática Aplicada</td>
	<td><input type="text" name="txtsala3_aplicada" value="<?php echo $sala3_aplicada;?>" ></td>
	<td><input type="text" name="txtsala4_aplicada" value="<?php echo $sala4_aplicada;?>" ></td>
	<td><input type="text" name="txtsala5_aplicada" value="<?php echo $sala5_aplicada;?>" ></td>
	</tr>
	<tr>
	<td>Bicultural</td>
	<td><input type="text" name="txtsala3_bicultural" value="<?php echo $sala3_bicultural;?>" ></td>
	<td><input type="text" name="txtsala4_bicultural" value="<?php echo $sala4_bicultural;?>" ></td>
	<td><input type="text" name="txtsala5_bicultural" value="<?php echo $sala5_bicultural;?>" ></td>
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
	<td>Rep. Legal</td>
	<td><input type="text" name="txtnombre_rl" value="<?php echo $nombre_rl;?>" ></td>
	<td><input type="text" name="txtcelular_rl" value="<?php echo $telefono_rl;?>" ></td>
	<td><input type="text" name="txtcorreo_rl" value="<?php echo $correo_rl;?>" ></td>
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
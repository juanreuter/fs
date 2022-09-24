<?php

include "funciones/funciones.php";

//$fecha = time (); 

$inst=consulta_sql("select * from instituciones where ID=".$_GET['inst']);



//cuota pactada

if ($_GET['tipo'] =="ccu")  

{

$tipo_recibo="FONDO SOLIDARIO";
$en_concepto_de="Cuota Pactada  Solidario";

$recibo=consulta_sql("select * from cobranzas_cuota, recibos where cobranzas_cuota.ccu_id=recibos.id_cuenta and ccu_id=".$_GET['id']." and tipo_cuenta='".$_GET['tipo']."'");

$pago=$recibo[0]['ccu_pago'];
$fecha = $recibo[0]['ccu_fecha'];
$nro_recibo=add_ceros($recibo[0]['numero_recibo'],5);

$saldo=$recibo[0]['ccu_saldo'];

if($recibo[0]['ccu_forma_pago']=='E') $tipo_pago="Efectivo";

if($recibo[0]['ccu_forma_pago']=='C') $tipo_pago="Cheque";

if($recibo[0]['ccu_forma_pago']=='T') $tipo_pago="Transferencia";

if($recibo[0]['ccu_forma_pago']=='R') $tipo_pago="Reintegro";

if($recibo[0]['ccu_forma_pago']=='O') $tipo_pago="Otros";

$observaciones=$recibo[0]['ccu_observaciones'];

$en_concepto_de='Cuota Pactada  Solidario. Año ' .$recibo[0]['ccu_anio']. '<br><br> <u>Saldo a la fecha</u>: $&nbsp; ' . $recibo[0]['ccu_saldo'];



if ($recibo[0]['ccu_pago_ac'] !="" && $recibo[0]['ccu_pago_ac'] !="0") $en_concepto_de=$en_concepto_de . '<br><br> <u>Por Accidentología</u>:&nbsp; ' . $recibo[0]['ccu_pago_ac'];

if ($recibo[0]['ccu_pago_rl'] !="" && $recibo[0]['ccu_pago_rl'] !="0") $en_concepto_de=$en_concepto_de . '<br><br> <u>Por Responsabilidad Laboral</u>:&nbsp;' . $recibo[0]['ccu_pago_rl'];

} 

//cuota prestamo

if ($_GET['tipo'] =="cde")  

{
$tipo_recibo="FONDO SOLIDARIO";

$recibo=consulta_sql("select * from cobranzas_devolucion, prestamos, recibos where cobranzas_devolucion.cde_id=recibos.id_cuenta and cde_prestamo=pre_id and cde_id=".$_GET['id']." and tipo_cuenta='".$_GET['tipo']."'");

$pago=$recibo[0]['cde_pago'];

$nro_recibo=add_ceros($recibo[0]['numero_recibo'],5);

$nro_prestamo=$recibo[0]['cde_prestamo'];

if($recibo[0]['cde_forma_pago']=='E') $tipo_pago="Efectivo";

if($recibo[0]['cde_forma_pago']=='C') $tipo_pago="Cheque";

if($recibo[0]['cde_forma_pago']=='T') $tipo_pago="Transferencia";

if($recibo[0]['cde_forma_pago']=='R') $tipo_pago="Reintegro";

if($recibo[0]['cde_forma_pago']=='O') $tipo_pago="Otros";

$observaciones=$recibo[0]['cde_observaciones'];

$en_concepto_de='Devolución Préstamo Nº ' .$recibo[0]['pre_numero']. ' - Cuota Nº ' .$recibo[0]['cde_cuota'] ;

$fecha = $recibo[0]['cde_fecha'];


} 



//pago a cuenta

if ($_GET['tipo'] =="cac")  

{

$tipo_recibo="FONDO SOLIDARIO";
$en_concepto_de="Pago a Cuenta  Solidario";

$recibo=consulta_sql("select * from cobranzas_a_cuenta, recibos  where cobranzas_a_cuenta.cac_id=recibos.id_cuenta and cac_id=".$_GET['id']." and tipo_cuenta='".$_GET['tipo']."'");

$pago=$recibo[0]['cac_pago'];

$nro_recibo=add_ceros($recibo[0]['numero_recibo'],5);

if($recibo[0]['cac_forma_pago']=='E') $tipo_pago="Efectivo";

if($recibo[0]['cac_forma_pago']=='C') $tipo_pago="Cheque";

if($recibo[0]['cac_forma_pago']=='T') $tipo_pago="Transferencia";

if($recibo[0]['cac_forma_pago']=='R') $tipo_pago="Reintegro";

if($recibo[0]['cac_forma_pago']=='O') $tipo_pago="Otros";

$observaciones=$recibo[0]['cac_observaciones'];

$fecha = $recibo[0]['cac_fecha'];


} 

//aporte a la junta 

if ($_GET['tipo'] =="cap")  

{

$tipo_recibo="JAEC";

$recibo=consulta_sql("select * from cobranzas_aporte, recibos  where cobranzas_aporte.cap_id=recibos.id_cuenta and cap_id=".$_GET['id']." and tipo_cuenta='".$_GET['tipo']."'");

$pago=$recibo[0]['cap_pago'];

//$nro_recibo=$recibo[0]['id'];

$nro_recibo=add_ceros($recibo[0]['numero_recibo'],5);

if($recibo[0]['cap_forma_pago']=='E') $tipo_pago="Efectivo";

if($recibo[0]['cap_forma_pago']=='C') $tipo_pago="Cheque";

if($recibo[0]['cap_forma_pago']=='T') $tipo_pago="Transferencia";

if($recibo[0]['cap_forma_pago']=='R') $tipo_pago="Reintegro";

if($recibo[0]['cap_forma_pago']=='O') $tipo_pago="Otros";

$observaciones=$recibo[0]['cap_observaciones'];

$fecha = $recibo[0]['cap_fecha'];

$en_concepto_de='Aporte Solidario a la Junta. Año ' .$recibo[0]['cap_anio']. '<br><br> <u>Saldo a la fecha</u>: $&nbsp; ' . $recibo[0]['cap_saldo'];


} 


//aporte a salud ocupacional 

if ($_GET['tipo'] =="cso")  

{

$tipo_recibo="FONDO SOLIDARIO";
$recibo=consulta_sql("select * from cobranzas_salud, recibos  where cobranzas_salud.cso_id=recibos.id_cuenta and cso_id=".$_GET['id']." and tipo_cuenta='".$_GET['tipo']."'");

$pago=$recibo[0]['cso_pago'];

$nro_recibo=add_ceros($recibo[0]['numero_recibo'],5);

if($recibo[0]['cso_forma_pago']=='E') $tipo_pago="Efectivo";

if($recibo[0]['cso_forma_pago']=='C') $tipo_pago="Cheque";

if($recibo[0]['cso_forma_pago']=='T') $tipo_pago="Transferencia";

if($recibo[0]['cso_forma_pago']=='R') $tipo_pago="Reintegro";

if($recibo[0]['cso_forma_pago']=='O') $tipo_pago="Otros";

$observaciones=$recibo[0]['cso_observaciones'];

$fecha = $recibo[0]['cso_fecha'];

$en_concepto_de='Aporte Salud Ocupacional. Año ' .$recibo[0]['cso_anio']. '<br><br> <u>Saldo a la fecha</u>: $&nbsp; ' . $recibo[0]['cso_saldo'];



} 


//aporte a ayuda escolar

if ($_GET['tipo'] =="cae")  

{

$tipo_recibo="FONDO SOLIDARIO";
$recibo=consulta_sql("select * from cobranzas_ayuda, recibos  where cobranzas_ayuda.cae_id=recibos.id_cuenta and cae_id=".$_GET['id']." and tipo_cuenta='".$_GET['tipo']."'");

$pago=$recibo[0]['cae_pago'];

$nro_recibo=add_ceros($recibo[0]['numero_recibo'],5);

if($recibo[0]['cae_forma_pago']=='E') $tipo_pago="Efectivo";

if($recibo[0]['cae_forma_pago']=='C') $tipo_pago="Cheque";

if($recibo[0]['cae_forma_pago']=='T') $tipo_pago="Transferencia";

if($recibo[0]['cae_forma_pago']=='R') $tipo_pago="Reintegro";

if($recibo[0]['cae_forma_pago']=='O') $tipo_pago="Otros";

$observaciones=$recibo[0]['cae_observaciones'];

$fecha = $recibo[0]['cae_fecha'];

$en_concepto_de='Aporte Ayuda Escolar. Año ' .$recibo[0]['cae_anio']. '<br><br> <u>Saldo a la fecha</u>: $&nbsp; ' . $recibo[0]['cae_saldo'];

} 



?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<html>

<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

<title></title>



<link href="../cobranzas/estilos/estilos.css" rel="stylesheet" type="text/css">
</head>

<body style="background-color:transparent" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table>
<tr><td style="height:30px;"></td></tr>
</table>
<table border="0"  align="center" class="tablareporte">

  <tr>

    <td height="300">
	<div align="center"><img src="../cobranzas/media/top_recibo.gif" /></div>
	<div style="margin-left:50px; margin-top:-160px; width:220px; text-align:center;"><span style="font-size:16px;"><strong><?php echo $tipo_recibo ;?> </strong></span></div>
    <div style="margin-left:500px; margin-top:-60px;"><span><strong>COPIA</strong></span></div>
    <div style="margin-left:500px; margin-top:30px;"><span><strong><?php echo $nro_recibo ;?> </strong></span></div>
	<div style="margin-left:500px; margin-top:30px;"><span><strong><? echo  $fecha ; ?> </strong></span></div>	
	</td>
  </tr>


  <tr>

    <td width="500" height="25" colspan="2" class="tahoma12"><b>Se&ntilde;or(es):</b>&nbsp;<?php echo $inst[0]['Nombre']?></td>
  </tr>

  <tr>

    <td height="25" colspan="2" class="tahoma12"><b>Domicilio:</b>&nbsp;<?php echo $inst[0]['Domicilio']?>   - <?php echo $inst[0]['Localidad']?> </td>
  </tr>
  <tr>
    <td height="25" colspan="2" class="tahoma12"><img src="../cobranzas/media/top_aclara.gif" width="710" height="90" /></td>
  </tr>
 
  <tr>

    <td height="25" colspan="2" class="tahoma12"><b>Recib&iacute; la suma de pesos:</b> <? echo num2letras($pago); ?>&nbsp;($ <?php echo $pago;?>)</td>
  </tr>

  <tr>

    <td height="25" colspan="2" class="tahoma12"><b>En concepto de:</b> <?php echo $en_concepto_de;?> <br><br> <br>

    <br> 

	<?php 

	if ($observaciones != "") {

	?>

	<i>Nota: <?php echo $observaciones;?> </i>

	<?php }?>	</td>
  </tr>

 
  <tr>

    <td height="25" class="tahoma12">&nbsp;</td>

    <td height="25" class="tahoma12">&nbsp;</td>
  </tr>

  <tr>

    <td colspan=2 height="25" class="tahoma12">

	  <strong>Detalles del Pago:</strong> <?php echo $tipo_pago; ?><br />

	 
  

      <img src="../cobranzas/media/top_total.gif" />
      <div style="margin-left:80px; margin-top:-50px;"><span><strong><?php echo $pago;?></strong></span></div>    </td>
 </tr>
</table>

</body>

<?php 


function num2letras($num, $fem = true, $dec = true) { 

//if (strlen($num) > 14) die("El n?mero introducido es demasiado grande"); 

   $matuni[2]  = "dos"; 

   $matuni[3]  = "tres"; 

   $matuni[4]  = "cuatro"; 

   $matuni[5]  = "cinco"; 

   $matuni[6]  = "seis"; 

   $matuni[7]  = "siete"; 

   $matuni[8]  = "ocho"; 

   $matuni[9]  = "nueve"; 

   $matuni[10] = "diez"; 

   $matuni[11] = "once"; 

   $matuni[12] = "doce"; 

   $matuni[13] = "trece"; 

   $matuni[14] = "catorce"; 

   $matuni[15] = "quince"; 

   $matuni[16] = "dieciseis"; 

   $matuni[17] = "diecisiete"; 

   $matuni[18] = "dieciocho"; 

   $matuni[19] = "diecinueve"; 

   $matuni[20] = "veinte"; 

   $matunisub[2] = "dos"; 

   $matunisub[3] = "tres"; 

   $matunisub[4] = "cuatro"; 

   $matunisub[5] = "quin"; 

   $matunisub[6] = "seis"; 

   $matunisub[7] = "sete"; 

   $matunisub[8] = "ocho"; 

   $matunisub[9] = "nove"; 



   $matdec[2] = "veint"; 

   $matdec[3] = "treinta"; 

   $matdec[4] = "cuarenta"; 

   $matdec[5] = "cincuenta"; 

   $matdec[6] = "sesenta"; 

   $matdec[7] = "setenta"; 

   $matdec[8] = "ochenta"; 

   $matdec[9] = "noventa"; 

   $matsub[3]  = 'mill'; 

   $matsub[5]  = 'bill'; 

   $matsub[7]  = 'mill'; 

   $matsub[9]  = 'trill'; 

   $matsub[11] = 'mill'; 

   $matsub[13] = 'bill'; 

   $matsub[15] = 'mill'; 

   $matmil[4]  = 'millones'; 

   $matmil[6]  = 'billones'; 

   $matmil[7]  = 'de billones'; 

   $matmil[8]  = 'millones de billones'; 

   $matmil[10] = 'trillones'; 

   $matmil[11] = 'de trillones'; 

   $matmil[12] = 'millones de trillones'; 

   $matmil[13] = 'de trillones'; 

   $matmil[14] = 'billones de trillones'; 

   $matmil[15] = 'de billones de trillones'; 

   $matmil[16] = 'millones de billones de trillones'; 



   $num = trim((string)@$num); 

   if ($num[0] == '-') { 

      $neg = 'menos '; 

      $num = substr($num, 1); 

   }else 

      $neg = ''; 

   while ($num[0] == '0') $num = substr($num, 1); 

   if ($num[0] < '1' or $num[0] > 9) $num = '0' . $num; 

   $zeros = true; 

   $punt = false; 

   $ent = ''; 

   $fra = ''; 

   for ($c = 0; $c < strlen($num); $c++) { 

      $n = $num[$c]; 

      if (! (strpos(".,'''", $n) === false)) { 

         if ($punt) break; 

         else{ 

            $punt = true; 

            continue; 

         } 



      }elseif (! (strpos('0123456789', $n) === false)) { 

         if ($punt) { 

            if ($n != '0') $zeros = false; 

            $fra .= $n; 

         }else 



            $ent .= $n; 

      }else 



         break; 



   } 

   $ent = '     ' . $ent; 

   if ($dec and $fra and ! $zeros) { 

      $fin = ' coma'; 

      for ($n = 0; $n < strlen($fra); $n++) { 

         if (($s = $fra[$n]) == '0') 

            $fin .= ' cero'; 

         elseif ($s == '1') 

            $fin .= $fem ? ' una' : ' un'; 

         else 

            $fin .= ' ' . $matuni[$s]; 

      } 

   }else 

      $fin = ''; 

   if ((int)$ent === 0) return 'Cero ' . $fin; 

   $tex = ''; 

   $sub = 0; 

   $mils = 0; 

   $neutro = false; 

   while ( ($num = substr($ent, -3)) != '   ') { 

      $ent = substr($ent, 0, -3); 

      if (++$sub < 3 and $fem) { 

         $matuni[1] = 'una'; 

         $subcent = 'as'; 

      }else{ 

         $matuni[1] = $neutro ? 'un' : 'uno'; 

         $subcent = 'os'; 

      } 

      $t = ''; 

      $n2 = substr($num, 1); 

      if ($n2 == '00') { 

      }elseif ($n2 < 21) 

         $t = ' ' . $matuni[(int)$n2]; 

      elseif ($n2 < 30) { 

         $n3 = $num[2]; 

         if ($n3 != 0) $t = 'i' . $matuni[$n3]; 

         $n2 = $num[1]; 

         $t = ' ' . $matdec[$n2] . $t; 

      }else{ 

         $n3 = $num[2]; 

         if ($n3 != 0) $t = ' y ' . $matuni[$n3]; 

         $n2 = $num[1]; 

         $t = ' ' . $matdec[$n2] . $t; 

      } 

      $n = $num[0]; 

      if ($n == 1) { 

         $t = ' ciento' . $t; 

      }elseif ($n == 5){ 

         $t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t; 

      }elseif ($n != 0){ 

         $t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t; 

      } 

      if ($sub == 1) { 

      }elseif (! isset($matsub[$sub])) { 

         if ($num == 1) { 

            $t = ' mil'; 

         }elseif ($num > 1){ 

            $t .= ' mil'; 

         } 

      }elseif ($num == 1) { 

         $t .= ' ' . $matsub[$sub] . '?n'; 

      }elseif ($num > 1){ 

         $t .= ' ' . $matsub[$sub] . 'ones'; 

      }   

      if ($num == '000') $mils ++; 

      elseif ($mils != 0) { 

         if (isset($matmil[$sub])) $t .= ' ' . $matmil[$sub]; 

         $mils = 0; 

      } 

      $neutro = true; 

      $tex = $t . $tex; 

   } 

   $tex = $neg . substr($tex, 1) . $fin; 

   return ucfirst($tex); 

} 
?> 


</html>


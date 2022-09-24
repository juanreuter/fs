<?php



function consulta_sql($sql){

	if(!$sql) return false;

	//conexion a base de datos

$servername = "localhost";
$username = "it_reuter";
$password = "Oca%xV2G11m5NmH4e$";
$dbname = "junta_web";

// Create connection
$link = mysqli_connect($servername, $username, $password, $dbname);
mysqli_set_charset($link,"utf8");
// Check connection
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

	

	$res = mysqli_query($link,$sql);

	if(stristr(substr($sql,0,6),"SELECT")){

		if(mysqli_num_rows($res) > 0) {

			while ($row = mysqli_fetch_assoc($res)) {

				$array_result[]=$row;

			}

			mysqli_close($link);

			return $array_result;

		}

		else {

			mysqli_close($link);

			return false;

		}

	}

	if($res){

		mysqli_close($link);	

		return true;

	}

	else{

		mysqli_close($link);		

		return false;

	}

}




//FUNCIONES DE FECHA

// está funcion toma un fecha con formato 01/12/2002 

// y lo transforma a 2002/12/01 antes de guardarlo en 

// una base de datos mysql

function fentrada($cad){

$uno=substr($cad, 0, 2);

$dos=substr($cad, 3, 2);

$tres=substr($cad, 6, 4);

$cad2 = ($tres."/".$dos."/".$uno);

return $cad2;

}

// Está funcion hace lo contrario toma una fecha con 

// formato 2002/12/01 y lo transforma a 01/12/2002

// antes de mostrarlo en una página, despues de leerlo 

// desde una base de datos mysql

function fsalida($cad2){

$tres=substr($cad2, 0, 4);

$dos=substr($cad2, 5, 2);

$uno=substr($cad2, 8, 2);

$cad = ($uno."/".$dos."/".$tres);

return $cad;

}





function add_ceros($numero,$ceros) {

 $order_diez = explode(".",$numero); 

$dif_diez = $ceros - strlen($order_diez[0]); 

for($m = 0 ; 

$m < $dif_diez;

 $m++) 

{ 

@$insertar_ceros .= 0;

 } 

return $insertar_ceros .= $numero; 

}

 



?>
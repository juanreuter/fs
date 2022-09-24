<?php
//controlo acceso y auditoria
session_start();
if(!$_SESSION["log"]) header("location:index.php");
$usrmodi=$_SESSION["Usuario"];
$fecmodi=date("Y-m-d H:i:s");
$usralta=$_SESSION["Usuario"];
$fecalta=date("Y-m-d H:i:s");

//base de datos
include ("../funciones/conexion_bbdd.php");
// 
$strsql = $_SESSION["SQL"] ;
$sql = mysqli_query($link,$strsql);

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
     <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
        
        <title>Fondo Solidario  |  Sistema de Gestión</title>
        <link rel="stylesheet" href="style.css" type="text/css">
        <script src="../amcharts/amcharts.js" type="text/javascript"></script>
        <script src="../amcharts/pie.js" type="text/javascript"></script>
        
        <script type="text/javascript">
            var chart;
            var legend;
            
			var chartData = [
            <?php while($row =  mysqli_fetch_assoc($sql)){ ?>
				{
                    "espacio": "<?php echo $row["Descripcion"]?>",
                    "value": "<?php echo $row["cantidad"]?>"
                },
 			<?php } ?>	          
            ];
 
			
            AmCharts.ready(function () {
                // PIE CHART
                chart = new AmCharts.AmPieChart();
                chart.dataProvider = chartData;
                chart.titleField = "espacio";
                chart.valueField = "value";
                chart.outlineColor = "#FFFFFF";
                chart.outlineAlpha = 0.8;
                chart.outlineThickness = 2;
                chart.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
                // this makes the chart 3D
                chart.depth3D = 15;
                chart.angle = 30;

                // WRITE
                chart.write("chartdiv");
            });
        </script>
    </head>
    
    <body>
	    <div id="chartdiv" style="width: 100%; height: 400px;"></div>
    </body>

</html>
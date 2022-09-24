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

    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <title>amCharts examples</title>
        <link rel="stylesheet" href="style.css" type="text/css">
        <script src="../amcharts/amcharts.js" type="text/javascript"></script>
        <script src="../amcharts/serial.js" type="text/javascript"></script>

        <script type="text/javascript">
            var chart;

            var chartData = [
            <?php while($row =  mysqli_fetch_assoc($sql)){ ?>
<?php 
switch ($row["mes"]) 
					{
    				case "1":
     			    $stract="ENERO";
        			$strcolor="#EDEDED";
					break;
					case "2":
     			    $stract="FEBRERO";
					$strcolor="#EDEDED";
        			break;
					case "3":
     			    $stract="MARZO";
					$strcolor="#EDEDED";
        			break;
					case "4":
     			    $stract="ABRIL";
					$strcolor="#EDEDED";
        			break;
					case "5":
     			    $stract="MAYO";
					$strcolor="#EDEDED";
        			break;
					case "6":
     			    $stract="JUNIO";
					$strcolor="#EDEDED";
        			break;
					case "7":
     			    $stract="JULIO";
					$strcolor="#EDEDED";
        			break;
					case "8":
     			    $stract="AGOSTO";
					$strcolor="#EDEDED";
        			break;
					case "9":
     			    $stract="SEPTIEMBRE";
					$strcolor="#EDEDED";
        			break;
					case "10":
     			    $stract="OCTUBRE";
					$strcolor="#EDEDED";
        			break;
					case "11":
     			    $stract="NOVIEMBRE";
					$strcolor="#EDEDED";
        			break;
					case "12":
     			    $stract="DICIEMBRE";
					$strcolor="#EDEDED";
        			break;
					default:
       				$stract="SIN INFORMACION";
        			$strcolor="#EDEDED";
        		
					}
?>
			    {
                    "country": "<?php echo $stract?>",
                    "visits": "<?php echo $row["cantidad"]?>",
                    "color": "<?php echo $strcolor?>"
                },
                <?php } ?>	          
			];


            AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartData;
                chart.categoryField = "country";
                // the following two lines makes chart 3D
                chart.depth3D = 20;
                chart.angle = 30;

                // AXES
                // category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.labelRotation = 90;
                categoryAxis.dashLength = 5;
                categoryAxis.gridPosition = "start";

                // value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.title = "Denuncias";
                valueAxis.dashLength = 5;
                chart.addValueAxis(valueAxis);

                // GRAPH
                var graph = new AmCharts.AmGraph();
                graph.valueField = "visits";
                graph.colorField = "color";
                graph.balloonText = "<span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>";
                graph.type = "column";
                graph.lineAlpha = 0;
                graph.fillAlphas = 1;
                chart.addGraph(graph);

                // CURSOR
                var chartCursor = new AmCharts.ChartCursor();
                chartCursor.cursorAlpha = 0;
                chartCursor.zoomable = false;
                chartCursor.categoryBalloonEnabled = false;
                chart.addChartCursor(chartCursor);

                chart.creditsPosition = "top-right";


                // WRITE
                chart.write("chartdiv");
            });
        </script>
    </head>

    <body>
        <div id="chartdiv" style="width: 100%; height: 400px;"></div>
    </body>

</html>
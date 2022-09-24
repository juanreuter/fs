<?php
//controlo acceso y auditoria
session_start();
if(!$_SESSION["log"]) header("location:index.php");
$usrmodi=$_SESSION["Usuario"];
$fecmodi=date("Y-m-d H:i:s");
$usralta=$_SESSION["Usuario"];
$fecalta=date("Y-m-d H:i:s");

//base de datos
include ("./funciones/conexion_bbdd.php");
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
        <script src="../amcharts/serial.js" type="text/javascript"></script>

        <script type="text/javascript">
            var chart;

            var chartData = [
            <?php while($row =  mysqli_fetch_assoc($sql)){ ?>
				<?php
					switch ($row["DA_Actividad"]) 
					{
    				case "AH":
     			    $stract="HABITUAL";
        			break;
					case "SP":
     			    $stract="PROGRAMADA";
        			break;
					case "AE":
     			    $stract="EXTRA PROGRAMADA";
        			break;
					case "O":
     			    $stract="OTRAS ACTIVIDADES";
        			break;
					default:
       				$stract="SIN INFORMACION";
        			}
				   ?>
				{
                                    {
                    "country": "<?php echo $stract?>",
                    "visits": <?php echo $row["cantidad"]?>,
                    "color": "#FF9E01"
                },
 			<?php } ?>	          
            ];
 

            AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartData;
                chart.categoryField = "actividad";
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
                valueAxis.title = "Visitors";
                valueAxis.dashLength = 5;
                chart.addValueAxis(valueAxis);

                // GRAPH
                var graph = new AmCharts.AmGraph();
                graph.valueField = "value";
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
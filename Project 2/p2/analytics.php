<?php

require_once 'db.php';
require_once 'navbar.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Bar Chart Template | PrepBootstrap</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">

<!-- <div class="page-header">
    <h1>Bar Chart <small>Bootstrap template, demonstrating a Bar Chart</small></h1>
</div> -->

<!-- Bar Chart - START -->
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Home insurance cost</h3>
                </div>
                <div class="panel-body">
                    <div id="chart1"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Auto insurance cost</h3>
                </div>
                <div id="chart2" class="panel-body">
                </div>
            </div>
        </div>
    </div>   
</div>

<!-- you need to include the shieldui css and js assets in order for the charts to work -->
<link rel="stylesheet" type="text/css" href="https://www.shieldui.com/shared/components/latest/css/light/all.min.css" />
<script type="text/javascript" src="https://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>

<script type="text/javascript">
    jQuery(function ($) {
        
            <?php
                echo "var data1 = [";
                $cid = $_SESSION['c_id'];       
                $homes_list_query = "SELECT * FROM insurance WHERE c_id='$cid' and insurance_type='H'";
                $result = $conn->query($homes_list_query);
                $counter = 1;
                while($row = $result->fetch_assoc()) {
                    if($counter != 1) {
                        echo ",";
                    }
                    echo intval($row['premium_amount']);
                    $counter += 1;    
                }
                echo "];";
                echo "var datax1 = [";
                $result = $conn->query($homes_list_query);
                $counter = 1;
                while($row = $result->fetch_assoc()) {
                    if($counter != 1) {
                        echo ",";
                    }
                    echo intval($row['i_id']);
                    $counter += 1;    
                }
                echo "];";
                $homes_list_query = "SELECT * FROM insurance WHERE c_id='$cid' and insurance_type='A'";
                echo "var data2 = [";
                $result = $conn->query($homes_list_query);
                $counter = 1;
                while($row = $result->fetch_assoc()) {
                    if($counter != 1) {
                        echo ",";
                    }
                    echo intval($row['premium_amount']);
                    $counter += 1;    
                }
                echo "];";
                echo "var datax2 = [";
                $result = $conn->query($homes_list_query);
                $counter = 1;
                while($row = $result->fetch_assoc()) {
                    if($counter != 1) {
                        echo ",";
                    }
                    echo intval($row['i_id']);
                    $counter += 1;    
                }
                echo "];";
            ?>
       
            
        $("#chart1").shieldChart({
            exportOptions: {
                image: false,
                print: false
            },
            primaryHeader: {
                text: "Budget overview"
            },
            axisY: {
                title: {
                    text: "Payable per month($)"
                }
            },
            axisX: {
                categoricalValues: datax1,
                title: {
                    text: "Insurance ID"
                }
            },
            dataSeries: [{
                seriesType: "bar",
                data: data1
            }]
        });

        $("#chart2").shieldChart({
            exportOptions: {
                image: false,
                print: false
            },
            primaryHeader: {
                text: "Budget overview"
            },
            axisY: {
                title: {
                    text: "Payable per month($)"
                }
            },
            axisX: {
                categoricalValues: datax2,
                title: {
                    text: "Insurance ID"
                }
            },
            dataSeries: [{
                seriesType: "bar",
                data: data2
            }]
        });
    });
</script>
<!-- Bar Chart - END -->
</div>

 <div id="chart"></div>
    <script type="text/javascript">
        $(function () {
            $("#chart").shieldChart({
                theme: "bootstrap",
                seriesSettings: {
                    pie: {
                        activeSettings: {
                            pointSelectedState: {
                                enabled: true
                            }
                        },
                        enablePointSelection: true,
                        slicedOffset: 20,
                        addToLegend: true,
                    }
                },               
                tooltipSettings: {
                    customPointText: "{point.collectionAlias}: {point.y}"
                },
                exportOptions: {
                    image: false,
                    print: false
                },
                primaryHeader: {
                    text: "Comparison of insurance plans"
                },
                dataSeries: [{
                    seriesType: "pie",
                    collectionAlias: "Usage",
                    data: [
                        
                        <?php
                        $cid = $_SESSION['c_id'];       
                        $homes_list_query = "SELECT count(*) mycount from insurance a where a.c_id=".$cid." GROUP BY a.insurance_plan order by insurance_plan";
                        //select max(mycount) from(select count(*) mycount from insurance a where a.c_id=4 GROUP BY a.insurance_plan) as b
                        $array = array("Bronze(1 yr)", "Silver(2 yr)","Gold(5 yr)","Platinum(10 yr)");
                        $result = $conn->query($homes_list_query);
                        $counter = 1;
                        while($row = $result->fetch_assoc()) {
                            if($counter != 1) {
                                echo ",";
                            }
                            $stmt = "['".$array[$counter-1]."',";
                            echo $stmt;
                            echo intval($row['mycount']);
                            echo "]";
                            $counter += 1;    
                        }
                        ?>
                        //  ['IE', 9.0],
                        // { collectionAlias: 'Firefox', y: 26.8, selected: true },
                        // ['Chrome', 55.8],
                        // ['Safari', 3.8],
                        // ['Opera', 1.9]
                    ]
                }]
            });
        });
        
    </script>

    
</div>
</div>
</body>
</html>
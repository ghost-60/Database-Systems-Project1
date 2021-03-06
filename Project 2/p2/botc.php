
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Dashboard</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    
    <style>
        h3 {
     display: inline-block;
 }
 .circle {
  /* width: 200px;
  height: 200px;
  border-radius: 50%; */
  color: #fff;
  text-align: center;
  background: #000
}
.square {
    color: #fff;
  text-align: center;
  background-color:rgba(0, 0, 0, 0.0);
}
        </style>
    </head>

<body style="background-image: url('img/botc2.jpg');color:#f6f6f6 ">
<h2 style = 'margin-bottom:50px;margin-left:50px;color:#fff'> Townsquare </h2>
<?php
//$stylingdead = style='background-color:green;'
//$stylingvote = style='background-color:red;'
//$stylingtravellers = style='background-color:blue;'
$array = array(
    "<div class='square' style='background-color:green;'>SERCAP</div>",
    "<div class='square' style='background-color:green;'>CHRIS</div>",
    "<div class='square' style='background-color:green;'>VUDOO</div>",
    "<div class='square' style='background-color:white;'>IVY</div>", 
    "<div class='square'>NULL</div>",
    "<div class='square' style='background-color:green;'>OLIVER</div>",
    "<div class='square' style='background-color:green;'>RAIN</div>",
    "<div class='square'>SPOTTER</div>",
    "<div class='square' style='background-color:green;'>SUBTLE</div>",
    "<div class='square' >TEHO</div>",
    "<div class='square' style='background-color:white;'>TOR</div>",
    "<div class='square' style='background-color:green;'>ZYN</div>",
    "<div class='square' style='background-color:green;'>MICHEAL</div>");
$count = count($array);
$i1 = "1";
$i2 = $count-1;

$radius = intval($count/3)*100;
$angle = 2*pi() / $count;
$curangle = 0;
$offset = 50;
for ($x = 0; $i1 <= $i2; $x+=1) {

    if($x == 0) {
        $distance1 = $radius + $offset;
        $query = "<h3 style='margin-left:".$distance1."px;'>".$array['0']."</h3><br>";
        echo $query;
        
    } else {
        $distance1 = $offset+intval($radius *(1-sin($curangle)));
        $distance2 = intval(2*$radius *sin($curangle));
        
        $query1 = "<h3 style='margin-left:".$distance1."px;'>".$array[$i2]."</h3>";
        echo $query1; 
        $query2 = "<h3 style='margin-left:".$distance2."px;'>".$array[$i1]."</h3><br><br><br>";
        if($i1 != $i2) {
            echo $query2;
        }
        $i1 += 1;
        $i2 -= 1;
    }
    $curangle += $angle;
}

?>

</body>

</html>
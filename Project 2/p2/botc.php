
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
    <link rel="stylesheet" href="style3.css" />
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    </head>

<body style="background-color:#2a2a2a;color:#f6f6f6 ">

    <!-- <header>
  <h1>Text</h1>
  <span>text2</span>
</header> -->


<?php
//$stylingdead = style='color:red'
//$stylingvote = style='color:blue'
$array = array("<p>Ghost</p>", "<p style='color:red'>Lynn</p>", "<p>Micheal</p>", "<p style='color:red'>Peter</p>", "<p>Wildtsar</p>");
$count = intval(count($array)/2)-1;
$i1 = "1";
$i2 = count($array)-1;
$check = intval(count($array)/4);
$space1 = 100+ $count*200;
$space2 = 100+$count*200;
$temp = "0";
$adder = "140";
// echo "<h3 style='margin-left:200px;'>".$array['0']."</h3>";
$flag = "0";
for ($x = 0; $i1 <= $i2; $x+=1) {

    if($x == 0) {
        $query = "<h3 style='margin-left:".$space1."px;'>".$array['0']."</h3><br>";
        echo $query;
        
    } else {
        if($i1 == $i2-1) {
            $space1 -= 100;
            $temp+=130;
        }
        $query1 = "<h3 style='margin-left:".$space1."px;'>".$array[$i2]."</h3>";
        echo $query1;
        
        $query2 = "<h3 style='margin-left:".$temp."px;'>".$array[$i1]."</h3><br><br><br>";
        if($i1 != $i2) {
            echo $query2;
        }
        $i1 += 1;
        $i2 -= 1;
    }
    if($space1 == 0) {
        $flag = "1";
    }
    if($x < $check) {
        $space1 -= 150;
        $space2 += 150;
        if($x ==0 ) {
            $temp += 150;
        } else {
            $temp += 250;
        }
        
        $adder += 140;
    } else {
        $space1 +=150;
        $space2 -= 150;
        $temp -= 250;
    }
}
echo $count;
?>

</body>

</html>
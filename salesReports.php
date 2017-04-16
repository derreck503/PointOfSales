<?php
require 'database/connect.php';
?>

<html>

<head>
    <title>Account</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
    <link rel="stylesheet" href="css/custom.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/loadNavBar.js"></script>
    <script src="js/custom.js"></script>
</head>

<body>
    <div id="navigation-bar"></div>

    <!--Table for report-->
    <div class="container-fluid">
        <!--one huge column for the whole container-->
        <div class="col-lg-12">

            <!--tabs navigation-->
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#report1">Sales</a></li>
              <li><a data-toggle="tab" href="#report2">Products</a></li>
            </ul>
            <!--end tabs navigation-->

            <!--tab content-->
            <div class="tab-content">
            <!-- tab 1 -->
            <div id="report1" class="tab-pane fade in active">
                <div class="panel panel-default">
                    <h2>Sales per Year (
                        <?php
                            $year = 2017;
                            if(isset($_POST['salessubmit'])){
                            $year = $_POST['selectedValueSales'];
                            } 
                            echo $year;
                        ?>
                    )</h2>
                    <!-- dropdown menu for Sales -->
                    <div class="dropdown form-group">
                        <form action="" method="post" name="myForm" id="myForm">
                          <table>
                            <tr>
                              <td>
                                <select name="selectedValueSales" class="form-control">
                                  <option>Select Year</option>
                                    <?php
                                        $sql = $db->query("SELECT SaleDate FROM POSDB.Sale ORDER BY SaleDate DESC");
                                        $row = $sql->fetch_array(MYSQLI_ASSOC);
                                        $currentYear = substr($row['SaleDate'],0,4);
                                        $sql = $db->query("SELECT SaleDate FROM POSDB.Sale ORDER BY SaleDate ASC");
                                        $row = $sql->fetch_array(MYSQLI_ASSOC);
                                        $oldestYear = substr($row['SaleDate'],0,4);
                                        echo '<option value="',$currentYear,'" id="selection">',$currentYear,'</option>';
                                        $testYear = $currentYear-1;
                                        while($testYear>$oldestYear){
                                            $sql = $db->query("SELECT SaleDate FROM POSDB.Sale WHERE SaleDate LIKE '".$testYear."%'");
                                            $row = $sql->fetch_array(MYSQLI_ASSOC);
                                            $currentYear=$row['SaleDate'];
                                            if(!is_null($currentYear))
                                            {
                                                $currentYear=substr($row['SaleDate'],0,4);
                                                echo '<option value="',$currentYear,'" id="selection">',$currentYear,'</option>';
                                            }
                                            $currentYear = $testYear;
                                            $testYear = $currentYear-1;
                                        };
                                        echo '<option value="',$oldestYear,'" id="selection">',$oldestYear,'</option>';
                                    ?>
                                </select>
                                <td>
                                  <input type="submit" class="btn btn-primary" name="salessubmit" value="Submit" />
                                </td>
                            </tr>
                          </table>
                        </form>
                    </div>

                    <!-- Sales Chart -->
                    <div id="sales-chart" class="ct-chart ct-major-eleventh"></div>
                </div>
            </div><!--end tab 1-->
            <!-- tab 2 -->
            <div id="report2" class="tab-pane fade in">
                <div class="panel panel-default">
                    <h2>Products by Sales</h2>
                    <hr><div class="col-lg-8">
                    <?php 
                        $sql = $db->query("SELECT ProductName FROM POSDB.Product GROUP BY ProductName");
                        if($sql->num_rows){
                            $products = $sql->fetch_all(MYSQLI_ASSOC);
                        }
                        $productsArray = array();
                        $data = array();
                        foreach($products as $product){
                            $productTotalSales = 0;

                            $sql = $db->query("SELECT ProductID FROM POSDB.Product WHERE ProductName='".$product['ProductName']."'");
                            $productIDs = $sql->fetch_all(MYSQLI_ASSOC);
                            foreach($productIDs as $prID)
                            {
                                $sql = $db->query("SELECT SUM(SaleTotal) as sales FROM POSDB.Sale WHERE ProductID='".$prID['ProductID']."'");
                                $row = $sql->fetch_array(MYSQLI_ASSOC);
                                $productSale = $row['sales'];
                                $productTotalSales = $productTotalSales + $productSale;
                            }
                            $tempArray = array($product['ProductName'],$productTotalSales);
                            array_push($productsArray,$tempArray);
                        }
                        $result = $productsArray[0][1];
                        $index = 0;
                        for($i=0;$i<sizeof($productsArray);$i++)
                        {
                            if($productsArray[$i][1]>$result)
                            {
                                $result = $productsArray[$i][1];
                                $index = $i;
                            }
                        }
                        echo "<div class=\"well productreport\">Best Selling Product ",$productsArray[$index][0]," : ",$productsArray[$index][1],"</div>";
                        echo "<table class=\"table table-bordered table-condensed\"><thead><tr><th style=\"width:20px;\">Product</th><th>Sales</th></tr></thead><tbody>";
                        for($i=0;$i<sizeof($productsArray);$i++)
                        {
                            echo "<tr><td>",$productsArray[$i][0],"</td><td>",$productsArray[$i][1],"</td></tr>";
                        }
                        echo "</tbody></table>";

                    ?>
                    </div>
                    <div class="clearfix"></div>
                    <!--<div id="customer-chart" class="ct-chart ct-double-octave"></div>-->
                </div>
            </div><!--end tab 2-->
            </div> <!--end tab content-->

    </div>

    <script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
    <!-- PHP code for the Sales Chart -->
    <?php
        $year = 2017;
        if(isset($_POST['salessubmit'])){
        $year = $_POST['selectedValueSales'];
        }

        $startDates = array();
        $endDates = array();
        for($i=1;$i<=12;$i++) {
            if($i!=12) {
                if($i<10) {
                    $startDate = "$year.0$i.01";
                    $temp = $i+1;
                    $endDate = "$year.0$temp.01";
                    if($i==9)
                        $endDate = "$year.$temp.01";
                } 
                else {
                    $startDate = "$year.$i.01";
                    $temp = $i+1;
                    $endDate = "$year.$temp.01"; 
                }
            }
            else {
                $startDate = "$year.$i.01";
                $temp = $year+1;
                $endDate = "$temp.01.01";
            }
            array_push($startDates,$startDate);
            array_push($endDates,$endDate);
        }

        $chartValues = array(); 
        for($j=0;$j<12;$j++)
        {
            $startDate = $startDates[$j];
            $endDate = $endDates[$j];
            $qry = "SELECT SUM(SaleTotal) AS 'sales_total' FROM POSDB.Sale WHERE SaleDate >= '".$startDate."' AND SaleDate < '".$endDate."'";
            $sql = $db->query($qry);
            $row = $sql->fetch_array(MYSQLI_ASSOC);
            $value = $row['sales_total'];
            if(is_null($value))
                array_push($chartValues,0);
            else
                array_push($chartValues,$value);
        }
    ?>
    <script>
        //Define chart data

        var salesData = {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          series: [
            <?php echo json_encode($chartValues); ?>
          ]
        };

        var customerData = {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          series: [
            [5, 2, 4, 2, 0, 6, 2, 8, 1, 7, 3, 2]
          ]
        };

        //Create charts

        new Chartist.Bar('#sales-chart', salesData);
        //new Chartist.Bar('#customer-chart', customerData);

        //Needed for when new tabs are selected, so the charts can resize
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            new Chartist.Bar('#sales-chart', salesData);
            //new Chartist.Bar('#customer-chart', customerData);
        });

    </script>
</body>

</html>
<?php
require 'database/connect.php';
session_start();
$employeeID = $_SESSION['Identifier'];
$sql = $db->query("SELECT * FROM POSDB.Employee WHERE EmployeeID=$employeeID");
$row = $sql->fetch_array(MYSQLI_ASSOC);
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

            <!--tabs navigation
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#report1">Sales</a></li>
              <li><a data-toggle="tab" href="#report2">Products</a></li>
            </ul>
            end tabs navigation-->

            <!--tab content-->
            <div class="container-fluid">
            <!-- tab 1 -->
            <div id="report1" class="col-lg-6">
                <div class="panel panel-default">
                    <h2>Sales per Year</h2>
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
                        <h4>Currently selected: <?php
                            $year = 2017;
                            if(isset($_POST['salessubmit'])){
                            $year = $_POST['selectedValueSales'];
                            } 
                            echo $year;
                        ?></h4>
                    </div>

                    <hr>

                    <!-- Sales Chart -->
                    <div id="sales-chart" class="ct-chart ct-major-eleventh"></div>
                </div>
            </div><!--end tab 1-->
            <!-- tab 2 -->
            <div id="report2" class="col-lg-6">
                <div class="panel panel-default">
                    <h2>Product Sales</h2>
                    <hr><div class="col-lg-8">

                    <div class="dropdown form-group">
                        <form action="" method="post" name="myForm" id="myForm">
                          <table>
                            <tr>
                              <td>
                                <select name="selectedMonthProducts" class="form-control">
                                  <option>Select Month</option>
                                  <option value="01" id="selection">January</option>
                                  <option value="02" id="selection">February</option>
                                  <option value="03" id="selection">March</option>
                                  <option value="04" id="selection">April</option>
                                  <option value="05" id="selection">May</option>
                                  <option value="06" id="selection">June</option>
                                  <option value="07" id="selection">July</option>
                                  <option value="08" id="selection">August</option>
                                  <option value="09" id="selection">September</option>
                                  <option value="10" id="selection">October</option>
                                  <option value="11" id="selection">November</option>
                                  <option value="12" id="selection">December</option>
                                </select>
                                <select name="selectedValueProducts" class="form-control">
                                  <option>Select Year</option>
                                    <?php
                                        $sql = $db->query("SELECT SaleDate FROM POSDB.Sale ORDER BY SaleDate DESC");
                                        $row = $sql->fetch_array(MYSQLI_ASSOC);
                                        $currentYearProduct = substr($row['SaleDate'],0,4);
                                        $sql = $db->query("SELECT SaleDate FROM POSDB.Sale ORDER BY SaleDate ASC");
                                        $row = $sql->fetch_array(MYSQLI_ASSOC);
                                        $oldestYearProduct = substr($row['SaleDate'],0,4);
                                        echo '<option value="',$currentYearProduct,'" id="selection">',$currentYearProduct,'</option>';
                                        $testYearProduct = $currentYearProduct-1;
                                        while($testYearProduct>$oldestYearProduct){
                                            $sql = $db->query("SELECT SaleDate FROM POSDB.Sale WHERE SaleDate LIKE '".$testYearProduct."%'");
                                            $row = $sql->fetch_array(MYSQLI_ASSOC);
                                            $currentYearProduct=$row['SaleDate'];
                                            if(!is_null($currentYearProduct))
                                            {
                                                $currentYearProduct=substr($row['SaleDate'],0,4);
                                                echo '<option value="',$currentYearProduct,'" id="selection">',$currentYearProduct,'</option>';
                                            }
                                            $currentYearProduct = $testYearProduct;
                                            $testYearProduct = $currentYearProduct-1;
                                        };
                                        echo '<option value="',$oldestYearProduct,'" id="selection">',$oldestYearProduct,'</option>';
                                    ?>
                                </select>
                                <td>
                                  <input type="submit" class="btn btn-primary" name="productssubmit" value="Submit" />
                                </td>
                            </tr>
                          </table>
                        </form>
                    </div>


                    <hr>
                    <?php 
                        $productYear = 2017;
                        $productMonth = "04"; 
                        if(isset($_POST['productssubmit'])){
                            $productYear = $_POST['selectedValueProducts'];
                            $productMonth = $_POST['selectedMonthProducts'];
                        }

                        echo "<h4>Currently selected: ",$productMonth,".",$productYear,"</h4>";

                        if($productMonth!="12")
                        {
                            $startDateProduct = "$productYear.$productMonth.01";
                            $temp = $productMonth+1;
                            $endDateProduct = "$productYear.0$temp.01";
                        }
                        else
                        {
                            $startDateProduct = "$productYear.$productMonth.01";
                            $temp = $productYear+1;
                            $endDateProduct = "$productYear.01.01";
                        }

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
                                $sql = $db->query("SELECT SUM(SaleTotal) as sales FROM POSDB.Sale WHERE ProductID='".$prID['ProductID']."' AND SaleDate >= '".$startDateProduct."' AND SaleDate < '".$endDateProduct."'");
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
                        echo "<div class=\"well productreport\">Best Selling Product<br>",$productsArray[$index][0]," : ",'$',$productsArray[$index][1],"</div>";
                        echo "<table class=\"table table-bordered table-condensed\"><thead><tr><th style=\"width:20px;\">Product</th><th>Sales</th></tr></thead><tbody>";
                        for($i=0;$i<sizeof($productsArray);$i++)
                        {
                            echo "<tr><td>",$productsArray[$i][0],"</td><td>",'$',$productsArray[$i][1],"</td></tr>";
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
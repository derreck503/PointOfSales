<?php
error_reporting(0);
require 'database/connect.php';
echo 'Success';
?>

<html>

<head>
    <title>Suppliers Details</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
            <h2>Suppliers Details</h2>
        <hr>
            <!--Dropdown bar-->
            <div class="well">
            <div class="dropdown form-group">
                <label for="selectProduct">Select product from dropdown:</label>
                <select class="form-control" id="selectProduct">
                <option value="volvo">Select a Product</option>
                <option value="volvo">Baby Shoes</option>
                <option value="saab">Baby Shirt</option>
                <option value="vw">Baby Toy</option>
                <option value="audi" selected>Baby Food</option>
                </select>
            </div>
            <hr>

            <!-- search bar -->
            <label for="selectProduct">Search for product:</label>
            <form role="form" id="searchProduct">
                <div class="input" >
                    <input type="text" class="form-control" placeholder="Type a product">
                    <br>
                    <button type="button" class="btn btn-primary">Search</button>
                </div>
            </form>
            </div>

            <h4>Suppliers for &lt;selected product&gt;</h4>
            <!-- table of search results -->
            <table class="table table-bordered table-condensed">
                <!--Head means title columns-->
                <thead>
                    <tr>
                        <th>SupplierID</th>
                        <th>Company Name</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Postal Code</th>
                        <th>Country</th>
                        <th>Phone</th>
                        <th>Re-StockLevel</th>
                        <th>Country</th>
                    </tr>
                </thead>
                <!--Each tr is a row and td is a cell for each column-->
                <tbody>
                    <?php
                    $query = $db->query("SELECT * FROM POSDB.Supplier");
                    if($count = $query->num_rows){
                        $rows = $query->fetch_all(MYSQLI_ASSOC);
                        foreach($rows as $row){
                            //echo $row['CompanyName'], '<br>';
                    echo'<tr>';
                        echo'<td>', $row['SupplierID'],'</td>';
                        echo'<td>', $row['CompanyName'],'</td>';
                        echo'<td>', $row['Address'],'</td>';
                        echo'<td>', $row['City'],'</td>';
                        echo'<td>', $row['State'],'</td>';
                        echo'<td>', $row['PostalCode'],'</td>';
                        echo'<td>', $row['Country'],'</td>';
                        echo'<td>', $row['Phone'],'</td>';
                        echo'<td>', $row['ReStockLevel'],'</td>';
                        echo'<td>', $row['UnitCost'],'</td>';
                    echo'</tr>';
                                        }
                                        }
                        ?>
                </tbody>
            </table>
            <?php
            $sql=mysql_query("SELECT SupplierID,CompanyName FROM POSDB.Supplier");
            if(mysql_num_rows($sql)){
            $select= '<select name="select">';
            while($rs=mysql_fetch_array($sql)){
                $select.='<option value="'.$rs['SupplierID'].'">'.$rs['CompanyName'].'</option>';
                }
            }
                $select.='</select>';
                echo $select;
            ?>
        </div>
    </div>
</div>
</body>

</html>
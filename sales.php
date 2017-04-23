<?php
require 'database/connect.php';
session_start();
$employeeID = $_SESSION['Identifier'];
$sql = $db->query("SELECT * FROM POSDB.Employee WHERE EmployeeID=$employeeID");
$row = $sql->fetch_array(MYSQLI_ASSOC);
?>
<html>

<head>
    <title>Sales</title>
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
    <script src="js/showAllSales.js"></script>
    <script src="js/showEmployeeSales.js"></script>
</head>

<body>
    <div id="navigation-bar"></div>

    <!--Table for report-->
    <div class="container-fluid">
        <!--8 column width for the sales register container-->
        <div class="col-lg-12">
            <h2>Sales Details</h2>
        <hr>
            <!--search bar-->
            <div class="well">
                <!--Show All Button-->
                <button type="button" class="btn btn-primary" onclick="showAll();">Show all Sales</button>
                <hr>
                <!--Show sales by employee-->
                <div class="dropdown form-group">
                <form action="" method="post" name="myForm" id="myForm">
                <table>
                    <tr>
                    <td>
                        <select name="selectedValue" class="form-control">
                        <option>Select an Employee</option>
                        <?php
                                $sql = $db->query("SELECT *  FROM POSDB.Employee");
                                if($sql->num_rows){
                                    $suppliers = $sql->fetch_all(MYSQLI_ASSOC);
                                    foreach($suppliers as $sup){
                                        echo '<option value="',$sup['EmployeeID'],'" id="selection">',$sup['FirstName'],' ',$sup['LastName'],'</option>';
                                    }
                                }
                                ?>
                        </select>
                        <td>
                        <input type="submit" class="btn btn-primary" name="submit" value="Show" />
                        </td>
                    </tr>
                </table>
                </form>
            </div>
            </div>

            <!-- Table for showing all Sales -->

        <table class="table table-striped" id="showAllSales" style="display:none">
          <!--Head means title columns-->
          <thead>
            <tr>
              <th>SaleID</th>
              <th>Employee</th>
              <th>Customer</th>
              <th>Product</th>
              <th>Sale Date</th>
              <th>Quantity Sold</th>
              <th>Sale Total</th>
            </tr>
          </thead>
          <!--Each tr is a row and td is a cell for each column-->
          <tbody>
            <?php
                $query = $db->query("SELECT Sale.SaleID, Employee.EmployeeID, Customer.CustomerID, Product.ProductName, Sale.SaleDate, Sale.Qty, Sale.SaleTotal, Customer.FirstName as cFName, Customer.LastName as cLName, Employee.FirstName as eFName,Employee.LastName as eLName FROM Sale, Employee, Customer, Product WHERE Sale.EmployeeID = Employee.EmployeeID AND Sale.CustomerID = Customer.CustomerID AND Sale.ProductID = Product.ProductID");
                if($count = $query->num_rows){
                    $rows = $query->fetch_all(MYSQLI_ASSOC);
                    foreach($rows as $row){
                        echo'<tr>';
                        echo'<td>', $row['SaleID'],'</td>';
                        echo'<td>', $row['eFName'], ' ',$row['eLName'],'</td>';
                        echo'<td>', $row['cFName'], ' ',$row['cLName'], '</td>';
                        echo'<td>', $row['ProductName'],'</td>';
                        echo'<td>', $row['SaleDate'],'</td>';
                        echo'<td>', $row['Qty'],'</td>';
                        echo'<td>', $row['SaleTotal'],'</td>';
                        echo'</tr>';
                    }
                }
                ?>
          </tbody>
        </table>


        <!--Table for showing certain employee sales-->
        <table class="table table-striped" id="showEmployeeSale" style="display:none">
          <!--Head means title columns-->
          <thead>
            <tr>
              <th>SaleID</th>
              <th>EmployeeID</th>
              <th>CustomerID</th>
              <th>ProductID</th>
              <th>SaleDate</th>
              <th>Quantity Sold</th>
              <th>Sale Total</th>
            </tr>
          </thead>
          <!--Each tr is a row and td is a cell for each column-->
          <tbody>
            <?php
                if(isset($_POST['submit'])){
                    $selection = $_POST['selectedValue'];
                    echo "<script> employeeSales(); </script>";
                }
                $query = $db->query("SELECT Sale.SaleID, Employee.FirstName AS eFName, Employee.LastName AS eLName, Customer.FirstName AS cFName, Customer.LastName AS cLName, Product.ProductName, Sale.SaleDate, Sale.Qty, Sale.SaleTotal
                FROM Sale 
                INNER JOIN Employee ON Sale.EmployeeID = Employee.EmployeeID
                INNER JOIN Customer ON Sale.CustomerID = Customer.CustomerID
                INNER JOIN Product ON Sale.ProductID = Product.ProductID
                WHERE Sale.EmployeeID = $selection
                ORDER BY Sale.SaleDate DESC");
                if($count = $query->num_rows){
                    $rows = $query->fetch_all(MYSQLI_ASSOC);
                    foreach($rows as $row){
                        echo'<tr>';
                        echo'<td>', $row['SaleID'],'</td>';
                        echo'<td>', $row['eFName'], ' ',$row['eLName'],'</td>';
                        echo'<td>', $row['cFName'], ' ',$row['cLName'], '</td>';
                        echo'<td>', $row['ProductName'],'</td>';
                        echo'<td>', $row['SaleDate'],'</td>';
                        echo'<td>', $row['Qty'],'</td>';
                        echo'<td>', $row['SaleTotal'],'</td>';
                        echo'</tr>';
                    }
                }
                ?>
          </tbody>
        </table>
        </div>
    </div>
</body>

</html>
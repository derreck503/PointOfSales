<?php
require 'database/connect.php';
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
    <script src="js/showAllSuppliers.js"></script>
    <script src="js/showSuppliers.js"></script>
  </head>

  <body>
    <div id="navigation-bar"></div>
    <!--Table for report-->
    <div class="container-fluid">
      <!--one huge column for the whole container-->
      <div class="col-lg-12">
        <div class="well">
          <!--Show All Suppliers-->
          <button type="button" class="btn btn-primary" onclick="showAll();">Show all suppliers</button>
          <hr>
          <!--Select Supplier from dropdown-->
          <div class="dropdown form-group">
            <form action="" method="post" name="myForm" id="myForm">
              <table>
                <tr>
                  <td>
                    <select name="selectedValue" class="form-control">
                    <option>Select a supplier</option>
                      <?php
                        $sql = $db->query("SELECT CompanyName, SupplierID FROM POSDB.Supplier");
                        if($sql->num_rows){
                            $suppliers = $sql->fetch_all(MYSQLI_ASSOC);
                            foreach($suppliers as $sup){
                                echo '<option value="',$sup['SupplierID'],'" id="selection">',$sup['CompanyName'],'</option>';
                            }
                        }
                        ?>
                    </select>
                  <td>
                    <input type="submit" class="btn btn-primary" name="submit" value="Submit"/>
                  </td>
                </tr>
              </table>
            </form>
          </div>
        </div>

          <!-- Table for showing all Suppliers -->
          <table class="table table-bordered table-condensed" id="showAllSuppliers" style="display:none">
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
                    }
                }
                ?>
            </tbody>
          </table>

          <!--Table for showing certain supplier -->
          <table class="table table-bordered table-condensed" id="showSupplier" style="display:none">
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
                if(isset($_POST['submit'])){
                    $selection = $_POST['selectedValue'];
                    echo "<script> showSupplier(); </script>"; 
                }
                $query = $db->query("SELECT * FROM POSDB.Supplier Where SupplierID = $selection");
                if($count = $query->num_rows){
                    $rows = $query->fetch_all(MYSQLI_ASSOC);
                    foreach($rows as $row){
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
                    }
                }
                ?>
            </tbody>
          </table>
        </div>
      </div>
  </body>

  </html>
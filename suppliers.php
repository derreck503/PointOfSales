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
          <!--Show All Suppliers Button-->
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
                      <input type="submit" class="btn btn-primary" name="submit" value="Submit" />
                    </td>
                </tr>
              </table>
            </form>
          </div>
          <hr>
          <!--Delete a Supplier from dropdown-->
          <div class="dropdown form-group">
            <form action="" method="post" name="myForm" id="myForm">
              <table>
                <tr>
                  <td>
                    <select name="selectedDeleteValue" class="form-control">
                      <option>Select a supplier to Delete</option>
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
                      <input type="submit" class="btn btn-primary" name="Delete" value="Delete" />
                    </td>
                </tr>
              </table>
            </form>
            <?php
                if(isset($_POST['Delete'])){
                    $deletion = $_POST['selectedDeleteValue'];
                    echo "Deleted ";
                    echo $deletion;
                    $delete = $db->query("DELETE FROM POSDB.Supplier Where SupplierID = $deletion");
                    $result = mysql_query($delete);
                    //Need to refresh page to not show deleted value in dropdown menu anymore!!!!!
                    //header("Refresh:0");
                }
                ?>
          </div>
          <hr>
          <h4>Add a Supplier:</h4>
          <!--Create a Supplier-->
          <form action="" method="post">
            <p>
            <label for="SupplierID">SupplierID: </label>
              <input type="text" name="SupplierID" id="SupplierID">
              <label for="CompanyName">Company Name: </label>
              <input type="text" name="CompanyName" id="CompanyName">
              <label for="Address">Address: </label>
              <input type="text" name="Address" id="Address">
              <label for="City">City: </label>
              <input type="text" name="City" id="City">
              <label for="State">State: </label>
              <input type="text" name="State" id="State">
              <label for="PostalCode">Postal Code: </label>
              <input type="text" name="PostalCode" id="PostalCode">
              <label for="Country">Country: </label>
              <input type="text" name="Country" id="Country">
              <label for="Phone">Phone: </label>
              <input type="text" name="Phone" id="Phone">
              <label for="Re-StockLevel">Re-StockLevel: </label>
              <input type="text" name="Re-StockLevel" id="Re-StockLevel">
              <label for="UnitCost">Unit Cost: </label>
              <input type="text" name="UnitCost" id="UnitCost">
            <input type="submit" name="Create" value="Create" class="btn btn-primary">
          </form>
          <?php
            if(isset($_POST['Create'])){
                $sID = $_POST['SupplierID'];
                $cName = $_POST['CompanyName'];
                $address = $_POST['Address'];
                $city = $_POST['City'];
                $state = $_POST['State'];
                $postalCode = $_POST['PostalCode'];
                $country = $_POST['Country'];
                $phone = $_POST['Phone'];
                $reStockLevel = $_POST['Re-StockLevel'];
                $unitCost = $_POST['UnitCost'];

                $create = $db->query("INSERT INTO POSDB.Supplier (`SupplierID`, `CompanyName`, `Address`, `City`, `State`, `PostalCode`, `Country`, `Phone`, `ReStockLevel`, `UnitCost`) VALUES(0, '$cName', '$address', '$city', '$state', '$postalCode', '$country', '$phone', $reStockLevel, $unitCost)");

                $results = mysql_query($create);
            }
          ?>
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
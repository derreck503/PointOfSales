<?php
require 'database/connect.php';
?>

<html>

<html>

<head>
    <title>Inventory</title>
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
    <script src="js/showProduct.js"></script>
    <script src="js/showProducts.js"></script>

    <style type="text/css">
        .product .form-control {
            display: inline-block;
            width: 50%;
        }
        .product label {
            width: 8%;
        }
    </style>
</head>

<body>
    <div id="navigation-bar"></div>

    <!--Table for report-->
    <div class="container-fluid">

        <!-- Modal for trigger -->
        <div class="modal" id="modalWarnings" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title" id="myModalLabel">Low Inventory Warning</h3>
                    </div>
                    <div class="modal-body">
                        <p>The following products have low inventory levels. Please restock.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal -->

        <!--one huge column for the whole container-->
        <div class="col-lg-12">
        <h2>Inventory Details</h2>
        <hr>
        <!--search bar for products-->
        <div class="well">
          <!--Show All Inventory Button-->
          <button type="button" class="btn btn-primary" onclick="showAll();">Show all Inventory</button>
          <hr>
          <!--Select Inventroy from dropdown-->
          <div class="dropdown form-group">
            <form action="" method="post" name="myForm" id="myForm">
              <table>
                <tr>
                  <td>
                    <select name="selectedValue" class="form-control">
                      <option>Select a Product</option>
                      <?php
                            $sql = $db->query("SELECT ProductID, ProductName FROM POSDB.Product");
                            if($sql->num_rows){
                                $suppliers = $sql->fetch_all(MYSQLI_ASSOC);
                                foreach($suppliers as $sup){
                                    echo '<option value="',$sup['ProductID'],'" id="selection">',$sup['ProductName'],'</option>';
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
            <!--Delete a Inventory from dropdown-->
          <div class="dropdown form-group">
            <form action="" method="post" name="myForm" id="myForm">
              <table>
                <tr>
                  <td>
                    <select name="selectedDeleteValue" class="form-control">
                      <option>Select a supplier to Delete</option>
                      <?php
                        $sql = $db->query("SELECT ProductName, ProductID FROM POSDB.Product");
                        if($sql->num_rows){
                            $suppliers = $sql->fetch_all(MYSQLI_ASSOC);
                            foreach($suppliers as $sup){
                                echo '<option value="',$sup['ProductID'],'" id="selection">',$sup['ProductName'],'</option>';
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
                    $delete = $db->query("DELETE FROM POSDB.Product Where ProductID = $deletion");
                    $result = mysql_query($delete);
                    //Need to refresh page to not show deleted value in dropdown menu anymore!!!!!
                    //header("Refresh:0");
                }
                ?>
          </div>
          <hr>
          <!--Add a Product-->
          <h4>Add a Product:</h4>
          <form class="product" action="" method="post">
            <p>
              <label for="ProductName">Product Name: </label>
              <input type="text" class="form-control" name="ProductName" id="ProductName"><br>
              <label for="Supplier">Supplier: </label>
              <input type="text" class="form-control" name="Supplier" id="Supplier"><br>
              <label for="ProductDetail">Product Detail: </label>
              <input type="text" class="form-control" name="ProductDetail" id="ProductDetail"><br>
              <label for="Category">Category: </label>
              <input type="text" class="form-control" name="Category" id="Category"><br>
              <label for="Quantity">Quantity: </label>
              <input type="text" class="form-control" name="Quantity" id="Quantity"><br>
              <label for="UnitPrice">UnitPrice: </label>
              <input type="text" class="form-control" name="UnitPrice" id="UnitPrice"><br>
              <br>
            <input type="submit" name="Create" value="Create" class="btn btn-primary">
          </form>
          <?php
            if(isset($_POST['Create'])){
                $PName = $_POST['ProductName'];
                $supplier = $_POST['Supplier'];
                $productDetail = $_POST['ProductDetail'];
                $category = $_POST['Category'];
                $quantity = $_POST['Quantity'];
                $unitPrice = $_POST['UnitPrice'];

                $create = $db->query("INSERT INTO POSDB.Product (`ProductID`, `ProductName`, `SupplierID`, `ProductDetail`, `QtyInStock`, `UnitPrice`) VALUES(0, '$PName', '$supplier', '$productDetail', '$category', '$quantity', '$unitPrice')");

                $results = mysql_query($create);
            }
          ?>
        </div>
      <!-- Table for showing all products -->
        <table class="table table-striped" id="showAllProducts" style="display:none">
          <!--Head means title columns-->
          <thead>
            <tr>
              <th>ProductID</th>
              <th>Product Name</th>
              <th>Supplier</th>
              <th>Product Details</th>
              <th>Category</th>
              <th>Qty In Stock</th>
              <th>Unit Stock</th>
            </tr>
          </thead>
          <!--Each tr is a row and td is a cell for each column-->
          <tbody>
            <?php
                $query = $db->query("SELECT * FROM POSDB.Product");
                if($count = $query->num_rows){
                    $rows = $query->fetch_all(MYSQLI_ASSOC);
                    foreach($rows as $row){
                        echo'<tr>';
                        echo'<td>', $row['ProductID'],'</td>';
                        echo'<td>', $row['ProductName'],'</td>';
                        echo'<td>', $row['SupplierID'],'</td>';
                        echo'<td>', $row['ProductDetailID'],'</td>';
                        echo'<td>', $row['Category'],'</td>';
                        echo'<td>', $row['QtyInStock'],'</td>';
                        echo'<td>', $row['UnitPrice'],'</td>';
                        echo'</tr>';
                    }
                }
                ?>
          </tbody>
        </table>

        <!--Table for showing certain product -->
        <table class="table table-striped" id="showProduct" style="display:none">
          <!--Head means title columns-->
          <thead>
            <tr>
              <th>ProductID</th>
              <th>Product Name</th>
              <th>Supplier</th>
              <th>Product Details</th>
              <th>Category</th>
              <th>Qty In Stock</th>
              <th>Unit Stock</th>
            </tr>
          </thead>
          <!--Each tr is a row and td is a cell for each column-->
          <tbody>
            <?php
                if(isset($_POST['submit'])){
                    $selection = $_POST['selectedValue'];
                    echo "<script> showProduct(); </script>";
                }
                $query = $db->query("SELECT * FROM POSDB.Product Where ProductID = $selection");
                if($count = $query->num_rows){
                    $rows = $query->fetch_all(MYSQLI_ASSOC);
                    foreach($rows as $row){
                        echo'<tr>';
                        echo'<td>', $row['ProductID'],'</td>';
                        echo'<td>', $row['ProductName'],'</td>';
                        echo'<td>', $row['SupplierID'],'</td>';
                        echo'<td>', $row['ProductDetailID'],'</td>';
                        echo'<td>', $row['Category'],'</td>';
                        echo'<td>', $row['QtyInStock'],'</td>';
                        echo'<td>', $row['UnitPrice'],'</td>';
                        echo'</tr>';
                    }
                }
                ?>
          </tbody>
        </table>

           </div>
    </div>
</div>
</body>

</html>
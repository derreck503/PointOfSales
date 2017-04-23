<?php
require 'database/connect.php';
session_start();
$employeeID = $_SESSION['Identifier'];
$sql = $db->query("SELECT * FROM POSDB.Employee WHERE EmployeeID=$employeeID");
$row = $sql->fetch_array(MYSQLI_ASSOC);
?>

<html>

<head>
    <title>Dashboard</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/loadNavBar.js"></script>
    <link rel="stylesheet" href="css/custom.css">
    <script src="js/custom.js"></script>
</head>



<body>
    <div id="navigation-bar"></div>

    <!--Table for report-->
    <div class="container-fluid">
    	<div class="row">
    		<div class="col-md-3" style="text-align:center;">
               <h2>Welcome back,</h2>
			   <?php
			   session_start();
				$employeeID = $_SESSION['Identifier'];
				$sql = $db->query("SELECT EmployeeID, FirstName, LastName FROM POSDB.Employee");
					if($sql->num_rows){
					$EmployeeLogins = $sql->fetch_all(MYSQLI_ASSOC);
					foreach($EmployeeLogins as $EInfo){
					if ($EInfo['EmployeeID'] == $employeeID ) {
						$Name = $EInfo['FirstName'];
						$EmployeeIDSale = $EInfo['EmployeeID'];
						echo '<h1>',$Name,'!</h1>';
						}
					}
					}
				?>
	    	</div>
	    	<div class="col-md-3 col-xs-4">
	    	<div class="well">
	    		<div class="container-fluid">
		    		<span class="col-md-4 visible-md-block visible-lg-block glyphicon glyphicon-user" style="font-size:60px; color:#64b5f6; padding-top:30px; padding-bottom:20px;"></span>
		    		<span class="col-xs-12 col-md-8">
						<h1><?php
						$sql11 = $db->query("SELECT SUM(SaleTotal) AS 'salesTotal' FROM POSDB.Sale WHERE EmployeeID = $EmployeeIDSale");
						$rowz = $sql11->fetch_array(MYSQLI_ASSOC);	
						echo round($rowz['salesTotal'], 2);					
						?></h1>
			    		<h4>Your Sales</h4>
			    	</span>
		    	</div>
		    </div>
	    	</div>
	    	<div class="col-md-3 col-xs-4">
	    	<div class="well">
	    		<div class="container-fluid">
	    		<span class="col-md-4 visible-md-block visible-lg-block glyphicon glyphicon-piggy-bank" style="font-size:60px; color:#e57373; padding-top:30px; padding-bottom:20px;"></span>
	    		<span class="col-xs-12 col-md-8">
	    			<h1>$<?php
						$sql = $db->query("SELECT SUM(SaleTotal) AS 'sales_total' FROM POSDB.Sale");
						$row = $sql->fetch_array(MYSQLI_ASSOC);	
						echo round($row['sales_total'], 2);					
						?></h1>
		    		<h4>Total Sales</h4>
	    		</span>
	    		</div>
	    	</div>	
	    	</div>
	    	<div class="col-md-3 col-xs-4">
	    	<div class="well">
	    		<div class="container-fluid">
	    		<span class="col-md-4 visible-md-block visible-lg-block glyphicon glyphicon-shopping-cart" style="font-size:60px; color:#ffbb33; padding-top:30px; padding-bottom:20px;"></span>
		    	<span class="col-xs-12 col-md-8">
		    		<h1><?php
						$sql = $db->query("SELECT COUNT(*) AS 'members_total' FROM POSDB.Customer WHERE Membership='1'");
						$row = $sql->fetch_array(MYSQLI_ASSOC);	
						echo $row['members_total'];					
						?></h1>
		    		<h4>Club Members</h4>
		    	</span>
	    		</div>
    		</div>
    		</div>
    	<div class="row">
	    	<div class="col-md-8" style="text-align:center;">
		    	<hr>
		    	<h2>Sales Register</h2>
	    	</div>
    	</div>
        <!--8 column width for the left container-->
        <div class="col-md-8">
            <row>
            <div class="well">
				<!--Select Customer from dropdown-->
				<div class="dropdown form-group">
					<form action="" method="post" name="myForm" id="myForm">
					<table>
						<tr>
						<td>
							<select name="selectedValue" class="form-control">
							<option>Select a Customer</option>
							<?php
									$sql = $db->query("SELECT FirstName, LastName, CustomerID FROM POSDB.Customer");
									if($sql->num_rows){
										$suppliers = $sql->fetch_all(MYSQLI_ASSOC);
										foreach($suppliers as $sup){
											echo '<option value="',$sup['CustomerID'],'" id="selection">',$sup['FirstName'],' ',$sup['LastName'],'</option>';
										}
									}
									?>
							</select>
							<td>
							<input type="submit" class="btn btn-primary" name="CustomerSelect" value="Select Customer" />
							</td>
						</tr>
					</table>
					</form>
				</div>

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
                                    echo '<option value="',$sup['ProductName'],'" id="selection">',$sup['ProductName'],'</option>';
                                }
                            }
                            ?>
                    </select>
                    <td>
                      <input type="submit" class="btn btn-primary" name="submit" value="Add to Cart" />
                    </td>
                </tr>
              </table>
            </form>
          </div>
          

		  <!--Clear Cart-->
			<form action="" method="post" name="myForm" id="myForm">
                        <input type="submit" class="btn btn-primary" name="ClearCart" value="Clear Cart" />
                </form>

					<?php
					if(isset($_POST['ClearCart'])){
					$_SESSION['cart'] = array();
					}
					?>

		  <!--Checkout Cart-->
			<form action="" method="post" name="myForm1" id="myForm1">
                        <input type="submit" class="btn btn-primary" name="checkOutCart" value="Checkout Cart" />
                </form>

					<?php
					if(isset($_POST['checkOutCart'])){
					//$_SESSION['cart'] = array();
					echo "Cart has been checkedout!";
					foreach($_SESSION['cart'] as $rows){
						//echo'<br>Data: ';
						//echo $rows;
						$query1 = $db->query("SELECT ProductName FROM POSDB.Product WHERE ProductID = $rows");
						$productId = mysql_query($query1);
						//echo 'product Id: ';
						//echo $productId;
						$create = $db->query("INSERT INTO POSDB.Sale (`SaleID`, `EmployeeID`,`CustomerID`, `ProductID`, `SaleDate`, `Qty`, `SaleTotal`) VALUES(0, 1, 1, $rows,'2017-04-15', 1, 5)");
	                	$results = mysql_query($create);
					}
					}
					?>
					
					<hr>

			 <!--Checkout Table-->
			 <h2>Checkout Cart:</h2>
			  <table class="table table-striped" id="showCart" style="display:block">
				<!--Head means title columns-->
				<thead>
					<tr>
					<th>Product Name</th>
					<th>Qty In Stock</th>
					<th>Price</th>
					</tr>
				</thead>
				<!--Each tr is a row and td is a cell for each column-->
				<tbody>
			<?php
 				if(isset($_POST['submit'])){
                    $selection = $_POST['selectedValue'];
					if(empty($_SESSION['cart'])){
					$_SESSION['cart'] = array();
					}
                    $myArr = array();
					//$myArr = array("Baby Shoes","Baby shirt","Diapers");
					//$myArr[] = $selection;
					array_push($_SESSION['cart'], $selection);
					//$arrlength = count($cart);
					foreach($_SESSION['cart'] as $rows){
						echo'<tr>';
						echo'<td>',$rows,'</td>';
						echo'<td>5</td>';
						echo'<td>5</td>';
						echo'</tr>';
					}
					
					$eName = "1";
					$cID = "1";
					$listOfProducts = implode(',',$_SESSION['cart']);
                }
		  ?>
				</tbody>
				</table>

            </row>
		</div>			
        </div>
        <!--4 column width for the News container-->
        <div class="col-md-4">
            <row>
            <div class="well">
                <h2>News:</h2>
					<ul>
						<li><h4>NewBorn Outlet is projected to hit its April sales goal 5 days early!</h4></li>
						<li><h4>Company picnic is this upcomming Saturday!</h4></li>
						<li><h4>All timesheets are due this 4/2
					</ul>
               </div>
            </row>
        </div>
    </div>
</body>

</html>
<?php
require 'database/connect.php';
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
               <h1>&lt;Employee Name&gt;</h1>
	    	</div>
	    	<div class="col-md-3 col-xs-4">
	    	<div class="well">
	    		<div class="container-fluid">
		    		<span class="col-md-4 visible-md-block visible-lg-block glyphicon glyphicon-user" style="font-size:60px; color:#64b5f6; padding-top:30px; padding-bottom:20px;"></span>
		    		<span class="col-xs-12 col-md-8">
			    		<h1>$200.00</h1>
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
						echo $row['sales_total'];					
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
            	<table class="table table-bordered table-condensed">
	            	<thead>
	                    <tr>
	                        <th>Product</th>
	                        <th>Color</th>
	                        <th>Size</th>
	                        <th>Quantity</th>
	                    </tr>
	                </thead>
	                <tbody>
	                	<tr>
	                		<td>
	                			<div class="dropdown">
				                <select class="form-control product">
				                <option value="volvo">Baby Shoes</option>
				                <option value="saab">Baby Shirt</option>
				                <option value="vw">Baby Toy</option>
				                <option value="audi" >Baby Food</option>
				                </select>
				            	</div>
	                		</td>
	                		<td>
	                			<div class="dropdown">
				                <select class="form-control color" disabled>
				                <option value="volvo">Blue</option>
				                <option value="saab">Yellow</option>
				            	</div>
	                		</td>
	                		<td>
	                			<div class="dropdown">
				                <select class="form-control size" disabled>
				                <option value="volvo">XS</option>
				                <option value="saab">S</option>
				                <option value="vw">M</option>
				                <option value="audi" >L</option>
				                </select>
				            	</div>
	                		</td>
	                		<td class="col-md-3">
	                			<div class="dropdown">
				                <select class="form-control quantity" disabled>
				                <option value="volvo">0</option>
				                <option value="saab">1</option>
				                <option value="vw">2</option>
				                <option value="audi" >3</option>
				                </select>
				            	</div>
	                		</td>
	                	</tr>
	                	<tr id="insert"></tr>
	                	<tr>
	                		<td colspan="4" align="center">
	                			<button class="btn btn-default"><span class="glyphicon glyphicon-plus"></span></button>
	                		</td>
	                	</tr>
	                </tbody>
            	</table>
                <h4>Customer Details</h4>
                <p>Search for customer in database or</p>
                <p>Enter new details</p>
             </div>
            </row>
        </div>
        <!--4 column width for the right container-->
        <div class="col-md-4">
            <row>
            <div class="well">
                <h2>News:</h2>
                <p>Sample text Sample text Sample text Sample text Sample text Sample text Sample text Sample text Sample text
                    Sample text Sample text Sample text Sample text Sample text
                </p>
               </div>
            </row>
        </div>
    </div>
</body>

</html>
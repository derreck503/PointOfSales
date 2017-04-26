<?php
require 'database/connect.php';
session_start();
$employeeID = $_SESSION['Identifier'];
$sql = $db->query("SELECT * FROM POSDB.Employee WHERE EmployeeID=$employeeID");
$row = $sql->fetch_array(MYSQLI_ASSOC);
?>
<html>

<head>
    <title>Customers</title>
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
    <script src="js/showAllCustomers.js"></script>
    <script src="js/showCustomer.js"></script>
    <script src="js/reload.js"></script>

    <style type="text/css">
        .customers .form-control {
            display: inline-block;
            width: 50%;
        }
        .customers label {
            width: 8%;
        }
    </style>
</head>

<body>
    <div id="navigation-bar"></div>

    <!--Table for report-->
    <div class="container-fluid">
        <!--one huge column for the whole container-->
        <div class="col-lg-12">
            <h2>Customer Details</h2>
            <hr>
            <!--search bar-->
            <div class="well">
            <!--Show All Button-->
                <button type="button" class="btn btn-primary" onclick="showAllCustomersTable();">Show all Customers</button>
                <hr>
                <!--Search for customer -->
                <form action="" method="post" name="myForm" id="myForm">
                    <input type="text" class="form-control" name ="customerName" placeholder="Search for customer">
                    <input type="submit" class="btn btn-primary" name="search"></button>
                </form>
                <hr>
            <h4>Add a Customer:</h4>
            <!--Add a customer-->
            <form class="customers" action="" method="post">
              <label for="LastName">Last Name: </label>
              <input class="form-control" type="text" name="LastName" id="LastName"><br>
              <label for="FirstName">First Name: </label>
              <input class="form-control" type="text" name="FirstName" id="FirstName"><br>
              <label for="Address">Address: </label>
              <input class="form-control" type="text" name="Address" id="Address"><br>
              <label for="City">City: </label>
              <input class="form-control" type="text" name="City" id="City"><br>
              <label for="PostalCode">Postal Code: </label>
              <input class="form-control" type="text" name="PostalCode" id="PostalCode"><br>
              <label for="Country">Country: </label>
              <input class="form-control" type="text" name="Country" id="Country"><br>
              <label for="Phone">Phone: </label>
              <input class="form-control" type="text" name="Phone" id="Phone"><br>
              <label for="Email">Email: </label>
              <input class="form-control" type="text" name="Email" id="Email"><br>
              <label for="Membership">Membership: </label>
              <input class="form-control" type="text" name="Membership" id="Membership"><br>
            <input type="submit" name="Create" value="Create" class="btn btn-primary">
          </form>
          <?php
            if(isset($_POST['Create'])){
                $LName = $_POST['LastName'];
                $FName = $_POST['FirstName'];
                $address = $_POST['Address'];
                $city = $_POST['City'];
                $postalCode = $_POST['PostalCode'];
                $country = $_POST['Country'];
                $phone = $_POST['Phone'];
                $email = $_POST['Email'];
                $membership = 1;
                $value = $_POST['Membership'];

                $create = $db->query("INSERT INTO POSDB.Customer (`CustomerID`, `LastName`, `FirstName`, `Address`, `City`, `PostalCode`, `Country`, `Phone`, `Email`, `Membership`) VALUES (0, '$LName', '$FName','$address', '$city', '$postalCode', '$country', '$phone', '$email', $membership)");
                $results = mysql_query($create);
                
                echo '<script type="text/javascript">','reloadPage();','</script>';
            }
          ?>
            <hr>
            <!--Delete a customer-->
            <div class="dropdown form-group">
            <form action="" method="post" name="myForm" id="myForm">
              <table>
                <tr>
                  <td>
                    <select name="selectedDeleteValue" class="form-control">
                      <option>Select a Customer to Delete</option>
                      <?php
                        $sql = $db->query("SELECT FirstName, LastName, CustomerID FROM POSDB.Customer");
                        if($sql->num_rows){
                            $suppliers = $sql->fetch_all(MYSQLI_ASSOC);
                            foreach($suppliers as $sup){
                               echo '<option value="',$sup['CustomerID'],'" id="selection">',$sup['FirstName'],' ', $sup['LastName'],'</option>';
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
                    $delete = $db->query("DELETE FROM POSDB.Customer Where CustomerID = $deletion");
                    $result = mysql_query($delete);
                    //Need to refresh page to not show deleted value in dropdown menu anymore!!!!!
                    //header("Refresh:0");
                    //header('location:customers.php');
                    echo '<script type="text/javascript">','reloadPage();','</script>';
                }
                ?>
            </div>

            <!-- table of all Customers -->
            <table class="table table-striped" id="showAllCustomerResults" style="display:none">
                <!--Head means title columns-->
                <thead>
                    <tr>
                        <th>CustomerID</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Postal</th>
                        <th>Country</th>
                        <th>Phone #</th>
                        <th>Email</th>
                        <th>Club Member</th>
                    </tr>
                </thead>
                <!--Each tr is a row and td is a cell for each column-->
                <tbody>
                    <?php
                $query1 = $db->query("SELECT * FROM POSDB.Customer");
                if($counts = $query1->num_rows){
                    $rows1 = $query1->fetch_all(MYSQLI_ASSOC);
                    foreach($rows1 as $row1){
                        echo'<tr>';
                        echo'<td>', $row1['CustomerID'],'</td>';
                        echo'<td>', $row1['LastName'],'</td>';
                        echo'<td>', $row1['FirstName'],'</td>';
                        echo'<td>', $row1['Address'],'</td>';
                        echo'<td>', $row1['City'],'</td>';
                        echo'<td>', $row1['PostalCode'],'</td>';
                        echo'<td>', $row1['Country'],'</td>';
                        echo'<td>', $row1['Phone'],'</td>';
                        echo'<td>', $row1['Email'],'</td>';
                        echo'<td>', $row1['Membership'],'</td>';
                        echo'</tr>';
                    }
                }
                ?>
                </tbody>
            </table>

            <!--Table for searched Customer-->
            <table class="table table-striped" id="showCustomerResults" style="display:none">
                <!--Head means title columns-->
                <thead>
                    <tr>
                        <th>CustomerID</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Postal</th>
                        <th>Country</th>
                        <th>Phone #</th>
                        <th>Email</th>
                        <th>Club Member</th>
                    </tr>
                </thead>
                <!--Each tr is a row and td is a cell for each column-->
                <tbody>
                    <?php
                        if(isset($_POST['search'])){
                        $searchValue = $_POST['customerName'];
                        echo "<script> showSearchedCustomer(); </script>";
                        }
                        $query1 = $db->query("SELECT * FROM POSDB.Customer WHERE FirstName LIKE '%$searchValue%' OR LastName LIKE '%$searchValue%'");
                        if($counts = $query1->num_rows){
                            $rows1 = $query1->fetch_all(MYSQLI_ASSOC);
                            foreach($rows1 as $row1){
                                echo'<tr>';
                                echo'<td>', $row1['CustomerID'],'</td>';
                                echo'<td>', $row1['LastName'],'</td>';
                                echo'<td>', $row1['FirstName'],'</td>';
                                echo'<td>', $row1['Address'],'</td>';
                                echo'<td>', $row1['City'],'</td>';
                                echo'<td>', $row1['PostalCode'],'</td>';
                                echo'<td>', $row1['Country'],'</td>';
                                echo'<td>', $row1['Phone'],'</td>';
                                echo'<td>', $row1['Email'],'</td>';
                                echo'<td>', $row1['Membership'],'</td>';
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
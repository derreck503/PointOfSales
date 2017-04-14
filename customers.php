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
                <button type="button" class="btn btn-primary" onclick="showAllCustomersTable();">Show all Customers</button>
                <form role="form">
                    <input type="text" class="form-control" placeholder="Search for customer">
                    <button type="button" class="btn btn-primary">Search</button>
                </form>
            </div>

            <!-- table of search results -->
            <table class="table table-bordered table-condensed" id="showAllCustomerResults" style="display:none">
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
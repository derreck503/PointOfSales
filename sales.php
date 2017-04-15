<?php
require 'database/connect.php';
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
</head>

<body>
    <div id="navigation-bar"></div>

    <!--Table for report-->
    <div class="container-fluid">
        <!--8 column width for the sales register container-->
        <div class="col-lg-8">
            <h2>Sales Details</h2>
        <hr>
            <!--search bar-->
            <div class="well">
                <form role="form">
                    <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group" >
                            <label for="sel1">Filter by:</label>
                            <select class="form-control" id="sel1">
                            <option>Product</option>
                            <option>Customer</option>
                            <option>Employee</option>
                            <option>Date</option>
                            </select>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-lg-4">
                    <input type="text" class="form-control" placeholder="Search for sale">
                    </div>
                    </div>
                    <br>
                    <button type="button" class="btn btn-primary">Search</button>
                </form>
            </div>

            <!-- table of search results -->
            <table class="table table-bordered table-condensed">
                <!--Head means title columns-->
                <thead>
                    <tr>
                        <th>Sale no.</th>
                        <th>Employee</th>
                        <th>Customer</th>
                        <th>Product</th>
                        <th>Date</th>
                        <th>Qty</th>
                        <th>Sale Total ($)</th>
                    </tr>
                </thead>
                <!--Each tr is a row and td is a cell for each column-->
                <tbody>
                    <tr>
                        <td>123</td>
                        <td>Rose</td>
                        <td>Earl</td>
                        <td>Socks</td>
                        <td>3/31/17</td>
                        <td>2</td>
                        <td>10</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</body>

</html>
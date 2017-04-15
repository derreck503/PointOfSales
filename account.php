<?php
require 'database/connect.php';
?>
<html>
<head>
    <title>Employee Account</title>
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
    <script src="js/showEmployee.js"></script>
</head>

<body>
    <div id="navigation-bar"></div>

    <!--Table for report-->
    <div class="container-fluid">
        <!--8 column width for the sales register container-->
        <div class="col-lg-6">
            
        <h2>Personal Information</h2>
            <hr>
            <!-- <div class="well">
                <div class="container">
                <div class="col-lg-4">
                    <form>
                    <?php 
                        $sql = $db->query("SELECT * FROM POSDB.Employee");
                        $row = $sql->fetch_array(MYSQLI_ASSOC);
                        echo '<input type = "text" class = "form-control" name="FirstName" value = "',$row['FirstName'],'">';
                    ?> 
                    <?php
                        $sql = $db->query("SELECT * FROM POSDB.Employee");
                        $row = $sql->fetch_array(MYSQLI_ASSOC);
                        echo '<input type = "text" class = "form-control" name="LastName" value = "',$row['LastName'],'">';
                    ?> 

                   <?php
                        $sql = $db->query("SELECT * FROM POSDB.Employee");
                        $row = $sql->fetch_array(MYSQLI_ASSOC);
                        echo '<input type = "text" class = "form-control" name="Title" value = "',$row['Title'],'">';
                    ?> 
                    
                    <?php
                        $sql = $db->query("SELECT * FROM POSDB.Employee");
                        $row = $sql->fetch_array(MYSQLI_ASSOC);
                        echo '<input type = "text" class = "form-control" name="DOB" value = "',$row['DOB'],'">';
                    ?> 

                    <?php
                        $sql = $db->query("SELECT * FROM POSDB.Employee");
                        $row = $sql->fetch_array(MYSQLI_ASSOC);
                        echo '<input type = "text" class = "form-control" name="Address" value = "',$row['Address'],'">';
                    ?> 

                    <?php
                        $sql = $db->query("SELECT * FROM POSDB.Employee");
                        $row = $sql->fetch_array(MYSQLI_ASSOC);
                        echo '<input type = "text" class = "form-control" name="City" value = "',$row['City'],'">';
                    ?> 

                    <?php
                        $sql = $db->query("SELECT * FROM POSDB.Employee");
                        $row = $sql->fetch_array(MYSQLI_ASSOC);
                        echo '<input type = "text" class = "form-control" name="PostalCode" value = "',$row['PostalCode'],'">';
                    ?> 

                  
                    <?php
                        $sql = $db->query("SELECT * FROM POSDB.Employee");
                        $row = $sql->fetch_array(MYSQLI_ASSOC);
                        echo '<input type = "text" class = "form-control" name="Phone" value = "',$row['Phone'],'">';
                    ?> 
 
                    <?php
                        $sql = $db->query("SELECT * FROM POSDB.Employee");
                        $row = $sql->fetch_array(MYSQLI_ASSOC);
                        echo '<input type = "text" class = "form-control" name="Email" value = "',$row['Email'],'">';
                    ?> 
                     <input type="submit" name="Update" value="Update" class="btn btn-primary">
                    </form>
                    
                </div>
                </div> 
            </div>
            <div class = "clearfix"></div> -->
            <div class="well">
                <div class="container">
                <div class="col-lg-4">
                    <form>
                        <?php 
                        $sql = $db->query("SELECT * FROM POSDB.Employee");
                        $row = $sql->fetch_array(MYSQLI_ASSOC);
                        echo '<input type = "text" class = "form-control" name="FirstName" value = "',$row['FirstName'],'">';
                    ?> 
                    <?php
                        $sql = $db->query("SELECT * FROM POSDB.Employee");
                        $row = $sql->fetch_array(MYSQLI_ASSOC);
                        echo '<input type = "text" class = "form-control" name="LastName" value = "',$row['LastName'],'">';
                    ?> 
                    
                    <?php
                        $sql = $db->query("SELECT * FROM POSDB.Employee");
                        $row = $sql->fetch_array(MYSQLI_ASSOC);
                        echo '<input type = "text" class = "form-control" name="DOB" value = "',$row['DOB'],'">';
                    ?> 

                    <?php
                        $sql = $db->query("SELECT * FROM POSDB.Employee");
                        $row = $sql->fetch_array(MYSQLI_ASSOC);
                        echo '<input type = "text" class = "form-control" name="Address" value = "',$row['Address'],'">';
                    ?> 

                    <?php
                        $sql = $db->query("SELECT * FROM POSDB.Employee");
                        $row = $sql->fetch_array(MYSQLI_ASSOC);
                        echo '<input type = "text" class = "form-control" name="City" value = "',$row['City'],'">';
                    ?> 

                    <?php
                        $sql = $db->query("SELECT * FROM POSDB.Employee");
                        $row = $sql->fetch_array(MYSQLI_ASSOC);
                        echo '<input type = "text" class = "form-control" name="PostalCode" value = "',$row['PostalCode'],'">';
                    ?> 

                  
                    <?php
                        $sql = $db->query("SELECT * FROM POSDB.Employee");
                        $row = $sql->fetch_array(MYSQLI_ASSOC);
                        echo '<input type = "text" class = "form-control" name="Phone" value = "',$row['Phone'],'">';
                    ?> 
 
                    <?php
                        $sql = $db->query("SELECT * FROM POSDB.Employee");
                        $row = $sql->fetch_array(MYSQLI_ASSOC);
                        echo '<input type = "text" class = "form-control" name="Email" value = "',$row['Email'],'">';
                    ?> 
                     <input type="submit" name="Update" value="Update" class="btn btn-primary">
                         
                    </form>
                    
                </div> 
                </div>
            </div>
            </div>

            <div class="col-lg-6">
            <h2>Admin Tool: Update Employee Information</h2>
            <hr>
            <div class="well">

           <!--Select Employee from dropdown-->
          <div class="dropdown form-group">
            <form action="" method="post" name="myForm" id="myForm">
              <table>
                <tr>
                  <td>
                    <select name="selectedValue" class="form-control">
                      <option>Select an employee</option>
                      <?php
                            $sql = $db->query("SELECT FirstName, LastName, EmployeeID FROM POSDB.Employee");
                            if($sql->num_rows){
                                $employees = $sql->fetch_all(MYSQLI_ASSOC);
                                foreach($employees as $sup){
                                    echo '<option value="',$sup['EmployeeID'],'" id="selection">',$sup['FirstName'],' ',$sup['LastName'], '</option>';
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
            <form id="showEmployee" style="display:none">
                <?php
                if(isset($_POST['submit'])){
                    $selection = $_POST['selectedValue'];
                    echo "<script> showEmployee(); </script>";
                }
                $query = $db->query("SELECT * FROM POSDB.Employee Where EmployeeID = $selection");
                if($count = $query->num_rows){
                    $rows = $query->fetch_all(MYSQLI_ASSOC);
                    foreach($rows as $row){
                        echo '<input type = "text" class = "form-control" name="FirstName" value = "',$row['FirstName'],'">';
                    }
                }
                ?>
            </form>
          </div>
        </div>
        </div>

    </div>
</body>

</html>
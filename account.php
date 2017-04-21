<?php
require 'database/connect.php';
session_start();
$employeeID = $_SESSION['Identifier'];
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
    <script src="js/showAdminTools.js"></script>

    <style type="text/css">
        .form-control {
            display: inline-block;
            width: 70%;
        }
        label {
            width: 20%;
        }
    </style>
</head>

<body>
    <div id="navigation-bar"></div>

    <!--Table for report-->
    <div class="container-fluid">
        <!--8 column width for the sales register container-->
        <div class="">
            
        <h2>Personal Information</h2>
            <hr>
            <div class="col-lg-10">
            <div class="well">
                    <div class="dropdown form-group">
                    <form action="" method="post" name="myForm">
                        <span style="position:absolute;display:none;">
                        <select name="firstNameValue" class="form-control" style="width:100%;">
                            <option value="" id="personalfname" name="personalfname">
                        </select>
                        <select name="lastNameValue" class="form-control" style="width:100%;">
                            <option value="" id="personallname" name="personallname">
                        </select>
                        <select name="DOBValue" class="form-control" style="width:100%;">
                            <option value="" id="personaldob" name="personaldob">
                        </select>
                        <select name="AddressValue" class="form-control" style="width:100%;">
                            <option value="" id="personaladdress" name="personaladdress">
                        </select>
                        <select name="CityValue" class="form-control" style="width:100%;">
                            <option value="" id="personalcity" name="personalcity">
                        </select>
                        <select name="PostalCodeValue" class="form-control" style="width:100%;">
                            <option value="" id="personalpostal" name="personalpostal">
                        </select>
                        <select name="PhoneValue" class="form-control" style="width:100%;">
                            <option value="" id="personalphone" name="personalphone">
                        </select>
                        <select name="EmailValue" class="form-control" style="width:100%;">
                            <option value="" id="personalemail" name="personalemail">
                        </select>
                        </span>
                        <?php
                        if(isset($_POST['UpdatePersonal'])){
                            echo "Personal information updated.<br>";
                            $fname = $_POST['firstNameValue'];
                            $lname = $_POST['lastNameValue'];
                            $dob = $_POST['DOBValue'];
                            $addr = $_POST['AddressValue'];
                            $city = $_POST['CityValue'];
                            $postal = $_POST['PostalCodeValue'];
                            $phone = $_POST['PhoneValue'];
                            $email = $_POST['EmailValue'];
                        }
                        $update = $db->query("UPDATE POSDB.Employee SET Employee.FirstName = '".$fname."', Employee.LastName = '".$lname."', Employee.DOB = '".$dob."', Employee.Address = '".$addr."', Employee.City = '".$city."', Employee.PostalCode = '".$postal."', Employee.Phone = '".$phone."', Employee.Email = '".$email."' WHERE Employee.EmployeeID = $employeeID");
                        ?>
                        <!-- display personal information -->
                        <?php 
                        $sql = $db->query("SELECT * FROM POSDB.Employee WHERE EmployeeID=$employeeID");
                        $row = $sql->fetch_array(MYSQLI_ASSOC);
                        echo '<label for="FirstName">First Name</label><input type ="text" class="form-control" id="FirstName" value="',$row['FirstName'],'">';
                    ?> 
                    <?php
                        $sql = $db->query("SELECT * FROM POSDB.Employee WHERE EmployeeID=$employeeID");
                        $row = $sql->fetch_array(MYSQLI_ASSOC);
                        echo '<label for="LastName">Last Name</label><input type = "text" class = "form-control" id="LastName" value = "',$row['LastName'],'">';
                    ?> 
                    
                    <?php
                        $sql = $db->query("SELECT * FROM POSDB.Employee WHERE EmployeeID=$employeeID");
                        $row = $sql->fetch_array(MYSQLI_ASSOC);
                        echo '<label for="DOB">Date of Birth</label><input type = "text" class = "form-control" id="DOB" value = "',$row['DOB'],'">';
                    ?> 

                    <?php
                        $sql = $db->query("SELECT * FROM POSDB.Employee WHERE EmployeeID=$employeeID");
                        $row = $sql->fetch_array(MYSQLI_ASSOC);
                        echo '<label for="Address">Address</label><input type = "text" class = "form-control" id="Address" value = "',$row['Address'],'">';
                    ?> 

                    <?php
                        $sql = $db->query("SELECT * FROM POSDB.Employee WHERE EmployeeID=$employeeID");
                        $row = $sql->fetch_array(MYSQLI_ASSOC);
                        echo '<label for="City">City</label><input type = "text" class = "form-control" id="City" value = "',$row['City'],'">';
                    ?> 

                    <?php
                        $sql = $db->query("SELECT * FROM POSDB.Employee WHERE EmployeeID=$employeeID");
                        $row = $sql->fetch_array(MYSQLI_ASSOC);
                        echo '<label for="PostalCode">Postal Code</label><input type = "text" class = "form-control" id="PostalCode" value = "',$row['PostalCode'],'">';
                    ?> 
                    <?php
                        $sql = $db->query("SELECT * FROM POSDB.Employee WHERE EmployeeID=$employeeID");
                        $row = $sql->fetch_array(MYSQLI_ASSOC);
                        echo '<label for="Phone">Phone</label><input type = "text" class = "form-control" id="Phone" value = "',$row['Phone'],'">';
                    ?> 
                    <?php
                        $sql = $db->query("SELECT * FROM POSDB.Employee WHERE EmployeeID=$employeeID");
                        $row = $sql->fetch_array(MYSQLI_ASSOC);
                        echo '<label for="Email">Email</label><input type = "text" class = "form-control" id="Email" value = "',$row['Email'],'">';
                    ?> 
                    <hr>
                     <input type="submit" name="UpdatePersonal" value="Update" class="btn btn-primary">
                    </form>
                    </div>
                </div> 
                </div>

            </div>

            <div class="col-lg-10" id="admintools" style="display:none;">
            <script> showAdminTools(); </script>
            <h2>Administration Tools</h2>
            <hr>
            <!-- View All Employees -->
            <h3>View Employee Details</h3>
            <div class="well">
                <button type="button" class="btn btn-primary" onclick="showAllEmployees();">Show all employees</button>
                <table class="table table-striped" id="showAllEmployees" style="display:none">
                      <!--Head means title columns-->
                      <thead>
                        <tr>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Title</th>
                          <th>Date of Birth</th>
                          <th>Address</th>
                          <th>City</th>
                          <th>Postal Code</th>
                          <th>Phone</th>
                          <th>Email</th>
                        </tr>
                      </thead>
                      <!--Each tr is a row and td is a cell for each column-->
                      <tbody>
                        <?php
                            $query = $db->query("SELECT * FROM POSDB.Employee");
                            if($count = $query->num_rows){
                                $rows = $query->fetch_all(MYSQLI_ASSOC);
                                foreach($rows as $row){
                                    echo'<tr>';
                                    echo'<td>', $row['FirstName'],'</td>';
                                    echo'<td>', $row['LastName'],'</td>';
                                    echo'<td>', $row['Title'],'</td>';
                                    echo'<td>', $row['DOB'],'</td>';
                                    echo'<td>', $row['Address'],'</td>';
                                    echo'<td>', $row['City'],'</td>';
                                    echo'<td>', $row['PostalCode'],'</td>';
                                    echo'<td>', $row['Phone'],'</td>';
                                    echo'<td>', $row['Email'],'</td>';
                                    echo'</tr>';
                                }
                            }
                            ?>
                      </tbody>
                    </table>
            </div>
            <!-- Add New Employee -->
            <hr>
            <h3>Add New Employee</h3>
            <div class="well">
            <div class="dropdown form-group">
            <form action="" method="post">
                <span style="position:absolute;display:none;">
                <select name="firstNameNew" class="form-control" style="width:100%;">
                    <option value="" id="newfname" name="newfname">
                </select>
                <select name="lastNameNew" class="form-control" style="width:100%;">
                    <option value="" id="newlname" name="newlname">
                </select>
                <select name="TitleNew" class="form-control" style="width:100%;">
                    <option value="" id="newtitle" name="newtitle">
                </select>
                <select name="DOBNew" class="form-control" style="width:100%;">
                    <option value="" id="newdob" name="newdob">
                </select>
                <select name="AddressNew" class="form-control" style="width:100%;">
                    <option value="" id="newaddress" name="newaddress">
                </select>
                <select name="CityNew" class="form-control" style="width:100%;">
                    <option value="" id="newcity" name="newcity">
                </select>
                <select name="PostalCodeNew" class="form-control" style="width:100%;">
                    <option value="" id="newpostal" name="newpostal">
                </select>
                <select name="PhoneNew" class="form-control" style="width:100%;">
                    <option value="" id="newphone" name="newphone">
                </select>
                <select name="SupervisorNew" class="form-control" style="width:100%;">
                    <option value="" id="newsupervisor " name="newsupervisor">
                </select>
                <select name="EmailNew" class="form-control" style="width:100%;">
                    <option value="" id="newemail" name="newemail">
                </select>
                </span>
              <label for="NewFirstName">First Name</label>
              <input class="form-control" type="text" name="NewFirstName" id="NewFirstName">
              <label for="NewLastName">Last Name</label>
              <input class="form-control" type="text" name="NewLastName" id="NewLastName">
              <label for="NewTitle">Title</label>
              <input class="form-control" type="text" name="NewTitle" id="NewTitle">
              <label for="NewDOB">Date of Birth</label>
              <input class="form-control" type="text" name="NewDOB" id="NewDOB">
              <label for="NewAddress">Address</label>
              <input class="form-control" type="text" name="NewAddress" id="NewAddress">
              <label for="NewCity">City</label>
              <input class="form-control" type="text" name="NewCity" id="NewCity">
              <label for="NewPostalCode">Postal Code</label>
              <input class="form-control" type="text" name="NewPostalCode" id="NewPostalCode">
              <label for="NewPhone">Phone</label>
              <input class="form-control" type="text" name="NewPhone" id="NewPhone">
              <label for="NewSupervisor">Supervisor</label>
              <input class="form-control" type="text" name="NewSupervisor" id="NewSupervisor">
              <label for="NewEmail">Email</label>
              <input class="form-control" type="text" name="NewEmail" id="NewEmail">
            <input type="submit" name="Create" value="Create" class="btn btn-primary">
          </form>
          </div>
          <?php
            if(isset($_POST['Create'])){
                $fname = $_POST['firstNameNew'];
                $lname = $_POST['lastNameNew'];
                $title = $_POST['TitleNew'];
                $dob = $_POST['DOBNew'];
                $address = $_POST['AddressNew'];
                $city = $_POST['CityNew'];
                $postal = $_POST['PostalCodeNew'];
                $phone = $_POST['PhoneNew'];
                $supervisor = $_POST['SupervisorNew'];
                $email = $_POST['EmailNew'];

                $create = $db->query("INSERT INTO POSDB.Employee (`FirstName`, `LastName`,`Title`,`DOB`,`HireDate`, `Address`, `City`, `PostalCode`, `Phone`, `SuperVisorID`, `email`) VALUES('$fname', '$lname', '$title','$dob', CURDATE(), '$address','$city', '$postal', '$phone', '$supervisor', '$email')");

            }
          ?>
            </div>
        <!-- Delete Employee Information -->
            <hr>
            <h3>Delete Employee</h3>
            <div class="well">
              <div class="dropdown form-group">
                <form action="" method="post" name="myForm" id="myForm">
                  <table>
                    <tr>
                      <td>
                        <select name="selectedValueDelete" class="form-control" style="width:100%;"">
                          <option>Select an employee</option>
                          <?php
                                $sql = $db->query("SELECT FirstName, LastName, EmployeeID FROM POSDB.Employee WHERE EmployeeID <> $employeeID");
                                if($sql->num_rows){
                                    $employees = $sql->fetch_all(MYSQLI_ASSOC);
                                    foreach($employees as $sup){
                                        echo '<option value="',$sup['EmployeeID'],'" id="selection">',$sup['FirstName'],' ',$sup['LastName'], '</option>';
                                    }
                                }
                            ?>
                        </select>
                        <td>
                          <input type="submit" class="btn btn-primary" name="submitDelete" value="Select" />
                          <input type="submit" class="btn btn-success" name="confirmDelete" id="confirmDelete" value="Confirm" disabled>
                        </td>
                    </tr>
                  </table>
                </form>
                <form id="showEmployeeDelete" style="display:none">
                    <?php
                    if(isset($_POST['submitDelete'])){
                        $selection = $_POST['selectedValueDelete'];
                        $_SESSION['selectionDelete'] = $selection;
                        echo "<script> showEmployeeDelete(); </script>";
                        $query = $db->query("SELECT * FROM POSDB.Employee Where EmployeeID = $selection");
                        $row = $query->fetch_array(MYSQLI_ASSOC);
                        $fname = $row['FirstName'];
                        echo "<h3>Are you sure you want to delete ",$fname,"?</h3>";
                    }
                        if(isset($_POST['confirmDelete'])){
                            echo "<script> showEmployeeDelete(); </script>";
                            echo "<script> disableConfirmButton(); </script>";
                            $deletion = $_SESSION['selectionDelete'];
                            $query = $db->query("SELECT * FROM POSDB.Employee Where EmployeeID = $deletion");
                            $row = $query->fetch_array(MYSQLI_ASSOC);
                            $fname = $row['FirstName'];
                            echo "<h3>",$fname," has been deleted from the Employee database.</h3>";
                            $delete = $db->query("DELETE FROM POSDB.Employee Where EmployeeID = $deletion");
                        }
                    ?>
                </form>
              </div>
            </div>
            <!-- View All Audit -->
            <hr>
            <h3>View Audit Details</h3>
            <div class="well">
                <button type="button" class="btn btn-primary" onclick="showAudit();">Show audit history</button>
                <p>
                <table class="table table-striped" id="showAuditDetails" style="display:none">
                      <!--Head means title columns-->
                      <thead>
                        <tr>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Action Performed</th>
                          <th>Date/Time</th>
                        </tr>
                      </thead>
                      <!--Each tr is a row and td is a cell for each column-->
                      <tbody>
                        <?php
                            $counter = 0;
                            $query = $db->query("SELECT * FROM POSDB.History ORDER BY Time DESC");
                            if($count = $query->num_rows){
                                $rows = $query->fetch_all(MYSQLI_ASSOC);
                                foreach($rows as $row){
                                    echo'<tr>';
                                    echo'<td>', $row['FirstName'],'</td>';
                                    echo'<td>', $row['LastName'],'</td>';
                                    echo'<td>', $row['ActionPerformed'],'</td>';
                                    echo'<td>', $row['Time'],'</td>';
                                    echo'</tr>';
                                    $counter++;
                                    if($counter>=25){
                                        break;
                                    }
                                }
                            }
                            ?>
                      </tbody>
                    </table>
                    </p>
            </div>
        </div>
        <!--end admin-->
    </div>

    <script>
    //These allow me to pull data using _POST ughhh
    var fname = $('#FirstName').val();
    $('#personalfname').val(fname);
    var fname = $('#LastName').val();
    $('#personallname').val(fname);
    var fname = $('#DOB').val();
    $('#personaldob').val(fname);
    var fname = $('#Address').val();
    $('#personaladdress').val(fname);
    var fname = $('#City').val();
    $('#personalcity').val(fname);
    var fname = $('#PostalCode').val();
    $('#personalpostal').val(fname);
    var fname = $('#Phone').val();
    $('#personalphone').val(fname);
    var fname = $('#Email').val();
    $('#personalemail').val(fname);

    $('#FirstName').on('input', function() {
        var fname = $('#FirstName').val();
        $('#personalfname').val(fname);
    });
    $('#LastName').on('input', function() {
        var fname = $('#LastName').val();
        $('#personallname').val(fname);
    });
    $('#DOB').on('input', function() {
        var fname = $('#DOB').val();
        $('#personaldob').val(fname);
    });
    $('#Address').on('input', function() {
        var fname = $('#Address').val();
        $('#personaladdress').val(fname);
    });
    $('#City').on('input', function() {
        var fname = $('#City').val();
        $('#personalcity').val(fname);
    });
    $('#PostalCode').on('input', function() {
        var fname = $('#PostalCode').val();
        $('#personalpostal').val(fname);
    });
    $('#Phone').on('input', function() {
        var fname = $('#Phone').val();
        $('#personalphone').val(fname);
    });
    $('#Email').on('input', function() {
        var fname = $('#Email').val();
        $('#personalemail').val(fname);
    });

    //new employee
    var fname = $('#NewFirstName').val();
    $('#newfname').val(fname);
    var fname = $('#NewLastName').val();
    $('#newlname').val(fname);
    var fname = $('#NewTitle').val();
    $('#newtitle').val(fname);
    var fname = $('#NewDOB').val();
    $('#newdob').val(fname);
    var fname = $('#NewAddress').val();
    $('#newaddress').val(fname);
    var fname = $('#NewCity').val();
    $('#newcity').val(fname);
    var fname = $('#NewPostalCode').val();
    $('#newpostal').val(fname);
    var fname = $('#NewPhone').val();
    $('#newphone').val(fname);
    var fname = $('#NewSupervisor').val();
    $('#newsupervisor').val(fname);
    var fname = $('#NewEmail').val();
    $('#newemail').val(fname);

    $('#NewFirstName').on('input', function() {
        var fname = $('#NewFirstName').val();
        $('#newfname').val(fname);
        console.log(fname);
        console.log($('#newfname').val());
    });
    $('#NewLastName').on('input', function() {
        var fname = $('#NewLastName').val();
        $('#newlname').val(fname);
    });
    $('#NewTitle').on('input', function() {
        var fname = $('#NewTitle').val();
        $('#newtitle').val(fname);
        console.log(fname);
        console.log($('#newtitle').val());
    });
    $('#NewDOB').on('input', function() {
        var fname = $('#NewDOB').val();
        $('#newdob').val(fname);
    });
    $('#NewAddress').on('input', function() {
        var fname = $('#NewAddress').val();
        $('#newaddress').val(fname);
    });
    $('#NewCity').on('input', function() {
        var fname = $('#NewCity').val();
        $('#newcity').val(fname);
    });
    $('#NewPostalCode').on('input', function() {
        var fname = $('#NewPostalCode').val();
        $('#newpostal').val(fname);
    });
    $('#NewPhone').on('input', function() {
        var fname = $('#NewPhone').val();
        $('#newphone').val(fname);
    });
    $('#NewSupervisor').on('input', function() {
        var fname = $('#NewSupervisor').val();
        $('#newsupervisor').val(fname);
    });
    $('#NewEmail').on('input', function() {
        var fname = $('#NewEmail').val();
        $('#newemail').val(fname);
    });
    </script>

    <?php

        //Check if employee is a Manager
        $sql = $db->query("SELECT EmployeeID FROM POSDB.Employee WHERE SupervisorID=$employeeID");
        $row = $sql->fetch_array(MYSQLI_ASSOC);

        if(is_null($row['EmployeeID']))
        {
            echo "<script> hideAdminTools(); </script>";
        } else {
            echo "<script> showAdminTools(); </script>";
        } 
    ?>
</body>

</html>
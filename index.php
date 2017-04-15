<?php
require 'database/connect.php';
session_start();


  if(isset($_POST["Log"])) {

    $username=$_POST['username'];
    $password=$_POST['password'];


   $sql = $db->query("SELECT Username, Password, UserID FROM POSDB.Login");
    if($sql->num_rows){
    $Logins = $sql->fetch_all(MYSQLI_ASSOC);
    foreach($Logins as $Users){
      if ($Users['Username'] == $username && $Users['Password'] == $password) {
        $_SESSION['Identifier'] = $Users['UserID'];
        header('Location: dashboard.php');
        
        }
    }
            echo "Invalid Username or Password";
       
  }


  }

?>


  

<!DOCTYPE html>
<html>

<head>
  <title>Point of Sales</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>



<body style="background-image: url('images/baby-background.jpg')">
  


  <!--Main container-->
  <div class="container" style="text-align: center; margin-top: 250px; width: 80%;">
    <!--Title banner-->
    <div class="jumbotron" style="background-color:aliceblue;">
      <h1>Welcome to Babies R Us</h1>
      <p>The leading point of sales system for a baby store.</p>
    </div>
    <!--Login button-->
    <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#popUpWindow">Log In</button>
    <!--Contents of button-->
    <div class="modal fade" id="popUpWindow" style="margin-top: 300px;">
      <div class="modal-dialog">
        <div class="modal-content">
          <!--Header inside of button-->
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title">Log In</h3>
          </div>
          <!--Body inside of button-->
          <div class="modal-body">
            <form role="form" action="" method="post">
              <div class="form-group">
                <input type="username" class="form-control" placeholder="Username" name='username'>
              </div>
              <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" name='password'>
              </div>
              </div>
          <!--Footer inside of button-->
          <div class="modal-footer">
           <button class="btn btn-primary btn-block" type="submit" name="Log" >Log In</button>
           </form>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>

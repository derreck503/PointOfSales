<?php
require 'database/connect.php';
session_start();
echo $_SESSION['Identifier'];
session_destroy();

?>


<?php
require 'database/connect.php';


  if(isset($_POST["Log"])) {

    $username=$_POST['username'];
    $password=$_POST['password'];

   $sql = $db->query("SELECT Username, Password FROM POSDB.Login");
    if($sql->num_rows){
    $Logins = $sql->fetch_all(MYSQLI_ASSOC);
    foreach($Logins as $Users){
      if ($Users['Username'] == $username && $Users['Password'] == $password) {
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
      <p>You have been logged out.</p>
      <hr>
      <button type="button" class="btn btn-primary btn-lg" onclick="location.href='index.php'" >Return to HomePage</button>

    </div>
  </div>

</body>

</html>



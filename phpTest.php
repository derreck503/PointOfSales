<!--PHP Practice-->
<!--Connection to Database-->
<?php
error_reporting(0);
require 'database/connect.php';
echo 'Success';


$result = $db->query("SELECT * FROM POSDB.Supplier");

if($result->num_rows){
    echo 'Yay';
}

?>
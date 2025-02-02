<?php
   $server = "localhost";
   $username = "root";
   $pwd = "";
   $db = "signup";

   $conn = new mysqli($server,$username,$pwd,$db);

   if($conn->connect_error){
    die ("Unable to conenct database !");
   }
?>
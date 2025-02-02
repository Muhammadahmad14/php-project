<?php
include 'connect.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    $sql = "DELETE FROM book WHERE id = '$id';";

    if($conn->query($sql) === TRUE){
        header("location: homepage.php");
    }
    else{
        echo '<div class="alert alert-danger alert-dismissible col-md-4 container" role="alert">
            <i class="fa-solid fa-triangle-exclamation " style="color: #b61b3a;"></i>
          Error!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
}

?>
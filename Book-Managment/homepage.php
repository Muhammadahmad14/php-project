<?php
session_start();
if(!isset($_SESSION['user_login'])){
  header("location: login.php");
  exit();
}
$user_email = $_SESSION['user_email'];

include 'connect.php';
if(isset($_POST['add_book'])){
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $book_name =  $_POST['name'];
  $refnum = $_POST['refnum'];
  $author = $_POST['author_name'];

  $sql = "INSERT INTO book (book_name, author_name, Reference_num) VALUES('$book_name', '$author', '$refnum');";

  if($conn->query($sql) === TRUE){
    echo '<div class="alert alert-success alert-dismissible col-md-4 container " role="alert">
<i class="fa-solid fa-circle-check fs-bold" style="color: #28a745;"></i>
 <span class="ms-2">Successfully added</span>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }
  else{
    echo '<div class="alert alert-danger alert-dismissible col-md-4 container" role="alert">
      <i class="fa-solid fa-triangle-exclamation " style="color: #b61b3a;"></i>
    Error!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }
}
}
$book_names = array();
$shelf_names = array();

$books = "SELECT * FROM book";
$shelfs = "SELECT * FROM shelf";

$result_books = $conn->query($books);
$result_shelfs = $conn->query($shelfs);

// Fetch book data
if($result_books->num_rows > 0){
    while($row = $result_books->fetch_assoc()){
        $book_names[] = $row;
    }
}

// Fetch shelf data
if($result_shelfs->num_rows > 0){
    while($row = $result_shelfs->fetch_assoc()){
        $shelf_names[] = $row;
    }
}



if(isset($_POST['add'])){
  if($_SERVER['REQUEST_METHOD']=== 'POST'){
    $shelf = $_POST['shelfid'];
    $book = $_POST['bookname'];
    $sql = "UPDATE  book SET shelf_id ='$shelf' WHERE id = '$book';";
  
    if($conn->query($sql) === TRUE){
      echo  '<div class="container alert alert-success alert-dismissible col-md-4" role="alert">
      <i class="fa-solid fa-circle-check fs-bold" style="color: #28a745;"></i>
       <span class="ms-2">Successfully added</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';  
    }
    else{
      echo '<div class="alert alert-danger alert-dismissible col-md-4 container" role="alert">
        <i class="fa-solid fa-triangle-exclamation " style="color: #b61b3a;"></i>
      Error!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    }
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Library Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <style>
      body{
        margin:0;
        padding:0;
        overflow-x: hidden;
      }
    </style>
  </head>
  <body style="font-family:serif;">

  <!-- navigation -->
  <nav class="navbar navbar-expand-lg bg-dark p-3">
  <div class="container-fluid">
    <a class="navbar-brand text-white fw-bold" href="homepage.php">Library Manager</a>
    <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon bg-white"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item mb-sm-3 mb-lg-0">
          <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#book-modal">Add Book</button>
        </li>
        <li class="nav-item  mb-sm-3 mb-lg-0">
          <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#shelf_modal">Add Shelf</button>
        </li>
        <li class="nav-item  mb-ms-3 mb-lg-0">
          <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#warning">Log out</button>
        </li>
      </ul>
    </div>
  </div>
</nav>









  
    <div class="container mt-4">
    <div class="shadow-lg p-4 bg-white rounded" style="max-width: 900px; margin: auto;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold">All Books</h5>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Book Name</th>
                        <th scope="col">Reference Number</th>
                        <th scope="col">Author Name</th>
                        <th scope="col">Shelf</th>
                        <th scope="col" class="text-center">Update</th>
                        <th scope="col" class="text-center">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $sql = "SELECT id, book_name,author_name, Reference_num, shelf.shelf_name FROM book
                    JOIN shelf ON shelf.shelf_id = book.shelf_id;";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($row['book_name']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['Reference_num']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['shelf_name']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['author_name']) . '</td>';
                            echo '<td class="text-center"><a class="btn btn-warning btn-sm" href="update.php?id=' . $row['id'] . '">Update</a></td>';
                            echo '<td class="text-center"><a class="btn btn-danger btn-sm" href="delete.php?id='. $row['id'] . '">Delete</a></td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="5" class="text-center text-muted">No books found</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>


  <!-- Book Modal -->
  <div class="modal fade" id="book-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5">Add Book</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- form -->
          <form method="post" action="homepage.php" onsubmit="return validation();">
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="name" class="form-label">Book Name:</label>
                <input type="text" class="form-control" id="name" name="name">
                <p class="text-danger " style="font-size:12px;" id="name-Error"></p>
              </div>
              <div class="mb-3 col-md-6">
                <label for="refnum" class="form-label">Reference No:</label>
                <input type="text" class="form-control" id="refnum" name="refnum">
                <p class="text-danger" style="font-size:12px;" id="ref-Error"></p>
              </div>
              <div class="mb-3">
                <label for="Author-name" class="form-label">Author:</label>
                <input type="text" class="form-control" id="Author-name" name="author_name">
                <p class="text-danger" style="font-size:12px;" id="author-Error"></p>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" name="add_book">Add Book</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Shelf modal -->
  <div class="modal fade" tabindex="-1" id="shelf_modal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Shelf</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="homepage.php" method="post" onsubmit="return Isselect();">
        <!-- select book -->
            <div class="mb-3">
              <select class="form-select" id="select_book" name="bookname">
                <option value="">Select Book</option>
                <?php
                foreach($book_names as $book) {
                    echo '<option value="' . $book['id'] . '">' . $book['book_name'] . '</option>';
                }
                ?>
              </select>
              <p class="text-danger " style="font-size:12px;" id="selectbook_Error"></p>
            </div>
            <!-- select shelf -->
            <div class="mb-3">
              <select class="form-select" id="select_shelf" name="shelfid">
                <option value="">Select Shelf</option>
                <?php
                foreach($shelf_names as $shelf){
                  echo '<option value="'. $shelf['shelf_id'] . '">'. $shelf['shelf_name']. '</option>';
                }
                ?>
              </select>
              <p class="text-danger " style="font-size:12px;" id="selectshelf_Error"></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="add">Add</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  
  <!-- LogOut warning -->
  <div class="modal fade" tabindex="-1" id="warning" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fw-bold">Warning</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to logout?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
      </div>
    </div>
  </div>



  <!-- <p>Welcome, ?php echo $user_email; ?>!</p> -->


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
  crossorigin="anonymous"></script>

  <script>
    function validation() {
      const name = document.getElementById("name").value.trim();
      const refnum = document.getElementById("refnum").value.trim(); 
      const authorName = document.getElementById("Author-name").value.trim();

      const nameError = document.getElementById("name-Error");
      const refError = document.getElementById("ref-Error");
      const authorError = document.getElementById("author-Error");

      nameError.textContent = "";
      refError.textContent = "";
      authorError.textContent = "";

      let isValid = true;

      if (name === "") {
        nameError.textContent = "Book Name is required.";
        isValid = false;
      }

      if (refnum === "") {
        refError.textContent = "Reference Number is required.";
        isValid = false;
      } else if (refnum <= 0) {
        refError.textContent = "Reference Number must be a positive number.";
        isValid = false;
      }

      if (authorName === "") {
        authorError.textContent = "Author Name is required.";
        isValid = false;
      }

      return isValid; 
    }

    function Isselect() {
    var book = document.getElementById("select_book").value;
    var shelf = document.getElementById("select_shelf").value;
    var bookError = document.getElementById("selectbook_Error");
    var shelfError = document.getElementById("selectshelf_Error");

    let isValid = true; // Assume form is valid

    if (book === "") {
        bookError.textContent = "Please select a book.";
        isValid = false;
    } else {
        bookError.textContent = "";
    }

    if (shelf === "") {
        shelfError.textContent = "Please select a shelf.";
        isValid = false;
    } else {
        shelfError.textContent = "";
    }

    return isValid;
}

  </script>
  </body>
</html>





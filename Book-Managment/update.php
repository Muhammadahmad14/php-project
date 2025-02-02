<?php
include 'connect.php';
$shelf_query = "SELECT shelf_id, shelf_name FROM shelf";
$shelves_result = $conn->query($shelf_query);
if(isset($_GET['id'])){
    $id =$_GET['id'];
    $sql = "SELECT id, book_name, author_name,  Reference_num,shelf.shelf_id, shelf.shelf_name FROM book
            JOIN shelf ON shelf.shelf_id = book.shelf_id
             WHERE id= '$id'; ";
    $result = $conn->query($sql);
    if($result->num_rows>0){

        $book = $result->fetch_assoc();
    }
}
if(isset($_POST['btn'])){
    if($_SERVER['REQUEST_METHOD']=== 'POST'){
       // $id = $_GET['id'];
       $book_id =$_POST['id'];
        $book_name = $_POST['book_name'];
        $refnum = $_POST['refnum'];
        $author_name = $_POST['author_name'];
        $shelf_id = $_POST['shelf_id'];
        // query to update the book data
        $sql = "UPDATE book SET book_name = '$book_name', Reference_num= '$refnum', author_name = '$author_name',
    shelf_id = '$shelf_id'
      WHERE id = '$book_id';";

        if($conn->query($sql) === TRUE) {
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
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>update Book</title>
    <style>
        body{
            background:lightgrey;
        }
    </style>
</head>
<body>
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <form action="update.php" method="post" class="row g-3 bg-white p-4 rounded shadow-lg" style="max-width: 500px; width: 100%;">
        <h3 class="text-center mb-4 text-primary fw-bold">Update Book</h3>

        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">📖 Book Name</label>
            <input type="text" class="form-control"   name="book_name" value="<?php echo $book['book_name']; ?>" placeholder="Enter book name" required>
        </div>

        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="mb-3">
            <label for="refnum" class="form-label fw-semibold">🔖 Reference No</label>
            <input type="text" class="form-control" id="refnum" name="refnum" value="<?php echo $book['Reference_num']; ?>" placeholder="Enter reference number" required>
        </div>

        <div class="mb-3">
            <label for="author_name" class="form-label fw-semibold">✍️ Author Name</label>
            <input type="text" class="form-control" id="author_name" name="author_name" value="<?php echo $book['author_name']; ?>" placeholder="Enter author's name" required>
        </div>

        <div class="mb-3">
    <label for="select_shelf" class="form-label fw-semibold">📚 Shelf Name</label>
    <select class="form-select" name="shelf_id" id="shelf_id">
        <option value="">Choose a shelf</option>
        <?php
        // Loop through all shelves and create options
        while ($shelf = $shelves_result->fetch_assoc()) {
            $selected = ($shelf['shelf_id'] == $book['shelf_id']) ? 'selected' : ''; // Set selected if this shelf matches the book's shelf
            echo '<option value="' . $shelf['shelf_id'] . '" ' . $selected . '>' . $shelf['shelf_name'] . '</option>';
        }
        ?>
    </select>
</div>


        <div class="d-grid">
            <button type="submit" class="btn btn-primary fw-bold" name="btn">🔄 Update Book</button>
        </div>
    </form>
</div>













            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
  crossorigin="anonymous"></script>
</body>
</html>
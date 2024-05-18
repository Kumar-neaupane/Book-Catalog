<?php
include 'connection.php';


if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

   
    $selectquery = "SELECT * FROM addbook WHERE id = $id";
    $query = mysqli_query($conn, $selectquery);
    $result = mysqli_fetch_assoc($query);

    if(!$result) {
        echo "Book not found";
        exit;
    }

    
    if(isset($_POST['submit'])) {
        $bookname = $_POST['bookname'];
        $authorname = $_POST['authorname'];
        $isbn = $_POST['isbn'];
        $category = $_POST['category'];

        // Update the book details
        $updatequery = "UPDATE addbook SET bookname=?, authorname=?, isbn=?, category=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $updatequery);
        mysqli_stmt_bind_param($stmt, "ssssi", $bookname, $authorname, $isbn, $category, $id);
        $success = mysqli_stmt_execute($stmt);

        if($success) {
            echo "Updated successfully";
            
            ?>
            <script>
                // Redirect after 3 seconds
                setTimeout(function() {
                    location.replace("managebook.php");
                }, 1000);
            </script>
            <?php
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
} else {
    echo "Invalid ID";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="edit.css">
    <title>Edit Book</title>
</head>
<body>
    <div class="container">
        <h2>Edit Book</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="bookName">Book Name:</label>
                <input type="text" id="bookName" name="bookname" value="<?php echo htmlspecialchars($result['bookname']); ?>" required>
            </div>
            <div class="form-group">
                <label for="authorName">Author Name:</label>
                <input type="text" id="authorName" name="authorname" value="<?php echo htmlspecialchars($result['authorname']); ?>" required>
            </div>
            <div class="form-group">
                <label for="ISBN">ISBN:</label>
                <input type="text" id="ISBN" name="isbn" value="<?php echo htmlspecialchars($result['isbn']); ?>" required>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" id="category" name="category" value="<?php echo htmlspecialchars($result['category']); ?>" required>
            </div>
            
            <div class="form-group">
                <input type="submit" name="submit" value="Update">
            </div>
        </form>
    </div>
</body>
</html>

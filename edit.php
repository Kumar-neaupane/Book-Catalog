<?php
include 'connection.php';
$id = $_GET['id'];
$selectquery = "SELECT * FROM addbook where id = $id";
                
$query = mysqli_query($conn, $selectquery);
$result = mysqli_fetch_assoc($query);

if (isset($_POST['submit'])){
    $bookname = $_POST['bookname'];
    $authorname = $_POST['authorname'];
    $isbn = $_POST['isbn'];
    $category = $_POST['category'];
    $file = $_FILES['bookimage'];

    $filename = $file['name'];
    $filepath = $file['tmp_name'];
    $fileerror = $file['error'];
    
    if($fileerror == 0){
        $destfile = 'BookImages/'.$filename;
        move_uploaded_file($filepath, $destfile);
        $updatequery = "UPDATE addbook SET bookname='$bookname', authorname='$authorname', isbn='$isbn', category='$category', bookimage='$destfile' WHERE id=$id";
        $query = mysqli_query($conn, $updatequery);

        if($query) {
            echo "Updated successfully";
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admininterface.css">
    <title>Edit Book</title>
</head>
<body>
    <div class="container">
        <h2>Edit Book</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="bookName">Book Name:</label>
                <input type="text" id="bookName" name="bookname" value="<?php echo $result['bookname']; ?>" required>
            </div>
            <div class="form-group">
                <label for="authorName">Author Name:</label>
                <input type="text" id="authorName" name="authorname" value="<?php echo $result['authorname']; ?>" required>
            </div>
            <div class="form-group">
                <label for="ISBN">ISBN:</label>
                <input type="text" id="ISBN" name="isbn" value="<?php echo $result['isbn']; ?>" required>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" id="category" name="category" value="<?php echo $result['category']; ?>" required>
            </div>
            <div class="form-group">
                <label for="bookImage">Book Image:</label>
                <input type="file" id="bookImage" name="bookimage" accept="image/*">
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="edit">
            </div>
        </form>
    </div>
</body>
</html>

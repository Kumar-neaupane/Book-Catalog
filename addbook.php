<?php
include 'connection.php';

if (isset($_POST['submit'])){
    $bookname = $_POST['bookname'];
    $authorname = $_POST['authorname'];
    $isbn = $_POST['isbn'];
    $category = $_POST['category'];
    $imageFile = $_FILES['bookimage'];
    $pdfFile = $_FILES['pdffile'];

    // Image file details
    $imageFileName = $imageFile['name'];
    $imageFilePath = $imageFile['tmp_name'];
    $imageFileError = $imageFile['error'];

    // PDF file details
    $pdfFileName = $pdfFile['name'];
    $pdfFilePath = $pdfFile['tmp_name'];
    $pdfFileError = $pdfFile['error'];
    
    if($imageFileError == 0 && $pdfFileError == 0){
        $imageDestFile = 'BookImages/'.$imageFileName;
        move_uploaded_file($imageFilePath, $imageDestFile);

        $pdfDestFile = 'BookImages/'.$pdfFileName;
        move_uploaded_file($pdfFilePath, $pdfDestFile);

        $insertQuery = "INSERT INTO addbook (bookname, authorname, isbn, category, bookimage, pdffile) 
                VALUES ('$bookname', '$authorname', '$isbn', '$category', '$imageDestFile', '$pdfDestFile')";

        $query = mysqli_query($conn, $insertQuery);

        if($query) {
            
            echo "Book Added successfully";
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
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="addbook.css">
</head>
<?php include 'adminheader.php' ?>

<body>

    <div id="add" class="tabcontent">
        <div class="containerr">
            <h2>Add Book</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="bookName">Book Name:</label>
                    <input type="text" id="bookName" name="bookname" required>
                </div>
                <div class="form-group">
                    <label for="authorName">Author Name:</label>
                    <input type="text" id="authorName" name="authorname" required>
                </div>
                <div class="form-group">
                    <label for="ISBN">ISBN:</label>
                    <input type="text" id="ISBN" name="isbn" required>
                </div>
                <div class="form-group">
                    <label for="category">Category:</label>
                    <input type="text" id="category" name="category" required>
                </div>
                <div class="form-group">
                    <label for="bookImage">Book Image:</label>
                    <input type="file" id="bookImage" name="bookimage" accept="image/*" required>
                </div>
                <div class="form-group">
                    <label for="pdfFile">PDF File:</label>
                    <input type="file" id="pdfFile" name="pdffile" accept=".pdf" required>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Add Book">
                </div>
            </form>
        </div>
    </div>
</body>

</html>
<?php include 'footer.php'  ?>
<?php
include 'connection.php';

if (isset($_POST['submit'])){
    $bookname = $_POST['bookname'];
    $authorname = $_POST['authorname'];
    $isbn = $_POST['isbn'];
    $category = $_POST['category'];
    $edition = $_POST['edition'];
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
    
    // Check if the book name and author name combination already exists
    $checkBookAuthorQuery = "SELECT * FROM addbook WHERE bookname='$bookname' AND authorname='$authorname'";
    $checkBookAuthorResult = mysqli_query($conn, $checkBookAuthorQuery);

    // Check if the ISBN number already exists
    $checkISBNQuery = "SELECT * FROM addbook WHERE isbn='$isbn'";
    $checkISBNResult = mysqli_query($conn, $checkISBNQuery);

    if(mysqli_num_rows($checkBookAuthorResult) > 0) {
        echo "<script>
                document.getElementById('error-message').textContent = 'Book with this name and author already exists.';
              </script>";
    } else if (mysqli_num_rows($checkISBNResult) > 0) {
        echo "<script>
                document.getElementById('error-message').textContent = 'ISBN number already exists.';
              </script>";
    } else {
        if($imageFileError == 0 && $pdfFileError == 0){
            $imageDestFile = 'BookImages/'.$imageFileName;
            move_uploaded_file($imageFilePath, $imageDestFile);

            $pdfDestFile = 'BookImages/'.$pdfFileName;
            move_uploaded_file($pdfFilePath, $pdfDestFile);

            $insertQuery = "INSERT INTO addbook (bookname, authorname, isbn, category, edition, bookimage, pdffile) 
                    VALUES ('$bookname', '$authorname', '$isbn', '$category', '$edition', '$imageDestFile', '$pdfDestFile')";

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
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <link rel="stylesheet" href="addbook.css">
    <style>
    .error {
        color: red;
    }
    </style>
    <script>
    function validateForm() {
        var bookName = document.getElementById("bookName").value;
        var authorName = document.getElementById("authorName").value;
        var isbn = document.getElementById("ISBN").value;
        var category = document.getElementById("category").value;
        var edition = document.getElementById("edition").value;
        var errorMessage = document.getElementById("error-message");

        var nameRegex = /^[A-Za-z\s]+$/;
        var isbnRegex = /^\d+$/;
        var editionRegex = /^[A-Za-z0-9\s]+$/;

        if (!nameRegex.test(bookName)) {
            errorMessage.textContent = "Book Name must contain only letters and spaces.";
            setTimeout(function() {
                errorMessage.textContent = "";
            }, 2000);
            return false;
        }

        if (!nameRegex.test(authorName)) {
            errorMessage.textContent = "Author Name must contain only letters and spaces.";
            setTimeout(function() {
                errorMessage.textContent = "";
            }, 2000);
            return false;
        }

        if (!isbnRegex.test(isbn)) {
            errorMessage.textContent = "ISBN must contain only numbers.";
            setTimeout(function() {
                errorMessage.textContent = "";
            }, 2000);
            return false;
        }

        if (!nameRegex.test(category)) {
            errorMessage.textContent = "Category must contain only letters and spaces.";
            setTimeout(function() {
                errorMessage.textContent = "";
            }, 2000);
            return false;
        }

        if (!editionRegex.test(edition)) {
            errorMessage.textContent = "Edition must contain only letters, numbers, and spaces.";
            setTimeout(function() {
                errorMessage.textContent = "";
            }, 2000);
            return false;
        }

        errorMessage.textContent = "";
        return true;
    }
    </script>
</head>
<?php include 'adminheader.php' ?>

<body>
    <div id="add" class="tabcontent">
        <div class="containerr">
            <h2>Add Book</h2>
            <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
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
                    <label for="edition">Edition:</label>
                    <input type="text" id="edition" name="edition" required>
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
                <div id="error-message" class="error"></div>
            </form>
        </div>
    </div>
</body>

</html>
<?php include 'footer.php' ?>
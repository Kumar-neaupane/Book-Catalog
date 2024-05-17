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
    <title>Add Book Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<?php 
include 'adminheader.php';
?>
<div class="container">
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

</body>
</html>

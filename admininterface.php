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
    <link rel="stylesheet" href="admininterface.css">
    <title>Active Tabs</title>
</head>
<body>
    <div class="tabs">
        <button class="tablink active" onclick="openTab('add')">Add Books</button>
        <button class="tablink" onclick="openTab('manage')">Manage Books</button>
        <button class="tablink" onclick="openTab('users')">Users</button>
        <button class="tablink" onclick="openTab('prequest')">Purchase Request</button>
        <button class="tablink"  ><a href="index.php">Logout</a></button>
    </div>

    <div id="add" class="tabcontent">
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
    </div>


    
    <div id="manage" class="tabcontent">
    <!--<div class="container">-->
       
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Book Name</th>
            <th>Author Name</th>
            <th>ISBN</th>
            <th>Category</th>
            <th>Book Image</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
                <?php
                $selectquery = "SELECT * FROM addbook";
                $query = mysqli_query($conn, $selectquery);

                while($result = mysqli_fetch_array($query)){
                ?>
                <tr>
                    <td><?php echo $result['id']; ?></td>
                    <td><?php echo $result['bookname']; ?></td>
                    <td><?php echo $result['authorname']; ?></td> 
                    <td><?php echo $result['isbn']; ?></td>
                    <td><?php echo $result['category']; ?></td>
                    <td><img src="<?php echo $result['bookimage']; ?>" alt="Book Image" class="book-image" height="100px" width="100px"></td>
                    <td><a href="edit.php? id= <?php echo $result['id']; ?>"><button class="edit-btn">Update</button></a></td>
                    <td><a href="delete.php? id= <?php echo $result['id']; ?>"><button class="delete-btn">Delete</button></a></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
</table>
    </div>
</div>

    <div id="users" class="tabcontent">
    <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Userid</th>
            <th>Email</th>
            
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
                <?php
                $selectquery = "SELECT * FROM usersignup";
                $query = mysqli_query($conn, $selectquery);

                while($result = mysqli_fetch_array($query)){
                ?>
                <tr>
                    <td><?php echo $result['id']; ?></td>
                    <td><?php echo $result['name']; ?></td>
                    <td><?php echo $result['student_id']; ?></td> 
                    <td><?php echo $result['email']; ?></td>
                    
                    <td><a href="deletuser.php? id= <?php echo $result['id']; ?>"><button class="delete-btn">Delete</button></a></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
</table>
        
    </div>

    <div id="prequest" class="tabcontent">
        <h3>Purchase Request Content</h3>
        <p>This is the content for purchase rquest.</p>
    </div>

    <div id="logout" class="tabcontent">
        <h3>Logout Content</h3>
        <p>This is the content for logging out.</p>
    </div>


    <script>
        function openTab(tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            event.currentTarget.className += " active";
        }

        document.getElementById("addBookForm").addEventListener("submit", function(event) {
            event.preventDefault(); 
            var form = this;
            var formData = new FormData(form);

            fetch(form.action, {
                method: form.method,
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('message').innerHTML = data;
                document.getElementById('message').style.display = 'block';
                setTimeout(function() {
                    document.getElementById('message').style.display = 'none';
                }, 3000); 
                form.reset(); 
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>

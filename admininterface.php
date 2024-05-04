<?php
include 'connection.php';

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
        $insertquery = "INSERT INTO addbook (bookname, authorname, isbn, category, bookimage) 
                        VALUES ('$bookname', '$authorname', '$isbn', '$category', '$destfile')";
        $query = mysqli_query($conn, $insertquery);

        if($query) {
            echo "Book Added succesfully";
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
        <button class="tablink" onclick="openTab('request')">Issued Request</button>
        <button class="tablink" onclick="openTab('issued')">Book Issued</button>
        <button class="tablink" onclick="openTab('logout')">Logout</button>
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
                    <input type="submit" name="submit" value="Add Book">
                </div>
            </form>
        </div>
    </div>

    <!-- Other tab content goes here -->
    <div id="manage" class="tabcontent">
    <div class="container">
        <table class="book-table">
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
                    <td><img src="<?php echo $result['bookimage']; ?>" alt="Book Image" class="book-image"></td>
                    <td><a href="edit.php? id= <?php echo $result['id']; ?>"><button class="edit-btn">Edit</button></a></td>
                    <td><a href=""><button class="delete-btn">Delete</button></a></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

    <div id="request" class="tabcontent">
        <h3>Issued Request Content</h3>
        <p>This is the content for issued requests.</p>
    </div>

    <div id="issued" class="tabcontent">
        <h3>Book Issued Content</h3>
        <p>This is the content for issued books.</p>
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

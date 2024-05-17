<?php include 'connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="header.css">
    <title>Search Results</title>
</head>
<body>
<div id="header">
    <div class="container">
        <nav>
            <img src="bookcatalog.png" alt="logo" class="logo">
            <ul id="sidemenu">
                <li><a href="home.php">Home</a></li>
                <li><a href="books.php">Books</a></li>
                <li><a href="orders.php">Orders</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="index.php">Logout</a></li>
                <li class="search-box">
                    <form action="search.php" method="GET">
                        <input type="text" name="query" placeholder="Search">
                        <button type="submit">Search</button>
                    </form>
                </li>
            </ul>  
        </nav>           
    </div>                
</div>

<div class="container">
    <h2>Search Results</h2>
    <?php
    if (isset($_GET['query'])) {
        $query = $_GET['query'];
        // Prevent SQL injection
        $query = mysqli_real_escape_string($conn, $query);
        
        $sql = "SELECT * FROM addbook WHERE 
                bookname LIKE '%$query%' OR 
                authorname LIKE '%$query%' OR 
                isbn LIKE '%$query%' OR 
                category LIKE '%$query%'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<table>
                    <tr>
                        <th>ID</th>
                        <th>Book Name</th>
                        <th>Author Name</th>
                        <th>ISBN</th>
                        <th>Category</th>
                    </tr>";
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['bookname']}</td>
                        <td>{$row['authorname']}</td>
                        <td>{$row['isbn']}</td>
                        <td>{$row['category']}</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "No results found.";
        }
    }
    ?>
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="header.css">
    <title>Document</title>
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
</body>
</html>

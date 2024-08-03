<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="header.css">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/d21d709eb4.js" crossorigin="anonymous"></script>
</head>

<body>
    <div id="header">
        <div class="container">
            <nav>
                <img src="bookcatalog.png" alt="logo" class="logo">
                <ul id="sidemenu">
                    <li><a href="home.php">Home</a></li>
                    <li><a href="books.php">Books</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="index.php">Logout</a></li>
                    <li class="search-box">
                        <form action="search.php" method="GET">
                            <input type="text" name="query" placeholder="Search">
                            <button type="submit">Search</button>
                        </form>
                    </li>
                    <!--- <i class="fa-solid fa-xmark" onclick="closemenu()"></i>-->
                </ul>
                <!--- <i class="fa-solid fa-bars" onclick="openmenu()"></i>--->
            </nav>
        </div>
    </div>

    <script>
    function openmenu() {
        document.getElementById("sidemenu").style.right = "0";
    }

    function closemenu() {
        document.getElementById("sidemenu").style.right = "-200px";
    }
    </script>
</body>

</html>
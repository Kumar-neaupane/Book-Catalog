<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="practice.css">
</head>
<style>
* {
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
    box-sizing: border-box;
}
html {
    scroll-behavior: smooth;
}

body {
    background-color: #ecf0f1;
    margin: 0; /* Ensure there's no margin on body */
    padding: 0; /* Ensure there's no padding on body */
}

.header-text {
    background-image: url(homepageimg.jpg);
    height: 500px;
    width: 1400px;
   padding-top: 50px;
   padding-left: 20px;
    font-size: 30px;
    display: flex; /* Use flexbox to center text */
    flex-direction: column;
    margin: 50px;
    color:#ecf0f1; /* Ensure text is readable against the background */
}

.header-text p, .header-text h1 {
    margin: 0; 
}

header {
    margin-bottom: 0; /* Ensure header has no bottom margin */
}

</style>
<body>
    <?php 
    include 'header.php';
    ?>

    <div class="header-text">
        <h1>Book Catalog System</h1>
        <p>Discover, manage, and enjoy your favorite books with our easy-to-use Book Catalog System.</p>
    </div>

    <?php
    include 'footer.php';
    ?>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="practice.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

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
            margin: 0; 
            padding: 0; 
        }

        @keyframes backgroundChange {
            0% { background-image: url('BookImages/image7.jpg'); }
            33% { background-image: url('BookImages/image8.webp'); }
            66% { background-image: url('BookImages/image07.jpg'); }
            100% { background-image: url('BookImages/image1.jpg'); }
        }

        @keyframes slideText {
            0% { transform: translateX(-100%); }
            50% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }

        .header-text {
            height: 500px;
            width: 100%;
            padding-top: 50px;
            padding-left: 20px;
            font-size: 30px;
            display: flex; 
            flex-direction: column;
            margin: 50px 0;
            color: #ecf0f1; 
            background-color: #000; 
            animation: backgroundChange 15s infinite;
            background-size: cover;
            background-position: center;
            position: relative;
            overflow: hidden; /* Ensure the text doesn't overflow outside */
        }

        .header-text h1, .header-text p {
            margin: 0; 
            position: absolute;
            white-space: nowrap; /* Prevent text from wrapping */
            animation: slideText 10s infinite linear;
        }

        .header-text h1 {
            top: 10%;
        }

        .header-text p {
            top: 50%;
        }

        header {
            margin-bottom: 0;
        }
    </style>
</head>
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

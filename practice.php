<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Book Catalog System</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #636e72;
        }
        .about-us {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1, h2 {
            color: #2c3e50;
            text-align: center;
        }
        h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }
        h2 {
            font-size: 2em;
            margin-bottom: 10px;
        }
        p {
            font-size: 1.2em;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .mission-vision {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 40px;
        }
        .mission, .vision {
            width: 48%;
        }
        .features, .how-to-use {
            margin-bottom: 40px;
        }
        ul, ol {
            font-size: 1.1em;
            margin-left: 20px;
        }
        li {
            margin-bottom: 10px;
        }
        strong {
            color: #2980b9;
        }
        @media (max-width: 768px) {
            .mission-vision {
                flex-direction: column;
            }
            .mission, .vision {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <?php 
    include 'header.php';
     ?>
    <div class="about-us">
        <section class="intro">
            <h1>Welcome to Our Book Catalog System</h1>
            <p>Your ultimate digital haven for book lovers, students, and researchers.  We're dedicated to providing a seamless and enriching reading experience with a vast collection of books across various genres and formats.</p>
        </section>
        <section class="mission-vision">
            <div class="mission">
                <h2>Our Mission</h2>
                <p>Empowering readers by offering a comprehensive platform that makes finding, reading, and managing books simple and enjoyable. We believe in the transformative power of books and aim to foster a community where readers can discover new interests, gain knowledge, and share their insights.</p>
            </div>
            <div class="vision">
                <h2>Our Vision</h2>
                <p>We envision a world where access to books and knowledge is unrestricted and universally available. <br>By continually expanding our catalog and enhancing our platform, we strive to be a leading resource for readers around the globe, promoting literacy, education, and a love for reading.</p>
            </div>
        </section>
        <section class="features">
            <h2>Key Features</h2>
            <ul>
                <li><strong>Extensive Book Database:</strong> A diverse collection of books across various genres, from timeless classics to contemporary bestsellers.</li>
                <li><strong>User-Friendly Search:</strong> Advanced search features allowing you to find books by title, author, keywords.</li>
                <li><strong>Detailed Book Information:</strong> In-depth book descriptions, author biographies, publication details, ISBN, and user reviews.</li>
                <li><strong>Download Options:</strong> Download and read offline.</li>
                <li><strong>Regular Updates:</strong> Continuously updated catalog with new releases and popular titles.</li>
            </ul>
        </section>
        <section class="how-to-use">
            <h2>How to Use Our System</h2>
            <ol>
                <li><strong>Search for Books:</strong> Use our search bar to find books by title, author, or keywords. Apply filters for refined results.</li>
                <li><strong>View Book Details:</strong> Click on any book in the search results for detailed information,  author.</li>
                <li><strong>Download Books:</strong> Choose your preferred format and click the download button to save the book to your device for offline reading.</li>
            </ol>
        </section>
    </div>
</body>
</html>
<?php
include 'footer.php';
?>


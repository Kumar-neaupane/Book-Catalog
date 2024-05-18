<?php include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="books.css">
</head>
<body>
   
    <?php include 'header.php'; ?>

    <main>
        <!-- Your book cards go here -->
        <?php
        $selectquery = "SELECT * FROM addbook";
        $query = mysqli_query($conn, $selectquery);

        while ($result = mysqli_fetch_array($query)) {
        ?>
            <div class="card">
                <div class="work">
                    <div class="image">
                        <img src="<?php echo htmlspecialchars($result['bookimage']); ?>" alt="img" name="bookimage">
                    </div>
                    <div class="caption">
                        <p class="bookname" name="bookname"><?php echo htmlspecialchars($result['bookname']); ?></p>
                        <p class="authorname" name="authorname"><?php echo htmlspecialchars($result['authorname']); ?></p>
                        <p class="isbn" name="isbn"><?php echo htmlspecialchars($result['isbn']); ?></p>
                        <p class="category" name="category"><?php echo htmlspecialchars($result['category']); ?></p>
                    </div>
                    <a href="<?php echo htmlspecialchars($result['pdffile']); ?>" class="download" name="pdffile" download>Download</a>
                </div>
            </div>
        <?php
        }
        ?>
    </main>

   
</body>
<?php include 'footer.php'; ?>
</html>

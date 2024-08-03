<?php include 'connection.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="search.css">
    <title>Search Results</title>
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="container">
        <main>

            <?php
    if (isset($_GET['query'])) {
        $query = $_GET['query'];
        
        
        $stmt = $conn->prepare("SELECT * FROM addbook WHERE 
                                bookname LIKE ? OR 
                                authorname LIKE ? OR 
                                isbn LIKE ? OR 
                                category LIKE ?");
        $searchTerm = "%$query%";
        $stmt->bind_param("ssss", $searchTerm, $searchTerm, $searchTerm, $searchTerm);
        
       
        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
            <div class="card">
                <div class="work">
                    <div class="image">
                        <img src="<?php echo htmlspecialchars($row['bookimage']); ?>" alt="img" name="bookimage">
                    </div>
                    <div class="caption">
                        <p class="bookname" name="bookname"><?php echo htmlspecialchars($row['bookname']); ?></p>
                        <p class="authorname" name="authorname"><?php echo htmlspecialchars($row['authorname']); ?></p>
                        <p class="isbn" name="isbn"><?php echo htmlspecialchars($row['isbn']); ?></p>
                        <p class="category" name="category"><?php echo htmlspecialchars($row['category']); ?></p>
                    </div>
                    <a href="<?php echo htmlspecialchars($row['pdffile']); ?>" class="download" name="pdffile"
                        download>Download</a>
                </div>
            </div>
            <?php
                }
            } else {
                echo "<p>No results found for '$query'.</p>";
            }
        } else {
            echo "<p>Error executing query: " . htmlspecialchars($stmt->error) . "</p>";
        }
        
        $stmt->close();
    } else {
        echo "<p>Please enter a search query.</p>";
    }
    ?>
        </main>
    </div>
</body>
<?php include 'footer.php'; ?>

</html>
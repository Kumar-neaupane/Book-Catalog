<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    main {
        flex: 1;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        background-color: #fff;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    img {
        max-width: 80px;
        height: auto;
    }

    .edit-btn,
    .delete-btn {
        padding: 8px 12px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 4px;
    }

    .edit-btn:hover,
    .delete-btn:hover {
        background-color: #45a049;
    }

    footer {
        background-color: #007bff;
        color: white;
        text-align: center;
        padding: 10px 0;
    }
    </style>
</head>

<body>
    <?php include 'connection.php'; ?>
    <?php include 'adminheader.php'; ?>

    <main>
        <div id="manage" class="tabcontent">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Book Name</th>
                        <th>Author Name</th>
                        <th>ISBN</th>
                        <th>Category</th>
                        <th>Edition</th>
                        <th>Book Image</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $selectquery = "SELECT * FROM addbook";
                    $query = mysqli_query($conn, $selectquery);

                    while($result = mysqli_fetch_assoc($query)){
                    ?>
                    <tr>
                        <td><?php echo $result['id']; ?></td>
                        <td><?php echo $result['bookname']; ?></td>
                        <td><?php echo $result['authorname']; ?></td>
                        <td><?php echo $result['isbn']; ?></td>
                        <td><?php echo $result['category']; ?></td>
                        <td><?php echo $result['Edition']; ?></td>
                        <td><img src="<?php echo $result['bookimage']; ?>" alt="Book Image" class="book-image"
                                height="100px" width="100px"></td>
                        <td><a href="edit.php?id=<?php echo $result['id']; ?>"><button
                                    class="edit-btn">Update</button></a></td>
                        <td><a href="delete.php?id=<?php echo $result['id']; ?>"><button
                                    class="delete-btn">Delete</button></a></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>

</html>
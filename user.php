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

        th, td {
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

        .edit-btn, .delete-btn {
            padding: 8px 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        .edit-btn:hover, .delete-btn:hover {
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
        <div id="users" class="tabcontent">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Userid</th>
                        <th>Email</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $selectquery = "SELECT * FROM usersignup";
                    $query = mysqli_query($conn, $selectquery);

                    while($result = mysqli_fetch_array($query)){
                    ?>
                    <tr>
                        <td><?php echo $result['id']; ?></td>
                        <td><?php echo $result['name']; ?></td>
                        <td><?php echo $result['student_id']; ?></td> 
                        <td><?php echo $result['email']; ?></td>
                        <td>
                            <a href="deletuser.php?id=<?php echo $result['id']; ?>">
                                <button class="delete-btn">Delete</button>
                            </a>
                        </td>
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

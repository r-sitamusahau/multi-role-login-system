<?php
session_start();
include ('./conn/conn.php');


if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT `name` FROM `tbl_user` WHERE `tbl_user_id` = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch();
        $user_name = $row['name'];
    }

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

        <style>
            * {
                margin: 0;
                padding: 0;
            }

            body {
                background-image: url("https://img.freepik.com/free-vector/abstract-secure-technology-background_23-2148357087.jpg?t=st=1704160688~exp=1704161288~hmac=b37f6a9bb894ee4655cd411712309f6507644a1de23f709e5dfc0c33ed33bb15");
                background-size: cover;
                background-repeat: no-repeat;
                background-attachment: fixed;        
                overflow: hidden;
                height: 100vh;
            }

            .main {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                background-color: rgba(0, 0, 0, 0.4);
                height: 100vh;
            }

            .title-container {
                text-align: center;
                width: 1000px;
                color: rgb(255, 255, 255);
                background-color: rgba(0, 0, 0, 0.6);
                padding: 40px;
                border-radius: 10px;
                margin: 20px;
                border: 1px solid;
            }

            .title-container > h1 {
                font-size: 80px;
            }

            .title-container > h2 {
                font-size: 40px;
                margin-bottom: 20px;
            }

            .title-container > a {
                font-size: 20px;
                padding: 8px 20px;
                color: rgb(255, 255, 255);
                background-color: rgba(100, 100, 100, 0.76);
                border: none;
                text-decoration: none;
            }

            .title-container > a:hover {
                color: rgb(100, 100, 100);
                background-color: rgba(255, 255, 255, 0.76);
            }
            
            .users-container {
                color: rgb(255, 255, 255);
                margin: 20px;
                width: 1000px;
                background-color: rgba(0, 0, 0, 0.6);
                padding: 40px;
                border-radius: 10px;
                border: 1px solid;
            }
        </style>
    </head>
    <body>
        
        <div class="main">

            <div class="title-container">

                <h1>Welcome Admin</h1>
                <h2> <?= $user_name ?></h2>

                <a href="./endpoint/logout.php">Log out</a>
            </div>

            <div class="users-container">
                <h2>List of Users</h2>
                <div class="table-responsive">
                    <table class="table" style="color:rgb(255, 255, 255);">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Account Name</th>
                                <th scope="col">Username</th>
                                <th scope="col">Password</th>
                                <th scope="col">Role</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php 
                            $stmt = $conn->prepare("SELECT * FROM `tbl_user`");
                            $stmt->execute();
                            $result = $stmt->fetchAll();

                            foreach ($result as $row) {
                                $userID = $row['tbl_user_id'];
                                $name = $row['name'];
                                $username = $row['username'];
                                $password = $row['password'];
                                $role = $row['role'];
                            ?>
                            <tr>
                                <td><?= $userID ?></td>
                                <td><?= $name ?></td>
                                <td><?= $username ?></td>
                                <td><?= $password ?></td>
                                <td><?= $role ?></td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    
    </body>
    </html>

    <?php
} else {
    header("Location: http://localhost/multi-role-login-system/");
}

?>


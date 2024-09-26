<?php
include('../conn/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT `password`, `role`, `tbl_user_id` FROM `tbl_user` WHERE `username` = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $stored_password = $row['password'];
        $stored_role = $row['role'];
        $user_id = $row['tbl_user_id'];

        if (password_verify($password, $stored_password)) {
            session_start();
            $_SESSION['user_id'] = $user_id;
            $_SESSION['role'] = $stored_role;

            if ($stored_role == 'admin') {
                header("Location: admin.php");
                exit;
            } else if ($stored_role == 'user') {
                header("Location: user.php");
                exit;
            }
        } else {
            echo "
            <script>
                alert('Login Failed, Incorrect Password!');
                window.location.href = 'http://localhost/multi-role-login-system/';
            </script>
            ";
        }
    } else {
        echo "
        <script>
            alert('Login Failed, User Not Found!');
            window.location.href = 'http://localhost/multi-role-login-system/';
        </script>
        ";
    }
}
?>

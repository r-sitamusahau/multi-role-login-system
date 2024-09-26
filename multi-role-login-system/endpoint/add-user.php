<?php 
include ('../conn/conn.php');

if (isset($_POST['name'], $_POST['role'], $_POST['username'], $_POST['password'])) {
    $name = $_POST['name'];
    $role = $_POST['role'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    try {
        $stmt = $conn->prepare("SELECT `name` FROM `tbl_user` WHERE `name` =  :name ");
        $stmt->execute(['name' => $name]);

        $nameExist =  $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($nameExist)) {
            $conn->beginTransaction();

            $insertStmt = $conn->prepare("INSERT INTO `tbl_user` (`name`, `role`, `username`, `password`) VALUES (:name, :role, :username, :password)");
            $insertStmt->bindParam('name', $name, PDO::PARAM_STR);
            $insertStmt->bindParam('role', $role, PDO::PARAM_STR);
            $insertStmt->bindParam('username', $username, PDO::PARAM_STR);
            $insertStmt->bindParam('password', $password, PDO::PARAM_STR);

            $insertStmt->execute();

            $conn->commit(); 

            echo "
            <script>
                alert('Registered Successfully!');
                window.location.href = 'http://localhost/multi-role-login-system/';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Account Already Exist!');
                window.location.href = 'http://localhost/multi-role-login-system/';
            </script>
            ";
        }

    }  catch (PDOException $e) {
        $conn->rollBack();
        echo "Error: " . $e->getMessage();
    }

}

?>

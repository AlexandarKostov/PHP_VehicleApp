
<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once __DIR__ . "/database/connection.php";
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM `admins` WHERE `username`= :username OR `email` = :email ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'username' => $username,
        'email' => $username,
    ]);

    if ($stmt->rowCount() == 1) {
        $user = $stmt->fetch();
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            header('Location: dashboard.php');
            die();
        } else {
            $_SESSION['msg'] = 'Wrong credentials';
            header('Location: login.php');
            die();
        }
    } else {
        $_SESSION['msg'] = 'User not found';
        header('Location: login.php');
        die();
    }
} else {
    header('Location: index.php');
    die();
}

?>   



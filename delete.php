<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once __DIR__ . "/database/connection.php";
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'delete') {
            $sqlDelete = "DELETE FROM `registrations` WHERE id=:id";
            $stmtDelete = $pdo->prepare($sqlDelete);
            if ($stmtDelete->execute([
                'id' => $_POST['id']
            ])) {
                $_SESSION['msg']['success'] = 'Deleted';
                header('Location: dashboard.php');
                die();
            } else {
                $_SESSION['msg']['error'] = 'Error';
                header('Location: dashboard.php');
                die();
            }
        }
    }
}

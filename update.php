<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once __DIR__ . "/database/connection.php";
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'edit') {
            
            $sql = "UPDATE `registrations` SET 
            vehicle_model_id = :vehicle_model_id,
            vehicle_type_id = :vehicle_type_id,
            fuel_type_id = :fuel_type_id,
            chasis_number = :chasis_number,
            reg_number = :reg_number,
            reg_to = :reg_to,
            product_year = :product_year
            WHERE id = :id";

            $stmt = $pdo->prepare($sql);
            
            $execute = $stmt->execute([
                'vehicle_model_id' => $_POST['vehicle_model_id'],
                'vehicle_type_id' => $_POST['vehicle_type_id'],
                'fuel_type_id' => $_POST['fuel_type_id'],
                'chasis_number' => $_POST['chasis_number'],
                'reg_number' => $_POST['reg_number'],
                'reg_to' => $_POST['reg_to'],
                'product_year' => $_POST['product_year'],
                'id' => $_POST['id']
            ]);
            if ($execute) {
                $_SESSION['msg']['success'] = 'Update';
                header('Location: dashboard.php');
                die();
            } else {
                $_SESSION['msg']['success'] = 'Erorr happend while you editing';
                header('Location: dashboard.php');
                die();
            }
        }
    }
} 

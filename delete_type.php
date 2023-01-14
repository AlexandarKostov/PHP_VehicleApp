<?php
session_start();
require_once __DIR__ . "/database/connection.php";

$id = $_GET['id'];
$sql = "SELECT `registrations`.*, `vehicle_model`.`vehicle_model_dropdown` AS `vehicle_model_id`, `vehicle_type`.`vehicle_type_dropdown` AS `vehicle_type_id`, `fuel_type`.`fuel_type_dropdown` AS `fuel_type_id`, chasis_number, reg_number, reg_to , product_year FROM `registrations` JOIN `vehicle_model` ON `registrations`.`vehicle_model_id`=`vehicle_model`.`id` JOIN `vehicle_type` ON `registrations`.`vehicle_type_id` = `vehicle_type`.`id` JOIN `fuel_type` ON `registrations`.`fuel_type_id` = `fuel_type`.`id` WHERE registrations.id = :id LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
if ($stmt->rowCount() == 0) {
    header("Location: dashboard.php");
    die();
}
$user = $stmt->fetch();



?>

<!DOCTYPE html>
<html>

<head>
    <title>Document</title>
    <meta charset="utf-8" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <!-- Latest compiled and minified Bootstrap 5.3.1 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/style.css" />
    <!-- Latest Font-Awesome CDN -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">

</head>

<body>

    <div class="container-fluid">
        <div class="row d-flex justify-content-center py-5 px-5">
            <div class="alert alert-primary d-flex align-items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </svg>
                <div>
                    You are on the page where you want to delete your choosen model, are you sure ?
                </div>
            </div>
            <table class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Vehcle Model</th>
                        <th scope="col">Vehicle Type</th>
                        <th scope="col">Vehicle Chassis Number</th>
                        <th scope="col">Vehicle Product Year</th>
                        <th scope="col">Registration Number</th>
                        <th scope="col">Fuel Type</th>
                        <th scope="col">Registration to</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row"><?= $user['id'] ?></th>
                        <td><?= $user['vehicle_model_id'] ?></td>
                        <td><?= $user['vehicle_type_id'] ?></td>
                        <td><?= $user['chasis_number'] ?></td>
                        <td><?= $user['product_year'] ?></td>
                        <td><?= $user['reg_number'] ?></td>
                        <td><?= $user['fuel_type_id'] ?></td>
                        <td><?= $user['reg_to'] ?></td>
                        <td>
                            <form action="./delete.php" method="POST">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Latest Compiled Bootstrap 4.4.1 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>
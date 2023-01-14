<?php
session_start();




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once __DIR__ . "/database/connection.php";
    $sql = "SELECT `registrations`.*, `vehicle_model`.`vehicle_model_dropdown` AS `vehicle_model_id`, `vehicle_type`.`vehicle_type_dropdown` AS `vehicle_type_id`, `fuel_type`.`fuel_type_dropdown` AS `fuel_type_id`, chasis_number, reg_number, reg_to , product_year FROM `registrations` JOIN `vehicle_model` ON `registrations`.`vehicle_model_id`=`vehicle_model`.`id` JOIN `vehicle_type` ON `registrations`.`vehicle_type_id` = `vehicle_type`.`id` JOIN `fuel_type` ON `registrations`.`fuel_type_id` = `fuel_type`.`id` WHERE `reg_number` LIKE ?";
    $stmt = $pdo->prepare($sql);
    $search = '%' . $_POST['search'] . '%';
    $stmt->execute([
        $search
    ]);
    if ($stmt->rowCount() >= 1) {
        $reg_plate = $stmt->fetch();
    } else {
        $_SESSION['msg']['error'] = 'Vehicle with that registration plate is not found';
        header('Location: index.php');
        die();
    }
}


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

    <nav class="navbar navbar-expand-lg navbar-light bg-light ">
        <div class="container-fluid ">
            <a class="navbar-brand" href="index.php">Registration Vehicle</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="ms-auto">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active text-primary" aria-current="page" href="login.php">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <h1 class="fw-bold text-center mt-3"> Full information about the car with the plate number: is displayed below</h1>
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
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th scope="col"><?= $reg_plate['id'] ?></th>
                        <th scope="col"><?= $reg_plate['vehicle_model_id'] ?></th>
                        <th scope="col"><?= $reg_plate['vehicle_type_id'] ?></th>
                        <th scope="col"><?= $reg_plate['chasis_number'] ?></th>
                        <th scope="col"><?= $reg_plate['product_year'] ?></th>
                        <th scope="col"><?= $reg_plate['reg_number'] ?></th>
                        <th scope="col"><?= $reg_plate['fuel_type_id'] ?></th>
                        <th scope="col"><?= $reg_plate['reg_to'] ?></th>
                    </tr>
                </thead>
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
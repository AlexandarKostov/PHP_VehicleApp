<?php
session_start();
require_once __DIR__ . "/database/connection.php";
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    die();
}
$sqlModel = "SELECT * FROM `vehicle_model`";
$stmt = $pdo->query($sqlModel);
$sqlType = "SELECT * FROM `vehicle_type`";
$stmtType = $pdo->query($sqlType);
$sqlFuel = "SELECT * FROM `fuel_type`";
$stmtFuel = $pdo->query($sqlFuel);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'create') {
            $sqlCreate = "INSERT INTO `registrations` 
             (vehicle_model_id, vehicle_type_id, fuel_type_id, chasis_number, reg_number, reg_to, product_year)
             VALUES
             (:vehicle_model_id, :vehicle_type_id, :fuel_type_id, :chasis_number, :reg_number, :reg_to, :product_year)";
            $stmtCreate = $pdo->prepare($sqlCreate);
            if ($stmtCreate->execute([
                'vehicle_model_id' => $_POST['vehicle_model_id'],
                'vehicle_type_id' => $_POST['vehicle_type_id'],
                'fuel_type_id' => $_POST['fuel_type_id'],
                'chasis_number' => $_POST['chasis_number'],
                'reg_number' => $_POST['reg_number'],
                'reg_to' => $_POST['reg_to'],
                'product_year' => $_POST['product_year']
            ])) {
                $_SESSION['msg']['success'] = 'New vehicle added';
                header('Location: dashboard.php');
                die();
            } else {
                $messages['msg']['error'] = "Erorr occured";
                header('Location: dashboard.php');
                die();
            }
        } elseif ($_POST['action'] == 'search') {

            $sqlSearch = "SELECT `registrations`.*, `vehicle_model`.`vehicle_model_dropdown` AS `vehicle_model_id`, `vehicle_type`.`vehicle_type_dropdown` AS `vehicle_type_id`, `fuel_type`.`fuel_type_dropdown` AS `fuel_type_id`, chasis_number, reg_number, reg_to , product_year FROM `registrations` JOIN `vehicle_model` ON `registrations`.`vehicle_model_id`=`vehicle_model`.`id` JOIN `vehicle_type` ON `registrations`.`vehicle_type_id` = `vehicle_type`.`id` JOIN `fuel_type` ON `registrations`.`fuel_type_id` = `fuel_type`.`id` WHERE `chasis_number` LIKE ? or `reg_number` LIKE ?";
            $stmtSearch = $pdo->prepare($sqlSearch);
            $search = '%' . $_POST['search'] . '%';
            $stmtSearch->execute([
                $search,
                $search
            ]);
            if ($stmtSearch->rowCount() >= 1) {
                $listSearchVehicle = $stmtSearch->fetch();
            } else {
                $_SESSION['msg']['error'] = 'Vehicle not found';
                header('Location: dashboard.php');
                die();
            }
        }
    }
}



$sqlList = "SELECT `registrations`.*, `vehicle_model`.`vehicle_model_dropdown` AS `vehicle_model_id`, `vehicle_type`.`vehicle_type_dropdown` AS `vehicle_type_id`, `fuel_type`.`fuel_type_dropdown` AS `fuel_type_id`, chasis_number, reg_number, reg_to , product_year FROM `registrations` JOIN `vehicle_model` ON `registrations`.`vehicle_model_id`=`vehicle_model`.`id` JOIN `vehicle_type` ON `registrations`.`vehicle_type_id` = `vehicle_type`.`id` JOIN `fuel_type` ON `registrations`.`fuel_type_id` = `fuel_type`.`id`";
$stmtList = $pdo->query($sqlList);

// $sqlDate = "SELECT * FROM `registrations` WHERE reg_to BETWEEN CURDATE() and DATE_ADD(CURDATE(), INTERVAL 30 DAY)";
// $stmtDate = $pdo->query($sqlDate);
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
                            <a class="nav-link active text-primary" aria-current="page" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
                <?php if (isset($_SESSION['msg']['success'])) { ?>
                    <div class="alert alert-success">
                        <?= $_SESSION['msg']['success']; ?>
                    </div>
                <?php }
                unset($_SESSION['msg']['success']); ?>
                <?php if (isset($_SESSION['msg']['error'])) { ?>
                    <div class="alert alert-danger">
                        <?= $_SESSION['msg']['error']; ?>
                    </div>
                <?php }
                unset($_SESSION['msg']['error']); ?>
            </div>
            <form method="POST" action="">
                <input type="hidden" name="action" value="create">
                <div class="row d-flex justify-content-center my-5">
                    <h1 class="text-center fw-bold">Vehicle Registration</h1>
                    <div class="col-lg-4 col-md-4 col-sm-12 py-5">
                        <div class="mb-3">
                            <label for="vehicle_model_id" class="form-label">Vehicle Model</label>
                            <select class="form-select" name="vehicle_model_id" id="vehicle_model_id">
                                <?php
                                while ($model = $stmt->fetch()) { ?>
                                    <option value="<?= $model['id'] ?>"><?= $model['vehicle_model_dropdown'] ?></option>

                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="chasis_number" class="form-label">Vehicle chassis number</label>
                            <input type="text" class="form-control" id="chasis_number" name="chasis_number">
                        </div>
                        <div class="mb-3">
                            <label for="reg_number" class="form-label">Registration number</label>
                            <input type="text" class="form-control" id="reg_number" name="reg_number">
                        </div>
                        <div class="mb-3">
                            <label for="reg_to" class="form-label">Registration to</label>
                            <input type="date" class="form-control" id="reg_to" name="reg_to">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 py-5">
                        <div class="mb-3">
                            <label for="vehicle_type_id" class="form-label">Vehicle Type</label>
                            <select class="form-select" name="vehicle_type_id" id="vehicle_type_id">
                                <?php
                                while ($type = $stmtType->fetch()) { ?>
                                    <option value="<?= $type['id'] ?>"><?= $type['vehicle_type_dropdown'] ?></option>

                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="product_year" class="form-label">Vehicle product year</label>
                            <input type="date" class="form-control" id="product_year" name="product_year">
                        </div>
                        <div class="mb-3">
                            <label for="fuel_type_id" class="form-label">Vehicle Fuel</label>
                            <select class="form-select" name="fuel_type_id" id="fuel_type_id">
                                <?php
                                while ($fuel = $stmtFuel->fetch()) { ?>
                                    <option value="<?= $fuel['id'] ?>"><?= $fuel['fuel_type_dropdown'] ?></option>

                                <?php } ?>
                            </select>
                        </div>
                        <div class="d-grid gap-2 mx-auto mt-5">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <?php echo '<button type="button" onClick="var loc = window.location; window.location = loc.protocol + \'//\' + loc.host + loc.pathname + loc.search;" class="btn btn-secondary float-right">Cancel</button>'; ?>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="container-fluid">
            <div class="row">
                <form action="./dashboard.php" method="POST">
                    <div class="col-lg-12 col-md-12 col-sm-12 bg-light">
                        <div class="col-lg-4 col-md-12 col-sm-12 d-flex  py-3 ms-auto">
                            <input type="hidden" name="action" value="search">
                            <input class="form-control me-2" type="search" placeholder="Search..." name="search">
                            <button class="btn btn-outline-primary" type="submit">Search</button>
                        </div>
                    </div>
                </form>
                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Vehicle Model</th>
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
                        <?php if (isset($listSearchVehicle)) { ?>
                            <tr>
                                <th scope="col"><?= $listSearchVehicle['id'] ?></th>
                                <th scope="col"><?= $listSearchVehicle['vehicle_model_id'] ?></th>
                                <th scope="col"><?= $listSearchVehicle['vehicle_type_id'] ?></th>
                                <th scope="col"><?= $listSearchVehicle['chasis_number'] ?></th>
                                <th scope="col"><?= $listSearchVehicle['product_year'] ?></th>
                                <th scope="col"><?= $listSearchVehicle['reg_number'] ?></th>
                                <th scope="col"><?= $listSearchVehicle['fuel_type_id'] ?></th>
                                <th scope="col"><?= $listSearchVehicle['reg_to'] ?></th>
                                <td class="col">
                                    <a href="./dashboard.php" class="btn btn-primary">All list</a>
                                </td>
                            </tr>
                        <?php } else { ?>
                            <tr>
                                <?php while ($list = $stmtList->fetch()) { ?>
                                    <th scope="col"><?= $list['id'] ?></th>
                                    <th scope="col"><?= $list['vehicle_model_id'] ?></th>
                                    <th scope="col"><?= $list['vehicle_type_id'] ?></th>
                                    <th scope="col"><?= $list['chasis_number'] ?></th>
                                    <th scope="col"><?= $list['product_year'] ?></th>
                                    <th scope="col"><?= $list['reg_number'] ?></th>
                                    <th scope="col"><?= $list['fuel_type_id'] ?></th>
                                    <th scope="col"><?= $list['reg_to'] ?></th>
                                    <th class="me-auto">
                                        <a href="./edit.php?id=<?= $list['id'] ?>" class="btn btn-warning">Edit</a>
                                        <a href="./delete_type.php?id=<?= $list['id'] ?>" class="btn btn-danger">Delete</a>
                                    </th>
                            </tr>
                    <?php }
                            } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Latest Compiled Bootstrap 4.4.1 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>
<?php
session_start();
require_once __DIR__ . "/database/connection.php";



$id = $_GET['id'];
$sqlGetId = "SELECT * FROM `registrations` WHERE id = :id LIMIT 1";
$stmtGetId = $pdo->prepare($sqlGetId);
$stmtGetId->execute(['id' => $id]);
if ($stmtGetId->rowCount() == 0) {
    header("Location: dashboard.php");
    die();
}
$update = $stmtGetId->fetch();



$sqlModel = "SELECT * FROM `vehicle_model`";
$stmt = $pdo->query($sqlModel);
$sqlType = "SELECT * FROM `vehicle_type`";
$stmtType = $pdo->query($sqlType);
$sqlFuel = "SELECT * FROM `fuel_type`";
$stmtFuel = $pdo->query($sqlFuel);




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
        <div class="row">
            <form method="POST" action="./update.php">
                <input type="hidden" name="id" value="<?= $update['id'] ?>">
                <div class="row d-flex justify-content-center my-5">
                    <h1 class="text-center fw-bold">Vehicle Update</h1>
                    <div class="col-lg-4 col-md-12 col-sm-12 py-5">
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
                    <div class="col-lg-4 col-md-12 col-sm-12 py-5">
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
                            <input type="hidden" name="action" value="edit">
                            <input type="hidden" name="id" value="<?= $update['id'] ?>">
                            <button type="submit" class="btn btn-warning">Edit</button>
                            <?php echo '<button type="button" onClick="var loc = window.location; window.location = loc.protocol + \'//\' + loc.host + loc.pathname + loc.search;" class="btn btn-secondary float-right">Cancel</button>'; ?>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Latest Compiled Bootstrap 4.4.1 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>
<?php 
session_start();
if(isset($_SESSION['username'])){
    header('Location:dashboard.php');
    die();
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


    <div class="container-fluid py-4">
    <div class="row">
            <div class="col-md-4 offset-md-4 my-4">
            <?php if(isset($_SESSION['msg'])) {?>
                <div class="alert alert-danger">
                    <?= $_SESSION['msg']; ?>
                </div>
                <?php } unset($_SESSION['msg']); ?>
            </div>
        </div>
        <form method="POST" action="registration_list.php">
            <div class="row d-flex justify-content-center text-center">
                <div class="p-5 mx-5 my-5 bg-light">
                    <h1 class="display-5 fw-bold py-5">Vehicle Registration</h1>
                    <p class="fs-4">Enter your car registration number to check if it's valid</p>
                    <div class="col-6 mx-auto">
                        <input type="text" class="form-control" placeholder="Enter your car registration plate" name="search" id="search">
                        <button type="submit" class="btn btn-primary mt-3">Search</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Latest Compiled Bootstrap 4.4.1 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>
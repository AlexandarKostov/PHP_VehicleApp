<?php
session_start();
if (isset($_SESSION['username'])) {
    header('Location: dashboard.php');
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Registration Vehicle</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 offset-md-4 my-4">
                <?php if (isset($_SESSION['msg'])) { ?>
                    <div class="alert alert-danger">
                        <?= $_SESSION['msg']; ?>
                    </div>
                <?php }
                unset($_SESSION['msg']); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12 offset-lg-4 mt-4">
                <form action="auth.php" method="POST">
                    <div class="form-group">
                        <label for="username" class="form-label">Username/ Email address</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="john / john@example.com">
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">Enter your password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-success">Login</button>
                </form>
            </div>
        </div>
    </div>
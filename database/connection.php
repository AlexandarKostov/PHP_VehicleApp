<?php 
require_once __DIR__ . "/../const.php";

try{
    $pdo = New PDO("mysql:host=localhost;dbname=" .DB_NAME, DB_USERNAME, DB_PASSWORD, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
}catch(PDOException $e){
    echo "Someting went wrong";
    die();

}

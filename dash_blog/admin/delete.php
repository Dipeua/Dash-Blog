<?php
require_once '../func/dbconnect.php';

if(isset($_GET['id'])){
    $query = $pdo->prepare("DELETE FROM articles WHERE id = :id");
    $query->execute([
        "id" => htmlentities($_GET['id'])
    ]);
}

header("Location: dashboard.php");
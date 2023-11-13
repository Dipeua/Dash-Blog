<?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=dash_blog', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ]);
}catch(Exception $e){
    die("Erreur de connection a la bd: " . $e->getMessage());
}


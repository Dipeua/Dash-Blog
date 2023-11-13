<?php

function isConnected(){
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    return !empty($_SESSION['connected']);
}

function forceToConnect(){
    if(!isConnected()){
        header('Location: /dash_blog/admin/index.php');
        die();
    }
}
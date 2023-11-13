<?php
session_start();
unset($_SESSION['connected']);
header('Location: /dash_blog/admin/index.php');
<?php
require_once '../func/dbconnect.php';
require_once '../func/auth.php';
$error = null;

try {
    $query = $pdo->query('SELECT * FROM users');
    $users = $query->fetchAll();
} catch(Exception $e){
    die("Erreur SQL: " . $e->getMessage());
}

if(!empty($_POST['username']) && !empty($_POST['password'])){
    $username = htmlentities($_POST['username']);
    $password = htmlentities($_POST['password']);
    foreach($users as $user){
        if($username == $user->username && password_verify($password, $user->password)){
            session_start();
            $_SESSION['connected'] = $user->id;
            header('Location: /dash_blog/admin/dashboard.php');
            exit();
        } else {
            $error = true;
        }
    }
}

if(isConnected()){
    header('Location: /dash_blog/admin/dashboard.php');
    exit();
}


?>

<title>Dash Blog - Login</title>
<link rel="stylesheet" href="admin.css">
<main>
    <div class="login-page">
        <h2 style="text-align: center;">Login</h2>    
        <?php if ($error) : ?>
            <p class="error">📢 Identifiant ou mot de passe incorrect.</p>
        <?php endif ?>
        <form action="" method="post">
            <div>    
                <label for="username">Nom d'utilisateur: </label>
                <input required type="text" name="username" id="username" placeholder="Vueillez renseigner votre nom" value="<?php if(isset($_POST['username'])) { echo htmlspecialchars($_POST['username']); } ?>">
            </div>
            <div>    
                <label for="password">Mot de passe: </label>
                <input required type="password" name="password" id="password" placeholder="Votre mot de passe">
            </div>
            <div>
                <button type="submit">Se connecter</button>                                
            </div>
        </form>
        <div>
            Retour a la <a href="../index.php">page d'accuel.</a>
        </div>
    </div>
</main>

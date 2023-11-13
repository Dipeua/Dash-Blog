<?php
require_once '../func/dbconnect.php';
require_once '../func/const.php';
require_once '../func/auth.php';
require_once '../func/functions.php';
forceToConnect();
require_once 'dash_header.php';


$error = null;
$success = null;
try{    
    if(isset($_POST['title'], $_POST['content'])){
        if(!empty($_POST['title']) AND !empty($_POST['content'])){
            $title = htmlentities($_POST['title']);
            $content = htmlentities($_POST['content']);
            $query = $pdo->prepare("INSERT INTO articles(title, content, create_at, users_id) VALUES(:title, :content, :create_at, :users_id)");
            $current_date = date('Y-m-d H:i:s');
            $query->execute([
                'title' => $title,
                'content' => $content,
                'create_at' => $current_date,
                'users_id' => $_SESSION['connected']
            ]);
            $link = '<a class="articleAdded" href="edit.php?id='. $pdo->lastInsertId() .'">Le modifier</a>';
            $success = "✅ Votre article a eter ajouter → $link";

        } else {
            $error = "📢 Tout les champs doivent etre remplir.";
        }
    }
} catch(Exception $e){
    die($e->getMessage());
}

?>

<style>
    .articleAdded{
        color: inherit;
    }
</style>
<main>
    <div>
        <?php require_once 'const_header.php'; ?>
        <a href="dashboard.php">Revenir au listing</a>
        <p>
            Ajouter un article a la base de donnees.
        </p>
            
        <?php if($error): ?>
            <p class="error">
                <?= $error ?>
            </p>
        <?php endif ?>

        <?php if($success): ?>
            <p class="success">
                <?= $success ?>
            </p>
        <?php endif ?>

        <form action="" method="post">
        <!-- enctype="multipart/form-data" -->
            <div>
                <input placeholder="Tire de l'article" type="text" name="title" value="<?= (!empty($_GET['id'])) ? htmlentities($article->title) : null ?>">
            </div>
            <!-- <div>
                <label for="image">Sélectionner une image :</label>
                <input type="file" name="image" accept="image/*">
            </div> -->
            <textarea placeholder="Contenu de l'article" id="editor1" name="content"><?= !empty($_GET['id']) ? htmlentities($article->content) : null ?></textarea>
            <div>
                <button type="submit">Sauvegarder</button>                                
            </div>
        </form>

    </div>
</main>
<script src="https://cdn.ckeditor.com/4.23.0-lts/standard/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('editor1');
</script>
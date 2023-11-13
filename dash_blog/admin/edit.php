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
    if(isset($_GET['id']) AND !empty($_GET['id'])){
        $id = htmlentities($_GET['id']);
        if(isset($_POST['title'], $_POST['content']) && !empty($_POST['title']) && !empty($_POST['content'])){
            $title = htmlentities($_POST['title']);
            $content = htmlentities($_POST['content']);
            $current_date = date('Y-m-d H:i:s');
            $query = $pdo->prepare("UPDATE articles SET title = :title, content = :content WHERE id = :id");
            $query->execute([
                'title' => $title,
                'content' => $content,
                'id' => $id
            ]);
            $success = true;
        }
    
        $query_other = $pdo->prepare("SELECT * FROM articles WHERE id = :id");
        $query_other->execute([
            'id' => $id
        ]);
        if($query_other->rowCount() == 1){
            $article = $query_other->fetch();
        } else {
            $error = "Cet article n'existe pas !";
        }

    } else {
        $error = "Une erreur est survenu : URL est invalide";
    }

} catch(Exception $e){
    die("Erreur " .$e->getMessage());
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
        <a href="dashboard.php" class="col">← Revenir au listing</a>
        <p>
            Modifier un article dans la base de donnees.
        </p>
            
        <?php if($error): ?>
            <p class="error">
                <?= $error ?>
            </p>
        <?php else: ?>
            <?php if($success): ?>
                <p class="success">
                    ✅L'article a bien ete modifier. 
                </p>
            <?php endif ?>
            <form action="" method="post">
                
                <div>
                    <input placeholder="Tire de l'article" type="text" name="title" value="<?= (!empty($_GET['id'])) ? $article->title : null ?>">
                </div>
                <textarea placeholder="Contenu de l'article" name="content" id="editor1"><?= !empty($_GET['id']) ? $article->content : null ?></textarea>
                <div>
                    <button type="submit">Modifier</button>                                
                </div>
            </form>
        <?php endif ?>

        

    </div>
</main>
<script src="https://cdn.ckeditor.com/4.23.0-lts/standard/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('editor1');
</script>

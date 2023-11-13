<?php
require 'func/functions.php';
require 'func/auth.php';
require 'func/dbconnect.php';
require 'layouts/header.php';

$error = null;
if(isset($_GET['id']) AND !empty($_GET['id'])){
    $id = htmlentities($_GET['id']);
    $article = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
    $article->execute([$id]);
    if($article->rowCount() == 1){
        $article = $article->fetch();
        $title = $article->title;
        $content = $article->content;
    } else {
        $error = "Cet article n'existe pas !";
    }
} else {
    $error = "Tu essai de me pirater C'est rater l'URL est invalide";
}

?>
<main>
    <h1>Welcome to Dash Blog</h1>
    <?php if($error): ?>
        <p class="error">
            <?= $error ?>
        </p>
    <?php else: ?>
        <div class="bb">
            <a href="index.php">← Retour</a><br>
            <style>
                .bb {
                    line-height: normal;
                    position: relative;
                }
                .bb p{
                    line-height: 25px;
                }

                .bb a {
                    text-decoration: none;    
                    color: rgba(24, 24, 23);
                    font-weight: bold;
                }
                .bb a:hover {
                    text-decoration: underline;
                }

                .bb p a {
                    font-weight: 700;
                }
            </style>
        </div>

        <div>
            <div style="text-align: center;"><!-- 
                <img src="img/bloodhound.png" alt="#" style="height:250px;"> -->
            </div>
            <h1 class="detector">
                <?= $article->title ?>
            </h1>
            <?php  ?>
            <span style="font-size: 13px; margin:0;padding:0px;font-weight:100;">Publier le <?= $article->create_at ?> par <i><?= getAuthor($pdo, $article) ?></i></span>
            <div>
                <?= trim(html_entity_decode($article->content)) ?>
            </div>
        </div>
    <?php endif ?>
</main>
<?php require 'layouts/footer.php'; ?>
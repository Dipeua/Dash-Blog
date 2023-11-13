<?php 
require 'func/functions.php';
require 'func/auth.php';
require 'func/dbconnect.php';
require 'layouts/header.php';

$articles = $pdo->query("SELECT * FROM articles ORDER BY id DESC LIMIT 5")->fetchAll();

?>
<main>
    <h1>Welcome to Dash Blog</h1>
    <p>
        Dash Blog est une application web qui un implemente les fonctionnalitees d'un blog. vous pouvez controller le site en accedant au <a href="admin/dashboard.php" title="les identifiants par defaut sont admin:admin">Dashboard</a>
    </p>
    <?php foreach($articles as $article): ?>
        <div class="blog_container">
            <div style="text-align: center;">
                <!-- <img src="img/bloodhound.png" alt="#" style="height:250px;"> -->
            </div>
            <h2 style="margin: 0;">
                <a title="<?= $article->title ?>" href="show.php?id=<?= $article->id?>"><?= $article->title ?></a>
            </h2>
            <?php  ?>
            <span style="font-size: 13px; margin:0;padding:0px;font-weight:100;">Publier le <?= $article->create_at ?> par <i><?= getAuthor($pdo, $article) ?></i></span>
            <div>
                <?= substr(strip_tags(html_entity_decode($article->content)), 0, 500); ?>
            </div>
            <p><a href="show.php?id=<?= $article->id?>">Lire la suite →</a></p>
        </div>
    <?php endforeach ?>
</main>
<?php require 'layouts/footer.php'; ?>
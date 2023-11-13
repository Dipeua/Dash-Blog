<?php
require_once '../func/dbconnect.php';
require_once '../func/const.php';
require_once '../func/auth.php';
require_once '../func/functions.php';
require_once 'dash_header.php';
forceToConnect();

$query = "SELECT * FROM articles";
$params = [];
if(!empty($_GET['q'])){
    $q = htmlentities($_GET['q']);
    $query .= " WHERE title LIKE :req";
    $params['req'] = '%'. $q . '%';
    if(empty($params)){
        echo "Aucum element trouver";
    }
}

$query .= "  ORDER BY create_at DESC LIMIT 5";

$statement = $pdo->prepare($query);
$statement->execute($params);

$articles = $statement->fetchAll();
?>

    <main> 
            <?php require 'const_header.php'; ?>
        <br>
        <p>Gérez vos articles avec facilité : ajoutez, modifiez, supprimez. Tout sous contrôle dans un tableau clair</p>
    <div>
        <form action="" method="get" class="search-zone">
            <style>
                .search-zone input[type="submit"]{
                    display: none;
                }
                .search-zone input[type="search"]{
                    width: 100%;
                    font-family: 'Montserrat';
                    padding: 10px;
                    font-size: 14px;
                    outline: none;
                    border-radius: 4px;
                    border: 1px solid rgba(24, 24, 23, 0.2);
                }

                
                .search-zone input[type="search"]:focus{
                    border-color: rgba(24, 24, 23, 0.2);
                    box-shadow: 0px 0px 3px rgba(24, 24, 23, 0.2);
                }

                .search-notfound {
                    font-size: 30px;
                    text-align: center;
                    margin-top: 18%;
                    border: 1px solid;
                }

            </style>
            <div>
                <input value="" type="search" name="q" placeholder="Rechercher un article">
            </div>
            <input type="submit" value="Rechercher">
        </form>
        <div class="btn-articles add">
            <a href="add.php" class="edite">Ajouter un article</a>
        </div>
        <br>
        <table>
            <caption style="text-align: left;"><h4>Liste des articles:</h4></caption>
            <thead>
                <tr>
                    <th class="id">#</th>
                    <th class="titre">Titre</th>
                    <th class="action">Auteur</th>
                    <th class="action">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($articles as $article): ?>
                    <tr>
                        <td><?= $article->id ?></td>
                        <td><?= $article->title ?></td>
                        <td><?= getAuthor($pdo, $article) ?></td>
                        <td>
                            <div class="btn-articles">
                                <a href="edit.php?id=<?= $article->id ?>" class="edite">Editer</a>
                                <a href="delete.php?id=<?= $article->id ?>" class="delete" onclick="return confirm('Voulez-vous vraimenet supprimer cette element ?')">Supprimer</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
<?php require '../layouts/footer.php'; ?>
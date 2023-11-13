<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
    <title>Dash Blog - Dashboard</title>
</head>
<body>
    <div id="main-body">
        <header>
            <div class="title-page" title="Dash Blog">
                <a href="index.html" class="ss">Admin
                    <div class="circle" title="Vous etes connectez">
                        <style>
                            .circle{
                                width: 10px;
                                height: 10px;
                                background-color: green;
                                border-radius: 50%;
                                position: absolute;
                                top: 10px;
                                right: -15px;
                            }
                            .ss {
                                position: relative;
                            }
                        </style>
                    </div>
                </a>
            </div>
            <nav>
                <ul>
                    <?= menu_nav('/dash_blog/admin/dashboard.php', 'Gérer les Articles'); ?>
                    <?= menu_nav('/dash_blog/admin/#', 'Gérer les Utilisateurs'); ?>
                    <?= menu_nav('/dash_blog/admin/#', 'Statistiques'); ?>
                    <?= menu_nav('/dash_blog/index.php', 'Accueil'); ?>
                </ul>
            </nav>

            <div class="footer">
                <p class="admin-login">
                    <a href="logout.">Se deconnecter</a>
                </p>
                <p>
                    <a href="https://twitter.com/Berthold_au" target="_blank" title="Twitter"><img src="../img/twitter.png" alt="twitter"></a>
                    <a href="https://github.com/Berthold-au" target="_blank" title="Github"><img src="../img/github.png" alt="github"></a>
                    <a href="linkedin.com/in/dipeua-berthold-62474a278/" target="_blank" title="Linkedin"><img src="../img/linkedin.png" alt="linkedin"></a>
                    <a href="#" target="_blank" title="Discord"><img src="../img/discord.png" alt="discord"></a>
                    <a href="#" target="_blank" title="Kofi"><img src="../img/kofi.gif" alt="kofi"></a>
                    <a href="#" target="_blank" title="RSS"><img src="../img/rss.png" alt="rss"></a>
                    <a href="#" target="_blank" title="Shell"><img src="../img/shell.png" alt="shell"></a>
                    <a href="#" target="_blank" title="YouTube"><img src="../img/youtube.png" alt="youtube"></a>
                </p>
                <p>
                    &copy; 2023. ❤️ Tous droits réservés.
                </p>
            </div>
        </header>
<?php

function menu_nav(string $page, string $nom) : string {
    $class = '';
    if($_SERVER['SCRIPT_NAME'] === $page){
        $class .= "link-active";
    }
    return <<<HTML
        <li><a href="$page" class="$class">$nom</a></li>
HTML;
}

function getAuthor($pdo, $article){
    $userId = $article->users_id;
    $userQuery = "SELECT full_name FROM users WHERE id = $userId";
    $userResult = $pdo->prepare($userQuery);
    $userResult->execute();

    if ($userResult) {
        $userData = $userResult->fetch(PDO::FETCH_ASSOC);
        $userName = $userData['full_name'];
    } else {
        $userName = "Utilisateur inconnu";
    }
    return $userName;
}


function fixed($article){
    $decode = html_entity_decode($article->content);
    substr($decode, 0, 2000);
    if (preg_match("/<[^>]+>(.*?)<\/[^>]+>/", $decode, $matches)){
        $end = $matches[1];
        echo $end;
    }
}
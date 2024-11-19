<?php
if (isset($_GET['PaintingID']) && isset($_GET['ImageFileName']) && isset($_GET['Title'])) {
    $paintingID = $_GET['PaintingID'];
    $imageFileName = $_GET['ImageFileName'];
    $title = $_GET['Title'];

    $favorites = [];
    if (isset($_COOKIE['favorites'])) {
        $favorites = json_decode($_COOKIE['favorites'], true) ?? [];
    }

    $isAlreadyFavorite = false;
    foreach ($favorites as $favorite) {
        if ($favorite['PaintingID'] == $paintingID) {
            $isAlreadyFavorite = true;
            break;
        }
    }

    if (!$isAlreadyFavorite) {
        $favorites[] = [
            'PaintingID' => $paintingID,
            'ImageFileName' => $imageFileName,
            'Title' => $title
        ];
    }
    setcookie('favorites', json_encode($favorites), time() + (86400 * 30), "/");
}

header('Location: view-favorites.php');
exit();
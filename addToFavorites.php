<?php
session_start();

if (isset($_GET['PaintingID']) && isset($_GET['ImageFileName']) && isset($_GET['Title'])) {
    $paintingID = $_GET['PaintingID'];
    $imageFileName = $_GET['ImageFileName'];
    $title = $_GET['Title'];

    if (!isset($_SESSION['favorites'])) {
        $_SESSION['favorites'] = [];
    }

    $isAlreadyFavorite = false;
    foreach ($_SESSION['favorites'] as $favorite) {
        if ($favorite['PaintingID'] == $paintingID) {
            $isAlreadyFavorite = true;
            break;
        }
    }

    if (!$isAlreadyFavorite) {
        $_SESSION['favorites'][] = [
            'PaintingID' => $paintingID,
            'ImageFileName' => $imageFileName,
            'Title' => $title
        ];
    }
}

header('Location: view-favorites.php');
exit();
<?php
session_start();
if (isset($_GET['removeAll']) && $_GET['removeAll'] === 'true') {
    setcookie('favorites', '', time() - 3600, "/");
} elseif (isset($_GET['id'])) {
    $paintingID = $_GET['id'];
    if (isset($_COOKIE['favorites'])) {
        $favorites = json_decode($_COOKIE['favorites'], true) ?? [];
        $favorites = array_filter($favorites, function ($favorite) use ($paintingID) {
            return $favorite['PaintingID'] != $paintingID;
        });
        setcookie('favorites', json_encode($favorites), time() + (86400 * 30), "/");
    }
}

header('Location: view-favorites.php');
exit();
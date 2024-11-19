<?php
session_start();

if (isset($_GET['removeAll']) && $_GET['removeAll'] === 'true') {
    unset($_SESSION['favorites']);
} elseif (isset($_GET['id'])) {
    $paintingID = $_GET['id'];
    if (isset($_SESSION['favorites'])) {
        $_SESSION['favorites'] = array_filter($_SESSION['favorites'], function ($favorite) use ($paintingID) {
            return $favorite['PaintingID'] != $paintingID;
        });
    }
}

header('Location: view-favorites.php');
exit();
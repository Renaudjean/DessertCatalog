<?php
require_once 'connect.php';

if(isset($_GET['id'])){
    $article_id = $_GET['id'];
    $delete = $articles->query("DELETE FROM `articles`   WHERE `id_article` = '$article_id'");
    $deleteCat = $articles->query("DELETE FROM `articles_categorie`   WHERE `id_article` = '$article_id'");
    header("location:../index.php");
}

?>
<?php 
try{
    $articles = new PDO('mysql:host=localhost;dbname=dessertblog;charset=utf8', 'root');
}catch(Exception $e){
    echo'Erreur : '. $e->getMessage();
}
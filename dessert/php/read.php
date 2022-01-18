<?php
require_once 'connect.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spooks and Scoots</title>
    <link rel="icon" href="../Assets/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gothic+A1:wght@200&family=Love+Ya+Like+A+Sister&family=Over+the+Rainbow&family=Risque&family=Roboto:wght@300&family=Ruthie&display=swap" 
    rel="stylesheet">
</head>
<body>
<img src="" alt="">
<header class="header">
    <div>
        <h1 class="title"> Spooks and Scoots </h1>


    </div>
    <nav class="navigation">
        <ul>
            <li><a id="Home" class="nav" href="../index.php"><h1>Home</h1></a></li>
            <li><a id="Categories" class="nav" href="Categories.php"><h1>Categories</h1></a></li>
            <li><a id="Contact Us" class="nav" href="ContactUs.php"><h1>Contact us</h1></a></li>
            <li><a id="Login" class="sec-nav" href="./php/login.php"><h1>Login</h1></a></li>
        </ul>
    </nav>
</header>
<div class="content_container">
<?php
    $id = $_GET['id'];
        
    $req = $articles->query("SELECT * FROM `articles` WHERE `id_article`= $id");
    $article = $req->fetch(PDO::FETCH_ASSOC);
   
    $idA = $article['id_article'];
    $innerQuery= $articles->query("SELECT * FROM articles a INNER JOIN articles_categorie ac ON ac.id_article = a.id_article  INNER JOIN categorie c ON c.id_categorie = ac.id_categorie WHERE ac.id_article = $idA ");
    $inner = $innerQuery->fetchAll(PDO::FETCH_ASSOC);

        echo '<section>';
        echo '<h1>'. $article['titre'].'</h1>';
        foreach($inner as $i){
            echo ' <a class="categorie_tag" href="./php/categories.php"<h3> '. $i['name_categorie'] .' &nbsp; </h3> </a>'; 
        }
        echo '<br>';    
        echo '<img src="'.$article['img'].'" alt="">';
        echo '<p>'.$article['description'].'</p>';
        echo '<a href="update.php?id='. $article['id_article'] .'">Edit</a> ';
        echo '<a href="delete.php?id='. $article['id_article'] .'">Delete</a> <br>';
        echo '</section>';
    

    ?>
    </div>
    <div class="footer">
        <h3> Where to contact us </h3>
        <div class="socialmedia">
        <a id="email"  href="#"><img class="smicon" src="../Assets/Email.png" alt="Email page"></a>
        <a id="fb"  href="#"><img class="smicon" src="../Assets/fb.png" alt="Facebook page"></a>
        <a id="ig"  href="#"><img class="smicon" src="../Assets/ig.png" alt="Instagram page"></a>

        </div>
    </div>



</body>
</html>
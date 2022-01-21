<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spooks and Scoots</title>
    <link rel="icon" href="./Assets/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gothic+A1:wght@200&family=Love+Ya+Like+A+Sister&family=Over+the+Rainbow&family=Risque&family=Roboto:wght@300&family=Ruthie&display=swap" 
    rel="stylesheet">
</head>
<body>

<header class="header">
    <div>
      <a href="#" >  <h1 class="title"> Spooks and Scoots </h1> </a>
    </div>
    <nav class="navigation">
        <ul>
            <li><a id="Home" class="nav" href="#"><h1>Home</h1></a></li>
            <li><a id="Categories" class="nav" href="./php/categories.php"><h1>Categories</h1></a></li>
            <li><a id="Create" class="sec-nav" href="./php/create.php"><h1>Create</h1></a></li>
        </ul>
    </nav>
</header>
    <div class="container">
    <div class="content_container">
        <h1 class="lastest-recipes"> LATEST RECIPES!</h1> 
    <?php
    require_once 'php/connect.php';
    $reqQuery = $articles->query("SELECT * FROM articles a   ORDER BY a.`id_article` DESC LIMIT 100");
    $req = $reqQuery->fetchAll(PDO::FETCH_ASSOC); 
    foreach($req as $t){
        $idA = $t['id_article'];
        $innerQuery= $articles->query("SELECT * FROM articles a INNER JOIN articles_categorie ac ON ac.id_article = a.id_article  INNER JOIN categorie c ON c.id_categorie = ac.id_categorie WHERE ac.id_article = $idA ");
        $inner = $innerQuery->fetchAll(PDO::FETCH_ASSOC);
        
        echo '<section class="mainlist">';
        echo '<img src="'.$t['img'].'" alt="">';
        echo '<div> <a id="titre"  href="./php/read.php?id='. $t['id_article'] .'"> <h1>'.$t['titre'].'</h1> </a>'; 
    foreach($inner as $i){
        echo ' <a class="categorie_tag" href="./php/categories.php"<h3> '. $i['name_categorie'] .' &nbsp; </h3> </a>'; 
    }
        echo '<p>'.$t['description'].'</p>';
        echo '</section>';
    }
    ?>
    </div>
    <div class="side_logo">
        <img src="./Assets/LogoSample_ByTailorBrands.jpg">
    <div class="side_header">
        <h1 class="more-recipes"> MORE SPOOKIES!</h1> 
    <div class="side_container">
    <?php
    require_once 'php/connect.php';
    $req = $articles->query('SELECT * FROM `articles` ORDER BY id_article LIMIT 100 ', PDO::FETCH_ASSOC); 
    foreach($req as $t){
        $idA = $t['id_article'];
        $innerQuery= $articles->query("SELECT * FROM articles a INNER JOIN articles_categorie ac ON ac.id_article = a.id_article  INNER JOIN categorie c ON c.id_categorie = ac.id_categorie WHERE ac.id_article = $idA ");
        $inner = $innerQuery->fetchAll(PDO::FETCH_ASSOC);
        echo '<section class="sidelist">';
        echo '<img src="'.$t['img'].'" alt="">';
        echo '<div> <a href="./php/read.php?id='. $t['id_article'] .'"> <h1>'.$t['titre'].'</h1> </a>'; 
        foreach($inner as $i){
        echo ' <a class="categorie_tag" href="./php/categories.php"<h3> '. $i['name_categorie'] .' &nbsp; </h3> </a>'; 
        }
        echo '<p>'.$t['description'].'</p>';
        echo '</section>';
    }
    ?>
            </div>
        </div>
    </div>
</div>
    <div class="footer">
        <h3> Where to contact us </h3>
        <div class="socialmedia">
        <a id="email"  href="#"><img class="smicon" src="./Assets/Email.png" alt="Email page"></a>
        <a id="fb"  href="#"><img class="smicon" src="./Assets/fb.png" alt="Facebook page"></a>
        <a id="ig"  href="#"><img class="smicon" src="./Assets/ig.png" alt="Instagram page"></a>
        </div>
    </div>
</body>
</html>
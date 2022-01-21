<?php
require_once 'connect.php';

    $catQuery = $articles->query("SELECT * FROM `categorie` ");

    $cat = $catQuery->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['submit'])){
   
    //This Will insert into the Article Table
    $req = $articles->prepare("INSERT INTO `articles` (`titre`, `img`, `description`) 
    VALUES (:titre,:img, :descri)");
    $req->bindParam('titre',$_POST['titre'], PDO::PARAM_STR);
    $req->bindParam('img',$_POST['img'], PDO::PARAM_STR);
    $req->bindParam('descri',$_POST['description'], PDO::PARAM_STR);
    $req->execute();
    $lastId = $articles->lastInsertId(); 
    $catForm =$_POST['cat'];
    //This will insert into the Categorie table
    foreach($catForm as $c){
        $reqCat = $articles->prepare("INSERT INTO `articles_categorie` (`id_categorie`, `id_article`) 
    VALUES (:idcat,:idart)");
    $reqCat->bindParam('idcat',$c, PDO::PARAM_INT);
    $reqCat->bindParam('idart',$lastId, PDO::PARAM_INT);
    $reqCat->execute();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=*, initial-scale=1.0">
    <link rel="icon" href="../Assets/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gothic+A1:wght@200&family=Love+Ya+Like+A+Sister&family=Over+the+Rainbow&family=Risque&family=Roboto:wght@300&family=Ruthie&display=swap" 
    rel="stylesheet">
    <title>Create</title>
</head>
<body>
<img src="" alt="">
<header class="header">
    <div>
        <a href="../index.php" ><h1 class="title"> Spooks and Scoots </h1>
    </div>
    <nav class="navigation">
        <ul>
            <li><a id="Home" class="nav" href="../index.php"><h1>Home</h1></a></li>
            <li><a id="Categories" class="nav" href="./categories.php"><h1>Categories</h1></a></li>
            <li><a id="Create" class="sec-nav" href="./create.php"><h1>Create</h1></a></li>
        </ul>
    </nav>
</header>
<div class="container">
<div class="create_container">
<form action="#" method="POST">
        <div class="form-group">
            <label class="form-label">Title:</label><br>
            <input type="text" class="create-title" name="titre" id="titre" aria-describedby="TitleHelp" placeholder="Enter Title">
            
        </div>
        <div class="form-group">
            <label class="form-label">Image (insert image link)</label><br>
            <input type="url" class="create-image"  name="img" id="img" aria-describedby="emailHelp" placeholder="Enter img link..">
            
        </div>
        <div class="form-group">
            <label class="form-label">Description:</label>
            <textarea class="form-description" name="description" id="description" aria-describedby="DescriptionHelp" placeholder="Enter Description"></textarea>
        </div>
        <div class="form-group">
            <label for="S" class="create_label"> Catégorie: </label><br>
            <?php
                foreach($cat as $c){       
            ?>
            <label class="cattitle_create"><?= $c['name_categorie'] ?>: 
            <input class="checkbox_create" type="checkbox" name="cat[]" value="<?= $c['id_categorie']?>">
            </label>
            <?php 
                }
          ?>
           <button class="create-submit" type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
</div>
   
</form>
</div>
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
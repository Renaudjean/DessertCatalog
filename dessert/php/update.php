<?php
    require_once 'connect.php';
    $catQuery = $articles->query("SELECT * FROM `categorie`");
    $cat = $catQuery->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spooks and Scoots</title>
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
            <li><a id="Categories" class="nav" href="./categories.php"><h1>Categories</h1></a></li>
            <li><a id="Create" class="sec-nav" href="./create.php"><h1>Create</h1></a></li>
        </ul>
    </nav>
</header>
<body>
<?php $id = $_GET['id'];
$req = $articles->query("SELECT * FROM `articles` WHERE `id_article` = '$id'");
$article = $req->fetch(PDO::FETCH_ASSOC);
    $idarticle = $article['id_article'];
    $titre=$article['titre'];
    $img=$article['img'];
    $description=$article['description'];
    $idA = $article['id_article'];
    $innerQuery= $articles->query("SELECT `id_categorie` FROM articles_categorie WHERE id_article = $idA ");
    $inner = $innerQuery->fetchAll(PDO::FETCH_COLUMN);
?>
<div class="container">
<div class="content_container">
<form action="#" method="POST">
        <div class="form-group">
            <label class="form-label">Title:</label>
            <input type="text" class="form-input" name="titre" id="titre" value="<?php echo $titre;?>" placeholder="Enter Title">
        </div>
        <div class="form-group">
            <label class="form-label">Image (insert image link)</label>
            <input type="url" class="form-control"  name="img" id="img" value="<?php echo $img;?>" placeholder="Enter img">
        </div>
        <div class="form-group">
            <label class="form-label">Description:</label>
            <textarea class="form-control" name="description" id="description" placeholder="Enter Description"><?php echo $description;?></textarea>
            </div>
             <div class="form-group">
            <label for="S"> Catégorie: </label><br>
            <?php
                foreach($cat as $c){       
            ?>
            <label><?= $c['name_categorie'] ?>: 
            <input type="checkbox" name="cat[]" value="<?= $c['id_categorie']?>" 
            <?php if (in_array($c['id_categorie'],  $inner)){  echo"checked";}?>
            >
            </label>        
            <?php 
                }
          ?>
        </div>
    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
<?php
if(isset($_POST['submit'])){
    $titre=$_POST['titre'];
    $img=$_POST['img'];
    $description=$_POST['description'];
    $edit = $articles->query("UPDATE `articles` SET `titre` = '$titre', `img` = '$img', `description` = '$description'  WHERE `id_article` = $id ");
    $catForm =$_POST['cat']??[];
    //This will update into the Categorie table
    $deleteCat = $articles->query("DELETE FROM `articles_categorie`   WHERE `id_article` = '$id'");
    foreach($catForm as $Ic){    
        $reqCat = $articles->prepare("INSERT INTO `articles_categorie` (`id_categorie`, `id_article`)  VALUES (:idcat,:idart)");
        $reqCat->bindParam('idcat',$Ic, PDO::PARAM_INT);
        $reqCat->bindParam('idart',$id, PDO::PARAM_INT);
        $success = $reqCat->execute();
    }
 header("location:./read.php?id=$idarticle");
}
?>
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
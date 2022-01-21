
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
    <?php
    require_once 'connect.php';

    $catQuery = $articles->query("SELECT * FROM `categorie` ");
    $cat = $catQuery->fetchAll(PDO::FETCH_ASSOC);


    ?>
</head>
<body>
<img src="" alt="">
<header class="header">
<div>
        <a href="../index.php"><h1 class="title"> Spooks and Scoots </h1></a>
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
    <div class="category_container">

    <form action="#" method="POST">
    <div class="category-group">
            <label class="categorie-title" for="S"> Catégorie: </label> <button class="categorie-submit"type="submit" name="submit" value="submit" class="btn btn-primary">search</button><br>
            
            <?php
                foreach($cat as $c){       
            ?>
            <label class="categorie-label"><?= $c['name_categorie'] ?>: 
            <input class="categorie-search" type="checkbox" name="cat[]" value="<?= $c['id_categorie']?>" > 
            </label>
            <?php 
                }
          ?>
        
        </div>
        
    </form>
   
    
    <?php
        if(isset($_POST['submit'])){
        
            $catForm =$_POST['cat'];
            $c=implode(",", $catForm);
           

            $innerQuery= $articles->query("SELECT a.id_article id, a.titre, GROUP_CONCAT(c.name_categorie) categories, a.img, a.description, a.id_article FROM articles a LEFT JOIN articles_categorie ac ON ac.id_article = a.id_article LEFT JOIN categorie c ON c.id_categorie = ac.id_categorie WHERE ac.id_categorie IN ($c) GROUP BY a.id_article ");
            
            $inner = $innerQuery->fetchAll(PDO::FETCH_ASSOC);
             
            
            foreach($inner as $t){
                echo '<section class="mainlist">';
                echo '<img src="'.$t['img'].'" alt="">';
                echo '<div> <a href="./read.php?id='. $t['id_article'] .'"> <h1>'.$t['titre'].'</h1> </a>'; 
                echo '<h3 class="categorie_tag"> '. $t['categories'] .' &nbsp; </h3>'; 
                echo '<p>'.$t['description'].'</p>';
                echo '</section>';  
             }
        
    }
    
    ?>
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
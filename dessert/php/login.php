<?php 
  require_once 'connect.php';
          ob_start();
          session_start();

         
            $login = $_POST['email'];
            $mdp = $_POST['password'];


            $req = $db->query("SELECT * FROM `login` ");
            $post = $req->fetch(PDO::FETCH_ASSOC);
            $tryUser = $db->query("SELECT `email`, `password` FROM `userlogin` WHERE `email` = '$login', password='$password' ");

            if (isset($_POST['login']) && !empty($_POST['username']) 
               && !empty($_POST['password'])) {
				
               if ($_POST['email'] == 'Admin' && 
                  $_POST['password'] == 'Admin123') {
                  $_SESSION['valid'] = true;
                  $_SESSION['timeout'] = time();
                  $_SESSION['username'] = 'Admin';
                  
                  echo 'You have entered valid use name and password';
               }else {
                  $msg = 'Wrong username or password';
               }
            }
         ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gothic+A1:wght@200&family=Love+Ya+Like+A+Sister&family=Over+the+Rainbow&family=Risque&family=Roboto:wght@300&family=Ruthie&display=swap" 
    rel="stylesheet">
    <title>login</title>
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
            <li><a id="Login" class="sec-nav" href="#"><h1>Login</h1></a></li>
        </ul>
    </nav>
</header>


<div class="container">
    <h1>Login</h1>

<form>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email"
        class="form-control" id="name"  
        placeholder="Enter email">
    </div>
    
    <div class="form-group">
    <label  for="password">Password</label>
    <input type="password" 
        class="form-control" name="password" id="pass" 
        placeholder="Enter password">
    </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</body>
</html>
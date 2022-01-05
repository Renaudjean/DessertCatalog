<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    require_once 'connect.php';

    $req = $articles->query('SELECT * FROM `articles` LIMIT 100', PDO::FETCH_ASSOC);
    
    ?>
</body>
</html>
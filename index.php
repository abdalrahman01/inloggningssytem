<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
   <div class="container">
        <h1>Hello <?php echo $_SESSION["username"] ?></h1>
        <h1>You are an <?php echo $_SESSION["permission_level"] ?></h1>
        <h2><a href="logout.php">Logout</a></h2>
   </div>
</body>

</html>
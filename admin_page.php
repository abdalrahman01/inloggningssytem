<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_POST["username"]; ?></title>
</head>

<body>

<a href="add.php">ADD A POST</a>

    <hr>

    <h1>

    </h1>

    <h2>Title</h2>
    <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam deleniti doloremque aut pariatur saepe officiis ab et, molestiae esse rem, atque laboriosam autem dolor exercitationem? Inventore!</p>
    <h4>yy/mm/dd | writer</h4>
    <form action="edit.php" method="post">
        <input type="hidden" name="id" value="id">
        <input type="submit" value="edit" name="edit">
    </form>

</body>

</html>
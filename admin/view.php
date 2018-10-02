<?php
    require 'database.php';

    if (!empty($_GET['id']))
    {
        $id = checkInput($_GET['id']);
    }

    $db = Database::connect();
    $statement = $db->prepare('SELECT items.id, items.name, items.description, items.price, items.image, categories.name AS category FROM items LEFT JOIN categories ON items.category = categories.id WHERE items.id= ?');

    $statement->execute(array($id));
    $item = $statement->fetch();
    Database::disconnect();





    function checkInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<!doctype html>
<html>
<head>
    <title>Burger Code</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width:device-width, initial-scale:1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Holtwood+One+SC" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
<h1 class="text-logo"><span class="glyphicon glyphicon-cutlery"></span> Burger Code Hallal <span class="glyphicon glyphicon-cutlery"></span></h1>

<div class="container admin">
    <div class="row">
        <div class="col-sm-6">
        <h1><strong>Voir un items </strong></h1>
            <br>
            <form action="">
                <div class="form-group">
                    <label for="">Nom:</label><?php echo ' '. $item['name']; ?>
                </div>
                <div class="form-group">
                    <label for="">Description: </label><?php echo ' '. $item['description']; ?>
                </div>
                <div class="form-group">
                    <label for="">Prix: </label><?php echo ' '. number_format((float)$item["price"],2,'.',''). ' €'; ?>
                </div>
                <div class="form-group">
                    <label for="">Catégorie: </label><?php echo ' '. $item['category']; ?>
                </div>
                <div class="form-group">
                    <label for="">Image: </label><?php echo ' '. $item['image']; ?>
                </div>
            </form>
            <br>
            <div class="form_actions">
                <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
            </div>
        </div>

        <div class="col-sm-6 site">
            <div class="thumbnail">
                <img src="<?php echo '../img/' . $item['image'];?>" alt="...">
                <div class="price"><?php echo number_format((float)$item["price"],2,'.',''). ' €'; ?></div>
                <div class="caption">
                    <h4><?php echo $item['name']; ?></h4>
                    <p><?php echo $item['description']; ?></p>
                    <a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"></span> Commander</a>
                </div>
            </div>
        </div>

    </div>
</div>
</body>


</html>

<?php
session_start();

require ('../admin/database.php');

    if (!empty($_POST['pseudo']) && !empty($_POST['name']) && !empty($_POST['firstName']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_confirm']))
    {
        $pseudo           = $_POST['pseudo'];
        $name             = $_POST['name'];
        $firstName        = $_POST['firstName'];
        $email            = $_POST['email'];
        $password         = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];

//    Test password = password_confirm

        if ($password != $password_confirm)
        {
            header('location: ./?error=1&pass=1');
        }

//    Test si l'email existe deja

        $db = Database::connect();
        $req = $db->prepare("SELECT count(*) as numberEmail FROM users WHERE email = ?");
        $req->execute(array($email));

        while ($checkEmail = $req->fetch())
                {
                    if ($checkEmail['numberEmail'] != 0)
                        {
                            header('location: ./?error=1&email=1');
                        }
                }


//       Envoi du formulaire dans la DB

        // Hash
        $secret = sha1($email).time();
        $secret = sha1($secret).time().time();

        // Cryptage du Password (grain de sable)
        $password = "aq1".sha1($password. "1234")."25";

        // envoi de la requete
        $req = $db->prepare("INSERT INTO users(pseudo, name, firstName, email, password, secret) VALUES(?, ?, ?, ?, ?, ?)");
        $req->execute(array($pseudo, $name, $firstName, $email, $password, $secret));
        header('location: ./?success=1');


    };
?>


<!doctype html>
<html>
<head>
    <title>inscription</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width:device-width, initial-scale:1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Holtwood+One+SC" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<div>
    <h1 class="text-logo"> Inscription</h1>
    <div class="container admin">
        <div class="row">
            <div class="col-sm-12">
            <h1 class="text-center" ><strong>INFORMATION</strong></h1>
                <?php
                if (!isset($_SESSION['connect']))
                { ?>


            <!--affichage des erreurs-->
                <?php
            if (isset($_GET['error']))
            {
                if (isset($_GET['pass']))
                {
                    echo '<div id="error" class="alert alert-danger" role="alert"> Les mots de passe ne sont pas identiques.</div>';
                }
                elseif (isset($_GET['email']))
                {
                    echo '<div id="error" class="alert alert-warning" role="alert"> Cette adresse email est deja prise.</div>';
                }
            }
            elseif (isset($_GET['success']))
            {
                echo '<div class="alert alert-success" role="alert"> Votre inscription à bien était validé.</div>';
            }
            ?>
                <form method="post" action="index.php">
                        <!--Pseudo-->
                        <div class="mb-3">
                            <label for="pseudo">Pseudo</label>
                            <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Pseudo" required>
                        </div>
                        <br>
                        <!--Nom-->
                        <div class="mb-3">
                            <label for="name">Nom</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Nom" required>
                        </div>
                        <br>
                        <!--Prénom-->
                        <div class="mb-3">
                            <label for="firstName">Prénom</label>
                            <input type="text" class="form-control" name="firstName" id="firstName" placeholder="Prenom" required>
                        </div>
                        <br>
                        <!--Email-->
                        <div class="mb-3">
                            <label for="email">Email </label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com" required>
                        </div>
                        <br>
                        <!--Password -->
                        <div class="mb-3">
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Ex: ******" required>
                        </div>
                        <br>
                        <!--confirmation Password -->
                        <div class="mb-3">
                            <label for="password_confirm">Confirmation du mot de passe</label>
                            <input type="password" class="form-control" name="password_confirm" id="password_confirm" required>
                        </div>
                    <br>

                    <div class="form_actions ">
                        <button type="submit" class="btn btn-success"> Valider</button>
                        <a class="btn btn-danger" href="index.php"> Annuler</a>
                    </div>
                </form>
            <br>
            <p> Déjà inscrit ? <a href="connexion.php"> Connectez-vous</a></p>
                <?php } else{ ?>
                <h1 class="text-center" ><strong>Bonjour <?= $_SESSION['pseudo'] ?> </strong></h1>
                <a href="../index.php" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-eye-open"></span> Voir la boutique</a>
                <?php }?>
            </div>
        </div>
    </div>
</div>
</body>

</html>
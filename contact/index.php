<?php

    $firstname = $name = $email = $phone = $message = "";
    $firstnameError = $nameError = $emailError = $phoneError = $messageError = "";
    $isSuccess = false;
    $emailTo = "farid.b94@gmail.com";

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $firstname = verifyInput($_POST["firstname"]);
        $name = verifyInput($_POST["name"]);
        $email = verifyInput($_POST["email"]);
        $phone = verifyInput($_POST["phone"]);
        $message = verifyInput($_POST["message"]);
        $isSuccess = true;
        $emailText = "";

        if (empty($firstname))
        {
            $firstnameError = "Champs prenom vide";
            $isSuccess = false;
        }
        else
        {
            $emailText .= "Firstname: $firstname\n";
        }
        if (empty($name))
        {
            $nameError = "Champs nom vide";
            $isSuccess = false;
        }
        else
        {
            $emailText .= "Name: $name\n";
        }
        if(!isEmail($email))
        {
            $emailError = "Champs email vide";
            $isSuccess = false;
        }
        else
        {
            $emailText .= "Email: $email\n";
        }
        if (!isPhone($phone))
        {
            $phoneError = "Champs phone vide, seul les chiffres & les espaces sont accepté";
            $isSuccess = false;
        }
        else
        {
            $emailText .= "Telephone: $phone\n";
        }
        if (empty($message))
        {
            $messageError = "Champs message vide";
            $isSuccess = false;
        }
        else
        {
            $emailText .= "Message: $message\n";
        }
        if ($isSuccess)
        {
            $headers = "From: $firstname $name <$email>\r\nReply-To: $email";
            mail($emailTo, "Un message de votre site", $emailText, $headers);
            $firstname = $name = $email = $phone = $message = "";
        }

    }
//    Filtre de validation telephone
    function isPhone($var)
    {
        return preg_match("/^[0-9 ]*$/", $var);
    }

//    Filtre de validation d'email
    function isEmail($var)
    {
        return filter_var($var, FILTER_VALIDATE_EMAIL);
    }

//    Methode qui verifie les input
    function verifyInput($var)
    {
        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);
        return $var;
    }

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>votre avis !</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Holtwood+One+SC" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <div class="divider"></div>
        <div class="heading">
            <h2 class="text-logo">formulaires de contact</h2>
        </div>

        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <!-- Pour eviter une faille XSS on ajoute htmlspecialchars autour de la super globale $_SERVER -->
                <form id="contact-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="firstname">Prenom <span class="red">*</span></label>
                            <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Votre prénom" value="<?php echo $firstname; ?>">
                            <p class="comments"><?php echo $firstnameError; ?></p>
                        </div>

                        <div class="col-md-6">
                            <label for="name">nom <span class="red">*</span></label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Votre nom" value="<?php echo $name; ?>" >
                            <p class="comments"><?php echo $nameError; ?></p>
                        </div>

                        <div class="col-md-6">
                            <label for="email">email <span class="red">*</span></label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Votre email" value="<?php echo $email; ?>">
                            <p class="comments"><?php echo $emailError; ?></p>
                        </div>

                        <div class="col-md-6">
                            <label for="phone">Telephone</label>
                            <input type="tel" id="phone" name="phone" class="form-control" placeholder="Votre telephone" value="<?php echo $phone; ?>">
                            <p class="comments"><?php echo $phoneError; ?></p>
                        </div>

                        <div class="col-md-12">
                            <label for="message">Message <span class="red">*</span></label>
                            <textarea class="form-control" name="message" id="message" rows="4" placeholder="Votre message" ><?php echo $message; ?></textarea>
                            <p class="comments"><?php echo $messageError; ?></p>
                        </div>

                        <div class="col-md-12">
                            <p class="red"><strong>* Ces informations sont requises</strong></p>
                        </div>

                        <div class="col-md-12">
                            <input type="submit" class="button1" value="Envoyer">
                        </div>

                    </div>

                    <p class="thank-you" style="display:<?php if ($isSuccess) echo 'block'; else echo 'none';?>">Votre message a bien été envoyé. Merci de nous avoir contacté</p>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
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
    <script src="../js/script.js"></script>
</head>
<body>
    <div class="container">
        <div class="divider"></div>
        <div class="heading">
            <h2 class="text-logo">formulaires de contact</h2>
        </div>

        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <form id="contact-form" method="post" action="" role="form">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="firstname">Prenom <span class="red">*</span></label>
                            <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Votre prénom">
                            <p class="comments"></p>
                        </div>

                        <div class="col-md-6">
                            <label for="name">nom <span class="red">*</span></label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Votre nom"  >
                            <p class="comments"></p>
                        </div>

                        <div class="col-md-6">
                            <label for="email">email <span class="red">*</span></label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Votre email" >
                            <p class="comments"></p>
                        </div>

                        <div class="col-md-6">
                            <label for="phone">Telephone</label>
                            <input type="tel" id="phone" name="phone" class="form-control" placeholder="Votre telephone" >
                            <p class="comments"></p>
                        </div>

                        <div class="col-md-12">
                            <label for="message">Message <span class="red">*</span></label>
                            <textarea class="form-control" name="message" id="message" rows="4" placeholder="Votre message" ></textarea>
                            <p class="comments"></p>
                        </div>

                        <div class="col-md-12">
                            <p class="red"><strong>* Ces informations sont requises</strong></p>
                        </div>

                        <div class="col-md-12">
                            <input type="submit" class="button1" value="Envoyer">
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>

</body>
</html>
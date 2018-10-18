<?php

// Initialisation de la session
session_start();
// Desactiver la session
session_unset();
// detruire la session
Session_destroy();

header('location: ../index.php');
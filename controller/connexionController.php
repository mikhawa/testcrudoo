<?php

// si on a envoyé le formulaire de connexion
if (isset($_POST['theuserlogin'])) {

    // création d'une instance de type theuser afin d'utiliser les setters pour protéger le formulaire de toute attaque
    $theuserInstance = new theuser($_POST);

    // on va réellement vérifier la connexion dans le manager de theuser: theuserManager appelé depuis l'index.php
    $identify = $theuserM->connectTheuser($theuserInstance);

    // connexion ok
    if ($identify) {
        header("Location: ./");
    } else {
        // erreur de connexion, affichage du formulaire + erreur
        $error = "Login ou mot de passe non valide";
        echo $twig->render("connexion/connexion.html.twig", ['erreur' => $error]);
    }


// sinon accueil de la connexion    
} else {
    echo $twig->render("connexion/connexion.html.twig");
}
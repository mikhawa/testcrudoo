<?php

// si on a envoyé le formulaire de connexion
if(isset($_POST['theuserlogin'])){
  
    // création d'une instance de type theuser afin d'utiliser les setters pour protéger le formulaire de toute attaque
    $theuserInstance = new theuser($_POST);
    
    // on va réellement vérifier la connexion dans le manager de theuser: theuserManager appelé depuis l'index.php
    $identify = $theuserM->connectTheuser($theuserInstance);
    
    
    /*
     * pour tester l'envoi du $_POST et la création de l'instance de l'objet theuser
     * 
    echo "<pre>";
    var_dump($_POST,$theuserInstance);
    echo "</pre>";
     * 
     */
    
    
// sinon accueil de la connexion    
}else{
    echo $twig->render("connexion/connexion.html.twig");
}
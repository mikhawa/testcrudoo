<?php

// si on a envoyé le formulaire
if(isset($_POST['theuserlogin'])){
  
    // création d'une instance de type theuser
    $theuserInstance = new theuser($_POST);
    echo "<hr>";
    var_dump($_POST,$theuserInstance);
    echo "</hr>";
    
    
// sinon accueil de la connexion    
}else{
    echo $twig->render("connexion/connexion.html.twig");
}
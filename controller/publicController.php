<?php
/*
 * on veut se déconnecter
 */
if(isset($_GET['disconnect'])){
    
    $theuserM->disconnectTheuser();
    
/*
 * Accueil de l'utilisateur
 */ 
}else{
    
    echo $twig->render("public/accueilPublic.html.twig");

}
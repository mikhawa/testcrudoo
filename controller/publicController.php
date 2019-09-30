<?php

// on récupère toutes les catégories pour le menu
$menu = $jilliancategM->selectAllJilliancateg();

// var_dump($menu);


/*
 * on veut se déconnecter
 */
if(isset($_GET['disconnect'])){
    
    $theuserM->disconnectTheuser();
    
/*
 * Accueil de l'utilisateur
 */ 
}else{
    
    echo $twig->render("public/accueilPublic.html.twig",["afficheMenu"=>$menu]);

}
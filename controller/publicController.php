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
 * si on a cliqué sur une catégorie    
 */
}elseif(isset($_GET['idcateg'])&& ctype_digit($_GET['idcateg'])){
    
    // appel du détail d'une rubrique grace à son id
    
    
/*
 * Accueil de l'utilisateur
 */ 
}else{
    
    echo $twig->render("public/accueilPublic.html.twig",["afficheMenu"=>$menu]);

}
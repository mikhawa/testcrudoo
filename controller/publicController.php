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
    
    // appel du détail d'une rubrique grâce à son id
    $content = $jilliancategM->selectJilliancategById($_GET['idcateg']);
    
    // pas de résultat (tableau vide)
    if(empty($content)){
        $erreur = "Cette rubrique n'existe plus";
    }else{
        $erreur ="";
    }
    
    //var_dump($content,$erreur);
    // appel de la vue
    echo $twig->render("public/categPublic.html.twig",
            ["afficheMenu"=>$menu,
             "contenu"=>$content,
             "error"=>$erreur]
            );
    
/*
 * Accueil de l'utilisateur
 */ 
}else{
    
    // Appel de tous les articles du site
    $recuparticle = $jillianarticleM->selectAlljillianarticle();
    
    // passage des articles (et du menu) à la vue
    echo $twig->render("public/accueilPublic.html.twig",["afficheMenu"=>$menu,"afficheArticles"=>$recuparticle]);

}
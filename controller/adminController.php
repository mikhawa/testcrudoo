<?php
/*
 * on veut se déconnecter
 */
if(isset($_GET['disconnect'])){
    
    $theuserM->disconnectTheuser();
   
    
}elseif(isset($_GET['update'])&& ctype_digit($_GET['update'])){

    // on récupère l'article (et ses rubriques si il y en a) via son id
    $recup = $jillianarticleM->selectjillianarticleById($_GET['update']);
    
    // on récupère les rubriques
    $recupCateg = $jilliancategM->selectAllJilliancateg();
    
    if(empty($_POST)){
        
        // affichage formulaire
        echo $twig->render("admin/updateAdmin.html.twig",["article"=>$recup,"categ"=>$recupCateg]);
        
    }else{
        echo "<pre>";
        var_dump($_POST);
        echo "</pre>";
    }
    
/*
 * Accueil de l'admin
 */    
}else{
    
    // on récupère tous les article   
    $recup = $jillianarticleM->selectAdminjillianarticle();

    echo $twig->render("admin/accueilAdmin.html.twig",["allArticles"=>$recup]);

}
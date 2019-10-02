<?php
/*
 * on veut se déconnecter
 */
if(isset($_GET['disconnect'])){
    
    $theuserM->disconnectTheuser();
   
    
}elseif(isset($_GET['update'])&& ctype_digit($_GET['update'])){

    echo $_GET['update'];
    
/*
 * Accueil de l'admin
 */    
}else{
    
    // on récupère tous les article   
    $recup = $jillianarticleM->selectAdminjillianarticle();

    echo $twig->render("admin/accueilAdmin.html.twig",["allArticles"=>$recup]);

}
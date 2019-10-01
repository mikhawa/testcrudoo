<?php
/*
 * on veut se déconnecter
 */
if(isset($_GET['disconnect'])){
    
    $theuserM->disconnectTheuser();
    
/*
 * Accueil de l'admin
 */    
}else{

    echo $twig->render("admin/accueilAdmin.html.twig");

}
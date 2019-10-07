<?php
/*
 * on veut se déconnecter
 */
if(isset($_GET['disconnect'])){
    
    $theuserM->disconnectTheuser();

    
/*
 * INSERT un article
 */    
}elseif(isset($_GET['addarticle'])){

    // si on a pas cliqué sur envoyer
    if(empty($_POST)){
        
        // on récupère les rubriques
        $recupCateg = $jilliancategM->selectAllJilliancateg();
    
        // on appel la vue        
        echo $twig->render("admin/insertAdmin.html.twig",["categ"=>$recupCateg]);
    
    // Envoi du formulaire    
    }else{
        
        // grace au formulaire envoyé, on crée une instance de jillianarticle
        $articlePourInsert = new jillianarticle($_POST);
        
        // si on a coché au moins une catégorie
        $categ=(isset($_POST['idjilliancateg']))? $_POST['idjilliancateg']: [];
        
        // appel de la méthode permettant d'insérer un article
        $insert = $jillianarticleM->insertArticleAndCateg($articlePourInsert,$categ);
        
        /* utilisation de kint pour le débugage amélioré
        s($_POST,$articlePourInsert);
        d($_POST,$articlePourInsert);
        */
        
        
    }

    
/*
 * UPDATE
 */    
}elseif(isset($_GET['update'])&& ctype_digit($_GET['update'])){

    // on récupère l'article (et ses rubriques si il y en a) via son id
    $recup = $jillianarticleM->selectjillianarticleById($_GET['update']);
    
    // on récupère les rubriques
    $recupCateg = $jilliancategM->selectAllJilliancateg();
    
    // le formulaire n'a pas été envoyé
    if(empty($_POST)){
        
        // affichage formulaire
        echo $twig->render("admin/updateAdmin.html.twig",["article"=>$recup,"categ"=>$recupCateg]);
     
    // le formulaire a été envoyé donc mise à jour.   
    }else{
        
        // grace au formulaire envoyé, on crée une instance de jillianarticle
        $articlePourUpdate = new jillianarticle($_POST);
        
        /* utilisation de kint pour le débugage amélioré
        s($_POST,$articlePourUpdate);
        d($_POST,$articlePourUpdate);
        */
        
        /* on va vérifier si on a coché au moins une catégorie
         * avec un if else, quand il s'agit de remplir une variable, le ternaire est souvant préféré
         
        if(isset($_POST['idjilliancateg'])){
            $idcateg = $_POST['idjilliancateg'];
        }else{
            $idcateg = [];
        }
        */
        // on va vérifier si on a coché au moins une catégorie en ternaire (condition)? vrai : faux 
        $idcateg = (isset($_POST['idjilliancateg']))? $_POST['idjilliancateg']: [];
        
        $update = $jillianarticleM->updateArticleAndCateg($articlePourUpdate,$idcateg);
        
        if($update){
            header("Location: ./");
        }
    }
    
/*
 * Accueil de l'admin
 */    
}else{
    
    // on récupère tous les article   
    $recup = $jillianarticleM->selectAdminjillianarticle();

    echo $twig->render("admin/accueilAdmin.html.twig",["allArticles"=>$recup]);

}
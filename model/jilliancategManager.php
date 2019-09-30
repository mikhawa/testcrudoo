<?php

/*
 * 
 * Manager de la table "jilliancateg"
 *
 */
class jilliancategManager {
    // Attribut
    private $db;
    
    public function __construct(PDO $con) {
        $this->db = $con;
    }
    
    // afficher toutes les catégories
    public function selectAllJilliancateg(){
        
        $sql ="SELECT * FROM jilliancateg ORDER BY jilliancategnom ASC";
        
        $requete = $this->db->query($sql);
        
        // si on a au moins une rubrique (mais on peut en avoir plus)
        if($requete->rowCount()){
            
            // on envoie un tableau indexé contenant les résultats sous forme de tableau associatif
            return $requete->fetchAll(PDO::FETCH_ASSOC);
        }else{
            // pas de rubrique on envoie un tableau vide
            return [];
        }
        
    }

}

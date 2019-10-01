<?php

/*
 * 
 * Manager de la table "jillianarticle"
 *
 */
class jillianarticleManager {
    
    private $db;
    
    public function __construct(PDO $db) {
        $this->db = $db;
    }
    
    /*
     * On sélectionne tous les articles par date desc avec les catégories si il y en a.
     */
    public function selectAlljillianarticle() {
        $sql = "SELECT a.*, c.*
                    FROM jillianarticle a
                        LEFT JOIN jilliancateg_has_jillianarticle h
                        ON a.idjillianarticle = h.jillianarticle_idjillianarticle
                        LEFT jilliancateg c
                        ON c.idjilliancateg = h.jilliancateg_idjilliancateg
                    ORDER BY a.jillianarticletemps DESC;    
            ";
        try{
            $recup = $this->db->query($sql);
            
            // si pas de résultats
            if($recup->rowCount()===0){
                return [];
            }
            
            return $recup->fetchAll(PDO::FETCH_ASSOC);
            
            
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return [];        
        }
        
    }

}

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
     * PUBLIC
     */
    
    /*
     * On sélectionne tous les articles par date desc avec les catégories si il y en a.
     */
    public function selectAlljillianarticle() {
        $sql = "SELECT a.idjillianarticle, a.jillianarticletitre, LEFT(a.jillianarticletxt,270) AS jillianarticletxt, a.jillianarticletemps, GROUP_CONCAT(c.idjilliancateg) AS idjilliancateg, GROUP_CONCAT(c.jilliancategnom SEPARATOR '|||') AS jilliancategnom
                    FROM jillianarticle a
                        LEFT JOIN jilliancateg_has_jillianarticle h
                        ON a.idjillianarticle = h.jillianarticle_idjillianarticle
                        LEFT JOIN jilliancateg c
                        ON c.idjilliancateg = h.jilliancateg_idjilliancateg
                        GROUP BY a.idjillianarticle
                    ORDER BY a.jillianarticletemps DESC;    
            ";
        try{
            $recup = $this->db->query($sql);
            
            // si pas de résultats
            if($recup->rowCount()==0){
                return [];
            }
            
            return $recup->fetchAll(PDO::FETCH_ASSOC);
            
            
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return [];        
        }
        
    }
    
    /*
     * On sélectionne tous les articles par date desc qui sont dans
     * la catégorie dont l'id est passée en paramètre
     */
    public function selectAlljillianarticleByCateg(int $idcateg){
        $sql = "SELECT a.idjillianarticle, a.jillianarticletitre, LEFT(a.jillianarticletxt,380) AS jillianarticletxt, a.jillianarticletemps
                    FROM jillianarticle a
                        LEFT JOIN jilliancateg_has_jillianarticle h
                        ON a.idjillianarticle = h.jillianarticle_idjillianarticle
                        LEFT JOIN jilliancateg c
                        ON c.idjilliancateg = h.jilliancateg_idjilliancateg
                    WHERE c.idjilliancateg= :categ
                    ORDER BY a.jillianarticletemps DESC;    
            ";
        $recup = $this->db->prepare($sql);
        $recup->bindValue("categ", $idcateg,PDO::PARAM_INT);
        try{
            $recup->execute();
            
            // si pas de résultats
            if($recup->rowCount()==0){
                return [];
            }
            
            return $recup->fetchAll(PDO::FETCH_ASSOC);
            
            
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return [];        
        }
    }
    
    
    
    /*
     * 
     * ADMIN
     * 
     */
    
    /*
     * On sélectionne tous les articles par date desc pour l'admin
     */
    public function selectAdminjillianarticle() {
        $sql = "SELECT a.idjillianarticle, a.jillianarticletitre
                    FROM jillianarticle a
                    ORDER BY a.jillianarticletemps DESC;    
            ";
        try{
            $recup = $this->db->query($sql);
            
            // si pas de résultats
            if($recup->rowCount()==0){
                return [];
            }
            
            return $recup->fetchAll(PDO::FETCH_ASSOC);
            
            
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return [];        
        }
        
    }
    
    /*
     * 
     * ADMIN ET PUBLIC
     * 
     * 
     */
    
    /*
* On sélectionne un article via son id avec les catégories si il y en a.
*/
    public function selectjillianarticleById(int $idarticle) {
        $sql = "SELECT a.idjillianarticle, a.jillianarticletitre, a.jillianarticletxt, a.jillianarticletemps, GROUP_CONCAT(c.idjilliancateg) AS idjilliancateg, GROUP_CONCAT(c.jilliancategnom SEPARATOR '|||') AS jilliancategnom
                    FROM jillianarticle a
                        LEFT JOIN jilliancateg_has_jillianarticle h
                        ON a.idjillianarticle = h.jillianarticle_idjillianarticle
                        LEFT JOIN jilliancateg c
                        ON c.idjilliancateg = h.jilliancateg_idjilliancateg 
                        WHERE a.idjillianarticle = :id
                        GROUP BY a.idjillianarticle;    
            ";
        $recup = $this->db->prepare($sql);
        $recup->bindParam("id", $idarticle,PDO::PARAM_INT);
        
        try{
            $recup->execute();
            
            // si pas de résultats
            if($recup->rowCount()==0){
                return [];
            }
            
            return $recup->fetch(PDO::FETCH_ASSOC);
            
            
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return [];        
        }
        
    } 

}

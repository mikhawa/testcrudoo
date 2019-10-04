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
     * On UPDATE l'article, on supprime puis on ajoute le(s) lien(s) entre l'article et les catégories (jilliancateg_has_jillianarticle)
     * On besoin comme paramètre d'une instance de jillianarticle et d'un tableau contenant le(s) id(s) des catégories que lm'on souhaite insérer dans le many2many (envoyée depuis le formulaire d'update)
     */
    public function updateArticleAndCateg(jillianarticle $article, array $idcateg): bool{
        
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

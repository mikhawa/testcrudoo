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
    public function updateArticleAndCateg(jillianarticle $article, array $idcateg){
        
        // update préparé de l'article
        $sql = "UPDATE jillianarticle 
            SET jillianarticletitre = :titre,
                jillianarticletxt = :texte,
                jillianarticletemps = :temps
            WHERE idjillianarticle = :idarticle;";
        $update = $this->db->prepare($sql);
        $update->bindValue("idarticle", $article->getIdjillianarticle(),PDO::PARAM_INT);
        $update->bindValue("titre", $article->getJillianarticletitre(),PDO::PARAM_STR);
        $update->bindValue("texte", $article->getJillianarticletxt(),PDO::PARAM_STR);
        $update->bindValue("temps", $article->getJillianarticletemps(),PDO::PARAM_STR);
        
        
        try{
            // si ça fonctionne, on ne renvoie pas encore true car le return arrêterait le script ici
            $update->execute();
        } catch (PDOException $ex) {
            // en cas d'erreur on affiche un message d'erreur et on arrête le script avec return false;
            echo $ex->getMessage();
            return false;
        }
        
        // quoiqu'il arrive, on va supprimer toutes les entrées dans la table de jointure (pas de cases cochées ou cases décochées) en lien avec l'article que l'on modifie
        
        $sql = "DELETE FROM jilliancateg_has_jillianarticle WHERE jillianarticle_idjillianarticle = ?"; 
        $delete = $this->db->prepare($sql);
        $delete->bindValue(1, $article->getIdjillianarticle(),PDO::PARAM_INT);
        
        try{
            $delete->execute();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return false;
        }
        
        // si on a choisi des catégories, le tableau $idcateg n'est pas vide
        if(!empty($idcateg)){
           
            $sql = "INSERT INTO jilliancateg_has_jillianarticle (jilliancateg_idjilliancateg,jillianarticle_idjillianarticle) VALUES ";
            
            // tant qu'on a des catégories
            foreach($idcateg AS $id){
                // transformation en entier pour éviter les attaques
                $id = (int) $id;
                
                // concaténation de la requête
                $sql .= "($id,{$article->getIdjillianarticle()}),";
                
            }
            
            // on retire la ", " de la fin de $sql
            $sql = substr($sql, 0,-1);
            //s($sql);
            
            try{
                $this->db->exec($sql);
                return true;
            } catch (PDOException $ex) {
                echo $ex->getMessage();
                return false;
            }
            
        // pas de catégories    
        }else{
            // on est arrivé jusqu'ici et on ne doit rien insérer, on peut donc renvoyer true
            return true;
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

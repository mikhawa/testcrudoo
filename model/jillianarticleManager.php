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
        try {
            $recup = $this->db->query($sql);

            // si pas de résultats
            if ($recup->rowCount() == 0) {
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

    public function selectAlljillianarticleByCateg(int $idcateg) {
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
        $recup->bindValue("categ", $idcateg, PDO::PARAM_INT);
        try {
            $recup->execute();

            // si pas de résultats
            if ($recup->rowCount() == 0) {
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
     * 
     * Insertion d'un nouvel article avec ses catégories si il en a
     * 
     */
    public function insertArticleAndCateg(jillianarticle $article,array $idcateg = []){
        
        $sql = "INSERT INTO jillianarticle (jillianarticletitre, jillianarticletxt, jillianarticletemps) VALUES (?,?,?);";
        
        $insert = $this->db->prepare($sql);
        $insert->bindValue(1, $article->getJillianarticletitre(),PDO::PARAM_INT);
        $insert->bindValue(2, $article->getJillianarticletxt(),PDO::PARAM_STR);
        $insert->bindValue(3, $article->getJillianarticletemps(),PDO::PARAM_STR);
        
        try{
            $insert->execute();
        }catch(PDOException $ex){
            echo $ex->getMessage();
            return false;
        }
        
        
    }

    /*
     * On sélectionne tous les articles par date desc pour l'admin
     */

    public function selectAdminjillianarticle() {
        $sql = "SELECT a.idjillianarticle, a.jillianarticletitre
                    FROM jillianarticle a
                    ORDER BY a.jillianarticletemps DESC;    
            ";
        try {
            $recup = $this->db->query($sql);

            // si pas de résultats
            if ($recup->rowCount() == 0) {
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

    public function updateArticleAndCateg(jillianarticle $article, array $idcateg) {

            // on crée une transaction car on veut que les 3 requêtes (update, delete, insert) fonctionnent, sinon on revient en arrière
            /* Commence une transaction, désactivation de l'auto-commit */
            $this->db->beginTransaction();

            // update préparé de l'article
            $sql = "UPDATE jillianarticle 
            SET jillianarticletitre = :titre,
                jillianarticletxt = :texte,
                jillianarticletemps = :temps
            WHERE idjillianarticle = :idarticle;";
            $update = $this->db->prepare($sql);
            $update->bindValue("idarticle", $article->getIdjillianarticle(), PDO::PARAM_INT);
            $update->bindValue("titre", $article->getJillianarticletitre(), PDO::PARAM_STR);
            $update->bindValue("texte", $article->getJillianarticletxt(), PDO::PARAM_STR);
            $update->bindValue("temps", $article->getJillianarticletemps(), PDO::PARAM_STR);

            $update->execute();


            // quoiqu'il arrive, on va supprimer toutes les entrées dans la table de jointure (pas de cases cochées ou cases décochées) en lien avec l'article que l'on modifie

            $sql = "DELETE FROM jilliancateg_has_jillianarticle WHERE jillianarticle_idjillianarticle = ?";
            $delete = $this->db->prepare($sql);
            $delete->bindValue(1, $article->getIdjillianarticle(), PDO::PARAM_INT);

            $delete->execute();

            // si on a choisi des catégories, le tableau $idcateg n'est pas vide
            if (!empty($idcateg)) {

                $sql = "INSERT INTO jilliancateg_has_jillianarticle (jilliancateg_idjilliancateg,jillianarticle_idjillianarticle) VALUES ";

                // tant qu'on a des catégories
                foreach ($idcateg AS $id) {
                    // transformation en entier pour éviter les attaques
                    $id = (int) $id;

                    // concaténation de la requête
                    $sql .= "($id,{$article->getIdjillianarticle()}),";
                }

                // on retire la ", " de la fin de $sql
                $sql = substr($sql, 0, -1);
                //s($sql);

                $this->db->exec($sql);

            }
            
        try{    
            // on arrête la transaction en envoyant toutes les requêtes à MySQL
            $this->db->commit();
            return true;
        } catch (PDOException $ex) {
            // on supprime les modifications si on a un problème à au moins 1 requête
            $this->db->rollBack();
            echo $ex->getMessage();
            return false;
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
        $recup->bindParam("id", $idarticle, PDO::PARAM_INT);

        try {
            $recup->execute();

            // si pas de résultats
            if ($recup->rowCount() == 0) {
                return [];
            }

            return $recup->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return [];
        }
    }

}

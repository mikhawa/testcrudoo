<?php
/*
 * Manager de la table "theroles"
 */
class therolesManager {
    // Attribut
    private $db;
    
    // Méthodes
    
        // Constructeur qui récupère la connexion PDO
    
        public function __construct(PDO $v) {
            $this->db = $v;
        }
        
}

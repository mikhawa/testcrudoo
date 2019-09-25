<?php
/*
 * Manager de la table "theuser"
 */
class theuserManager {
    // Attribut
    private $db;
    
    // Méthodes
    
        // Constructeur qui récupère la connexion PDO
    
        public function __construct(PDO $v) {
            $this->db = $v;
        }
}

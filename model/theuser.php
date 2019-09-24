<?php
/*
 * Mapping de la table "theuser"
 */
class theuser {
    
    // Attributs
    
    private $idtheuser;
    private $theuserlogin;
    private $theuserpwd;
    private $theroles_idtheroles;
    
    // Constantes
    
    // Méthodes
    
        // Constructeur (appelé lors de l'instanciation "new theuser()")
        public function __construct(array $datas) {
            if(!empty($datas)){
                $this->hydratation($datas);
            }
        }
        
        // Hydratation (création des setters à la volée suivant le tableau reçu via le constructeur, ne fonctionne que si les clefs du tableau sont des setters réels dans l'instance de la classe)
        private function hydratation(array $values){
            foreach($values AS $key => $values){
                $setterName = "set".ucfirst($key);
                if(method_exists($this, $setterName)){
                    $this->$setterName($values);
                }
            }
        }
        
        // Getters
        
        public function getIdtheuser() {
            return $this->idtheuser;
        }

        public function getTheuserlogin() {
            return $this->theuserlogin;
        }

        public function getTheuserpwd() {
            return $this->theuserpwd;
        }

        public function getTheroles_idtheroles() {
            return $this->theroles_idtheroles;
        }

        // Setters
        
        public function setIdtheuser(int $idtheuser): void {
            $this->idtheuser = $idtheuser;
        }

        public function setTheuserlogin(string $theuserlogin): void {
            $this->theuserlogin = htmlspecialchars(strip_tags(trim($theuserlogin)),ENT_QUOTES);
        }

        public function setTheuserpwd(string $theuserpwd): void {
            $this->theuserpwd = htmlspecialchars(strip_tags(trim($theuserpwd)),ENT_QUOTES);
        }

        public function setTheroles_idtheroles(int $theroles_idtheroles)          {
            $this->theroles_idtheroles = $theroles_idtheroles;
        }
    
}

<?php

/**
 * Mapping de la table jilliancateg
 */
class jilliancateg {
    // attributs
    private $idjilliancateg;
    private $jilliancategnom;
    private $jilliancategtexte;
    
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
        public function getIdjilliancateg() {
            return $this->idjilliancateg;
        }

        public function getJilliancategnom() {
            return $this->jilliancategnom;
        }

        public function getJilliancategtexte() {
            return $this->jilliancategtexte;
        }
        
        // Setters
        public function setIdjilliancateg(int $idjilliancateg): void {
            $this->idjilliancateg = $idjilliancateg;
        }

        public function setJilliancategnom($jilliancategnom):void {
            $this->jilliancategnom = htmlspecialchars(strip_tags(trim($jilliancategnom)),ENT_QUOTES);
        }

        public function setJilliancategtexte($jilliancategtexte):void {
            $this->jilliancategtexte = htmlspecialchars(strip_tags(trim($jilliancategtexte)),ENT_QUOTES);
        }



}

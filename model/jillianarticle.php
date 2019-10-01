<?php

/**
 * Mapping de la table jillianarticle
 */
class jillianarticle {
    
    private $idjillianarticle;
    private $jillianarticletitre;
    private $jillianarticletxt;
    private $jillianarticletemps;
    
    // Méthodes
    
        // Constructeur (appelé lors de l'instanciation "new jillianarticle()")
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
        
        // Getter
        public function getIdjillianarticle() {
            return $this->idjillianarticle;
        }

        public function getJillianarticletitre() {
            return $this->jillianarticletitre;
        }

        public function getJillianarticletxt() {
            return $this->jillianarticletxt;
        }

        public function getJillianarticletemps() {
            return $this->jillianarticletemps;
        }

        // Setter
        public function setIdjillianarticle(int $idjillianarticle):void {
            $this->idjillianarticle = $idjillianarticle;
        }

        public function setJillianarticletitre($jillianarticletitre):void {
            $this->jillianarticletitre = htmlspecialchars(strip_tags(trim($jillianarticletitre)),ENT_QUOTES);
        }

        public function setJillianarticletxt($jillianarticletxt):void {
            $this->jillianarticletxt = htmlspecialchars(strip_tags(trim($jillianarticletxt)),ENT_QUOTES);
        }

        public function setJillianarticletemps($jillianarticletemps):void {
            if(is_null($jillianarticletemps)){
                $this->jillianarticletemps = time();
            }else{
                $this->jillianarticletemps = $jillianarticletemps;
            }
        }



}

<?php
/*
 * Mapping de la table "theroles"
 */
class theroles {
    
    // Attributs
    
    private $idtheroles;
    private $therolesname;
    
    // Constantes
    
    // Méthodes
    
        // Constructeur (appelé lors de l'instanciation "new theroles()")
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
        
       // getters
        
       public function getIdtheroles() {
           return $this->idtheroles;
       }

       public function getTherolesname() {
           return $this->therolesname;
       }


       // setters
       
       public function setIdtheroles(int $idtheroles): void {
           $this->idtheroles = $idtheroles;
       }

       public function setTherolesname($therolesname): void {
           $this->therolesname = htmlspecialchars(strip_tags(trim($therolesname)),ENT_QUOTES);
       }


    
}

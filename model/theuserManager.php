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

    /*
     * Connexion de l'utilisateur    
     */

    public function connectTheuser(theuser $var) {
        $sql = "SELECT theuser.*, theroles.*
                FROM theuser
                    INNER JOIN theroles
                        ON theuser.theroles_idtheroles = theroles.idtheroles
                WHERE theuser.theuserlogin = ? 
                    AND theuser.theuserpwd = ? ; ";

        $user = $this->db->prepare($sql);

        $user->bindValue(1, $var->getTheuserlogin(), PDO::PARAM_STR);
        $user->bindValue(2, $var->getTheuserpwd(), PDO::PARAM_STR);

        try {

            $user->execute();

            // si on a trouvé (1 vaut true, 0 vaut false)
            if ($user->rowCount()) {
                // création de la session avec tous les résultats venant de la requête MySQL au format tableau associatif
                $_SESSION = $user->fetch(PDO::FETCH_ASSOC);

                // on garde l'identifiant de session PHPSESSID nécessaire à la redirection sur notre contrôleur frontal
                $_SESSION['myKey'] = session_id();

                // on va supprimer le mot de passe de la session
                unset($_SESSION['theuserpwd']);
                // et un champs dupliqué
                unset($_SESSION['theroles_idtheroles']);

                // var_dump($_SESSION);

                return true;
            } else {
                return false;
            }

            // en cas d'erreur de syntaxe    
        } catch (PDOException $ex) {
            // affichage de l'erreur
            echo "Erreur: " . $ex->getMessage();
            return false;
        }
    }

    /*
     * Déconnexion des utilisateurs
     */

    public function disconnectTheuser() {

        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
            );
        }

        session_destroy();
        
        header("Location: ./");
    }

}

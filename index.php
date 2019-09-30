<?php

session_start();

/*
 * Load Dependencies
 */

require_once "config.php";

require_once 'vendor/autoload.php';


// Initialize twig templating system
$loader = new \Twig\Loader\FilesystemLoader('view/');
$twig = new \Twig\Environment($loader, [
    'debug' => true,
        ]);
// twig extension for text
$twig->addExtension(new Twig_Extensions_Extension_Text());
// twig extension for debug
$twig->addExtension(new \Twig\Extension\DebugExtension());


/*
 * create class autoload - find class into model's folder
 */

spl_autoload_register(function ($class) {
    require_once 'model/' . $class . '.php';
});


// connexion to our DB with PDO
try {
    $connexion = new PDO(
            'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=' . DB_PORT . ';charset=' . DB_CHARSET,
            DB_LOGIN,
            DB_PWD,
    );
    // affichage des erreurs pour le debugage
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    echo $e->getMessage();
    die();
}


// Appel des Managers
$theuserM = new theuserManager($connexion); 
$jilliancategM = new jilliancategManager($connexion);
$jillianarticleM = new jillianarticleManager($connexion);



// we're connected with Admin

if (isset($_SESSION['myKey']) && $_SESSION['myKey'] == session_id() && $_SESSION['therolesname'] == "admin") {
  
    /*
     * admin
     */
    require_once "controller/adminController.php";
    
// we're connected with a non admin (lulu)    
} elseif(isset($_SESSION['myKey']) && $_SESSION['myKey'] == session_id()) {

    /*
     * public
     */
    require_once "controller/publicController.php";

// we're NOT connected     
}else{
    
    /*
     * connexion
     */
    require_once "controller/connexionController.php";
    
}
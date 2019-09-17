# TestCrudOO
## Test d'évaluation | Septembre 2019
## Technologies et concepts:
#### Connexion et CRUD sur design pattern MVC en PHP7/OO - MySQL

#### Additionnel:  Composer - Git - Github - Twig - JS - HTML - CSS - Bootstrap - JQuery

### Consignes générales

#### La structure générale est déjà présente, le contrôleur frontal est complet et ne dois pas être modifié (à part un ajout de managers par exemple)

1. Clonez ce répertoire sur votre environnement de travail (!un clone n'est pas un fork!)
2. Créez un dossier privé sur votre compte github nommé {Votre_prénom}Testcrudoo
3. Faites le lien entre votre dossier privé github et le clone sur votre environnement de travail
4. Utilisez git et github comme d'habitude, avec un commit par action importante (les branches sont optionelles dans ce cas)
5. Vous ne partagerez le travail qu'avec moi en allant dans Settings/Collaborators/ puis mikhawa

### Travail préparatoire

1. Commencez par installer les dépendances avec Composer (composer.json est présent à la racine du projet))
2. Installez la DB testcrudoo avec le fichier /DB/testcrudoo-structure.sql
3. Insérez les données dans la DB avec le fichier /DB/testcrudoo-donnees.sql

### Ce qui est déjà présent

#### index.php (front controller)
1. L'ouverture de session
2. Le chargement de config.php contenant nos constantes de connexion à la DB
3. Le chargement des dépendances externes
4. L'activation de Twig et de certaines de ses extensions
5. L'autoload de nos modèles (se trouvant dans le dossier /model/)
6. Une connexion PDO à MySQL
7. Une redirection vers les 3 contrôleurs suivant l'état de la session

#### /controller
1. connexionController.php

    Où tous les utilisateurs non connectés arrivent
2. publicController.php

    Où les utilisateurs connectés en tant que "lecteur" arrivent
3. AdminController.php

    Où les utilisateurs connectés en tant que "admin" arrivent

#### /model
Dossier où vous créerez vous modèles


#### /view
- Les fichiers du template déjà fait en twig
- Le dossier /connexion avec un fichier pour vous connecter
- Le dossier /public permettant l'affichage du site aux "lecteur"
- Le dossier /admin permettant l'affichage du site aux "admin", avec des possibilitées étendues CRUD

### Consignes techniques communes
Ce test ressemblera fortement à l'exercice que vous avez eu fin juin, avec quelques changements structurels importants:

https://github.com/WebDevCF2019/CrudOO

Une vue de la nouvelle DB ce trouve à cette adresse:

https://dessycf2m.phpnet.org/images-utiles/crudoo/vue-globale.png

#### Dans /model
1. Vous devez avoir au minimum 2 mappings des tables venant de la base de données:
    - theuser.php
    - theroles.php

    Il vous faut pour TOUS vos mapping les attributs, le constructeur, les getters et setters et l'hydratation !
    Les setters doivent sécuriser les champs pour éviter les attaques de la DB !
    
2. Vous devez avoir au minimum 2 managers de ces classes:
    - theuserManager.php
    - therolesManager.php

    Une connexion PDO doit être passée en argument aux managers !
    Vous devez créer au minimum les méthodes "connectTheuser(theuser $var)" et "disconnectTheuser()" dans "theuserManager.php" pour permettre aux utilisateur enregistrés de se connecter et se déconnecter

### Consignes de fonctionnalitées communes

La base du site sera la même pour tous:

1. Lorsque vous arrivez sur le site, vous vous trouvez devant un formulaire de connexion
2. Vous pouvez vous connecter en tant que
    - "admin" avec comme login "admin" et mot de passe "admin"
    - "lecteur" avec comme login "lulu" et mot de passe "lulu"
3. En cas d'erreur un message est affiché et vous n'êtes pas connectés
4. En cas de connexion réussie vous êtes envoyés vers le contrôleur de de l'admin (adminController.php) ou celui d'un lecteur (publicController.php)
5. Un bouton de déconnexion doit apparaître et permettre la déconnexion réelle des utilisateurs: ![deconnect](https://dessycf2m.phpnet.org/images-utiles/crudoo/screenshot-crudoo_8080-2019.09.17-13_50_56.png "déconnexion")

### Consignes de fonctionnalitées individuelles

1. Si vous êtes connecté en tant que "lecteur", vous devez afficher:
    - Sur toutes les pages:
        - Dans le menu du haut, un retour à l'accueil et les catégories cliquables vers les entrées de la table {votre_prénom}categ par exemple:
![menu](https://dessycf2m.phpnet.org/images-utiles/crudoo/screenshot-crudoo_8080-2019.09.17-14_02_20.png "menu")

    - Sur l'accueil:
        - Un message disant "Pas encore d'article sur notre site" si pas d'articles OU
        - Une liste de tous vos articles triés par date descendante (table {votre_prénom}article) se trouvant dans n'importe quelle rubrique, même si l'article n'est pas dans une rubrique, avec:
            1. Le titre
            2. La liste des catégories de l'article cliquables (ou pas si l'article n'a pas de catégorie)
            3. Un résumé de l'article de 250 caractères avec "Lire la suite" cliquable vers le détail de l'article, si possible sans césure au millieu d'un mot
            4. La date de la création de l'article au format DATETIME: 
![extraitarticle](https://dessycf2m.phpnet.org/images-utiles/crudoo/screenshot-basiccrud_8080-2019.09.17-14_39_59.png "extrait article")
    - Sur la page d'un catégorie:
        - Le titre de la catégorie et la description de celle-ci
        - Un message disant "Pas encore d'article sur cette rubrique" si pas d'articles OU
        - Une liste de tous vos articles (table {votre_prénom}article) se trouvant dans la catégorie:
            1. Le titre
            2. Un résumé de l'article de 350 caractères avec "Lire la suite" cliquable vers le détail de l'article, si possible sans césure au millieu d'un mot
            3. La date de la création de l'article au format DATETIME
    - Sur la page de détail d'un article:
        - Un message disant "Cette article n'existe plus" si l'article n'est pas existant OU
            1. Le titre
            2. La liste des catégories de l'article cliquables (ou pas si l'article n'a pas de catégorie)
            3. Le texte complet de l'article avec des retours automatiques à la ligne
            4. La date de la création de l'article au format DATETIME:

1. Si vous êtes connecté en tant que "admin", vous devez afficher:
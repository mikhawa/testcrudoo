SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données :  `testcrudoo`
--

--
-- Déchargement des données de la table `andrecateg`
--

INSERT INTO `andrecateg` (`idandrecateg`, `categname`, `categdesc`) VALUES
(1, 'Japon', 'Le Japon, en forme longue l’État du Japon, en japonais Nihon ou Nippon  et Nihon-koku ou Nippon-koku respectivement, est un pays insulaire de l’Asie de l’Est, situé entre l’océan Pacifique et la mer du Japon, à l’est de la Chine, de la Corée et de la Russie, et au nord de Taïwan. \r\n\r\nÉtymologiquement, les kanjis (caractères chinois) qui composent le nom du Japon signifient « pays d’origine du Soleil » ; c’est ainsi que le Japon est désigné comme le « pays du soleil levant ».'),
(2, 'Chine', 'La Chine, en forme longue la république populaire de Chine (ou République populaire de Chine, RPC ; parfois appelée Chine populaire, est un pays d\'Asie de l\'Est. Avec près d\'1,4 milliard d\'habitants, soit environ un sixième de la population mondiale, elle est le pays le plus peuplé du monde. \r\n\r\nElle compte huit agglomérations de plus de dix millions d\'habitants, dont la capitale Pékin, Shanghai, Canton, Shenzhen et Chongqing, ainsi que plus de trente villes d\'au moins deux millions d\'habitants.'),
(3, 'Corée', 'La Corée est une région d’Asie de l’Est de 220 258 km située entre le Japon, la Chine et la Russie. Elle est principalement formée de la péninsule de Corée entourée de nombreuses îles ainsi que des terres situées entre l\'isthme de Corée et les fleuves Yalou et Tumen.');

--
-- Déchargement des données de la table `bogdancateg`
--

INSERT INTO `bogdancateg` (`idbogdancateg`, `bogdancategnom`, `bogdancategtexte`) VALUES
(1, 'Tablette tactile', 'Une tablette tactile, tablette électronique, ardoise électronique, tablette numérique, ou tout simplement tablette, est un assistant personnel ou un ordinateur portable ultraplat qui se présente sous la forme d\'un écran tactile sans clavier et qui offre à peu près les mêmes fonctionnalités qu\'un ordinateur personnel.'),
(2, 'Smartphone', 'Un smartphone (téléphone intelligent, téléphone multifonction ou ordiphone au Québec ou encore mobile multifonction en France) est un téléphone mobile disposant en général d\'un écran tactile, d\'un appareil photographique numérique, des fonctions d\'un assistant numérique personnel et de certaines fonctions d\'un ordinateur portable.'),
(3, 'Télévision', 'La télévision est un ensemble de techniques destinées à émettre et recevoir des séquences audiovisuelles, appelées programme télévisé (émissions, films et séquences publicitaires). Le contenu de ces programmes peut être décrit selon des procédés analogiques ou numériques tandis que leur transmission peut se faire par ondes radioélectriques ou par réseau câblé.');

--
-- Déchargement des données de la table `dimitricateg`
--

INSERT INTO `dimitricateg` (`iddimitricateg`, `dimitricategthetitle`, `dimitricategthedesc`) VALUES
(1, 'Rock', 'Le rock est un genre musical apparu dans les années 1950 aux États-Unis et qui s\'est développé en différents sous-genres à partir des années 1960, notamment aux États-Unis et au Royaume-Uni. Il prend ses racines dans le rock \'n\' roll des années 1940 et 1950, lui-même grandement influencé par le rhythm and blues et la country. Le rock a également incorporé des éléments provenant d\'autres genres dont la folk, le blues, le jazz et la musique classique.'),
(2, 'Hip-hop', 'Le hip-hop, musique rap, ou musique hip-hop, est un genre musical caractérisé par un rythme accompagné de rap et de chants. Le genre se développe en tant que mouvement culturel et artistique aux États-Unis, à New York, dans le South Bronx au début des années 1970. Originaire des ghettos noirs et latinos de New York, il se répandra rapidement dans l\'ensemble du pays puis au monde entier au point de devenir une culture urbaine importante.'),
(3, 'Electro', 'L\'electro (apocope d\'electro-funk ou electro-boogie) est un genre de musique électronique directement influencée par l\'utilisation d\'une boîte à rythmes TR-808 et de quelques samples dérivés du funk.');

--
-- Déchargement des données de la table `geoffreycateg`
--

INSERT INTO `geoffreycateg` (`idgeoffreycateg`, `categnom`, `categtext`) VALUES
(1, 'Bitcoin', 'La première monnaie décentralisée.'),
(2, 'Ethereum', 'La première monnaie basée sur une chaîne de blocs (Ethereum) permettant la création de contrats intelligents.'),
(3, 'Autres Cryptomonnaies', 'Une cryptomonnaie, dite aussi cryptoactif, cryptodevise, monnaie cryptographique ou encore cybermonnaie, est une monnaie émise de pair à pair, sans nécessité de banque centrale, utilisable au moyen d\'un réseau informatique décentralisé. Elle utilise les principes de la cryptographie et associe l\'utilisateur aux processus d\'émission et de règlement des transactions.');

--
-- Déchargement des données de la table `jbcateg`
--

INSERT INTO `jbcateg` (`idjbcateg`, `jbcategname`, `jbcategdescription`) VALUES
(1, 'Sculpture', 'La sculpture est une activité artistique qui consiste à concevoir et réaliser des formes en volume, en relief, soit en ronde-bosse (statuaire), en haut-relief, en bas-relief, par modelage, par taille directe, par soudure ou assemblage. Le terme de sculpture désigne également l\'objet résultant de cette activité.'),
(2, 'Architecture', 'L\'architecture est l\'art majeur de concevoir des espaces et de bâtir des édifices, en respectant des règles de construction empiriques ou scientifiques, ainsi que des concepts esthétiques, classiques ou nouveaux, de forme et d\'agencement d\'espace, en y incluant les aspects sociaux et environnementaux liés à la fonction de l\'édifice et à son intégration dans son environnement, quelle que soit cette fonction : habitable, sépulcrale, rituelle, institutionnelle, religieuse, défensive, artisanale, commerciale, scientifique, signalétique, muséale, industrielle, monumentale, décorative, paysagère, voire purement artistique.'),
(3, 'Arts graphiques', 'Les arts graphiques désignent l’ensemble des processus propres à la conception visuelle et à la mise en scène d’une création artistique, utilisant différentes techniques (écriture, typographie, dessin, peinture, gravure et estampe, photographie…), cette création pouvant être utilisée à des fins uniquement artistiques, industrielles ou commerciales (messages publicitaires, édition, affiches, revues, etc.).');

--
-- Déchargement des données de la table `jilliancateg`
--

INSERT INTO `jilliancateg` (`idjilliancateg`, `jilliancategnom`, `jilliancategtexte`) VALUES
(1, 'Échecs', 'Le jeu d’échecs (prononcer [eʃɛk]) oppose deux joueurs de part et d’autre d’un tablier appelé échiquier composé de soixante-quatre cases claires et sombres nommées les cases blanches et les cases noires. Les joueurs jouent à tour de rôle en déplaçant l\'une de leurs seize pièces (ou deux pièces en cas de roque), claires pour le camp des blancs, sombres pour le camp des noirs. Chaque joueur possède au départ un roi, une dame, deux tours, deux fous, deux cavaliers et huit pions. Le but du jeu est d\'infliger à son adversaire un échec et mat, une situation dans laquelle le roi d\'un joueur est en prise sans qu\'il soit possible d\'y remédier.'),
(2, 'Pierre-papier-ciseaux', 'Pierre-papier-ciseaux est un jeu effectué avec les mains et opposant un ou plusieurs joueurs.'),
(3, 'Dames', 'Les dames ou le jeu de dames est un jeu de société combinatoire abstrait pour deux joueurs. Le terme désigne en fait plusieurs jeux comme le jeu de dames international ou bien le jeu de dames anglaises.');

--
-- Déchargement des données de la table `oumarcateg`
--

INSERT INTO `oumarcateg` (`idoumarcateg`, `oumarcategthename`, `oumarcategthdesc`) VALUES
(1, 'Belgique', 'Située à mi-chemin entre l’Europe germanique et l’Europe romane, la Belgique abrite principalement deux groupes linguistiques : les francophones, membres de la Communauté française et les néerlandophones, membres de la Communauté flamande. De plus, il y a également un petit groupe de germanophones, officiellement reconnu, qui forme la Communauté germanophone.'),
(2, 'France', 'Fruit d\'une histoire politique longue et mouvementée, la France est une république constitutionnelle unitaire ayant un régime semi-présidentiel. La devise de la République est depuis 1875 « Liberté, Égalité, Fraternité » et son drapeau est constitué des trois couleurs nationales (bleu, blanc, rouge) disposées en trois bandes verticales d\'égale largeur (bleu et rouge étant les couleurs de la ville de Paris et blanc celle du roi).'),
(3, 'Espagne', 'L’Espagne, en forme longue le royaume d\'Espagne est un pays d\'Europe du Sud — et, selon les définitions, d\'Europe de l\'Ouest — qui occupe la plus grande partie de la péninsule Ibérique. En 2018, il s\'agissait du trentième pays le plus peuplé du monde, avec 46 millions d’habitants.');

--
-- Déchargement des données de la table `stephanecateg`
--

INSERT INTO `stephanecateg` (`idstephanecateg`, `stephanecategintitule`, `stephanecategdesc`) VALUES
(1, 'Intelligence artificielle', 'L\'intelligence artificielle (IA) est « l\'ensemble des théories et des techniques mises en œuvre en vue de réaliser des machines capables de simuler l\'intelligence ». Elle correspond donc à un ensemble de concepts et de technologies plus qu\'à une discipline autonome constituée.'),
(2, 'Logique mathématique', 'La logique mathématique ou métamathématique est une discipline des mathématiques introduite à la fin du xixe siècle, qui s\'est donné comme objet l\'étude des mathématiques en tant que langage.'),
(3, 'Logique philosophique', 'La logique philosophique traite des descriptions formelles du langage naturel. Ces philosophes considèrent que l\'essentiel du raisonnement quotidien peut être transcrit en logique, si une ou des méthode(s) parvient (parviennent) à traduire le langage ordinaire dans cette logique.');

--
-- Déchargement des données de la table `tarekcateg`
--

INSERT INTO `tarekcateg` (`idtarekcateg`, `tarekcategtitle`, `tarekcategtext`) VALUES
(1, 'Art figuratif', 'L\'art figuratif est un style artistique — en particulier dans la peinture, la photographie, la sculpture, la céramique, les arts textiles — qui se manifeste par la représentation du visible.'),
(2, 'Peinture non figurative', 'La peinture non figurative (ou, selon le dictionnaire Le Robert, « non-figurative ») est au xxe siècle l\'un des courants les plus importants de la nouvelle École de Paris qui se développe à la fin des années 1940, connaît son plus grand succès dans les années 1950 avant d\'être supplantée, dans les années 1960, par la peinture américaine.'),
(3, 'Art rupestre', 'L\'expression « art rupestre » (du latin rupes, « roche ») désigne l\'ensemble des œuvres d\'art au sens large (sans appréciation esthétique) réalisées par l\'Homme sur des rochers, le plus souvent en plein air. La plupart des auteurs l\'opposent aujourd\'hui à l\'art pariétal (du latin parietalis, « relatif aux murs », art sur parois de grottes en intérieur), mais aussi à l\'art mobilier (que l\'on peut déplacer) et à l\'art sur bloc.');

--
-- Déchargement des données de la table `theroles`
--

INSERT INTO `theroles` (`idtheroles`, `therolesname`) VALUES
(1, 'admin'),
(2, 'lecteur');

--
-- Déchargement des données de la table `theuser`
--

INSERT INTO `theuser` (`idtheuser`, `theuserlogin`, `theuserpwd`, `theroles_idtheroles`) VALUES
(1, 'admin', 'admin', 1),
(2, 'lulu', 'lulu', 2);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
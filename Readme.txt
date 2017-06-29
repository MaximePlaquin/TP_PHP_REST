Le nom de la Database est spécifié dans le constructeur des fichiers ‘users.php’ et ‘login.php’
Le script de creation de la table sur laquelle nous avons travaillé est le suivant :
 
CREATE TABLE `tpfinal_user` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `last_maj` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pseudo` varchar(255) NOT NULL
)


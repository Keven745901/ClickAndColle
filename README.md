# ClickAndColle

Projet d'une application web de Click and Collect écrite en Symfony.

Pour déployer l'application : 
  -dans le fichier .env : modifier la chaîne de connexion MySQL
  -dans le répertoire du projet : 
      php bin/console doctrine:database:create
      php bin/console make:migration
      php bin/console doctrine:migrations:migrate
  -démarrer le serveur :
      symfony server:start

Pour avoir un premier compte administrateur : créer un utilisateur, puis dans la table user de la bdd, mettre : ["ROLE_ADMIN"] 

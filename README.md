## Installation du projet

Une fois le projet télécharger ou cloner, pour l'installer il suffit de tapes les commandes suivantes : 
- composer install, pour installer toutes les dépendances PHP spécifiées dans le fichier composer.json et à créer ou mettre à jour le fichier composer.lock pour garantir une installation cohérente des versions des bibliothèques.

- php artisan key:generate, pour générer une nouvelle clé de cryptage pour sécuriser les données de votre application Laravel.

- php artisan migrate, pour appliquer les migrations de base de données définies dans votre projet Laravel, créant ou modifiant les tables et les colonnes nécessaires selon les schémas définis.

## Configuration du fichier d'environnement

-   DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=$PORT
    DB_DATABASE=(database name)
    DB_USERNAME= $root
    DB_PASSWORD= $root

## Lancement du projet

Pour lancer le projet il faut taper la commande : php artisan serve
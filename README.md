## Installation du projet

Une fois le projet télécharger ou cloner, pour l'installer il suffit de tapes les commandes suivantes : 
- composer install, pour installer toutes les dépendances PHP spécifiées dans le fichier composer.json et à créer ou mettre à jour le fichier composer.lock pour garantir une installation cohérente des versions des bibliothèques.

- php artisan key:generate, pour générer une nouvelle clé de cryptage pour sécuriser les données de votre application Laravel.

- php artisan migrate, pour appliquer les migrations de base de données définies dans votre projet Laravel, créant ou modifiant les tables et les colonnes nécessaires selon les schémas définis.

## Création des seeders

Pour avoir accès à l'appplication via un user par défaut il faut taper la commande : 
- php artisan db:seed, Pour inserer des données initiales dans la base de données en exécutant les seeders définis dans votre projet Laravel.

- Une fois le seeder crée avec succès, les identidinats pour se connecter sont : 
email->"root@modapp.tech"
password->"root"

## Configuration du fichier d'environnement

-   DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=$PORT
    DB_DATABASE=(database name)
    DB_USERNAME= $root
    DB_PASSWORD= $root

## Lancement du projet

Pour lancer le projet il faut taper la commande : php artisan serve


## Taches pour améliorer le projet

1.Envoyer automatiquement un mail, quand un module tombe en panne aux utilisateurs.

2.Rajouter les identifiants pour tous les membres du groupes dans le seeders.

3.Empecher la page de se recharger avec force. SI POSSIBLE

4.Côté Admin : 
    Gestion des utilisateurs et des modules, 
    Voir et les Historiques.
    Partie des bugs
    Ajouter un lien en bas pour mettre à l'admin de basculer en tant qu'utilisateur Classic et revenir en tant qu'admin.
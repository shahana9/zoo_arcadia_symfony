# Zoo Arcadia - Projet Symfony

Bienvenue dans le projet Zoo Arcadia. Il s'agit d'une application web basée sur Symfony conçue pour gérer et administrer les opérations du zoo, y compris la gestion des services, des habitats, des animaux, des utilisateurs et d'autres fonctionnalités.

## Table des Matières

- [Installation](#installation)
- [Utilisation](#utilisation)
- [Base de Données](#base-de-données)
- [Tests](#tests)
- [Déploiement](#Etapes pour déployer le site web)



## Installation

### Prérequis

Les éléments suivants doivent être installés :

- PHP 8.0 ou supérieur
- Composer
- Symfony CLI
- Node.js et npm (pour gérer les dépendances front-end)
- WAMP pour l'utilisation de PHPMYADMIN, pour visualiser la base de données

### Étapes

1. Cloner le dépôt :

    ```sh
    git clone https://github.com/shahana9/zoo_arcadia_symfony.git
    cd zoo_arcadia_symfony
    ```

2. Installer les dépendances :

    ```sh
    composer install
    npm install
    npm run dev
    ```

3. Configurer les variables d'environnement :

    Copiez le fichier `.env`` et configurez les paramètres.

    ```sh
    APP_SECRET=329c976ab8f04a4d82f0ddaeff48aca7
    DATABASE_URL="mysql://root:1993@127.0.0.1:3306/zoo_arcadia_symfony?serverVersion=8.0.32&charset=utf8mb4"
    MESSENGER_TRANSPORT_DSN=doctrine://default?auto_setup=0
    MAILER_DSN=smtp://636e720c000d25:ba6d03a0182e37@sandbox.smtp.mailtrap.io:2525
    ```

4. Configurer la base de données :

    ```sh
    php bin/console doctrine:database:create
    php bin/console make:migration
    php bin/console doctrine:migrations:migrate
    ```


6. Démarrer le serveur Symfony :

    ```sh
    symfony server:start
    ```

## Utilisation

Une fois le serveur démarré, vous pouvez accéder à l'application à l'adresse `http://localhost:8000`.

### Tableau de Bord Admin

Le tableau de bord admin est accessible à l'adresse `/admin`. Il utilise EasyAdminBundle pour gérer des entités comme `User` et `ServicePage`.


## Base de Données
Pour visualiser la base de données, il faut démarrer WAMP server et ouvrir PHPMYADMIN en indiquant "root" comme identifiant et "1993" comme mot de passe.

### Migrations

Chaque fois que vous apportez des modifications à vos entités, assurez-vous de créer et d'exécuter des migrations :

```sh
php bin/console make:migration
php bin/console doctrine:migrations:migrate

##Déploiement

1-	Préparer l'Environnement de Développement
S’assurer que Git est installé sur la machine.
Installer la CLI Heroku en suivant les instructions sur Heroku Dev Center.

2-	Créer un Compte Heroku
S’inscrire sur Heroku pour obtenir un compte gratuit.

3-	Initialiser un Projet Git
bash
Copier le code
git init

Ajouter et valider vos fichiers :
bash
Copier le code
 ```sh
git add .
git commit -m "Initial commit"
'''

4-	Créer une Nouvelle Application sur Heroku
Se connecter à Heroku via la CLI :
bash
Copier le code
 ```sh
heroku login
'''
Créez une nouvelle application Heroku :
bash
Copier le code
 ```sh
heroku create
'''

5-	Déployer l'Application
Poussez votre code vers Heroku :
 ```sh
bash
Copier le code
git push heroku master
'''

6-	Configurer l'Application
Définir les variables d'environnement si nécessaire :
 ```sh
bash
Copier le code
heroku config:set MY_VARIABLE=value
'''





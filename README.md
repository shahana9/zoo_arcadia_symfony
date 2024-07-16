# Zoo Arcadia - Projet Symfony

Bienvenue dans le projet Zoo Arcadia. Il s'agit d'une application web basée sur Symfony conçue pour gérer et administrer les opérations du zoo, y compris la gestion des services, des habitats, des animaux, des utilisateurs et d'autres fonctionnalités.

## Table des Matières

- [Installation](#installation)
- [Utilisation](#utilisation)
- [Configuration](#configuration)
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

## Configuration

Les fichiers de configuration se trouvent dans le répertoire `config`. Ajustez les paramètres si nécessaire pour les services, le routage et d'autres aspects de l'application Symfony.

### Configuration de Sécurité

La configuration de sécurité est gérée dans `config/packages/security.yaml`. Assurez-vous d'avoir les bons paramètres pour les fournisseurs d'utilisateurs, les pare-feu et le contrôle d'accès.

## Base de Données
Pour visualiser la base de données, il faut démarrer WAMP server et ouvrir PHPMYADMIN en indiquant "root" comme identifiant et "1993" comme mot de passe.

### Migrations

Chaque fois que vous apportez des modifications à vos entités, assurez-vous de créer et d'exécuter des migrations :

```sh
php bin/console make:migration
php bin/console doctrine:migrations:migrate

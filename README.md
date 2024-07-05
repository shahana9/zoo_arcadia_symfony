# Zoo Arcadia - Projet Symfony

Bienvenue dans le projet Zoo Arcadia. Il s'agit d'une application web basée sur Symfony conçue pour gérer et administrer les opérations du zoo, y compris la gestion des services, des utilisateurs et d'autres fonctionnalités.

## Table des Matières

- [Installation](#installation)
- [Utilisation](#utilisation)
- [Configuration](#configuration)
- [Base de Données](#base-de-données)
- [Tests](#tests)
- [Contribution](#contribution)
- [Licence](#licence)
- [Auteurs et Reconnaissance](#auteurs-et-reconnaissance)

## Installation

### Prérequis

Assurez-vous d'avoir les éléments suivants installés :

- PHP 8.0 ou supérieur
- Composer
- Symfony CLI
- Node.js et npm (pour gérer les dépendances front-end)

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

    Copiez le fichier `.env` en `.env.local` et configurez vos paramètres locaux (par exemple, les identifiants de la base de données).

    ```sh
    cp .env .env.local
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

### Migrations

Chaque fois que vous apportez des modifications à vos entités, assurez-vous de créer et d'exécuter des migrations :

```sh
php bin/console make:migration
php bin/console doctrine:migrations:migrate

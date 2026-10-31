# OtakuList

Projet universitaire de catalogue d'animés et de mangas.

## Outils

- PHP 8.5 et Laravel 13
- Blade et composants Blade
- SQLite et Eloquent
- Tailwind CSS 4 et Vite 8
- PHPUnit
- Git et GitLab de l'université

## Fonctionnalités

- Accueil, présentation et contact statiques.
- Catalogue sur `/oeuvres`, avec grille et fiches d'œuvres.
- Recherche par titre et filtres par type et statut.
- Recherche mémorisée dans un cookie pendant une heure.
- Réinitialisation des filtres et pagination.
- Modèle Oeuvre, migration, factory et seeder JSON.
- Notes comprises entre 0 et 5.

La page contact est statique : elle n'envoie pas d'e-mails.

## Installation

Prérequis : PHP 8.5 avec SQLite, Composer et Node.js 22.12 ou plus récent.

```sh
composer install
```

Copier `.env.example` vers `.env`, puis lancer :

```sh
php artisan key:generate
php artisan migrate --seed
npm install
npm run build
composer run dev
```

Le fichier `.env.example` configure SQLite et la langue française.
Laravel propose de créer `database/database.sqlite` si le fichier manque.
Le fichier `.env` et la base locale ne sont pas versionnés.

## Tests

```sh
php artisan test --compact
```

Les tests utilisent une base SQLite en mémoire, indépendante de la base locale.

## Organisation Git

Chaque modification doit avoir un ticket GitLab affecté à un membre du groupe.
Une correction doit avoir un nouveau ticket qui référence le ticket initial.
Créer une branche dédiée à partir de `main` ou `dev`, par exemple `12-bug-fix`.
Utiliser des messages simples, par exemple `bug fix`, avec `Refs #12` dans le corps du commit.
Intégrer les changements après vérification, puis envoyer les commits sur GitLab.
Les membres du groupe doivent être Maintainer et l'enseignant Reporter.

## Version du TP

Tag local : `fin-tp-otakulist`.

[Version de fin du TP](https://gitlab.univ-artois.fr/lylian_michel/otakulist/-/tags/fin-tp-otakulist)

Le lien sera disponible après l'envoi du tag sur GitLab.

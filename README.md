# WeatherApp

WeatherApp est une application de visualisation d'informations météorologiques de différents endroits (Villes, lieux dits ...)

## Installation

Pour installer l'application veuillez suivre les instructions suivantes : 

### Pre-requis

Pour lancer l'application : 

- make
- php >= 7 avec les extensions _pdo_sqlite_ and _curl_
- composer

Pour lancer les tests ou les fonctionnalités de developpement : 

- nodeJs >= 6  avec yarn et npm

### Instructions

- A la racine du projet lancez la commande `make install`
   
- Veuillez renseigner le fichier _.env_ avec les informations suivantes : 
**OPENWEATHER_API_KEY** and **GOOGLEMAP_API_KEY**

### Lancement

- A la racine du projet lancez la commande `make start` et rendez vous dans votre navigateur sur l'adresse 
127.0.0.1:8000
   
### Tests

- A la racine du projet lancez la commande `make tests-unit` pour lancer les tests unitaires

- A la racine du projet lancez la commande `make tests-func` pour lancer Cypress et executer les tests fonctionnels

## Utilisation

Vous arrivez par défaut sur le dashboard vide de l'application. Pour visualiser des widgets Meteo il vous faut vous 
connecter via le menu `Administration`.

### Se connecter

Voici les identifiants de demonstration pour la connection à l'application :

Pseudo : admin
Password : admin

Vous êtes automatiquement redirigé vers l'interface d'adminitration des widgets.

### Ajout d'un widget 

Cliquez sur le bouton `Ajouter` dans l'interface d'administration.
Vous arrivez sur le formulaire de création de widget. 

Vous pouvez ici renseigner manuellement les informations de 
celui-ci : Nom, coordonnées de latitude et longitude

Vous pouvez aussi utiliser l'assistant pour retrouver les coordonnées d'un lieu via le champs formulaire 'Aide à la geolocalisation'
qui se chargera de remplir automatiquement les champs du formulaire.

Cliquez ensuite sur 'Sauvegarder'. Votre widget sera maintenant visible depuis votre dashboard.

### Supprimer un widget

Cliquez sur le bouton `Supprimer` dans l'interface d'administration sur la ligne correspondante au widget à supprimer.

### Langues

Vous pouvez à tout moment basculer la langue de l'application entre Francais et Anglais en cliquant sur les boutons
respectifs situés à droite dans le menu de l'application.


# Explication des choix techniques

Le projet est basé sur Symfony 4 et PHP 7. 

La donnée est sauvegardée dans une base SQLite.

La generation / compilation des assets est effectuée via Yarn / Webpack.

Les tests unitaires sont réalisés avec PHPUnit, les tests fonctionnels sont réalisés avec Cypress.

CQRS a été implémenté dans l'application afin de découpler completement la logique metier des controlleurs MVC de Symfony.
Chaque action correspond à une commande avec la possibilité si on le souhaite de logger chaque appel a celles-ci pour 
re tracer par exemple un parcours utilisateur.

L'internationalisation de l'application est disponible avec des fichiers pré-remplis pour l'Anglais et le Francais.

# Possibilités d'évolution : 

- Intégration de docker pour le socle technique et l'hebergement de l'application
- Ajout de langues
- Ajout d'une gestion multi-utilisateurs

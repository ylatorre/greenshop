

## Commande pour lancer symfony

### Pour l'initialisation du projet 

```bash
composer install
npm i 
npm run build
```

### Pour lancer le projet
```bash
symfony server
```
```
npm run dev
```


### Pour creer une migration et mettre à jour la base de donnée (apres l'avoir créer)
```bash
symfony console make:migration
symfony console doctrine:migration:migrate 
```

### Structure du Projet 
```
MonProjetSymfony
│
├─── assets        // Dossiers pour les fichiers CSS, JavaScript et images
│
├─── bin           // Contient les scripts exécutables, notamment la console Symfony
│   └─── console
│
├─── config        // Fichiers de configuration du projet
│   ├─── packages  // Configurations spécifiques aux environnements
│   ├─── routes    // Fichiers de définition des routes
│   └─── services  // Services et paramètres
│
├─── migrations    // Migrations de base de données
│
├─── public        // Document root, contient le fichier index.php et les ressources publiques
│   └─── index.php
│
├─── src           // Code source principal de l'application
│   ├─── Controller    // Contrôleurs
│   ├─── Entity        // Entités (modèles) liées à la base de données
│   ├─── Repository    // Repositories pour interagir avec la base de données
│   └─── Kernel.php    // Le noyau de l'application
│
├─── templates     // Templates Twig
│
├─── tests         // Tests unitaires et fonctionnels
│
├─── translations  // Fichiers de traduction
│
├─── var           // Fichiers générés (cache, logs)
│   ├─── cache
│   └─── log
│
├─── vendor        // Bibliothèques et dépendances gérées par Composer
│
└─── .env          // Fichier de configuration des variables d'environnement
```
---
---

## Gestion des Permissions d'Admin dans Symfony 7

### Utilisation dans les Routes

Pour limiter l'accès à certaines parties de votre application en fonction du rôle de l'utilisateur dans Symfony, vous pouvez utiliser les Voters ou le système de sécurité intégré. Voici un exemple pour créer des routes accessibles uniquement par les utilisateurs avec le rôle "ROLE_ADMIN".

```php
// Dans votre fichier routes.yaml ou annotations dans les contrôleurs
admin:
    path: /admin
    controller: App\Controller\AdminController::index
    requirements:
        _role: "ROLE_ADMIN"

tableauDeBord:
    path: /tableau-de-bord
    controller: App\Controller\AdminController::tableauDeBord
    requirements:
        _role: "ROLE_ADMIN"
```

### Utilisation dans les Templates Twig

Avec Twig, vous pouvez utiliser des vérifications de rôle pour conditionnellement afficher du contenu.

#### Afficher un élément uniquement pour l'Admin

```twig
{% if is_granted('ROLE_ADMIN') %}
    <!-- Contenu visible uniquement par l'Admin -->
    <div>
        Contenu réservé à l'Admin
    </div>
{% endif %}
```

#### Afficher un élément pour tous sauf pour l'Admin

```twig
{% if is_granted('ROLE_ADMIN') %}
    <!-- Contenu visible uniquement par l'Admin -->
    <div>
        Contenu réservé à l'Admin
    </div>
{% else %}
    <!-- Contenu visible par tous les autres utilisateurs -->
    <div>
        Contenu visible par les utilisateurs
    </div>
{% endif %}
```

## Appel de données dans la base de données

Avec Doctrine, vous pouvez récupérer des données comme suit :

```php
// Dans un contrôleur
$repository = $this->getDoctrine()->getRepository(Commentaire::class);
$commentaires = $repository->findBy(['user' => $this->getUser()]);

foreach ($commentaires as $commentaire) {
    echo $commentaire->getContenu();
}
```

---

### À propos de Symfony

Symfony est un framework PHP pour les applications web. Il est conçu pour être rapide, flexible et prendre en charge des fonctionnalités avancées comme la gestion des événements, la sécurité et les processus asynchrones. Symfony est bien documenté et possède une large communauté de développeurs.

### Apprentissage de Symfony

La documentation officielle de Symfony est un excellent point de départ pour apprendre à utiliser le framework. Vous y trouverez des guides détaillés, des références API et de nombreuses ressources pour les développeurs de tous niveaux.

### Contribution à Symfony

Symfony est un projet open-source, et les contributions sont toujours les bienvenues. Si vous souhaitez contribuer, vous pouvez commencer par lire le guide des contributions sur le site officiel de Symfony.

### Sécurité

Si vous découvrez une faille de sécurité dans Symfony, vous devez la signaler de manière responsable. Les instructions pour signaler les failles de sécurité se trouvent également sur le site officiel.

### Licence

<<<<<<< HEAD
Symfony est distribué sous la licence MIT, ce qui le rend libre à utiliser et à modifier.

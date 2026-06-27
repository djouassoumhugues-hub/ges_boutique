# 🏪 Gestion de Boutique — Laravel

> Système d'information pour la gestion commerciale de la boutique de Monsieur Ali.  
> Développé avec le framework **Laravel** dans le cadre du cours de **Génie Informatique L2** — CEFOD Business School 2025-2026.

---

## 📋 Description du projet

Ce projet a pour objectif d'informatiser la gestion des activités commerciales d'une boutique. Il remplace la gestion manuelle des clients, produits et commandes par un système centralisé, fiable et facile à utiliser.

Le système permet à l'administrateur (Monsieur Ali) de :

- Enregistrer et gérer les **clients** de la boutique
- Enregistrer et gérer les **produits** du catalogue
- Créer et suivre les **commandes** passées par les clients
- Calculer automatiquement les **montants** des commandes
- Mettre à jour automatiquement le **stock** après chaque commande
- Générer et télécharger les **factures au format PDF**

---

## 🚀 Technologies utilisées

| Technologie | Version | Rôle |
|-------------|---------|------|
| PHP | 8.2.12 | Langage serveur |
| Laravel | 12.x | Framework PHP (MVC) |
| MySQL / MariaDB | 10.4.32 | Base de données |
| Bootstrap | 5.3 | Framework CSS |
| barryvdh/laravel-dompdf | latest | Génération PDF |
| Blade | — | Moteur de templates Laravel |

---

## 🗂️ Fonctionnalités

### 👤 Gestion des clients
- Ajouter un nouveau client
- Modifier les informations d'un client
- Supprimer un client
- Consulter la liste des clients

### 📦 Gestion des produits
- Ajouter de nouveaux produits
- Modifier les informations des produits
- Supprimer des produits
- Consulter le catalogue des produits avec le stock disponible

### 🧾 Gestion des commandes
- Créer une commande pour un client
- Ajouter plusieurs produits dans une même commande
- Calcul automatique du montant total
- Mise à jour automatique du stock après validation
- Restauration du stock en cas de suppression de commande
- Consulter l'historique des commandes

### 📄 Gestion des factures
- Génération automatique d'une facture après chaque commande
- Affichage détaillé des produits, quantités et prix
- Téléchargement de la facture au format **PDF**

---

## 🗄️ Structure de la base de données

```
clients
├── id
├── nom
├── prenom
├── telephone
├── adresse
├── email
└── timestamps

produits
├── id
├── reference (unique)
├── designation
├── prix_unitaire
├── quantite_stock
├── description
└── timestamps

commandes
├── id
├── numero_commande (unique)
├── date_commande
├── client_id (FK → clients)
├── montant_total
└── timestamps

ligne_commandes
├── id
├── commande_id (FK → commandes)
├── produit_id (FK → produits)
├── quantite
├── prix_unitaire
└── timestamps
```

---

## ⚙️ Installation et configuration

### Prérequis
- PHP >= 8.2
- Composer
- MySQL / MariaDB
- XAMPP (ou équivalent)

### Étapes d'installation

**1. Cloner le projet**
```bash
git clone https://github.com/djouassoumhugues-hub/ges_boutique.git
cd ges_boutique
```

**2. Installer les dépendances**
```bash
composer install
```

**3. Configurer l'environnement**
```bash
cp .env.example .env
php artisan key:generate
```

**4. Configurer la base de données dans `.env`**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ges_boutique
DB_USERNAME=root
DB_PASSWORD=
```

**5. Créer la base de données**

Ouvrir phpMyAdmin et créer une base de données nommée `ges_boutique`.

**6. Exécuter les migrations**
```bash
php artisan migrate
```

**7. Lancer le serveur**
```bash
php artisan serve
```

**8. Ouvrir dans le navigateur**
```
http://localhost:8000
```

---

## 📁 Structure du projet

```
ges_boutique/
├── app/
│   ├── Http/Controllers/
│   │   ├── ClientController.php
│   │   ├── ProduitController.php
│   │   └── CommandeController.php
│   └── Models/
│       ├── Client.php
│       ├── Produit.php
│       ├── Commande.php
│       └── LigneCommande.php
├── database/
│   └── migrations/
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       ├── clients/
│       ├── produits/
│       └── commandes/
├── routes/
│   └── web.php
└── public/
    └── css/
        └── style.css
```

---

## 👨‍💻 Auteur

**Hugues Djouassoum**  
Étudiant en Génie Informatique L2  
CEFOD Business School — N'Djaména, Tchad  
Année académique 2025-2026

---

## 📝 Licence

Projet académique — tous droits réservés © 2026
# Vente de vehicules en ligne

vente de vehicule en ligne


## Modèles

- utilisateurs
- paniers
- admin
- factures
- types
- marques
- medias

## Etapes

- [x] lister les marques
- [x] lister les types
- [x] lister les vehicules
- [x] lister tous les vehicules + pagination
- [x] filtrer les résultats
    - [x] recherche
    - [x] type de vehicule
    - [x] marque
    - [x] promotion
- [x] voir le détail du produit
- [x] utilisateur
    - [x] créer un utilisateur
    - [x] confirmer l'utlisateur
    - [x] connecter
    - [x] affiche les informations de l'utilisateur
    - [x] déconnnecter
    - [x] editer son compte
        - [x] change ces informations
        - [x] change le mot de passe
    - [x] supprimer son compte
    - [x] mot de passe oublier
        - [x] trouver le compte de l'utilisateur à l'aide de son email
        - [x] envoi code
        - [x] modifier le mot de passe
    - [x] message flash
- [x] panier
    - [x] voir le detail du produit
    - [x] calcul du montant à payer
    - [x] lister les produits dans le panier
    - [x] paginer les résultats
    - [x] supprimer un ou plusieurs produit dans le panier (AJAX)
    - [x] ajouter le produit dans le panier
    - [x] modifier la quantité (AJAX)
    - [x] calculer les résultats à payer + options de payment
- [x] mode de paiement par banque [simulation]
- [x] système de facturation.
    - [x] lister tous les factures
    - [x] voir une facture 
    - [x] voir tous les factures
- [x] système de notifications
    - [x] lister les notifications dans le header
    - [x] supprimer une notification [ajax]
    - [x] voir une notification
    - [x] detecter les nouvelles notifications [ajax]
- [x] système de popnew (cas on a un message non lu ou un vehicule  ajouté)
- [x] nous contacter
- [] admins
    - [x] types
        - [x] lister tous les types
        - [x] supprimer un type de voiture [ajax]
        - [x] ajouter un type de voiture
        - [x] editer un type de voiture
        - [x] recherche un type ou plusieurs
    - [x] marques
        - [x] lister tous les marques
        - [x] supprimer une marque de voiture [ajax]
        - [x] ajouter un type de voiture
        - [x] editer une marque de voiture
        - [x] recherche une marque ou plusieurs

## Technologie utilisée

- Apifetch de javascript : pour faire des requêtes en ajax
- composer : pour charge le fichier automatique sans utilisé le require ou include
- nodejs : pour le animation
- fontawesome : pour générer les icons
- typewrite : animation de texte (dans l'accueil du site "achetez votre voiture facilement...")

## Outils

- vscode comme editeur.
- laragon comme server web.
- cmder comme terminal.
- git pour garder la trace de nos programmes.
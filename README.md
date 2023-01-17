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

- [ok] lister les marques
- [ok] lister les types
- [ok] lister les vehicules
- [ok] lister tous les vehicules + pagination
- [ok] filtrer les résultats
    - [ok] recherche
    - [ok] type de vehicule
    - [ok] marque
    - [ok] promotion
- [ok] voir le détail du produit
- [ok] utilisateur
    - [ok] créer un utilisateur
    - [ok] confirmer l'utlisateur
    - [ok] connecter
    - [ok] affiche les informations de l'utilisateur
    - [ok] déconnnecter
    - [ok] editer son compte
        - [ok] change ces informations
        - [ok] change le mot de passe
    - [ok] supprimer son compte
    - [ok] mot de passe oublier
        - [ok] trouver le compte de l'utilisateur à l'aide de son email
        - [ok] envoi code
        - [ok] modifier le mot de passe
    - [ok] message flash
- [ok] panier
    - [ok] voir le detail du produit
    - [ok] calcul du montant à payer
    - [ok] lister les produits dans le panier
    - [ok] paginer les résultats
    - [ok] supprimer un ou plusieurs produit dans le panier (AJAX)
    - [ok] ajouter le produit dans le panier
    - [ok] modifier la quantité (AJAX)
    - [ok] calculer les résultats à payer + options de payment
- [ok] mode de paiement par banque [simulation]
- [ok] système de facturation.
    - [ok] lister tous les factures
    - [ok] voir une facture 
    - [ok] voir tous les factures
- [ok] système de notifications
    - [ok] lister les notifications dans le header
    - [ok] supprimer une notification [ajax]
    - [ok] voir une notification
    - [ok] detecter les nouvelles notifications [ajax]
- [ok] système de popnew (cas on a un message non lu ou un vehicule  ajouté)
- [ok] nous contacter
- [] admins
    - [ok] types
        - [ok] lister tous les types
        - [ok] supprimer un type de voiture [ajax]
        - [ok] ajouter un type de voiture
        - [ok] editer un type de voiture
        - [x] recherche un type ou plusieurs
    - [] marques
        - [] supprimer une marque de voiture
        - [] lister tous les marques
        - [] ajouter une marque de voiture
        - [] editer une marque de voiture

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
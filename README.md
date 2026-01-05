# EcoGestUM-grp12-BYTE

**pour créer la BDD aller dans le fichier *createDB.php***

comptes (mail, mdp)*

- test.etudiant.etu@univ-lemans.fr | test
- test.enseignant@univ-lemans.fr | test
- test.presidence@univ-lemans.fr | test

- marie.dupont.etu@univ-lemans.fr | mdp123
- pierre.martin.etu@univ-lemans.fr | mdp456
- sophie.durand.etu@univ-lemans.fr | mdp789
- luc.bernard@univ-lemans.fr | mdp321
- jean.moreau@univ-lemans.fr |  mdp987 | Président

## Pages

**Merci de mettre a jour les cases des pages finis pour qu'on sache où on en est**

### globale
- [X] header
- [X] footer
- [X] connexion
- [X] inscription
- [ ] accueil
- [ ] profil - donnees personelles
- [ ] profil - notifications
- [ ] profil - new mdp
- [X] catalogue recyclage
- [X] detaille objet
- [X] formulaire objet
- [ ] carte
- [ ] gestion des objets : mes reservations
- [ ] gestion des objets : proposer un objet
- [X] gestion des objets : mes objets proposés

### etudiant
- [X] Chercher et réserver des objets
- [ ] Être notifié des nouvelles ressources (?)
- [ ] evenements - etudiant
    - [ ] sans evenement
    - [ ] avec evenement
    - [ ] avec evenement et plus d'info
- [ ] statistique - etudiant
- [ ] Signaler un objet cassé ou non réutilisable
- [ ] Accéder à un espace dédié aux échanges de matériel entre étudiants

### enseignant
- [ ] Chercher et réserver des objets
- [ ] Être notifié des nouvelles ressources (?)
- [ ] gestion des objets - enseignant
- [ ] page evenement en mode "admin"
- [ ] proposer un evenement
- [ ] statistique departement / service
- [ ] statistique evenement
- [ ] statistique mes donnees
- [ ] historique des evenements
- [ ] Signaler un objet cassé ou non réutilisable
- [ ] Accéder à un espace d'échange entre enseignant - "Collaborer avec d’autres enseignants pour mutualiser les ressources recyclées."

### presidence
- [X] gestion des categories
- [ ] gerer les demandes
- [ ] inventaire
- [ ] historique
- [ ] génerer des rapports annuels/trimestriels sur les performances de recyclage
- [ ] statistique - presidence

## Exemple de .env

```env
BONUS_PATH=

DB_NAME=ECOGESTUM
DB_HOST=localhost
DB_USER=root
DB_PASS=
```

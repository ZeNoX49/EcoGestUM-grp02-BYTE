<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href=<?php echo $_ENV["BONUS_PATH"]."assets/css/style-profil.css" ?>>
    <title>Mon Profil</title>
</head>
<body>
<?php include  $_ENV["BONUS_PATH"].'assets/html/header.html'; ?>

<div class="main-profil">

    <div class="profile-card">

        <div class="profile-sidebar">

            <div class="sidebar-group">
                <h3><i class="fa-regular fa-circle-question"></i> Informations</h3>
                <ul>
                    <li onclick="showSection('perso', this)" class="active">Données Personnelles</li>
                    <li onclick="showSection('notif', this)">Notifications</li>
                </ul>
            </div>

            <div class="sidebar-group">
                <h3><i class="fa-solid fa-shield-halved"></i> Confidentialité et Sécurité</h3>
                <ul>
                    <li onclick="showSection('mdp', this)">Changer Mot de Passe</li>
                </ul>
            </div>

            <div class="sidebar-group">
                <ul>
                    <li onclick="showSection('deco', this)">Déconnexion</li>
                </ul>
            </div>

        </div>

        <div class="profile-content">

            <div id="perso" class="content-section active-section">
                <h2>Données Personnelles</h2>
                <form>
                    <div class="profil-form-group">
                        <label>Nom</label>
                        <input type="text" class="profil-input" value="<?php echo $user[0]["nom_utilisateur"] ?>">
                    </div>
                    <div class="profil-form-group">
                        <label>Prénom</label>
                        <input type="text" class="profil-input" value="<?php echo $user[0]["prenom_utilisateur"] ?>">
                    </div>
                    <div class="profil-form-group">
                        <label>Email</label>
                        <input type="email" class="profil-input" value="<?php echo $user[0]["email_utilisateur"] ?>">
                    </div>
                </form>
            </div>

            <div id="notif" class="content-section">
                <h2>Notifications</h2>

                <h4 style="margin-bottom: 5px; font-size: 18px;">Objets</h4>
                <p class="notif-intro">Choisissez les types d'objets et leur localisation pour recevoir des notifications</p>

                <div class="notif-grid">
                    <div class="col">
                        <div class="profil-form-group" style="margin-bottom: 10px;">
                            <label>Catégorie</label>
                            <select class="profil-input" style="cursor: pointer;">
                                <option>Sélectionnez</option>
                                <?php foreach($objet_categories_possible as $obj_cat_p) : ?>
                                    <option><?php echo $obj_cat_p["nom_categorie"] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="tag-box">
                            <?php foreach($notif_obj_cat as $obj_cat) : ?>
                                <option><span class="tag-close">×</span><?php echo " ".$objet_categories[$obj_cat["id_choix"]]["nom_categorie"] ?></option>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="col">
                        <div class="profil-form-group" style="margin-bottom: 10px; ">
                            <label>Localisation</label>
                            <select class="profil-input" style="cursor: pointer;">
                                <option>Sélectionnez</option>
                                <?php foreach($objet_position_possible as $obj_pos_p) : ?>
                                    <option><?php echo $obj_pos_p["adresse_point_collecte"] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="tag-box">
                            <?php foreach($notif_obj_loc as $obj_pos) : ?>
                                <option><span class="tag-close">×</span><?php echo " ".$objet_position[$obj_pos["id_choix"]]["adresse_point_collecte"] ?></option>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>

                <h4 style="margin-bottom: 5px; font-size: 18px; margin-top: 30px;">Évènements</h4>
                <p class="notif-intro">Choisissez les types d'évènements, les organisateurs et leur localisation pour recevoir des notifications</p>

                <div class="notif-grid" style="grid-template-columns: 1fr 1.5fr 1fr;">
                    <div class="col">
                        <div class="profil-form-group" style="margin-bottom: 10px;">
                            <label>Catégorie</label>
                            <select class="profil-input">
                                <option>Sélectionnez</option>
                                <?php foreach($event_categories_possible as $event_cat_p) : ?>
                                    <option><?php echo $event_cat_p["nom_type_evenement"] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="tag-box">
                            <?php foreach($notif_event_cat as $event_cat) : ?>
                                <option><span class="tag-close">×</span><?php echo " ".$event_categories[$event_cat["id_choix"]]["nom_type_evenement"] ?></option>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="col">
                        <div class="profil-form-group" style="margin-bottom: 10px;">
                            <label>Organisateurs</label>
                            <select class="profil-input">
                                <option>Sélectionnez</option>
                                <?php foreach($event_organisateur_possible as $event_org_p) : ?>
                                    <option><?php echo $event_org_p["email_utilisateur"] ?></option>
                                <?php endforeach ?>
                            </select>                        </div>
                        <div class="tag-box">
                            <?php foreach($notif_event_org as $event_org) : ?>
                                <option><span class="tag-close">×</span><?php echo " ".$event_organisateur[$event_org["id_choix"]]["email_utilisateur"] ?></option>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="col">
                        <div class="profil-form-group" style="margin-bottom: 10px;">
                            <label>Localisation</label>
                            <select class="profil-input">
                                <option>Sélectionnez</option>
                                <?php foreach($event_localisation_possible as $event_loc_p) : ?>
                                    <option><?php echo $event_loc_p["adresse_point_collecte"] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="tag-box">
                            <?php foreach($notif_event_loc as $event_loc) : ?>
                                <option><span class="tag-close">×</span><?php echo " ".$event_localisation[$event_loc["id_choix"]]["adresse_point_collecte"] ?></option>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>

                <h4 style="margin-bottom: 15px; font-size: 18px; margin-top: 30px;">Communications</h4>
                <div class="checkbox-group">
                    <label class="checkbox-item">
                        <input type="checkbox" checked>
                        Communications sur les initiatives écologiques de l'université
                    </label>
                    <label class="checkbox-item">
                        <input type="checkbox" !checked>
                        Communications sur ...
                    </label>
                </div>
            </div>

            <div id="mdp" class="content-section">
                <h2>Changer Mot de Passe</h2>
                <form>
                    <div class="profil-form-group center-btn" style="margin: 40px auto;">
                        <div style="width: 100%;">
                            <label>Mot de passe actuel</label>
                            <input type="password" class="profil-input">
                        </div>
                    </div>

                    <div class="profil-form-group center-btn" style="margin: 20px auto;">
                        <div style="width: 100%;">
                            <label>Nouveau Mot de passe</label>
                            <input type="password" class="profil-input">
                        </div>
                    </div>

                    <div class="profil-form-group center-btn" style="margin: 20px auto;">
                        <div style="width: 100%;">
                            <label>Confirmation du Mot de passe</label>
                            <input type="password" class="profil-input">
                        </div>
                    </div>

                    <div class="center-btn" style="margin-top: 40px;">
                        <button type="button" class="btn-confirm">CONFIRMER</button>
                    </div>
                </form>
            </div>

            <div id="deco" class="content-section">
                <h2>Déconnexion</h2>
                <div onclick="window.location.href='index.php?action=connexion/disconnect'">
                    <button type="button" class="btn-confirm">SE DÉCONNECTER</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include  $_ENV["BONUS_PATH"].'assets/html/footer.html'; ?>
<script src=<?php echo  $_ENV["BONUS_PATH"]."assets/js/page-profil.js" ?>></script>
</body>
</html>
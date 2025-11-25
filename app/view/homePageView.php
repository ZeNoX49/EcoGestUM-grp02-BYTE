<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>EcoGestUM - Accueil</title>
    <link rel="stylesheet" href=<?php echo $_ENV['BONUS_PATH']."assets/css/style-Home.css" ?>>
</head>
<header class="header">
    <?php include $_ENV['BONUS_PATH'].'assets/html/header.html'; ?>
</header>
<body>
<main>
    <div class="home-section-wrapper">
        <h1>ÉcoGestUM</h1>
        <h3>Ensemble pour un campus plus durable</h3>
        <p>
            La plateforme de gestion du recyclage et de réutilisation des équipements au sein de Le Mans Université</p>
    </div>

    <div class="home-section-wrapper">
        <h3>Notre Démarche Éco-Responsable</h3>
        <p>
            Dans une démarche éco-responsable et soucieuse de réduire son impact environnemental, Le Mans Université a développé EcoGestUM, une application web dédiée à la gestion du recyclage des objets issus de ses différentes composantes et services.
        </p>
        <div class="eco-grid">
            <div class="eco-item">
                <h1>🔄</h1>
                <h3>Optimiser le tri</h3>
                <p>Optimiser le tri et la revalorisation des équipements et mobiliers issus des différentes composantes.</p>
            </div>
            <div class="eco-item">
                <h1>📍</h1>
                <h3>Faciliter l'accès</h3>
                <p>Faciliter l'accès aux offres de réutilisation et préparer l'intégration pour les nouveaux usagers & services.</p>
            </div>
            <div class="eco-item">
                <h1>🌱</h1>
                <h3>Gestion durable</h3>
                <p>Proposer des stratégies de gestion durable et des statistiques sur les réutilisations.</p>
            </div>
        </div>

        <section class="recyclables">
            <h1>Objets Recyclables</h1>
            <p>
                EcoGestUM permet de gérer le recyclage d'une grande variété d'équipements issus des différentes composantes et services de l'université.
            </p>
            <div class="objects-grid">
                <div class="obj-item"><h1>💻</h1><span>Matériel informatique</span></div>
                <div class="obj-item"><h1>🪑</h1><span>Mobilier</span></div>
                <div class="obj-item"><h1>📚</h1><span>Livres</span></div>
                <div class="obj-item"><h1>🎓</h1><span>Fournitures</span></div>
                <div class="obj-item"><h1>⚽</h1><span>Équipements sportif</span></div>
                <div class="obj-item"><h1>🔌</h1><span>Petit électroménager</span></div>
                <div class="obj-item"><h1>📺</h1><span>Matériel média</span></div>
                <div class="obj-item"><h1>👕</h1><span>Vêtements</span></div>
            </div>
        </section>
        <section class="testimonials">
            <h1>Ils Témoignent</h1>
            <p>Les utilisateurs d'EcoGestUM partagent leur expérience</p>
            <div class="testimonial-list">
                <?php foreach($temoignages_display as $temoignage_display) : ?>
                    <div class="testimonial">
                        <p><?php echo $temoignage_display["temoignage"] ?></p>
                        <span class="user"><?php echo $temoignage_display["auteur"] ?></span>
                        <span class="role-user"><?php echo $temoignage_display["role"] ?></span>
                    </div>
                <?php endforeach ?>
            </div>
        </section>
    </div>
</main>
<footer>
     <?php include $_ENV['BONUS_PATH'].'assets/html/footer.html'; ?>
</footer>
</div>
</body>
</html>
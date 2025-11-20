<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style-catalogue.css">
    <title>Catalogue Recyclage</title>
</head>
<body>
<?php include 'assets/html/header.html'; ?>
<div class="main">
    <div class="elements">
        <div class="search-barre">
            <form action="index.php" method="GET" class="search-form" id="searchForm">
                <input type="hidden" name="action" value="catalogue/show">

                <input type="hidden" name="category" id="catInput" value="<?php echo isset($_GET['category']) ? htmlspecialchars($_GET['category']) : ''; ?>">
                <input type="hidden" name="etat" id="etatInput" value="<?php echo isset($_GET['etat']) ? htmlspecialchars($_GET['etat']) : ''; ?>">

                <div class="search-input-container">
                    <button type="submit" style="border:none; background:none; cursor:pointer;">
                        <img src="assets/image/search.svg" alt="Recherche" class="search-icon">
                    </button>
                    <input type="text" name="search" placeholder="Rechercher un objet..." class="search-input" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                </div>

                <div class="dropdown-container">
                    <input type="checkbox" id="toggle-filter" class="menu-checkbox">
                    <label for="toggle-filter" class="action-btn">
                        Filtrer <?php if(!empty($_GET['category'])) echo '<span style="color:green">•</span>'; ?>
                    </label>
                    <div class="dropdown-menu category-menu">
                        <p class="filter-title">Catégories</p>
                        <div class="filter-tags">
                            <button type="button"
                                    class="tag-btn <?php echo empty($_GET['category']) ? 'selected' : ''; ?>"
                                    onclick="setFilter('catInput', '', this)">
                                Toutes
                            </button>

                            <?php if(isset($categoriesList)): foreach($categoriesList as $cat): ?>
                                <button type="button"
                                        class="tag-btn <?php echo (isset($_GET['category']) && $_GET['category'] == $cat['id_categorie']) ? 'selected' : ''; ?>"
                                        onclick="setFilter('catInput', '<?php echo $cat['id_categorie']; ?>', this)">
                                    <?php echo htmlspecialchars($cat['nom_categorie']); ?>
                                </button>
                            <?php endforeach; endif; ?>
                        </div>

                        <button type="submit" class="validate-btn" style="margin-top:10px;">Appliquer</button>
                    </div>
                </div>

                <div class="dropdown-container">
                    <input type="checkbox" id="toggle-sort" class="menu-checkbox">
                    <label for="toggle-sort" class="action-btn">
                        Trier <?php if(!empty($_GET['etat']) || !empty($_GET['location'])) echo '<span style="color:green">•</span>'; ?>
                    </label>
                    <div class="dropdown-menu sort-menu">
                        <div class="filter-section">
                            <p class="filter-title">État</p>
                            <div class="filter-tags">
                                <button type="button"
                                        class="tag-btn <?php echo empty($_GET['etat']) ? 'selected' : ''; ?>"
                                        onclick="setFilter('etatInput', '', this)">
                                    Tous
                                </button>

                                <?php if(isset($etatsList)): foreach($etatsList as $et): ?>
                                    <button type="button"
                                            class="tag-btn <?php echo (isset($_GET['etat']) && $_GET['etat'] == $et['nom_etat']) ? 'selected' : ''; ?>"
                                            onclick="setFilter('etatInput', '<?php echo $et['nom_etat']; ?>', this)">
                                        <?php echo $et['nom_etat']; ?>
                                    </button>
                                <?php endforeach; endif; ?>
                            </div>
                        </div>

                        <div class="filter-section">
                            <p class="filter-title">Localisation</p>
                            <div class="location-box">
                                <img src="assets/image/map-pin.svg" alt="Loc" class="loc-icon">
                                <input type="text"
                                       name="location"
                                       list="locations-list"
                                       placeholder="Bâtiment, Salle..."
                                       autocomplete="off"
                                       value="<?php echo isset($_GET['location']) ? htmlspecialchars($_GET['location']) : ''; ?>">

                                <datalist id="locations-list">
                                    <?php if(isset($locationsList)): foreach($locationsList as $loc): ?>
                                    <option value="<?php echo htmlspecialchars($loc['nom_point_collecte']); ?>">
                                        <?php endforeach; endif; ?>
                                </datalist>
                            </div>
                        </div>
                        <button type="submit" class="validate-btn">Valider</button>
                    </div>
                </div>

                <?php if(!empty($_GET['search']) || !empty($_GET['category']) || !empty($_GET['etat']) || !empty($_GET['location'])): ?>
                    <a href="index.php?action=catalogue/show" class="action-btn" title="Tout réinitialiser" style="text-decoration:none; display:flex; align-items:center; justify-content:center; padding: 10px 15px;">
                        <i class="fa-solid fa-rotate-right"></i>
                    </a>
                <?php endif; ?>

            </form>
        </div>

        <div class="catalogue-wrapper">
            <div class="catalogue">
                <div class="catalogue-list">
                    <?php if(isset($objets) && !empty($objets)): ?>
                        <?php foreach($objets as $objet): ?>
                            <article class="card-objet">
                                <div class="card-img-container">
                                    <?php
                                    $imgSrc = !empty($objet['image_objet']) ? 'assets/image/uploads/'.$objet['image_objet'] : 'https://via.placeholder.com/140x140/A8A8A8/FFFFFF?text=Pas+d\'image';
                                    if(strpos($objet['image_objet'], 'http') === 0) { $imgSrc = $objet['image_objet']; }
                                    ?>
                                    <div class="card-image-box" style="background-image: url('<?php echo htmlspecialchars($imgSrc); ?>');"></div>
                                </div>
                                <div class="card-content" style="cursor: pointer;" onclick="window.location.href='index.php?action=detaille/show&id=<?php echo $objet['id_objet']; ?>'">
                                    <h3><?php echo htmlspecialchars($objet['nom_objet']); ?></h3>
                                    <div class="card-text">
                                        <span class="label">Description :</span>
                                        <p><?php echo htmlspecialchars(substr($objet['description_objet'], 0, 100)) . '...'; ?></p>
                                    </div>
                                    <div class="card-text">
                                        <span class="label">Localisation :</span>
                                        <span class="value">
                                            <?php echo htmlspecialchars($objet['nom_point_collecte']); ?>
                                            <?php echo !empty($objet['adresse_point_collecte']) ? ' | '.htmlspecialchars($objet['adresse_point_collecte']) : ''; ?>
                                        </span>
                                    </div>
                                    <div class="card-text">
                                        <span class="label">État :</span>
                                        <span class="value"><?php echo htmlspecialchars($objet['nom_etat']); ?></span>
                                    </div>
                                </div>
                                <a href="index.php?action=detaille/show&id=<?php echo $objet['id_objet']; ?>" class="card-action">
                                    <span>Reserver</span>
                                </a>
                            </article>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div style="text-align: center; padding: 50px;">
                            <h3>Aucun objet trouvé</h3>
                            <p>Essayez de modifier vos filtres de recherche.</p>
                            <a href="index.php?action=catalogue/show" style="color: #DB4C3B; text-decoration: underline;">Réinitialiser les filtres</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'assets/html/footer.html'; ?>

<script>
    function setFilter(inputId, value, element) {
        document.getElementById(inputId).value = value;
        const container = element.parentElement;
        const buttons = container.getElementsByClassName('tag-btn');
        for(let btn of buttons) {
            btn.classList.remove('selected');
        }
        element.classList.add('selected');
    }
</script>

</body>
</html>
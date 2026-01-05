<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>EcoGestUM - Événements</title>
  <link rel="stylesheet" href= <?php echo $_ENV['BONUS_PATH'].'assets/css/style-event.css' ?>>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Koulen&family=Lexend:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Press+Start+2P&family=Roboto:ital,wght@0,100..900;1,100..900&family=Sour+Gummy:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<?php 
include $_ENV['BONUS_PATH'].'assets/html/header.html'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
  if ($_POST['action'] === 'create_event') {
    error_log("POST data: " . print_r($_POST, true));
    
    if (isset($_SESSION['user_id']) && isset($_POST['event_titre']) && isset($_POST['event_date_debut']) && isset($_POST['event_date_fin'])) {
      $titre = htmlspecialchars($_POST['event_titre']);
      $type = htmlspecialchars($_POST['event_type']);
      $description = htmlspecialchars($_POST['event_description']);
      $date_debut = $_POST['event_date_debut'];
      $date_fin = $_POST['event_date_fin'];
      $id_type_evenement = isset($_POST['event_id_type']) ? (int)$_POST['event_id_type'] : 1;
      $id_utilisateur = $_SESSION['user_id'];

      error_log("Tentative de création événement: $titre, $type, $description, $date_debut, $date_fin, $id_type_evenement, $id_utilisateur");
      
      try {
        $result = createEvent($titre, $type, $description, $date_debut, $date_fin, $id_type_evenement, $id_utilisateur);
        error_log("Résultat création: " . ($result ? "SUCCÈS" : "ÉCHEC"));
        
        if ($result) {
          header('Location: ' . $_SERVER['REQUEST_URI']);
          exit;
        } else {
          $error_message = "Erreur lors de la création de l'événement.";
        }
      } catch (Exception $e) {
        error_log("Erreur création événement: " . $e->getMessage());
        $error_message = "Erreur: " . $e->getMessage();
      }
    } else {
      $missing = [];
      if (!isset($_SESSION['user_id'])) $missing[] = "user_id";
      if (!isset($_POST['event_titre'])) $missing[] = "event_titre";
      if (!isset($_POST['event_date_debut'])) $missing[] = "event_date_debut";
      if (!isset($_POST['event_date_fin'])) $missing[] = "event_date_fin";
      
      $error_message = "Champs manquants: " . implode(", ", $missing);
      error_log("Champs manquants: " . implode(", ", $missing));
    }
  }
  elseif ($_POST['action'] === 'register') {
    if (isset($_SESSION['user_id']) && isset($_POST['event_id'])) {
      $userId = $_SESSION['user_id'];
      $eventId = (int)$_POST['event_id'];

      if (!isUserRegisteredToEvent($userId, $eventId)) {
        $result = registerUserToEvent($userId, $eventId);
        if ($result) {
          header('Location: ' . $_SERVER['REQUEST_URI']);
          exit;
        } else {
          $error_message = "Erreur lors de l'inscription.";
        }
      }
    }
  }
  elseif ($_POST['action'] === 'unregister') {
    if (isset($_SESSION['user_id']) && isset($_POST['event_id'])) {
      $userId = $_SESSION['user_id'];
      $eventId = (int)$_POST['event_id'];

      if (isUserRegisteredToEvent($userId, $eventId)) {
        $result = unregisterUserFromEvent($userId, $eventId);
        if ($result) {
          header('Location: ' . $_SERVER['REQUEST_URI']);
          exit;
        } else {
          $error_message = "Erreur lors de la désinscription.";
        }
      }
    }
  }
  elseif ($_POST['action'] === 'delete_event') {
    error_log("Tentative de suppression événement ID: " . $_POST['event_id']);
    
    if (isset($_SESSION['user_id']) && isset($_POST['event_id'])) {
      $eventId = (int)$_POST['event_id'];
      
      try {
        error_log("Appel deleteEvent($eventId)");
        $result = deleteEvent($eventId);
        error_log("Résultat suppression: " . ($result ? "SUCCÈS" : "ÉCHEC"));

        if ($result) {
          header('Location: ' . $_SERVER['REQUEST_URI']);
          exit;
        } else {
          $error_message = "Erreur lors de la suppression de l'événement.";
        }
      } catch (Exception $e) {
        error_log("Erreur suppression événement: " . $e->getMessage());
        $error_message = "Erreur: " . $e->getMessage();
      }
    } else {
      error_log("Session ou event_id manquant");
      $error_message = "Données manquantes pour la suppression.";
    }
  }
}

$userId = $_SESSION['user_id'] ?? null;
$userEventIds = [];
$daysWithEvents = [];
$daysRegistered = [];
if ($userId) {
  $userEvents = getUserEvents($userId);
  $userEventIds = array_column($userEvents, 'id_evenement');
}

if (isset($data['events']) && !empty($data['events'])) {
  foreach ($data['events'] as $event) {
    $eventDate = date('Y-m-d', strtotime($event['date_debut_evenement']));
    if (date('Y-m', strtotime($eventDate)) === sprintf('%04d-%02d', $data['year'], $data['month'])) {
      $dayNum = (int)date('d', strtotime($eventDate));
      $daysWithEvents[$dayNum] = true;
      
      if (in_array($event['id_evenement'], $userEventIds)) {
        $daysRegistered[$dayNum] = true;
      }
    }
  }
}
?>

<?php if (isset($error_message)): ?>
<script>
  alert(<?php echo json_encode($error_message); ?>);
</script>
<?php endif; ?>

<main>
  <div class="event-main-wrapper">
    <div class="event-header-bar">
      <span class="event-title">Événements</span>
      <a href="#" class="event-back-btn" title="Retour"></a>
    </div>
    <div class="event-content-area">
      <div class="event-calendar-box">
        <?php
        $baseUrl = 'index.php?action=event/show';
        $month = $data['month'];
        $year = $data['year'];
        $selectedDay = $data['day'];

        $firstDay = mktime(0, 0, 0, $month, 1, $year);
        $daysInMonth = date('t', $firstDay);
        $weekdayStart = date('N', $firstDay);

        $prevMonth = $month - 1;
        $prevYear = $year;
        if ($prevMonth < 1) { 
            $prevMonth = 12; 
            $prevYear--; 
        }

        $nextMonth = $month + 1;
        $nextYear = $year;
        if ($nextMonth > 12) { 
            $nextMonth = 1; 
            $nextYear++; 
        }
        ?>

        <div class="calendar-nav">
          <button onclick="window.location.href='<?php 
              echo $baseUrl
                   . '&month=' . $prevMonth 
                   . '&year=' . $prevYear 
                   . '&day=' . $selectedDay; 
          ?>'"><</button>

          <div class="event-calendar-header">
            <?= $mois[$month]." ".$year ?>
          </div>

          <button onclick="window.location.href='<?php 
              echo $baseUrl
                   . '&month=' . $nextMonth 
                   . '&year=' . $nextYear 
                   . '&day=' . $selectedDay; 
          ?>'">></button>
        </div>

        <table class="event-calendar-table">
          <thead>
            <tr>
              <th>Lu</th><th>Ma</th><th>Me</th><th>Je</th><th>Ve</th><th>Sa</th><th>Di</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $day = 1;
            for ($week = 0; $week < 6; $week++) {
                echo '<tr>';
                for ($dayOfWeek = 1; $dayOfWeek <= 7; $dayOfWeek++) {
                    if ($week === 0 && $dayOfWeek < $weekdayStart) {
                        echo '<td></td>';
                    } elseif ($day > $daysInMonth) {
                        echo '<td></td>';
                    } else {
                        $isSelected = ($day === $selectedDay) ? 'selected-day' : '';
                        $hasEvents = isset($daysWithEvents[$day]) ? 'calendar-day-has-events' : '';
                        $isRegistered = isset($daysRegistered[$day]) ? 'calendar-day-registered' : '';
                        $cellDate = sprintf('%04d-%02d-%02d', $year, $month, $day);

                        echo '<td class="clickable ' . $isSelected . ' ' . $hasEvents . ' ' . $isRegistered . '" '
                           . 'onclick="window.location.href=\'' 
                           . $baseUrl 
                           . '&date=' . $cellDate 
                           . '\'">'
                           . $day 
                           . '</td>'; 

                        $day++;
                    }
                }
                echo '</tr>';
                if ($day > $daysInMonth) break;
            }
            ?>
          </tbody>
        </table>
      </div>
      <div class="event-details-box">
        <?php
          $selectedDate = sprintf('%04d-%02d-%02d', $year, $month, $selectedDay);
          $eventsForDay = [];

          if (isset($data['events']) && !empty($data['events'])) {
              foreach ($data['events'] as $event) {
                  $eventDate = date('Y-m-d', strtotime($event['date_debut_evenement']));
                  if ($eventDate === $selectedDate) {
                      $eventsForDay[] = $event;
                  }
              }
          }

          $date = DateTime::createFromFormat('Y-n-j', "$year-$month-$selectedDay");
          $j_date = $date->format('l d F Y');
          $j_list = explode(" ", $j_date);
          $j = $j_list[0];
        ?>
        <div class="event-details-header"><?= $jour[$j]." ".$selectedDay." ".$mois[$month]." ".$year; ?></div>
        
        <?php if (!empty($eventsForDay)): ?>
          <?php foreach ($eventsForDay as $event): ?>
            <details class="event-card">
              <summary>
                <span class="event-card-title"><?php echo htmlspecialchars($event['titre_evenement']);?></span>
                <?php if (in_array($event['id_evenement'], $userEventIds)): ?>
                  <form method="POST" style="display: inline;">
                    <input type="hidden" name="action" value="unregister">
                    <input type="hidden" name="event_id" value="<?php echo $event['id_evenement']; ?>">
                    <button class="event-card-btn event-card-btn-registered" type="submit">Se désinscrire</button>
                  </form>
                <?php else: ?>
                  <form method="POST" style="display: inline;">
                    <input type="hidden" name="action" value="register">
                    <input type="hidden" name="event_id" value="<?php echo $event['id_evenement']; ?>">
                    <button class="event-card-btn" type="submit">S'inscrire</button>
                  </form>
                <?php endif; ?>
              </summary>
              <div class="event-card-details">
                <?php if($event["id_utilisateur"] === $_SESSION["user_id"]) : ?>
                  <button class="delete-event-btn" title="Supprimer l'événement" onclick="confirmDeleteEvent(<?php echo (int)$event['id_evenement']; ?>)">
                    <i class="fa-solid fa-trash"></i>
                  </button>
                <?php endif ?>
                <form id="delete-event-form-<?php echo $event['id_evenement']; ?>" method="POST" style="display: none;">
                  <input type="hidden" name="action" value="delete_event">
                  <input type="hidden" name="event_id" value="<?php echo $event['id_evenement']; ?>">
                </form>
                <p><strong>Type:</strong> <?php echo htmlspecialchars($event['nom_type_evenement']); ?></p>
                <p><strong>Début:</strong> <?php echo date('d/m/Y H:i', strtotime($event['date_debut_evenement'])); ?></p>
                <p><strong>Fin:</strong> <?php echo date('d/m/Y H:i', strtotime($event['date_fin_evenement'])); ?></p>
                <p><strong>Organisateur:</strong> <?php echo htmlspecialchars($event['prenom_utilisateur'] . ' ' . $event['nom_utilisateur']); ?></p>
                <p><?php echo htmlspecialchars($event['description_evenement']); ?></p>
              </div>
            </details>
          <?php endforeach; ?>
        <?php else: ?>
          <p>Aucun événement pour cette date.</p>
        <?php endif; ?>
        <button class="add-event-icon-btn" title="Ajouter un événement" onclick="openAddEventModal()">
          <img src=<?php echo $_ENV['BONUS_PATH'].'assets/image/plus-inconn.svg'?> alt="Ajouter un événement"/>
        </button>
      </div>
    </div>
  </div>
</main>

<div id="addEventModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h2>Créer un nouvel événement</h2>
      <button class="close-btn" onclick="closeAddEventModal()">&times;</button>
    </div>
    <form method="POST">
      <input type="hidden" name="action" value="create_event">
      
      <div class="form-group">
        <label for="event_titre">Titre de l'événement *</label>
        <input type="text" id="event_titre" name="event_titre" required>
      </div>

      <div class="form-group">
      <label for="event_id_type">Type d'événement *</label>
        <select id="event_id_type" name="event_id_type" required>
          <option value="">Sélectionner un type</option>
          <option value="1">Collecte</option>
          <option value="2">Atelier de reparation</option>
          <option value="3">Brocante solidaire</option>
          <option value="4">Sensibilisation</option>
        </select>
      </div>


      <div class="form-group">
        <label for="event_description">Description *</label>
        <textarea id="event_description" name="event_description" required></textarea>
      </div>

      <div class="form-group">
        <label for="event_date_debut">Date et heure de début *</label>
        <input type="datetime-local" id="event_date_debut" name="event_date_debut" required>
      </div>

      <div class="form-group">
        <label for="event_date_fin">Date et heure de fin *</label>
        <input type="datetime-local" id="event_date_fin" name="event_date_fin" required>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn-cancel" onclick="closeAddEventModal()">Annuler</button>
        <button type="submit" class="btn-submit">Créer l'événement</button>
      </div>
    </form>
  </div>
</div>

<script>
function openAddEventModal() {
  document.getElementById('addEventModal').classList.add('active');
}

function closeAddEventModal() {
  document.getElementById('addEventModal').classList.remove('active');
}

window.onclick = function(event) {
  const modal = document.getElementById('addEventModal');
  if (event.target === modal) {
    modal.classList.remove('active');
  }
}

function confirmDeleteEvent(eventId) {
  if (confirm("Êtes-vous sûr de vouloir supprimer cet événement ?")) {
    const form = document.getElementById('delete-event-form-' + eventId);
    if (form) {
      form.submit();
    }
  }
}
</script>

<?php include $_ENV['BONUS_PATH'].'assets/html/footer.html'; ?>
</body>
</html>
<?php
if(!isset($notifications)) $notifications = [];

if(empty($notifications)){
    echo '<p class="no-notif">Aucune nouvelle notification.</p>';
} else {
    foreach($notifications as $notification){
        echo '<div class="notif-item" id="notif-' . $notification['id_notification'] . '"</div>';
        echo '<button class="delete-btn" onclick="supprimerNotif(' . $notification['id_notification'] . ')">&times;</button>';
        echo '<strong>' . htmlspecialchars($notification['contenu_notification']) . '</strong>';
        echo '<p>Reçu le ' . $notification['date_notification'] . '</p>';
        echo '</div>';
    }
}
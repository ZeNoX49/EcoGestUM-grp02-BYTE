<?php
if(!isset($notifications)) $notifications = [];
if(empty($notifications)){
    echo '<p>Aucune nouvelle notification.</p>';
} else {
    foreach($notifications as $notification){
        echo '<div class="notif-item">';
        echo '<strong>' . htmlspecialchars($notification['contenu_notification']) . '</strong>';
        echo '<p>Reçu le ' . $notification['date_notification'] . '</p>';
        echo '</div>';
    }
}

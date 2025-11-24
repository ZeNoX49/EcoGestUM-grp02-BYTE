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
<?php include $_ENV['BONUS_PATH'].'assets/html/header.html'; ?>
<main>
  <div class="event-main-wrapper">
    <div class="event-header-bar">
      <span class="event-title">Événements</span>
      <a href="#" class="event-back-btn" title="Retour">
      </a>
    </div>
    <div class="event-content-area">
      <div class="event-calendar-box">
        <div class="event-calendar-header">Octobre 2025</div>
        <table class="event-calendar-table">
          <thead>
            <tr>
              <th>Mo</th><th>Tu</th><th>We</th><th>Th</th><th>Fr</th><th>Sa</th><th>Su</th>
            </tr>
          </thead>
          <tbody>
            <tr><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td></tr>
            <tr><td>8</td><td>9</td><td>10</td><td>11</td><td>12</td><td>13</td><td>14</td></tr>
            <tr>
              <td>15</td>
              <td>16</td>
              <td class="selected-day">18</td>
              <td>19</td>
              <td>20</td>
              <td>21</td>
              <td>22</td>
            </tr>
            <tr><td>23</td><td>24</td><td>25</td><td>26</td><td>27</td><td>28</td><td>29</td></tr>
            <tr><td>30</td><td>31</td><td></td><td></td><td></td><td></td><td></td></tr>
          </tbody>
        </table>
      </div>
      <div class="event-details-box">
  <div class="event-details-header">Jeudi 18 Octobre</div>
  <details class="event-card" open>
    <summary>
      <span class="event-card-title">ADILL Event</span>
      <button class="event-card-btn" type="button">S'inscrire</button>
    </summary>
    <div class="event-card-details">
      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi pulvinar vitae elit placerat lacinia velit est sit amet enim. Mauris convallis commodo turpis. Vestibulum feugiat varius, accumsan eu odio eu, aliquet pharetra nunc. Etiam dictum ullamcorper enim.
    </div>
  </details>
</div>
</div>
</div>
</main>
</div>
</body>
</html>

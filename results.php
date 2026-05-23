<?php
include 'db.php';
include 'header.php';

if (!isset($conn)) {
    die("Database connection failed");
}
?>

<div class="results-wrapper">
<div class="results-card">

  <h2>🏁 Completed Race Results</h2>

  <?php
  // Get each completed race
  $races = mysqli_query($conn, "
      SELECT r.id, r.race_name, r.race_date, t.location
      FROM races r
      JOIN tracks t ON r.track_id = t.id
      WHERE r.status = 'Completed'
      ORDER BY r.race_date DESC
  ");

  while($race = mysqli_fetch_assoc($races)):
  ?>

    <h3>
      📍 Track: <?= htmlspecialchars($race['location']) ?><br>
      🏁 <?= htmlspecialchars($race['race_name']) ?> (<?= $race['race_date'] ?>)
    </h3>

    <table>
      <tr>
        <th>Racer</th>
        <th>Car</th>
        <th>Position</th>
        <th>Time</th>
        <th>Points</th>
      </tr>

      <?php
      // Results for this race
      $results = mysqli_query($conn, "
          SELECT rr.*, r.name AS racer_name, c.car_name
          FROM race_results rr
          JOIN racers r ON rr.racer_id = r.id
          JOIN cars c ON rr.car_id = c.id
          WHERE rr.race_id = {$race['id']}
          ORDER BY rr.position ASC
      ");

      while($row = mysqli_fetch_assoc($results)):
      ?>
      <tr>
        <td><?= htmlspecialchars($row['racer_name']) ?></td>
        <td><?= htmlspecialchars($row['car_name']) ?></td>
        <td><?= $row['position'] ?></td>
        <td><?= $row['finish_time'] ?></td>
        <td><?= $row['points'] ?></td>
      </tr>
      <?php endwhile; ?>

    </table>

  <?php endwhile; ?>

  <button onclick="window.location='index.php'" class="btn-back">⬅ Back</button>

</div>
</div>

<?php include 'footer.php'; ?>

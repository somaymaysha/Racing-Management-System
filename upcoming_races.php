<?php
include 'db.php';
include 'header.php';
?>

<div class="container">

  <!-- UPCOMING RACES -->
  <h2 class="section-title">⏳ Upcoming Races</h2>

  <div class="card">
    <table>
      <tr>
        <th>Race</th>
        <th>Track</th>
        <th>Date</th>
        <th>Status</th>
      </tr>

      <?php
      $upcoming = mysqli_query($conn, "
          SELECT r.*, t.location AS track_name
          FROM races r
          JOIN tracks t ON r.track_id = t.id
          WHERE r.status = 'Upcoming'
          ORDER BY r.race_date ASC
      ");

      while($row = mysqli_fetch_assoc($upcoming)):
      ?>
      <tr>
        <td><?= htmlspecialchars($row['race_name']) ?></td>
        <td><?= htmlspecialchars($row['track_name']) ?></td>
        <td><?= $row['race_date'] ?></td>
        <td class="upcoming">Upcoming</td>
      </tr>
      <?php endwhile; ?>

    </table>
  </div>

  <!-- COMPLETED RACES -->
  <h2 class="section-title">🏁 Completed Races</h2>

  <div class="card">
    <?php
    $completed = mysqli_query($conn, "
        SELECT r.id AS race_id, r.race_name, r.race_date, t.location AS track_name
        FROM races r
        JOIN tracks t ON r.track_id = t.id
        WHERE r.status = 'Completed'
        ORDER BY r.race_date DESC
    ");

    while($race = mysqli_fetch_assoc($completed)):
    ?>

    <h3>📍 <?= htmlspecialchars($race['track_name']) ?> — 🏁 <?= htmlspecialchars($race['race_name']) ?> (<?= $race['race_date'] ?>)</h3>

    <table>
      <tr>
        <th>Racer</th>
        <th>Car</th>
        <th>Position</th>
        <th>Time</th>
        <th>Points</th>
      </tr>

      <?php
      $res = mysqli_query($conn, "
          SELECT rr.*, ra.name AS racer_name, c.car_name
          FROM race_results rr
          JOIN racers ra ON rr.racer_id = ra.id
          JOIN cars c ON rr.car_id = c.id
          WHERE rr.race_id = {$race['race_id']}
          ORDER BY rr.position ASC
      ");

      while($row = mysqli_fetch_assoc($res)):
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
    <br>

    <?php endwhile; ?>
  </div>

</div>

<?php include 'footer.php'; ?>

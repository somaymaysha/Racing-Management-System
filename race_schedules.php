<?php
include 'db.php';
include 'header.php';

$query = "SELECT race_name, track_id, race_date, status
          FROM races
          ORDER BY race_date ASC";

$result = mysqli_query($conn, $query);
?>

<div class="schedule-wrapper">
  <div class="schedule-card">

    <h2>🏁 Race Schedules</h2>

    <table>
      <tr>
        <th>Race Name</th>
        <th>Track</th>
        <th>Date</th>
        <th>Status</th>
      </tr>

      <?php while($row = mysqli_fetch_assoc($result)): ?>
      <tr>
        <td><?= htmlspecialchars($row['race_name']) ?></td>
        <td><?= htmlspecialchars($row['track_id']) ?></td>
        <td><?= htmlspecialchars($row['race_date']) ?></td>
        <td class="<?= strtolower($row['status']) == 'upcoming' ? 'status-upcoming' : 'status-finished' ?>">
          <?= htmlspecialchars($row['status']) ?>
        </td>
      </tr>
      <?php endwhile; ?>

    </table>

    <button type="button" onclick="history.back()" class="btn-back">⬅ Back</button>

  </div>
</div>

<?php include 'footer.php'; ?>

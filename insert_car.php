<?php
include 'db.php';
include 'header.php';
$msg = '';

// Fetch racers for dropdown
$racers = mysqli_query($conn, "SELECT id, name FROM racers ORDER BY name");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $racer_id  = (int)$_POST['racer_id'];
    $car_name  = mysqli_real_escape_string($conn, $_POST['car_name']);
    $team      = mysqli_real_escape_string($conn, $_POST['team']);
    $top_speed = (int)$_POST['top_speed'];
    $engine_cc = (int)$_POST['engine_cc'];
    $color     = mysqli_real_escape_string($conn, $_POST['color']);

    $sql = "INSERT INTO cars (racer_id, car_name, team, top_speed, engine_cc, color)
            VALUES ($racer_id, '$car_name', '$team', $top_speed, $engine_cc, '$color')";

    if (mysqli_query($conn, $sql)) {
        $msg = '<div class="alert alert-success">✅ Car inserted successfully!</div>';
    } else {
        $msg = '<div class="alert alert-error">❌ Error: ' . mysqli_error($conn) . '</div>';
    }
}
?>

<div class="register-wrapper">
  <div class="register-card">

    <h2>🏎️ Insert New Car</h2>
    <p class="subtitle">Assign a car to a registered racer and fill in the specs.</p>

    <?= $msg ?>

    <form method="POST" novalidate>

      <p class="section-label">Racer Assignment</p>
      <div class="form-group">
        <label>Assign to Racer</label>
        <select name="racer_id" required>
          <option value=""></option>
          <?php
            mysqli_data_seek($racers, 0);
            while ($r = mysqli_fetch_assoc($racers)):
          ?>
            <option value="<?= $r['id'] ?>"><?= htmlspecialchars($r['name']) ?></option>
          <?php endwhile; ?>
        </select>
      </div>

      <p class="section-label">Car Details</p>

      <div class="form-row">
        <div class="form-group">
          <label>Car Name / Model</label>
          <input type="text" name="car_name" placeholder="e.g. Ferrari F40" required />
        </div>
        <div class="form-group">
          <label>Team</label>
          <input type="text" name="team" placeholder="e.g. Scuderia BD" />
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Top Speed (km/h)</label>
          <input type="number" name="top_speed" placeholder="e.g. 320" required />
        </div>
        <div class="form-group">
          <label>Engine (CC)</label>
          <input type="number" name="engine_cc" placeholder="e.g. 3500" />
        </div>
      </div>

      <div class="form-group">
        <label>Color</label>
        <input type="text" name="color" placeholder="e.g. Red" />
      </div>

      <hr class="form-divider">

      <div class="register-actions">
        <button type="submit" class="btn-submit">Insert Car</button>
        <button type="button" class="btn-back" onclick="history.back()">← Back</button>
        <a href="view.php" class="btn-link">View All Cars →</a>
      </div>

    </form>
  </div>
</div>

<?php include 'footer.php'; ?>

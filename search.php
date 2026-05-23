<?php
include 'db.php';
include 'header.php';

$result = null;

if (isset($_GET['search_id'])) {

    $id = (int)$_GET['search_id'];

    $sql = "SELECT racers.id,
                   racers.name,
                   racers.age,
                   racers.city,
                   racers.nationality,
                   racers.phone,
                   cars.car_name,
                   cars.team,
                   races.race_name,
                   race_results.position

            FROM racers

            JOIN cars
            ON racers.id = cars.racer_id

            LEFT JOIN race_results
            ON racers.id = race_results.racer_id

            LEFT JOIN races
            ON race_results.race_id = races.id

            WHERE racers.id = $id";

    $result = mysqli_query($conn, $sql);
}
?>

<div class="register-wrapper">
<div class="register-card">

  <h2>🔍 Search Racer</h2>

  <form method="GET">
    <div class="search-row">
      <input type="number" name="search_id" placeholder="Enter Racer ID">
      <button class="btn-search">Search</button>
    </div>
  </form>

  <?php if ($result && mysqli_num_rows($result) > 0): ?>

    <?php
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $r = $rows[0];
    ?>

    <div class="id-card">

      <div class="id-info">

        <div class="racer-id-badge">ID: #<?= $r['id'] ?></div>

        <div class="name-box"><?= htmlspecialchars($r['name']) ?></div>

        <div class="info-grid">
          <div class="info-box">
            <div class="label">Age</div>
            <div class="value"><?= $r['age'] ?></div>
          </div>
          <div class="info-box">
            <div class="label">City</div>
            <div class="value"><?= htmlspecialchars($r['city']) ?></div>
          </div>
          <div class="info-box">
            <div class="label">Nationality</div>
            <div class="value"><?= htmlspecialchars($r['nationality']) ?></div>
          </div>
          <div class="info-box">
            <div class="label">Phone</div>
            <div class="value"><?= htmlspecialchars($r['phone']) ?></div>
          </div>
          <div class="info-box">
            <div class="label">Car</div>
            <div class="value"><?= htmlspecialchars($r['car_name']) ?></div>
          </div>
          <div class="info-box">
            <div class="label">Team</div>
            <div class="value"><?= htmlspecialchars($r['team']) ?></div>
          </div>
        </div>

        <div class="track-section">
          <h3 class="track-title">🏁 Race Participation</h3>

          <?php foreach($rows as $race): ?>
            <?php if($race['race_name']): ?>
            <div class="track-box">
              <div>
                <div class="label">Race</div>
                <div class="value"><?= htmlspecialchars($race['race_name']) ?></div>
              </div>
              <div>
                <div class="label">Position</div>
                <div class="value">#<?= $race['position'] ?></div>
              </div>
            </div>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>

      </div>

      <div class="id-photo">
        <img src="default-user.jpg" alt="Racer Photo">
      </div>

    </div>

  <?php elseif(isset($_GET['search_id'])): ?>
    <div class="not-found">❌ No record found</div>
  <?php endif; ?>

  <button class="btn-back" onclick="history.back()">← Back</button>

</div>
</div>

<?php include 'footer.php'; ?>

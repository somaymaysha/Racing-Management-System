<?php
include 'db.php';

// ================= DELETE RACER =================
if (isset($_GET['delete_racer'])) {
    $id = (int)$_GET['delete_racer'];
    mysqli_query($conn, "DELETE FROM cars WHERE racer_id=$id");
    mysqli_query($conn, "DELETE FROM racers WHERE id=$id");
    header("Location: view.php?msg=racer_deleted");
    exit;
}

// ================= DELETE CAR =================
if (isset($_GET['delete_car'])) {
    $id = (int)$_GET['delete_car'];
    mysqli_query($conn, "DELETE FROM cars WHERE id=$id");
    header("Location: view.php?msg=car_deleted");
    exit;
}

include 'header.php';

// ================= FETCH DATA =================
$racers = mysqli_query($conn, "SELECT * FROM racers ORDER BY id");

$cars = mysqli_query($conn, "
    SELECT c.*, r.name AS racer_name
    FROM cars c
    LEFT JOIN racers r ON c.racer_id = r.id
    ORDER BY c.top_speed DESC
");
?>

<div class="view-wrapper">

<!-- ===== MESSAGE ===== -->
<?php if (isset($_GET['msg'])): ?>
<div class="alert alert-success">
<?php
if ($_GET['msg'] == 'racer_deleted') echo "✅ Racer deleted successfully.";
if ($_GET['msg'] == 'car_deleted')   echo "✅ Car deleted successfully.";
if ($_GET['msg'] == 'racer_updated') echo "✏️ Racer updated successfully.";
if ($_GET['msg'] == 'car_updated')   echo "✏️ Car updated successfully.";
?>
</div>
<?php endif; ?>

<!-- ================= RACERS ================= -->
<div class="view-card">
  <div class="view-card-header">
    <h2>👤 All Racers</h2>
    <span class="record-count"><?= mysqli_num_rows($racers) ?> Racers</span>
  </div>

  <?php if (mysqli_num_rows($racers) == 0): ?>
    <div class="empty-state"><span>🏁</span> No racers registered yet.</div>
  <?php else: ?>
    <div class="view-table-wrap">
      <table class="view-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Age</th>
            <th>City</th>
            <th>Nationality</th>
            <th>Phone</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while($r = mysqli_fetch_assoc($racers)): ?>
          <tr>
            <td><?= $r['id'] ?></td>
            <td><b><?= htmlspecialchars($r['name']) ?></b></td>
            <td><?= $r['age'] ?></td>
            <td><?= htmlspecialchars($r['city']) ?></td>
            <td><?= htmlspecialchars($r['nationality']) ?></td>
            <td><?= htmlspecialchars($r['phone']) ?></td>
            <td>
              <a href="edit_racer.php?id=<?= $r['id'] ?>" class="btn-update">✏️ Edit</a>
              <a href="view.php?delete_racer=<?= $r['id'] ?>"
                 class="btn-delete"
                 onclick="return confirm('Delete this racer and all cars?')">🗑 Delete</a>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>

  <div class="view-card-footer">
    <a href="register.php" class="btn-submit">+ Register Racer</a>
  </div>
</div>

<!-- ================= CARS ================= -->
<div class="view-card">
  <div class="view-card-header">
    <h2>🏎️ All Cars</h2>
    <span class="record-count"><?= mysqli_num_rows($cars) ?> Cars</span>
  </div>

  <?php if (mysqli_num_rows($cars) == 0): ?>
    <div class="empty-state"><span>🚗</span> No cars inserted yet.</div>
  <?php else: ?>
    <div class="view-table-wrap">
      <table class="view-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Racer</th>
            <th>Car Name</th>
            <th>Team</th>
            <th>Top Speed</th>
            <th>Engine</th>
            <th>Color</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while($c = mysqli_fetch_assoc($cars)): ?>
          <tr>
            <td><?= $c['id'] ?></td>
            <td><?= htmlspecialchars($c['racer_name']) ?></td>
            <td><b><?= htmlspecialchars($c['car_name']) ?></b></td>
            <td><?= htmlspecialchars($c['team']) ?></td>
            <td><?= $c['top_speed'] ?> km/h</td>
            <td><?= $c['engine_cc'] ?>cc</td>
            <td><?= htmlspecialchars($c['color']) ?></td>
            <td>
              <a href="edit_car.php?id=<?= $c['id'] ?>" class="btn-update">✏️ Edit</a>
              <a href="view.php?delete_car=<?= $c['id'] ?>"
                 class="btn-delete"
                 onclick="return confirm('Delete this car?')">🗑 Delete</a>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>

  <div class="view-card-footer">
    <a href="insert_car.php" class="btn-submit">+ Insert Car</a>
    <button onclick="history.back()" class="btn-back">← Back</button>
  </div>
</div>

</div>

<?php include 'footer.php'; ?>

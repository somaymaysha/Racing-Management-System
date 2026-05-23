<?php
include 'db.php';
include 'header.php';

$msg = '';

// Get racer ID from URL
$racer_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($racer_id <= 0) {
    echo '<p>❌ Invalid racer ID.</p>';
    include 'footer.php';
    exit;
}

// Fetch existing racer data
$racer_result = mysqli_query($conn, "SELECT * FROM racers WHERE id = $racer_id");
if (!$racer_result || mysqli_num_rows($racer_result) === 0) {
    echo '<p>❌ Racer not found.</p>';
    include 'footer.php';
    exit;
}
$racer = mysqli_fetch_assoc($racer_result);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name        = mysqli_real_escape_string($conn, $_POST['name']);
    $age         = (int)$_POST['age'];
    $city        = mysqli_real_escape_string($conn, $_POST['city']);
    $nationality = mysqli_real_escape_string($conn, $_POST['nationality']);
    $phone       = mysqli_real_escape_string($conn, $_POST['phone']);

    $sql = "UPDATE racers SET
                name        = '$name',
                age         = $age,
                city        = '$city',
                nationality = '$nationality',
                phone       = '$phone'
            WHERE id = $racer_id";

    if (mysqli_query($conn, $sql)) {
        header("Location: view.php?msg=racer_updated");
        exit;
    } else {
        $msg = '<div class="alert alert-error">❌ Error: ' . mysqli_error($conn) . '</div>';
        $racer_result = mysqli_query($conn, "SELECT * FROM racers WHERE id = $racer_id");
        $racer = mysqli_fetch_assoc($racer_result);
    }
}
?>

<div class="register-wrapper">
  <div class="register-card">

    <h2>✏️ Edit Racer</h2>
    <p class="subtitle">Update the racer's personal information and save your changes.</p>

    <div class="racer-id-badge">👤 Racer ID: #<?= $racer_id ?></div>

    <?= $msg ?>

    <form method="POST" novalidate>

      <p class="section-label">Personal Info</p>

      <div class="form-group">
        <label>Full Name</label>
        <input type="text" name="name"
               value="<?= htmlspecialchars($racer['name']) ?>"
               placeholder="e.g. Amir Hossain" required />
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Age</label>
          <input type="number" name="age"
                 value="<?= (int)$racer['age'] ?>"
                 placeholder="e.g. 28" required />
        </div>
        <div class="form-group">
          <label>Phone</label>
          <input type="text" name="phone"
                 value="<?= htmlspecialchars($racer['phone']) ?>"
                 placeholder="e.g. 01700000000" />
        </div>
      </div>

      <p class="section-label">Location</p>

      <div class="form-row">
        <div class="form-group">
          <label>City</label>
          <input type="text" name="city"
                 value="<?= htmlspecialchars($racer['city']) ?>"
                 placeholder="e.g. Dhaka" />
        </div>
        <div class="form-group">
          <label>Nationality</label>
          <input type="text" name="nationality"
                 value="<?= htmlspecialchars($racer['nationality']) ?>"
                 placeholder="e.g. Bangladeshi" />
        </div>
      </div>

      <hr class="form-divider">

      <div class="register-actions">
        <button type="submit" class="btn-submit">💾 Save Changes</button>
        <a href="view.php" class="btn-back">← Back</a>
        <a href="view.php" class="btn-link">View All Racers →</a>
      </div>

    </form>
  </div>
</div>

<?php include 'footer.php'; ?>

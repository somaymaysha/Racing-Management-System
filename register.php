<?php
include 'db.php';
include 'header.php';
$msg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name        = mysqli_real_escape_string($conn, $_POST['name']);
    $age         = (int)$_POST['age'];
    $city        = mysqli_real_escape_string($conn, $_POST['city']);
    $nationality = mysqli_real_escape_string($conn, $_POST['nationality']);
    $phone       = mysqli_real_escape_string($conn, $_POST['phone']);

    $sql = "INSERT INTO racers (name, age, city, nationality, phone)
            VALUES ('$name', $age, '$city', '$nationality', '$phone')";

    if (mysqli_query($conn, $sql)) {
        $msg = '<div class="alert alert-success">✅ Racer registered successfully!</div>';
    } else {
        $msg = '<div class="alert alert-error">❌ Error: ' . mysqli_error($conn) . '</div>';
    }
}
?>

<div class="register-wrapper">
  <div class="register-card">

    <h2>🏎️ Register New Racer</h2>
    <p class="subtitle">Fill in the details below to add a new racer to the system.</p>

    <?= $msg ?>

    <form method="POST" novalidate>

      <div class="form-group">
        <label>Full Name</label>
        <input type="text" name="name" placeholder="e.g. Lewis Hamilton" required />
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Age</label>
          <input type="number" name="age" placeholder="e.g. 28" min="16" max="80" required />
        </div>
        <div class="form-group">
          <label>City</label>
          <input type="text" name="city" placeholder="e.g. Dhaka" />
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Nationality</label>
          <input type="text" name="nationality" placeholder="e.g. Bangladeshi" />
        </div>
        <div class="form-group">
          <label>Phone</label>
          <input type="text" name="phone" placeholder="e.g. +880 1700 000000" />
        </div>
      </div>

      <hr class="form-divider">

      <div class="register-actions">
        <button type="submit" class="btn-submit">Register Racer</button>
        <button type="button" class="btn-back" onclick="history.back()">← Back</button>
        <a href="view.php" class="btn-link">View All Racers →</a>
      </div>

    </form>
  </div>
</div>

<?php include 'footer.php'; ?>

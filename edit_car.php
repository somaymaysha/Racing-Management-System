<?php
include 'db.php';

// Check ID
if (!isset($_GET['id'])) {
    die("No ID Found");
}

$id = (int)$_GET['id'];

// Fetch current data
$getData = mysqli_query($conn, "SELECT * FROM cars WHERE id=$id");

if (mysqli_num_rows($getData) == 0) {
    die("Car Not Found");
}

$row = mysqli_fetch_assoc($getData);

// Update data
if (isset($_POST['update'])) {
    $car_name  = mysqli_real_escape_string($conn, $_POST['car_name']);
    $team      = mysqli_real_escape_string($conn, $_POST['team']);
    $top_speed = mysqli_real_escape_string($conn, $_POST['top_speed']);
    $engine_cc = mysqli_real_escape_string($conn, $_POST['engine_cc']);
    $color     = mysqli_real_escape_string($conn, $_POST['color']);

    $query = "UPDATE cars SET
        car_name='$car_name',
        team='$team',
        top_speed='$top_speed',
        engine_cc='$engine_cc',
        color='$color'
        WHERE id=$id";

    $run = mysqli_query($conn, $query);

    if ($run) {
        header("Location: view.php?msg=car_updated");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

include 'header.php';
?>

<div class="register-wrapper">
  <div class="register-card">

    <h2>✏️ Edit Car</h2>

    <form method="POST">

      <div class="form-group">
        <label>Car Name</label>
        <input type="text" name="car_name"
               value="<?= htmlspecialchars($row['car_name']) ?>"
               placeholder="Car Name" required>
      </div>

      <div class="form-group">
        <label>Team</label>
        <input type="text" name="team"
               value="<?= htmlspecialchars($row['team']) ?>"
               placeholder="Team" required>
      </div>

      <div class="form-group">
        <label>Top Speed (km/h)</label>
        <input type="text" name="top_speed"
               value="<?= htmlspecialchars($row['top_speed']) ?>"
               placeholder="Top Speed" required>
      </div>

      <div class="form-group">
        <label>Engine CC</label>
        <input type="text" name="engine_cc"
               value="<?= htmlspecialchars($row['engine_cc']) ?>"
               placeholder="Engine CC" required>
      </div>

      <div class="form-group">
        <label>Color</label>
        <input type="text" name="color"
               value="<?= htmlspecialchars($row['color']) ?>"
               placeholder="Color" required>
      </div>

      <button type="submit" name="update" class="btn-submit">Update Car</button>

    </form>

    <a class="btn-back" href="view.php">← Back</a>

  </div>
</div>

<?php include 'footer.php'; ?>

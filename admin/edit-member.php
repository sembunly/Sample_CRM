<?php
include('includes/header.php');
include_once "../conn.php";

// Check if ID is set
if (!isset($_GET['id'])) {
    header("Location: ?tag=listmember");
    exit;
}

$id = intval($_GET['id']);
$query = mysqli_query($conn, "SELECT * FROM members WHERE id = $id");

if (mysqli_num_rows($query) == 0) {
    echo "<h4>No Such Member Found</h4>";
    exit;
}

$row = mysqli_fetch_assoc($query);

// Handle form submission
$msg = "";
if (isset($_POST['update'])) {
    $first = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last = mysqli_real_escape_string($conn, $_POST['last_name']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $join_date = mysqli_real_escape_string($conn, $_POST['join_date']);

    // Optional: Check duplicate phone/email except current member
    $checkPhone = mysqli_query($conn, "SELECT id FROM members WHERE phone='$phone' AND id != $id");
    $checkEmail = mysqli_query($conn, "SELECT id FROM members WHERE email='$email' AND id != $id");

    if (mysqli_num_rows($checkPhone) > 0) {
        $msg = "<div class='alert alert-danger'>Phone number already exists!</div>";
    } elseif (mysqli_num_rows($checkEmail) > 0) {
        $msg = "<div class='alert alert-danger'>Email already exists!</div>";
    } else {
        $update = mysqli_query($conn, "UPDATE members SET
            first_name='$first',
            last_name='$last',
            gender='$gender',
            dob='$dob',
            phone='$phone',
            email='$email',
            address='$address',
            join_date='$join_date'
            WHERE id=$id
        ");

        if ($update) {
            $msg = "<div class='alert alert-success'>Member updated successfully!</div>";
        } else {
            $msg = "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
        }
    }
}
?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Edit Member
                <a href="?tag=listmember" class="btn btn-danger float-end">Back</a>
            </h4>
        </div>

        <div class="card-body">
            <?php if($msg != "") echo $msg; ?>

            <form method="POST">
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label for="">First Name</label>
                        <input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars($row['first_name']); ?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Last Name</label>
                        <input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars($row['last_name']); ?>" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="">Gender</label>
                        <select name="gender" class="form-control" required>
                            <option value="Male" <?= $row['gender'] == 'Male' ? 'selected' : ''; ?>>Male</option>
                            <option value="Female" <?= $row['gender'] == 'Female' ? 'selected' : ''; ?>>Female</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="">Date of Birth</label>
                        <input type="date" name="dob" class="form-control" value="<?= $row['dob']; ?>" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="">Join Date</label>
                        <input type="date" name="join_date" class="form-control" value="<?= $row['join_date']; ?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Phone</label>
                        <input type="text" name="phone" class="form-control" value="<?= $row['phone']; ?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= $row['email']; ?>" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="">Address</label>
                        <textarea name="address" class="form-control" rows="3"><?= $row['address']; ?></textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <button type="submit" name="update" class="btn btn-primary">Update Member</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

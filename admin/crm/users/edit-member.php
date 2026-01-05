<?php
include_once "../conn.php";

if (!isset($_GET['id'])) {
    header("Location: ?tag=listmember");
    exit;
}

$id = intval($_GET['id']);
$query = mysqli_query($conn, "SELECT * FROM members WHERE id = $id");

if (mysqli_num_rows($query) == 0) {
    header("Location: ?tag=listmember");
    exit;
}

$row = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {
    $first = $_POST['first_name'];
    $last = $_POST['last_name'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $join_date = $_POST['join_date'];

    $update = mysqli_query($conn, "UPDATE members SET
        first_name='$first',
        last_name='$last',
        gender='$gender',
        dob='$dob',
        phone='$phone',
        email='$email',
        address='$address'
        WHERE id=$id
    ");

    if ($update) {
        echo "<script>alert('Member updated successfully!'); window.location='?tag=listmember';</script>";
        exit;
    } else {
        echo "<p style='color:red;'>Error: " . mysqli_error($conn) . "</p>";
    }
}
?>

<h2 style="color:#3785ea;">Edit Member</h2>

<hr>

<form method="post">
    <label>First Name</label>
    <input type="text" name="first_name" value="<?= $row['first_name'] ?>" required>

    <label>Last Name</label>
    <input type="text" name="last_name" value="<?= $row['last_name'] ?>" required>

    <label>Gender</label>
    <select name="gender" required>
        <option value="Male" <?= $row['gender'] == "Male" ? "selected" : "" ?>>Male</option>
        <option value="Female" <?= $row['gender'] == "Female" ? "selected" : "" ?>>Female</option>
        <option value="Other" <?= $row['gender'] == "Other" ? "selected" : "" ?>>Other</option>
    </select>

    <label>Date of Birth</label>
    <input type="date" name="dob" value="<?= $row['dob'] ?>">

    <label>Phone</label>
    <input type="text" name="phone" value="<?= $row['phone'] ?>">

    <label>Email</label>
    <input type="email" name="email" value="<?= $row['email'] ?>">

    <label>Address</label>
    <input type="text" name="address" value="<?= $row['address'] ?>">

    <button type="submit" name="update">Update</button>
    <a href="?tag=listmember">Cancel</a>
</form>

<style>
    form{width:100%; display:flex; flex-direction:column; gap:10px; margin-top:20px;}

    input,select{padding:8px; border:1px solid #6392f7ff; border-radius:4px;}

    button{padding:10px; background:#6392f7ff; color:#fff; border:none; border-radius:4px; cursor:pointer;}

    button:hover{background:#5796bdff;}

    a{padding:10px; background:#777; color:#fff; text-decoration:none; border-radius:4px; text-align:center;}

    a:hover{background:#555;}
</style>

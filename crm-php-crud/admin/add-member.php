<?php
include('includes/header.php');
include_once "../conn.php";

$msg = "";

// Handle form submission
if (isset($_POST['btnCreate'])) {
    $first = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last = mysqli_real_escape_string($conn, $_POST['last_name']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $join_date = mysqli_real_escape_string($conn, $_POST['join_date']);

    // Check for duplicates
    $checkPhone = mysqli_query($conn, "SELECT id FROM members WHERE phone='$phone'");
    $checkEmail = mysqli_query($conn, "SELECT id FROM members WHERE email='$email'");

    if (mysqli_num_rows($checkPhone) > 0) {
        $msg = "<div class='alert alert-danger'>Phone number already exists!</div>";
    } elseif (mysqli_num_rows($checkEmail) > 0) {
        $msg = "<div class='alert alert-danger'>Email already exists!</div>";
    } else {
        // Insert member
        $sql = "INSERT INTO members 
            (first_name, last_name, gender, dob, phone, email, address, join_date)
            VALUES ('$first', '$last', '$gender', '$dob', '$phone', '$email', '$address', '$join_date')";
        
        $exec = mysqli_query($conn, $sql);

        if ($exec) {
            $msg = "<div class='alert alert-success'>Member added successfully!</div>";
        } else {
            $msg = "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
        }
    }
}
?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Add Member
                <a href="members.php" class="btn btn-primary float-end">Back</a>
            </h4>
        </div>

        <div class="card-body">
            <?php if($msg != "") echo $msg; ?>

            <form action="" method="POST">
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label for="">First Name</label>
                        <input type="text" name="first_name" required class="form-control" />
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Last Name</label>
                        <input type="text" name="last_name" required class="form-control" />
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="">Gender</label>
                        <select name="gender" required class="form-control">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="">Date of Birth</label>
                        <input type="date" name="dob" required class="form-control" />
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="">Join Date</label>
                        <input type="date" name="join_date" required class="form-control" />
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Phone</label>
                        <input type="text" name="phone" required class="form-control" />
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Email</label>
                        <input type="email" name="email" required class="form-control" />
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="">Address</label>
                        <textarea name="address" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <button type="submit" name="btnCreate" class="btn btn-primary">Add Member</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

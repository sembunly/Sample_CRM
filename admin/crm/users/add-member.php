<?php
include_once "../conn.php";

if (isset($_POST['btnCreate'])) {
    $first = $_POST['first_name'];
    $last = $_POST['last_name'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $join_date = $_POST['join_date'];

    $checkPhone = mysqli_query($conn, "SELECT id FROM members WHERE phone='$phone'");
    
    $checkEmail = mysqli_query($conn, "SELECT id FROM members WHERE email='$email'");

    if (mysqli_num_rows($checkPhone) > 0) {
        echo "<p class='error'>Phone number already exists!</p>";
    }

    if (mysqli_num_rows($checkEmail) > 0) {
        echo "<p class='error'>Email already exists!</p>";
    }

    if (mysqli_num_rows($checkPhone) == 0 && mysqli_num_rows($checkEmail) == 0) {

        $sql = "INSERT INTO members (first_name, last_name, gender, dob, phone, email, address, join_date)
                VALUES ('$first', '$last', '$gender', '$dob', '$phone', '$email', '$address', '$join_date')";
        
        $exec = mysqli_query($conn, $sql);

        echo $exec 
            ? "<p class='success'>Member added successfully!</p>"
            : "<p class='error'>Error: " . mysqli_error($conn) . "</p>";
    }
}
?>


<h2 style="color:#3785ea;">Add Member</h2>

<hr>

<form method="post">
    <label>First Name</label>
    <input type="text" name="first_name" placeholder="First Name" required>

    <label>Last Name</label>
    <input type="text" name="last_name" placeholder="Last Name" required>

    <label>Gender</label>
    <select name="gender" required>
        <option value="">Select Gender</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
    </select>

    <label>Date of Birth</label>
    <input type="date" name="dob" required>

    <label>Phone</label>
    <input type="text" name="phone" placeholder="Phone">

    <label>Email</label>
    <input type="email" name="email" placeholder="Email" required>

    <label>Address</label>
    <textarea name="address" placeholder="Address"></textarea>

    <label>Join Date</label>
    <input type="date" name="join_date" value="<?= date('Y-m-d') ?>">

    <button type="submit" name="btnCreate">Save</button>
    <a href="?tag=listmember">Cancel</a>
</form>
<style>
form {
    width: 100%;
    max-width: 100%;
    display: flex;
    flex-direction: column;
    gap: 15px;
    margin: 15px auto;
    padding: 20px;
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
}

input, textarea, select {
    width: 100%;
    padding: 12px 14px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 15px;
    transition: border 0.3s, box-shadow 0.3s;
}

input:focus, textarea:focus, select:focus {
    border-color: #3498db;
    box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
    outline: none;
}

textarea {
    resize: vertical;
    min-height: 80px;
}

button {
    padding: 12px;
    background: #3498db;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s, transform 0.2s;
}

button:hover {
    background: #2980b9;
    transform: translateY(-2px);
}

a {
    padding: 12px;
    background: #777;
    color: #fff;
    text-decoration: none;
    border-radius: 8px;
    text-align: center;
    display: inline-block;
    transition: background 0.3s;
}

a:hover {
    background: #555;
}

.success, .error {
    padding: 12px;
    border-radius: 8px;
    font-weight: 600;
    margin-top: 10px;
    font-size: 14px;
}

.success {
    background: #d4edda;
    border: 1px solid #c3e6cb;
    color: #155724;
}

.error {
    background: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
}

@media (max-width: 450px) {
    form {
        padding: 20px;
        gap: 12px;
    }
    button, a {
        font-size: 14px;
        padding: 10px;
    }
}
</style>
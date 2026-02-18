<?php
include('includes/header.php');
include_once "../conn.php";

$search = "";

if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $sql = mysqli_query($conn, "
        SELECT * FROM members
        WHERE first_name LIKE '%$search%'
        OR last_name LIKE '%$search%'
        OR phone LIKE '%$search%'
        OR email LIKE '%$search%'
        ORDER BY id ASC
    ");
} else {
    $sql = mysqli_query($conn, "SELECT * FROM members ORDER BY id ASC");
}
?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Members List</h4>
        </div>

        <div class="card-body">

            <form method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control"
                           placeholder="Search name, phone, email..."
                           value="<?= htmlspecialchars($search); ?>">
                    <button class="btn btn-primary" type="submit">Search</button>
                    <a href="list-members.php" class="btn btn-secondary">Clear</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Gender</th>
                            <th>DOB</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Join Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php if (mysqli_num_rows($sql) > 0): ?>
                        <?php while ($rw = mysqli_fetch_assoc($sql)): ?>
                            <tr>
                                <td><?= $rw['first_name']; ?></td>
                                <td><?= $rw['last_name']; ?></td>
                                <td><?= $rw['gender']; ?></td>
                                <td><?= $rw['dob']; ?></td>
                                <td><?= $rw['phone']; ?></td>
                                <td><?= $rw['email']; ?></td>
                                <td><?= $rw['address']; ?></td>
                                <td><?= $rw['join_date']; ?></td>
                                <td>
                                    <a class="btn btn-primary btn-sm"
                                       href="edit-member.php?id=<?= $rw['id']; ?>">
                                        Edit
                                    </a>

                                    <a class="btn btn-danger btn-sm"
                                       href="delete-member.php?id=<?= $rw['id']; ?>"
                                       onclick="return confirm('Are you sure you want to delete this member?')">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center">No members found</td>
                        </tr>
                    <?php endif; ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

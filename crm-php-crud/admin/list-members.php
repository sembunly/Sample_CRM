<?php
include('includes/header.php');
include_once "../conn.php";

$sql = mysqli_query($conn, "SELECT * FROM members ORDER BY id ASC");
?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Members List</h4>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <!--<th>No.</th>-->
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
                                <!--<td><?= $i++ ?></td>-->
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

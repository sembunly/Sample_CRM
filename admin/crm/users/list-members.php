<?php
include_once "../conn.php";

$search = "";

if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $sql = mysqli_query($conn, "SELECT * FROM members
        WHERE first_name LIKE '%$search%'
        OR last_name LIKE '%$search%'
        OR phone LIKE '%$search%'
        ORDER BY id ASC");
} else {
    $sql = mysqli_query($conn, "SELECT * FROM members ORDER BY id ASC");
}
$total_members = mysqli_num_rows($sql);
$i = 1;
?>

<h2 style="margin-bottom:20px;">Members : <?= $total_members ?></h2>

<div class="search-container">
    <form method="get">
        <input type="hidden" name="tag" value="listmember">

        <input 
            type="text"
            name="search"
            value="<?= htmlspecialchars($search) ?>"
            placeholder="Search by first name, last name or phone number"
            class="search-input"
        >

        <button type="submit" class="btn">Search</button>

        <?php if ($search): ?>
            <a href="?tag=listmember" class="btn secondary">See All</a>
        <?php endif; ?>

        <a href="http://localhost/include%26require/admin/crm/users/export-excel.php" class="btn link">
            <img src="https://upload.wikimedia.org/wikipedia/commons/6/60/Microsoft_Office_Excel_%282025%E2%80%93present%29.svg" 
            alt="Excel Logo" style="height: 25px; vertical-align: middle; margin-right: 5px;">
            Export Excel</a>
    </form>
</div>
<hr>

<table>
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

    <?php if (mysqli_num_rows($sql) > 0): ?>
        <?php while ($rw = mysqli_fetch_assoc($sql)): ?>
            <tr>
                <!--<td><?= $i++ ?></td>-->
                <td><?= $rw['first_name'] ?></td>
                <td><?= $rw['last_name'] ?></td>
                <td><?= $rw['gender'] ?></td>
                <td><?= $rw['dob'] ?></td>
                <td><?= $rw['phone'] ?></td>
                <td><?= $rw['email'] ?></td>
                <td><?= $rw['address'] ?></td>
                <td><?= $rw['join_date'] ?></td>
                <td>
                    <a class="action-btn" href="?tag=editmember&id=<?= $rw['id'] ?>">Edit</a>
                    <a class="action-btn delete-btn"
                        href="?tag=deletemember&id=<?= $rw['id'] ?>"
                        onclick="return confirm('Are you sure you want to delete this member?')">
                        Delete
                    </a>

                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="10" style="text-align:center;">No members found</td>
        </tr>
    <?php endif; ?>
</table>

<style>
.search-container {
    width: 100%;
    display: flex;
    margin-bottom: 15px;
}

.search-container form {
    display: flex;
    gap: 8px;
}

.search-input {
    padding: 6px 10px;
    width: 300px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 12px;
}

.btn {
    padding: 6px 12px;
    background: #4fc926ff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    text-decoration: none;
    font-weight: bold;
    font-size: 12px;
}

.btn:hover { background: #08c314ff; }
.secondary { background: #555; }
.link { background: #08c314ff; }

table { 
    width: 100%; 
    border-collapse: collapse; 
    margin-top: 10px; 
    background: #fff; 
    box-shadow: 0 2px 10px rgba(0,0,0,0.1); 
    font-size: 12px;
}

th, td { 
    border: 1px solid #ddd; 
    padding: 7px 20px; 
}

th {
    background: #257ee3ff; 
    color: #fff; 
    font-size: 15px;
}

tr:nth-child(even) { background: #f7f7f7; }
tr:hover { background: #c8c5c5ff; }

.action-btn {
    padding: 4px 10px;
    background: #257ee3ff;
    color: #fff;
    border-radius: 3px;
    text-decoration: none;
    margin-right: 3px;
    font-size: 9px;
}

.action-btn:hover { background: #5796bdff; }

.delete-btn { background: #d32f2f; }
.delete-btn:hover { background: #b71c1c; }
</style>

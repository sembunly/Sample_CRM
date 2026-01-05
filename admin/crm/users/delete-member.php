<?php
include_once "../conn.php";

if (!isset($_GET['id'])) {
    header("Location: ?tag=listmember");
    exit;
}

$id = intval($_GET['id']);

$delete = mysqli_query($conn, "DELETE FROM members WHERE id = $id");

if ($delete) {
    echo "<script>window.location='?tag=listmember';</script>";
} else {
    echo "<script>alert('Error deleting member: " . mysqli_error($conn) . "'); window.location='?tag=listmember';</script>";
}


exit;
?>

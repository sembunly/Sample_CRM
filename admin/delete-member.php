<?php
include_once "../conn.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); 
    $sql = "DELETE FROM members WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        header("Location: list-members.php"); 
        exit;
    } else {
        echo "Error deleting member: " . mysqli_error($conn);
    }
} else {
    header("Location: list-members.php");
    exit;
}
?>

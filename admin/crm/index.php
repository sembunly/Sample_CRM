<?php
session_start();
$msg = "";
$tag = "";
if (isset($_GET['tag'])) $tag = $_GET['tag'];

if ($tag == 'logout') {
    session_destroy();
    header("Location: ../");
    exit();
}

if (!isset($_SESSION['login'])) {
    header("Location: ../");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CRM</title>
</head>
<body>

<div class="menu">
    <img src="https://img.freepik.com/premium-vector/crm-logo-crm-letter-crm-letter-logo-design-initials-crm-logo-linked-with-circle-uppercase-monogram-logo-crm-typography-technology-business-real-estate-brand_229120-63701.jpg" 
         alt="CRM Logo" 
         class="logo">

    <a href="?tag=listmember">List Member</a>
    <a href="?tag=addmember">Create Member</a>
    <!--<a href="?tag=deletemember">Delete Member</a>-->
    <!--<a href="?tag=editmember">Edit Member</a>-->
    <a href="?tag=logout" class="logout">Logout</a>
</div>

<div class="main">
    <h1>CRM: Customer Relationship Management</h1>

        <?php if (isset($_SESSION['username'])): ?>
            <div class="user-info">
                <?= date("l, F j, Y"); ?>  -  Logged in as: <?= $_SESSION['username'] ?>
            </div>
        <?php endif; ?>

    <hr>

    <?php
        if ($tag == 'addmember') {
            include("users/add-member.php");
        } elseif ($tag == "listmember") {
            include("users/list-members.php");
        } elseif ($tag == "editmember") {
            include("users/edit-member.php");
        } elseif ($tag == "deletemember") {
            include("users/delete-member.php");
        }
    ?>
</div>
</body>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    height: 100vh;
    display: flex;
    overflow: hidden;
    background: #f3f5f9;
}

.menu {
    width: 230px;
    background: #030101ff;
    padding: 25px 15px;
    display: flex;
    flex-direction: column;
    align-items: center;
    border-right: 3px solid #222;
}

.menu img.logo {
    width: 130px;
    margin-bottom: 25px;
    border-radius: 8px;
}

.menu a {
    width: 100%;
    text-align: center;
    padding: 12px 0;
    margin-bottom: 5px;
    background: #030101ff;
    color: white;
    border-radius: 2px;
    text-decoration: none;
    transition: 0.2s;
}

.menu a:hover {
    background: #3785eaff;
}

.menu a.logout {
    background: #cf3636ff;
    margin-top: auto;
}

.main {
    flex: 1;
    padding: 25px;
    overflow-y: auto;
    background: #ffffff;
}

h1 {
    color: #222;
}

hr {
    border: 0;
    height: 1px;
    background: #ddd;
    margin: 15px 0 25px;
}

.msg {
    margin-top: 15px;
    padding: 10px;
    background: #e9f9ee;
    color: #1e824c;
    border-left: 4px solid #27ae60;
    display: inline-block; 
}
.user-info {
    right: 15px;
    text-align: right;
    font-size: 18px;
    color: #1c46d1ff;
}
.user-info span {
    display: block;
    margin-bottom: 3px;
}

</style>
</html>

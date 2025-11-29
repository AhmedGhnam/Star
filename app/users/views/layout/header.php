<?php

    require_once __DIR__ . '/../../../helpers/Session.php';

    use App\helpers\Session;
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'User Management' ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        header { margin-bottom: 20px; display: flex; align-items: center; justify-content: space-between;  }
        a { text-decoration: none; color: blue;padding: 5px; }
        a:hover { text-decoration: underline; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        header .controls .name {font-weight: bold; margin-left: auto;}
    </style>
</head>
<body>

<header>
    <div class="links">
        <a href="/star/users">Home</a> |
        <a href="/star/users/create">Create</a> |
        <a href="/star/dashboard">Dashboard</a>
    </div>
    <div class="controls">
        <?php if(!isset($_SESSION['user'])): ?>
            <a href="/star/login">LogIn</a>
        <?php else: ?>
            <a href="/star/logout">LogOut</a>
        <?php endif; ?>
        <?php if(isset($_SESSION['user'])): ?>
            <a href="/star/users/profile/<?= $_SESSION['user']->id ?? '' ?>" class="name">Hello <?= $_SESSION['user']->userName; ?></a>
        <?php endif; ?>
    </div>
</header>
<hr>


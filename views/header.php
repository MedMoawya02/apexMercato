<?php
session_start();
$role = $_SESSION['role'] ?? 'visitor';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Apex Management</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/market.php">
            <i class="bi bi-controller"></i> Apex Management
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto">

                <!-- ADMIN -->
                <?php if ($role === 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="adminDashboard.php">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="formAddPerson.php">
                            <i class="bi bi-person-lines-fill"></i> Roster
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/teams.php">
                            <i class="bi bi-building"></i> Équipes
                        </a>
                    </li>
                <?php endif; ?>
                <!-- COMMUN -->
                <li class="nav-item">
                    <a class="nav-link" href="membres.php"><i class="bi bi-people"></i> Marché</a>
                </li>


                <!-- JOURNALISTE -->
                <?php if ($role === 'journalist'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/journalist/dashboard.php">
                            <i class="bi bi-bar-chart"></i> Analyses
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/journalist/news.php">
                            <i class="bi bi-newspaper"></i> News privées
                        </a>
                    </li>
                <?php endif; ?>

                <!-- AUTH -->
                <?php if ($role === 'visitor'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/login.php">
                            <i class="bi bi-box-arrow-in-right"></i> Connexion
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="#">
                            <i class="bi bi-box-arrow-right"></i> Déconnexion
                        </a>
                    </li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>

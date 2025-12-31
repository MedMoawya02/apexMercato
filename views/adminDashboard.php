<?php

include 'header.php';
if ($_SESSION['role'] !== 'admin') {
    header('Location:views/login.php');
    exit;
}
?>

<div class="container mt-4">
    <h3><i class="bi bi-speedometer2"></i> Dashboard Administrateur</h3>

    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-bg-primary">
                <div class="card-body">
                    <h5><i class="bi bi-people"></i> Joueurs</h5>
                    <p class="fs-3">48</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-bg-success">
                <div class="card-body">
                    <h5><i class="bi bi-building"></i> Équipes</h5>
                    <p class="fs-3">12</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-bg-warning">
                <div class="card-body">
                    <h5><i class="bi bi-cash-coin"></i> Budget Total</h5>
                    <p class="fs-3">€2.4M</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-bg-danger">
                <div class="card-body">
                    <h5><i class="bi bi-arrow-left-right"></i> Transferts</h5>
                    <p class="fs-3">9</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

include 'header.php';
if ($_SESSION['role'] !== 'journaliste') {
    header('Location:views/login.php');
    exit;
}
?>

<div class="container mt-4">
    <h3><i class="bi bi-bar-chart"></i> Dashboard Journaliste</h3>

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">
                <i class="bi bi-graph-up"></i> Coûts annuels (comparaison)
            </h5>

            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Rôle</th>
                        <th>Salaire annuel</th>
                        <th>Clause</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Neo</td>
                        <td>Player</td>
                        <td>€120,000</td>
                        <td>€300,000</td>
                    </tr>
                    <tr>
                        <td>CoachX</td>
                        <td>Coach</td>
                        <td>€90,000</td>
                        <td>—</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
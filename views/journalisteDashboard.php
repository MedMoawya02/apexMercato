<?php

include 'header.php';
if ($_SESSION['role'] !== 'journaliste') {
    header('Location:views/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="row g-4 mt-4">
    <div class="col-lg-8">
        <div class="card card-custom shadow-sm border-0 bg-white">
            <div class="card-header bg-transparent border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0 text-dark">
                    <i class="bi bi-bar-chart-line me-2 text-primary"></i>Analyse des Coûts Annuels
                </h5>
                <button class="btn btn-light btn-sm rounded-pill text-success fw-bold">
                    <i class="bi bi-file-earmark-excel me-1"></i> Export
                </button>
            </div>
            <div class="card-body px-4 pb-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr class="small text-muted text-uppercase">
                                <th>Nom du Membre</th>
                                <th>Rôle</th>
                                <th>Salaire Annuel</th>
                                <th>Clause</th>
                                <th>Tendance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-2 bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 32px; height: 32px; font-size: 11px;">NE</div>
                                        <span class="fw-semibold">Neo Matrix</span>
                                    </div>
                                </td>
                                <td><span class="badge bg-secondary-subtle text-secondary rounded-pill">Player</span></td>
                                <td class="fw-bold text-dark">€120,000</td>
                                <td>€300,000</td>
                                <td><i class="bi bi-graph-up text-danger"></i></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-2 bg-dark-subtle text-dark rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 32px; height: 32px; font-size: 11px;">CX</div>
                                        <span class="fw-semibold">Coach X</span>
                                    </div>
                                </td>
                                <td><span class="badge bg-dark-subtle text-dark rounded-circle px-3">Coach</span></td>
                                <td class="fw-bold text-dark">€90,000</td>
                                <td class="text-muted small">—</td>
                                <td><i class="bi bi-graph-down text-success"></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card card-custom shadow-sm border-0 bg-white h-100">
            <div class="card-header bg-transparent border-0 pt-4 px-4">
                <h5 class="fw-bold mb-0">Ressources & Accès</h5>
            </div>
            <div class="card-body px-4">
                <div class="d-grid gap-3">
                    <button class="btn btn-outline-primary py-3 border-dashed d-flex align-items-center justify-content-center">
                        <i class="bi bi-newspaper me-2"></i> Rédiger un Article
                    </button>
                    <button class="btn btn-outline-info py-3 border-dashed d-flex align-items-center justify-content-center text-dark">
                        <i class="bi bi-search me-2"></i> Base de données Joueurs
                    </button>
                    <button class="btn btn-outline-secondary py-3 border-dashed d-flex align-items-center justify-content-center">
                        <i class="bi bi-archive me-2"></i> Archives Transferts
                    </button>
                </div>

                <div class="mt-4 p-3 bg-light rounded-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="small text-muted">Masse Salariale Occupée</span>
                        <span class="small fw-bold">62%</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="small text-muted mt-2 mb-0" style="font-size: 10px;">
                        <i class="bi bi-info-circle me-1"></i> Basé sur le budget prévisionnel 2026.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!--  -->
    <div class="row mt-4">
    <div class="col-12">
        <div class="card card-custom shadow-sm border-0 bg-white">
            <div class="card-header bg-transparent border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0">
                    <i class="bi bi-arrow-left-right text-danger me-2"></i>Historique des Transferts Récents
                </h5>
                <span class="badge bg-light text-dark border">Total: 9 Transferts</span>
            </div>
            <div class="card-body px-4 pb-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr class="small text-muted text-uppercase">
                                <th>Joueur</th>
                                <th>Ancienne Équipe</th>
                                <th>Nouvelle Équipe</th>
                                <th>Montant du Transfert</th>
                                <th>Date de Signature</th>
                                <th>Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-2 bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 32px; height: 32px; font-size: 11px;">JD</div>
                                        <span class="fw-semibold">John Doe</span>
                                    </div>
                                </td>
                                <td><span class="text-muted">Équipe A</span></td>
                                <td><span class="fw-bold text-primary">Équipe B</span></td>
                                <td><span class="badge bg-dark text-white">€2.5M</span></td>
                                <td class="small">12 Jan 2026</td>
                                <td><span class="badge bg-info-subtle text-info">Définitif</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-2 bg-warning-subtle text-warning rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 32px; height: 32px; font-size: 11px;">AS</div>
                                        <span class="fw-semibold">Alex Smith</span>
                                    </div>
                                </td>
                                <td><span class="text-muted">Équipe C</span></td>
                                <td><span class="fw-bold text-primary">Équipe A</span></td>
                                <td><span class="badge bg-dark text-white">€1.2M</span></td>
                                <td class="small">05 Jan 2026</td>
                                <td><span class="badge bg-secondary-subtle text-secondary">Prêt</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>
<!-- <div class="container mt-4">
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
</div> -->
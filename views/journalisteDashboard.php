<?php
require_once "../classes/contrat.php";
require_once "../classes/transfert.php";
require_once "../classes/financialEngine.php";
include 'header.php';
if ($_SESSION['role'] !== 'journaliste') {
    header('Location:views/login.php');
    exit;
}
$contrat = new Contrat();
$rows = $contrat->getData();
//
$limit = 6;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$page = max($page, 1);
$offset = ($page - 1) * $limit;
$transfert = new Transfert();
$transferts = $transfert->allTransferts($limit, $offset);
$totalTransferts = $transfert->countTransferts();
$totalPages = ceil($totalTransferts / $limit);
$nbrTransfert = $transfert->nbrTransfertFinis();
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
                <div
                    class="card-header bg-transparent border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
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
                                <?php if (!empty($rows)): ?>
                                    <?php foreach ($rows as $row): ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm me-2 bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold"
                                                        style="width: 32px; height: 32px; font-size: 11px;">
                                                        <?= strtoupper(substr($row['nomJoueur'], 0, 2)) ?>
                                                    </div>
                                                    <span class="fw-semibold"><?= htmlspecialchars($row['nomJoueur']) ?></span>
                                                </div>
                                            </td>

                                            <td>
                                                <span class="badge 
                    <?= $row['type'] === 'Joueur'
                        ? 'bg-secondary-subtle text-secondary'
                        : 'bg-dark-subtle text-dark' ?>">
                                                    <?= $row['type'] ?>
                                                </span>
                                            </td>

                                            <td class="fw-bold text-dark">
                                                €<?= FinancialEngine::getSalAnn($row['salaire']) ?>
                                            </td>

                                            <td>
                                                <?= '€' . number_format(300000, 0, ',', ' ') ?>
                                            </td>

                                            <td>
                                                <i class="bi bi-graph-up text-danger"></i>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">
                                            Aucun contrat trouvé
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>

                        </table>
                    </div>

                    <!-- pagination start -->
                    <div class="d-flex justify-content-between align-items-center mt-3">

                        <!-- <div class="small text-muted">
                                Affichage de <?= $start ?> à <?= $end ?> sur <?= $totalTransferts ?> transferts
                            </div> -->

                        <?php if ($totalPages > 1): ?>
                            <div class="d-flex justify-content-between align-items-center mt-4">

                                <!-- <div class="small text-muted">
                                    Affichage de <?= ($offset + 1) ?>
                                    à <?= min($offset + $limit, $totalTransferts) ?>
                                    sur <?= $totalTransferts ?> transferts
                                </div> -->

                                <nav>
                                    <ul class="pagination pagination-sm mb-0">

                                        <!-- Précédent -->
                                        <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                            <a class="page-link" href="?page=<?= $page - 1 ?>">Précédent</a>
                                        </li>

                                        <!-- Pages -->
                                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                            <li class="page-item <?= ($i === $page) ? 'active' : '' ?>">
                                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                            </li>
                                        <?php endfor; ?>

                                        <!-- Suivant -->
                                        <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                                            <a class="page-link" href="?page=<?= $page + 1 ?>">Suivant</a>
                                        </li>

                                    </ul>
                                </nav>

                            </div>
                        <?php endif; ?>


                    </div>
                    <!-- pagination end -->

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
                        <button
                            class="btn btn-outline-primary py-3 border-dashed d-flex align-items-center justify-content-center">
                            <i class="bi bi-newspaper me-2"></i> Rédiger un Article
                        </button>
                        <button
                            class="btn btn-outline-info py-3 border-dashed d-flex align-items-center justify-content-center text-dark">
                            <i class="bi bi-search me-2"></i> Base de données Joueurs
                        </button>
                        <button
                            class="btn btn-outline-secondary py-3 border-dashed d-flex align-items-center justify-content-center">
                            <i class="bi bi-archive me-2"></i> Archives Transferts
                        </button>
                    </div>

                    <div class="mt-4 p-3 bg-light rounded-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="small text-muted">Masse Salariale Occupée</span>
                            <span class="small fw-bold">62%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 62%" aria-valuenow="62"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="small text-muted mt-2 mb-0" style="font-size: 10px;">
                            <i class="bi bi-info-circle me-1"></i> Basé sur le budget prévisionnel 2026.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
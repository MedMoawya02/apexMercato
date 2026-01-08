<?php
require_once "../classes/contrat.php";
require_once "../classes/transfert.php";
require_once "../classes/financialEngine.php";
include 'header.php';
if ($_SESSION['role'] !== 'journaliste') {
    header('Location:views/login.php');
    exit;
}
$transfert = new Transfert();
$transferts = $transfert->allTransferts();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container mt-4">
        <h4 class="fw-bold mb-4">Derniers Transferts</h4>

        <?php if (!empty($transferts)): ?>
            <div class="row g-4">
                <?php foreach ($transferts as $t): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body">
                                <!-- Header avec avatar -->
                                <div class="d-flex align-items-center mb-2">
                                    <?php
                                    $initials = strtoupper(substr($t['nomJ'] ?? $t['nomC'], 0, 2));
                                    ?>
                                    <div class="avatar-sm me-2 bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold"
                                        style="width:36px;height:36px;font-size:12px;">
                                        <?= $initials ?>
                                    </div>
                                    <h6 class="mb-0 fw-bold"><?= htmlspecialchars($t['nomJ'] ?? $t['nomC']) ?></h6>
                                </div>

                                <!-- Équipes -->
                                <p class="mb-1 text-muted small">
                                    De <strong><?= htmlspecialchars($t['equipeDepart'] ?? '-') ?></strong>
                                    → <strong class="text-primary"><?= htmlspecialchars($t['equipeArrive'] ?? '-') ?></strong>
                                </p>

                                <!-- Montant du transfert -->
                                <p class="mb-1">
                                    <span class="badge bg-dark text-white">€<?= number_format($t['montant'] ?? 0, 2) ?></span>
                                </p>

                                <!-- Date de signature -->
                                <p class="small text-muted mb-1">
                                    <i class="bi bi-calendar-event me-1"></i>
                                    <?= isset($t['dateTransfert']) ? date('d M Y', strtotime($t['dateTransfert'])) : date('d M Y') ?>
                                </p>

                                <!-- Statut -->
                                <?php
                                $badgeClass = match (strtolower($t['statut'] ?? '')) {
                                    'valide' => 'bg-success-subtle text-success',
                                    'en_attente' => 'bg-warning-subtle text-warning',
                                    'annule' => 'bg-danger-subtle text-danger',
                                    default => 'bg-info-subtle text-info'
                                };
                                ?>
                                <span class="badge <?= $badgeClass ?>"><?= ucfirst($t['statut'] ?? '-') ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-center text-muted mt-4">Aucun transfert récent</p>
        <?php endif; ?>
    </div>

    <!-- Bootstrap Icons si pas déjà inclus -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</body>


</html>
<?php
require_once "../classes/joueur.php";
require_once "../classes/team.php";
require_once "../classes/transfert.php";
require_once "../classes/Formater.php";
include 'header.php';
if ($_SESSION['role'] !== 'admin') {
    header('Location:views/login.php');
    exit;
}
//
$transfert = new Transfert();
$limit = 6;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$page = max($page, 1);
$offset = ($page - 1) * $limit;
$transferts = $transfert->allTransfertsPaginated($limit, $offset);
$totalTransferts = $transfert->countTransferts();
$totalPages = ceil($totalTransferts / $limit);
$nbrTransfert = $transfert->nbrTransfertFinis();
//
$joueur = new Joueur();
$joueursActifs = $joueur->joueursActifs();
$team = new Team();
$nbrEquipes = $team->nbrEquipes();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    :root {
        --primary-gradient: linear-gradient(45deg, #4e73df 0%, #224abe 100%);
        --success-gradient: linear-gradient(45deg, #1cc88a 0%, #13855c 100%);
        --info-gradient: linear-gradient(45deg, #36b9cc 0%, #258391 100%);
        --warning-gradient: linear-gradient(45deg, #f6c23e 0%, #dda20a 100%);
    }

    .card-custom {
        border: none;
        border-radius: 15px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
    }

    .card-custom:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12);
    }

    .icon-shape {
        width: 48px;
        height: 48px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .stat-label {
        font-size: 0.85rem;
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 1px;
        opacity: 0.8;
    }
</style>

<body>
    <div class="container-fluid px-4 mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold"><i class="bi bi-grid-1x2-fill me-2"></i> Dashboard Administrateur</h3>
            <button class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm">
                <i class="bi bi-download me-1"></i> Générer Rapport
            </button>
        </div>

        <div class="row g-4">
            <div class="col-xl-3 col-md-6">
                <div class="card card-custom text-white shadow" style="background: var(--primary-gradient)">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="stat-label">Joueurs Actifs</div>
                                <div class="display-6 fw-bold"><?= $joueursActifs ?? 0 ?></div>
                            </div>
                            <div class="icon-shape">
                                <i class="bi bi-person-badge"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card card-custom text-white shadow" style="background: var(--success-gradient)">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="stat-label">Total Équipes</div>
                                <div class="display-6 fw-bold"><?= $nbrEquipes ?? 0 ?></div>
                            </div>
                            <div class="icon-shape">
                                <i class="bi bi-shield-shaded"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card card-custom text-white shadow" style="background: var(--warning-gradient)">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="stat-label">Budget Global</div>
                                <div class="display-6 fw-bold">€2.4M</div>
                            </div>
                            <div class="icon-shape">
                                <i class="bi bi-currency-euro"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card card-custom text-white shadow" style="background: var(--info-gradient)">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="stat-label">Transferts Finis</div>
                                <div class="display-6 fw-bold"><?= $nbrTransfert ?? 0 ?></div>
                            </div>
                            <div class="icon-shape">
                                <i class="bi bi-arrow-left-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-2">
            <div class="col-lg-8">
                <div class="card card-custom shadow-sm border-0 bg-white">
                    <div
                        class="card-header bg-transparent border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">Derniers Transferts</h5>
                        <a href="#" class="btn btn-light btn-sm rounded-pill text-primary fw-bold">Voir tout</a>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr class="small text-muted text-uppercase">
                                        <th>Name</th>
                                        <th>Équipe Source</th>
                                        <th>Destination</th>
                                        <th>Valeur</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($transferts)): ?>
                                        <?php foreach ($transferts as $t): ?>

                                            <?php
                                            //nom du joueur ou coach
                                            $nomMembre = $t['nomJ'] ?? $t['nomC'];

                                            // Avatar
                                            $initials = '';
                                            if ($nomMembre) {
                                                $parts = explode(' ', $nomMembre);
                                                foreach ($parts as $p) {
                                                    $initials .= strtoupper(substr($p, 0, 2));
                                                }
                                            }

                                            // badge statut
                                            switch ($t['statut']) {
                                                case 'valide':
                                                    $badgeClass = 'bg-success-subtle text-success';
                                                    $badgeText = 'Complété';
                                                    break;

                                                case 'en_attente':
                                                    $badgeClass = 'bg-warning-subtle text-warning';
                                                    $badgeText = 'En attente';
                                                    break;

                                                default:
                                                    $badgeClass = 'bg-secondary-subtle text-secondary';
                                                    $badgeText = 'Annulé';
                                            }
                                            ?>

                                            <tr>
                                                <!-- Membre -->
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm me-2 bg-primary-subtle text-primary rounded-circle 
                        d-flex align-items-center justify-content-center fw-bold"
                                                            style="width: 32px; height: 32px; font-size: 12px;">
                                                            <?= $initials ?>
                                                        </div>
                                                        <span class="fw-semibold"><?= htmlspecialchars($nomMembre) ?></span>
                                                    </div>
                                                </td>

                                                <!-- Equipe départ -->
                                                <td><?= htmlspecialchars($t['equipeDepart']) ?></td>

                                                <!-- Equipe arrivée -->
                                                <td><?= htmlspecialchars($t['equipeArrive']) ?></td>

                                                <!-- Montant -->
                                                <td class="fw-bold">
                                                    €<?= /* number_format($t['montant'], 0, ',', ' ') */ Formater::currency($t['montant']) ?>
                                                </td>

                                                <!-- Statut -->
                                                <td>
                                                    <span class="badge rounded-pill <?= $badgeClass ?>">
                                                        <?= $badgeText ?>
                                                    </span>
                                                </td>
                                            </tr>

                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">
                                                Aucun transfert trouvé
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
                                <nav aria-label="Page navigation">
                                    <ul class="pagination pagination-sm mb-0">

                                        <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                                            <a class="page-link" href="?page=<?= $page - 1 ?>">Précédent</a>
                                        </li>

                                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                            <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                            </li>
                                        <?php endfor; ?>

                                        <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                                            <a class="page-link" href="?page=<?= $page + 1 ?>">Suivant</a>
                                        </li>

                                    </ul>
                                </nav>
                            <?php endif; ?>

                        </div>
                        <!-- pagination end -->

                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card card-custom shadow-sm border-0 bg-white h-100">
                    <div class="card-header bg-transparent border-0 pt-4 px-4">
                        <h5 class="fw-bold mb-0">Actions Rapides</h5>
                    </div>
                    <div class="card-body px-4">
                        <div class="d-grid gap-3">
                            <button
                                class="btn btn-outline-primary py-3 border-dashed d-flex align-items-center justify-content-center">
                                <i class="bi bi-plus-circle-fill me-2"></i> Ajouter un Joueur
                            </button>
                            <button
                                class="btn btn-outline-success py-3 border-dashed d-flex align-items-center justify-content-center">
                                <i class="bi bi-file-earmark-plus-fill me-2"></i> Créer un Contrat
                            </button>
                            <button
                                class="btn btn-outline-dark py-3 border-dashed d-flex align-items-center justify-content-center">
                                <i class="bi bi-gear-fill me-2"></i> Paramètres Système
                            </button>
                        </div>

                        <div class="mt-4 p-3 bg-light rounded-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="small text-muted">Utilisation du Budget</span>
                                <span class="small fw-bold">75%</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 75%"
                                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php

include 'header.php';
require_once "../classes/team.php";
$team = new Team();
$teams = $team->allTeams();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gestion des équipes</title>
</head>

<body>

    <div class="container mt-4">

        <!-- Titre + Logo + Bouton -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">
                <i class="bi bi-shield-fill text-primary"></i> Gestion des équipes
            </h3>

            <button id="btnAdd" class="btn btn-dark">
                <i class="bi bi-plus-circle"></i> Ajouter
            </button>
        </div>

        <!-- Formulaire start -->
        <div id="formEquipe" class="card shadow mb-4 d-none">
            <div class="card-header bg-primary text-white">
                <strong>Nouvelle équipe</strong>
            </div>

            <div class="card-body">
                <form method="POST" action="../actions/addTeam.php">
                    <div class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label">Nom de l'équipe</label>
                            <input type="text" name="nom" class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Budget (€)</label>
                            <input type="number" name="budget" class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Manager</label>
                            <input type="text" name="manager" class="form-control" required>
                        </div>

                    </div>

                    <div class="mt-3 text-end">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Formulaire end -->

        <!-- session message start -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?= $_SESSION['success'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <?= $_SESSION['error'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <!-- session message end -->

        <!-- Tableau des équipes -->
        <div class="card shadow">
            <div class="card-header bg-dark text-white">
                <strong>Liste des équipes</strong>
            </div>

            <div class="card-body">
                <table class="table table-striped table-hover text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Budget (€)</th>
                            <th>Manager</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($teams)): ?>
                            <?php foreach ($teams as $team): ?>
                                <tr>
                                    <td><?= $team['id'] ?></td>
                                    <td><?= htmlspecialchars($team['nom']) ?></td>
                                    <td><?= number_format($team['budget'], 0) ?></td>
                                    <td><?= htmlspecialchars($team['manager']) ?></td>

                                    <!-- Actions -->
                                    <td>
                                        <!-- UPDATE -->
                                        <a href="teamUpdate.php?id=<?= $team['id'] ?>" class="btn btn-sm btn-warning me-1"
                                            title="Modifier">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <!-- DELETE -->

                                        <form action="../actions/deleteTeam.php" method="POST" class="d-inline"
                                            onsubmit="return confirm('Voulez-vous vraiment supprimer cette équipe ?');">
                                            <input type="hidden" name="id" value="<?= $team['id'] ?>">
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-muted">
                                    Aucune équipe trouvée
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>
        </div>

    </div>


    <script>
        const btnAdd = document.getElementById('btnAdd');
        const formEquipe = document.getElementById('formEquipe');

        btnAdd.addEventListener('click', () => {
            formEquipe.classList.toggle('d-none');
        });
    </script>

</body>

</html>
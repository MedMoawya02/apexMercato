<?php
require_once '../classes/personne.php';
require_once '../classes/joueur.php';
require_once '../classes/coach.php';
require_once '../classes/team.php';
require_once '../classes/contrat.php';
include 'header.php';
$j = new Joueur("m", "m", "m", "m", "m", 111.00, 111.11);
$contrat = new Contrat();

if (!isset($_GET['search'])) {
    $rows = $j->getJoueurs();
    $teams = new Team();
    $teams = $teams->allTeams();
} else {
    $input = $_GET['search'];
    $rows = $j->searchMembre($input);
    $teams = new Team();
    $teams = $teams->allTeams();
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
    <div class="container mt-4">

        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">

            <!-- Filtre TYPE (gauche) -->
            <div class="d-flex align-items-center gap-2">
                <label for="typeMembre" class="fw-semibold mb-0">
                    <i class="bi bi-funnel-fill"></i> Filtrer :
                </label>

                <select id="typeMembre" class="form-select shadow-sm" style="width: 180px;">
                    <option value="">Tous les membres</option>
                    <option value="Joueur">Joueurs</option>
                    <option value="Coach">Coachs</option>
                </select>
            </div>

            <!-- Recherche (droite) -->
            <form method="GET" class="d-flex align-items-center position-relative" style="max-width: 300px;">
                <i class="bi bi-search position-absolute text-muted" style="left: 12px;"></i>

                <input type="text" name="search" class="form-control ps-5 shadow-sm" placeholder="Rechercher par nom..."
                    value="<?= $_GET['search'] ?? '' ?>">
            </form>

        </div>



        <div class="card shadow">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">
                    <i class="bi bi-people-fill"></i> Liste des membres
                </h5>
            </div>
            <div class="card-body">
                <table id="membersTable" class="table table-striped table-hover">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Nationalité</th>
                            <th>Type</th>
                            <th>Rôle</th>
                            <th>Pseudo</th>
                            <th>Salaire (€)</th>
                            <th>Valeur (€)</th>
                            <th>Exp.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($rows)): ?>
                            <?php foreach ($rows as $row): ?>
                                <tr data-type="<?= $row['type'] ?>">
                                    <td><?= $row['id'] ?></td>
                                    <td><?= htmlspecialchars($row['nom']) ?></td>
                                    <td><?= htmlspecialchars($row['nationalité']) ?></td>

                                    <td>
                                        <span class="badge <?= $row['type'] === 'Joueur' ? 'bg-primary' : 'bg-success' ?>">
                                            <?= $row['type'] ?>
                                        </span>
                                    </td>

                                    <td><?= $row['role'] ?? '-' ?></td>
                                    <td><?= $row['pseudo'] ?? '-' ?></td>
                                    <td><?= isset($row['salaire']) ? number_format($row['salaire'], 0) : '-' ?></td>
                                    <td><?= $row['valeurMarchande'] ? number_format($row['valeurMarchande'], 0) : '-' ?></td>
                                    <td><?= $row['experience'] ?? '-' ?></td>
                                    <?php if (!$contrat->havingContrat($row['id'], $row['type'])): ?>
                                        <td>
                                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#contratModal" data-id="<?= $row['id'] ?>"
                                                data-type="<?= $row['type'] ?>" data-nom="<?= htmlspecialchars($row['nom']) ?>">
                                                <i class="bi bi-file-earmark-plus"></i> Créer Contrat
                                            </button>
                                        </td>
                                    <?php else: ?>
                                        <td>
                                            <span class="text-muted">Contrat actif</span>
                                        </td>
                                    <?php endif; ?>
                                   
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">
                                    <i class="bi bi-search"></i>
                                    <strong>Aucun résultat trouvé</strong>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <!-- Modal start -->
                <div class="modal fade" id="contratModal" tabindex="-1" aria-labelledby="contratModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="../actions/createContrat.php" method="POST">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="contratModalLabel"><i
                                            class="bi bi-file-earmark-plus"></i> Créer Contrat</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <!-- ID et type cachés -->
                                    <input type="hidden" name="idPersonne" id="modalId">
                                    <input type="hidden" name="type" id="modalType">

                                    <!-- Nom joueur/coach (readonly) -->
                                    <div class="mb-3">
                                        <label class="form-label">Nom</label>
                                        <input type="text" id="modalNom" class="form-control" readonly>
                                    </div>

                                    <!-- Équipe -->
                                    <div class="mb-3">
                                        <label class="form-label">Équipe</label>
                                        <select name="idEquipe" class="form-select" required>
                                            <option value="">Sélectionner une équipe</option>
                                            <!-- PHP pour lister les équipes -->
                                            <?php foreach ($teams as $team): ?>
                                                <option value="<?= $team['id'] ?>"><?= htmlspecialchars($team['nom']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <!-- Start Date -->
                                    <div class="mb-3">
                                        <label class="form-label">Date de début</label>
                                        <input type="date" name="startDate" class="form-control" required>
                                    </div>

                                    <!-- End Date -->
                                    <div class="mb-3">
                                        <label class="form-label">Date de fin</label>
                                        <input type="date" name="endDate" class="form-control" required>
                                    </div>

                                    <!-- Salaire -->
                                    <div class="mb-3">
                                        <label class="form-label">Salaire (€)</label>
                                        <input type="number" name="salaire" class="form-control" step="0.01" min="0"
                                            required>
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-success">Enregistrer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal end -->

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const select = document.getElementById('typeMembre');
        const rows = document.querySelectorAll('#membersTable tbody tr');

        select.addEventListener('change', function () {
            const selectedType = this.value;

            rows.forEach(row => {
                const rowType = row.getAttribute('data-type');

                if (selectedType === '' || rowType === selectedType) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        const contratModal = document.getElementById('contratModal');
        contratModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const type = button.getAttribute('data-type');
            const nom = button.getAttribute('data-nom');

            document.getElementById('modalId').value = id;
            document.getElementById('modalType').value = type;
            document.getElementById('modalNom').value = nom;
        });
    </script>
</body>

</html>
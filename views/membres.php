<?php
require_once '../classes/personne.php';
require_once '../classes/joueur.php';
require_once '../classes/coach.php';
include 'header.php';
$j = new Joueur("m", "m", "m", "m", "m", 111.00, 111.11);


if (!isset($_GET['search'])) {
    $rows = $j->getJoueurs();
} else {
    $input = $_GET['search'];
    $rows = $j->searchMembre($input);
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
                                    <td><?= $row['salaireMensuel'] ? number_format($row['salaireMensuel'], 0) : '-' ?></td>
                                    <td><?= $row['valeurMarchande'] ? number_format($row['valeurMarchande'], 0) : '-' ?></td>
                                    <td><?= $row['experience'] ?? '-' ?></td>
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

            </div>
        </div>
    </div>

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
    </script>
</body>

</html>
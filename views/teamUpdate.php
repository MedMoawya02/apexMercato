<?php
require_once '../classes/team.php';
include 'header.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $team = new Team();
    $t = $team->updateTeam($id); 
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuration Équipe</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <i class="bi bi-gear-fill"></i> Configuration de l’équipe
                </div>

                <div class="card-body">
                    <form action="../actions/editTeam.php" method="POST">

                        <!-- ID équipe -->
                        <input type="hidden" name="id" value="<?= $t['id'] ?>">

                        <!-- Budget -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-cash-stack"></i> Budget (€)
                            </label>
                            <input type="number"
                                   name="budget"
                                   class="form-control"
                                   step="0.01"
                                   min="0"
                                   value="<?= $t['budget'] ?>"
                                   required>
                        </div>

                        <!-- Manager -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-person-badge"></i> Manager
                            </label>
                            <input type="text"
                                   name="manager"
                                   class="form-control"
                                   value="<?= htmlspecialchars($t['manager']) ?>"
                                   required>
                        </div>

                        <!-- Actions -->
                        <div class="d-flex justify-content-end gap-2">
                            <a href="teamCreate.php" class="btn btn-secondary">
                                Annuler
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save"></i> Enregistrer
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter un Membre | Apex Mercato</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

    <!-- HEADER -->
    <?php include 'header.php'; ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="card shadow-sm">
                    <div class="card-body p-4">

                        <h4 class="mb-4">
                            <i class="bi bi-person-plus"></i> Ajouter un nouveau membre
                        </h4>

                        <form action="../actions/addPerson.php" method="POST">

                            <!-- TYPE -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Type de membre</label>
                                <select name="type" id="typeSelect" class="form-select" onchange="toggleFields()"
                                    required>
                                    <option value="joueur">Joueur</option>
                                    <option value="coach">Coach</option>
                                </select>
                            </div>

                            <!-- COMMUN -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nom</label>
                                    <input type="text" name="nom" class="form-control" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nationalité</label>
                                <input type="text" name="nationalite" class="form-control" required>
                            </div>

                            <!-- JOUEUR -->
                            <div id="fields-joueur">
                                <hr>
                                <h6 class="text-primary">
                                    <i class="bi bi-controller"></i> Informations Joueur
                                </h6>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Pseudo</label>
                                        <input type="text" name="pseudo" class="form-control">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Rôle</label>
                                        <input type="text" name="role" class="form-control">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Valeur marchande (€)</label>
                                        <input type="number" step="0.01" name="valeurMarchande" class="form-control">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Salaire mensuel (€)</label>
                                        <input type="number" step="0.01" name="salaireMensuel" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <!-- COACH -->
                            <div id="fields-coach" class="d-none">
                                <hr>
                                <h6 class="text-success">
                                    <i class="bi bi-mortarboard"></i> Informations Coach
                                </h6>

                                <div class=" mb-3">
                                    <label class="form-label">Style de coaching</label>
                                    <input type="text"  name="styleCoaching" class="form-control">
                                </div>

                                <div class=" mb-3">
                                    <label class="form-label">Salaire mensuel (€)</label>
                                    <input type="number" step="0.01" name="salaireMensuel" class="form-control">
                                </div>
                        
                                <div class="mb-3">
                                    <label class="form-label">Années d'expérience</label>
                                    <input type="number" name="experience" class="form-control">
                                </div>
                            </div>

                            <!-- SUBMIT -->
                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i> Enregistrer
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- JS -->
    <script>
        function toggleFields() {
            const type = document.getElementById('typeSelect').value;

            document.getElementById('fields-joueur').classList.toggle('d-none', type !== 'joueur');
            document.getElementById('fields-coach').classList.toggle('d-none', type !== 'coach');
        }
    </script>

</body>

</html>
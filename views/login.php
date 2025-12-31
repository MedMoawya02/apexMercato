<?php
session_start();
$error="";
if($_SERVER['REQUEST_METHOD']=="POST"){
    $username=$_POST['username']??"";
    $password=$_POST['password']??"";

    //
    if($username=="admin"&&$password=="admin"){
        $_SESSION['role']="admin";
        header("location:adminDashboard.php");
        exit;
    }
    if($username=="journaliste"&&$password=="journaliste"){
        $_SESSION['role']="journaliste";
        header("location:journalisteDashboard.php");
        exit;
    }
    $error="Identifients incorrects ";
    
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion | Apex Management</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-5 col-lg-4">

            <div class="card shadow-sm">
                <div class="card-body p-4">

                    <h3 class="text-center mb-4">Connexion</h3>

                    <?php if ($error): ?>
                        <div class="alert alert-danger text-center">
                            <?= $error ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nom d'utilisateur</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mot de passe</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                Se connecter
                            </button>
                        </div>
                    </form>

                    <hr>

                    <div class="text-center">
                        <a href="/market.php" class="btn btn-outline-secondary btn-sm">
                            Continuer comme visiteur
                        </a>
                    </div>

                </div>
            </div>

            <p class="text-center text-muted mt-3 small">
                Apex Management © 2025
            </p>

        </div>
    </div>
</div>

</body>
</html>
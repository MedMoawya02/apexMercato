<?php
require_once '../classes/personne.php';
require_once '../classes/joueur.php';
require_once '../classes/coach.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
    $type=$_POST['type'];
    $nom=$_POST['nom'];
    $email=$_POST['email'];
    $nationalite=$_POST['nationalite'];
    $pseudo=$_POST['pseudo'];
    $role=$_POST['role'];
    $valeurMarchande=$_POST['valeurMarchande'];
    $salaireMensuel=$_POST['salaireMensuel'];
    $styleCoaching=$_POST['styleCoaching'];
    $experience=$_POST['experience'];
    if($type=="joueur"){
        $j=new Joueur($nom,$email,$nationalite,$pseudo,$role,(float) $valeurMarchande,(float)$salaireMensuel);
        $j->create();
    }
    if($type=="coach"){
        $coach=new Coach($nom,$email,$nationalite,$styleCoaching,$salaireMensuel,$experience);
        $coach->createCoach();
    }
    header("location:../views/adminDashboard.php");
}
?>
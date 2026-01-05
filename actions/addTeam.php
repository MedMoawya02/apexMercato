<?php
require_once '../classes/team.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
    $nom=$_POST['nom'];
    $budget=$_POST['budget'];
    $manager=$_POST['manager'];
    $e=new Team($nom,$budget,$manager);
    $e->createEquipe();
    header("location:../views/teamCreate.php");
}
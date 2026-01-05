<?php
session_start();
require_once '../classes/team.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
    $id=$_POST['id'];
    $budget=$_POST['budget'];
    $manager=$_POST['manager'];
    if($budget<0){
        $_SESSION['error']="Le budget ne doit pas étre 0";
        header("location:../views/teamCreate.php");
        exit;
    }
    if(empty($manager)){
        $_SESSION['error']="Remplir le champs de manager";
          header("location:../views/teamCreate.php");
        exit;
    }
    $team=new Team();
    $team->editTeam($id,$budget,$manager);
    $_SESSION['success']="Equipe Modifiée avec success";
    header("location:../views/teamCreate.php");
    exit;
 
}
<?php
require_once '../classes/contrat.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
    $id=$_POST['idPersonne'];
    $startDate=$_POST['startDate'];
    $endDate=$_POST['endDate'];
    $type=$_POST['type'];
    $salaire=$_POST['salaire'];
    $contrat=new Contrat();
   
    if($type=="Joueur"){
        $contrat->createContrat($startDate,$salaire,$endDate,$id,null);
    }elseif($type=="Coach"){
        $contrat->createContrat($startDate,$salaire,$endDate,null,$id);
    }
    header("location:../views/membres.php");
    exit;
}
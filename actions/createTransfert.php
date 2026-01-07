<?php
require_once '../classes/transfert.php';
$transfert=new Transfert();
 if($_SERVER['REQUEST_METHOD']=="POST"){
    $idPersonne=$_POST['idPersonne'];
    $type=$_POST['type'];
   $idD=$_POST['idEquipeDepart'];
   $idA=$_POST['idEquipeArrivee'];
   $salaire=$_POST['salaire'];
   $montant=$_POST['montant'];
   $statut=$_POST['statut'];
   $transfert->transfert($idPersonne,$type,$idD,$idA,$salaire,$montant,$statut);
   header("location:../views/membres.php");
    exit;
} 
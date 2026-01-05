<?php
require_once "../classes/team.php";
if(isset($_POST['id'])){
    $id=(int)$_POST['id'];
    $team=new Team();
    $team->deleteTeam($id);
    header("location:../views/teamCreate.php"); 
}
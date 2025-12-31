<?php
require_once "personne.php";
require_once "../db_connect.php";
class Coach extends Personne{
    private $db;
     private string $styleCoaching;
    private int $anneesExp;
    private float $salaireMensuel;

    public function __construct(string $nom,string $email,string $nationalite,string $styleCoaching,int $anneesExp,float $salaireMensuel) {
        parent::__construct($nom, $email, $nationalite);
        $this->db=new Database("localhost","apexmercato","root","");
        $this->styleCoaching = $styleCoaching;
        $this->anneesExp = $anneesExp;
        $this->salaireMensuel = $salaireMensuel;
    }
    public function getAnnualCost():float{
        return $this->salaireMensuel*12;
    }

    //
    public function createCoach(){
        $conn=$this->db->getConnection();
        $sql="INSERT INTO coach (nom,email,nationalité,styleCoaching,salaireMensuel,annéesExp)VALUES(:nom,:email,:nationalite,:styleCoaching,:salaireMensuel,:anneesExp)";
        $stmt=$conn->prepare($sql);
        $stmt->execute([
            ':nom'=>$this->nom,
            ':email'=>$this->email,
            ':nationalite'=>$this->nationalite,
            ':styleCoaching'=>$this->styleCoaching,
            ':salaireMensuel'=>$this->salaireMensuel,
            ':anneesExp'=>$this->anneesExp,
        ]);
    }
}
/* $coach=new Coach("Fakhir","fakhir@gmail.com","Morocain","Possession de ball",15,40000);
$coach->createCoach(); */
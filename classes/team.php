<?php
require_once "../db_connect.php";
class Team{
    private  $db;
    public function __construct(private ?string $nom=null,private ?float $budget=null,private ?string $manager=null,){
        
    }

    //create team
    public function createEquipe(){
         $this->db=new Database("localhost", "apexmercato", "root", "");
         $conn=$this->db->getConnection();
         $sql="INSERT INTO equipe (nom,budget,manager)VALUES (:nom,:budget,:manager)";
         $stmt=$conn->prepare($sql);
         $stmt->execute([
            ':nom'=>$this->nom,
            ':budget'=>$this->budget,
            ':manager'=>$this->manager,
         ]);
         
    }
    // get teams
    public function allTeams(){
        $this->db=new Database("localhost", "apexmercato", "root", "");
         $conn=$this->db->getConnection();
         $sql="SELECT * FROM equipe";
         $stmt=$conn->prepare($sql);
         $stmt->execute();
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Delete 
    public function deleteTeam($id){
        $this->db=new Database("localhost", "apexmercato", "root", "");
         $conn=$this->db->getConnection();
         $sql="DELETE FROM equipe where id=:id";
         $stmt=$conn->prepare($sql);
         $stmt->execute([':id'=>$id]);
    }

    //update
    public function updateTeam($id){
        $this->db=new Database("localhost", "apexmercato", "root", "");
         $conn=$this->db->getConnection();
         $sql="SELECT * FROM equipe where id=:id";
         $stmt=$conn->prepare($sql);
         $stmt->execute([':id'=>$id]);
         return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function editTeam($id,$budget,$manager){
         $this->db=new Database("localhost", "apexmercato", "root", "");
         $conn=$this->db->getConnection();
         $sql="UPDATE equipe set budget=:budget ,manager=:manager WHERE id=:id" ;
         $stmt=$conn->prepare($sql);
         $stmt->execute([
            ':id'=>$id,
            ':budget'=>$budget,
            ':manager'=>$manager,
         ]);
    }

}
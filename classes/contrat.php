<?php
require_once "../db_connect.php";
class Contrat{
    private $db;
    private readonly ?DateTime $startdate;
    private  ?float $salaire=null;
    private  ?DateTime $dateFin=null;

    // j'ai met ? parcque le contrat doit etre d'un joueur ou coach
    private  ?int $idJoueur;
    private  ?int $idCoach;

    public function __construct($startdate=null,$salaire=null,$dateFin=null,$idJoueur=null,$idCoach=null){
        $this->startdate=$startdate;
        $this->salaire=$salaire;
        $this->dateFin=$dateFin;
        $this->idJoueur=$idJoueur;
        $this->idCoach=$idCoach;
    }

    //create contrat
    public function createContrat($startDate,$salaire,$endDate,$idJoueur,$idCoach){
        $this->db = new Database("localhost", "apexmercato", "root", "");
        $conn = $this->db->getConnection();
        $sql="INSERT INTO contrat (startDate,salaire,dateFin,idJoueur,idCoach)VALUES (:startDate,:salaire,:dateFin,:idJoueur,:idCoach)";
        $stmt=$conn->prepare($sql);
        $stmt->execute([
            ':startDate'=>$startDate,
            ':salaire'=>$salaire,
            ':dateFin'=>$endDate,
            ':idJoueur'=>$idJoueur,
            ':idCoach'=>$idCoach,
        ]);

    //check contrat
}
    public function havingContrat($id,$type){
        $this->db = new Database("localhost", "apexmercato", "root", "");
        $conn = $this->db->getConnection();
        if($type=="Joueur"){
            $sql=" SELECT COUNT(*) FROM `contrat` WHERE idJoueur=:id AND dateFin>=CURRENT_DATE()";
            $stmt=$conn->prepare($sql);  
        }else{
            $sql=" SELECT COUNT(*) FROM `contrat` WHERE idCoach=:id AND dateFin>=CURRENT_DATE()";
            $stmt=$conn->prepare($sql); 
        }
        $stmt->execute([
            ':id'=>$id
        ]);
        return $stmt->fetchColumn()>0;
    }
}
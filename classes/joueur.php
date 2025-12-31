<?php
require_once "personne.php";
require_once "../db_connect.php";
class Joueur extends Personne
{
    private $db;
    private string $role;
    private string $pseudo;
    private float $valeurMarchande;
    private float $salaireMensuel;

    public function __construct(string $nom,string $email,string $nationalite,string $role,string $pseudo,float $valeurMarchande,float $salaireMensuel) {
        parent::__construct($nom, $email, $nationalite);
        $this->role = $role;
        $this->pseudo = $pseudo;
        $this->valeurMarchande = $valeurMarchande;
        $this->salaireMensuel = $salaireMensuel;
    }
    public function getAnnualCost():float
    {
        return $this->salaireMensuel*12;
    }

    public function create(){
        $this->db=new Database("localhost","apexmercato","root","");
        $conn=$this->db->getConnection();
        $sql="INSERT INTO joueur (nom,email,nationalité,role,pseudo,salaireMensuel,valeurMarchande)VALUES (:nom,:email,:nationalite,:role,:pseudo,:salaireMensuel,:valeurMarchande)";
        $stmt=$conn->prepare($sql);
        $stmt->execute([
            ':nom'=>$this->nom,
            ':email'=>$this->email,
            ':nationalite'=>$this->nationalite,
            ':role'=>$this->role,
            ':pseudo'=>$this->pseudo,
            ':salaireMensuel'=>$this->salaireMensuel,
            ':valeurMarchande'=>$this->valeurMarchande
        ]);
    }
}

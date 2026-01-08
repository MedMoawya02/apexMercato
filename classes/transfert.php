<?php
require_once "../db_connect.php";
require_once "financialEngine.php";
class Transfert{
    private $db ;

    public function __construct(private ?int $idEquipeDepart=null,private ?int $idEquipeArrive=null,private ?float $montant=null,private ?string $statut=null){}

    public function transfert($idMembre,$type,$idD,$idA,$salaire,$montant,$statut){
         $this->db = new Database("localhost", "apexmercato", "root", "");
        $conn = $this->db->getConnection();
        
        try {
            $conn->beginTransaction();

            $sql="SELECT budget FROM equipe WHERE id=:id";
            $stmt=$conn->prepare($sql);
            $stmt->execute([':id'=>$idA]);
            $eqABudget=$stmt->fetchColumn();

            if($eqABudget>$montant){

                //L'insertion dans le tableu transfert
                $sql="INSERT INTO transfert (idPersonne,typePersonne,idEquipeDepart,idEquipeArrivé,montant,statut)VALUES (:idPersonne,:type,:idEquipeDepart,:idEquipeArrive,:montant,:statut)";
                $stmt=$conn->prepare($sql);
                $stmt->execute([
                ':idPersonne'=>$idMembre,
                ':type'=>$type,
                ':idEquipeDepart'=>$idD,
                ':idEquipeArrive'=>$idA,
                ':montant'=>$montant,
                ':statut'=>$statut
            ]);

            //deminuer le budget de le nouveau equipe si le budget est suffisant
            $sql="UPDATE equipe set budget=budget-:montant WHERE id=:idEquipeArrive ";
            $stmt=$conn->prepare($sql);
            $stmt->execute([':idEquipeArrive'=>$idA,':montant'=>$montant]);


            //ajouter le montant dans l'équipe précedente
            $sql="UPDATE equipe set budget=budget+:montant WHERE id=:idEquipeDepart";
            $stmt=$conn->prepare($sql);
            $stmt->execute([':idEquipeDepart'=>$idD,':montant'=>$montant]);
            
            //la fermuture d'ancien contrat
            if($type=="Joueur"){
                $sql="UPDATE contrat SET dateFin=CURDATE() WHERE idJoueur=:idMembre AND dateFin > CURDATE() ";
                $stmt=$conn->prepare($sql);
            }else{
                $sql="UPDATE contrat SET dateFin=CURDATE() WHERE idCoach=:idMembre AND dateFin > CURDATE()";
                $stmt=$conn->prepare($sql);
            }
            $stmt->execute([':idMembre'=>$idMembre]);
            //ajouter une nouvelle contrat 
            if($type=="Joueur"){
                $sql="INSERT INTO contrat (startDate,salaire,idEquipe,dateFin,idJoueur)VALUES(CURDATE(),:salaire,:eqA,DATE_ADD(CURDATE(), INTERVAL 3 YEAR),:idPersonne)";
                $stmt=$conn->prepare($sql);
            }else{
                $sql="INSERT INTO contrat (startDate,salaire,idEquipe,dateFin,idCoach)VALUES(CURDATE(),:salaire,:eqA,DATE_ADD(CURDATE(), INTERVAL 3 YEAR),:idPersonne)";
                $stmt=$conn->prepare($sql);
            }
            $stmt->execute([
                ':salaire'=>$salaire,
                ':eqA'=>$idA,
                ':idPersonne'=>$idMembre
            ]);

            $conn->commit();
            return true;
            }
        } catch (Exception $e) {
        $conn->rollBack();
        return $e->getMessage();
    }
    }

    //get all transferts
    public function allTransferts(){
        $this->db = new Database("localhost", "apexmercato", "root", "");
        $conn = $this->db->getConnection();
        $sql="SELECT 
            transfert.*,
            joueur.nom AS nomJ,
            coach.nom AS nomC,
            eqD.nom AS equipeDepart,
            eqA.nom AS equipeArrive
        FROM transfert
        LEFT JOIN joueur 
            ON transfert.idPersonne = joueur.id 
            AND transfert.typePersonne = 'Joueur'
        LEFT JOIN coach 
            ON transfert.idPersonne = coach.id  
            AND transfert.typePersonne = 'Coach'
         LEFT JOIN equipe AS eqD ON transfert.idEquipeDepart=eqD.id
         LEFT JOIN equipe AS eqA ON transfert.idEquipeArrivé=eqA.id;";
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }
    //get nbr transfert valide
    public function nbrTransfertFinis(){
          $this->db = new Database("localhost", "apexmercato", "root", "");
        $conn = $this->db->getConnection();
        $sql="SELECT COUNT(*) FROM `transfert` WHERE statut='Validè'";
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

}
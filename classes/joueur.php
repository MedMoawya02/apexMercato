<?php
require_once "personne.php";
require_once "../db_connect.php";
class Joueur extends Personne
{
    private $db;
    private ?string $role = null;
    private ?string $pseudo = null;
    private ?float $valeurMarchande = null;
    private ?float $salaireMensuel = null;

    public function __construct(string $nom, string $email, string $nationalite, string $role, string $pseudo, float $valeurMarchande, float $salaireMensuel)
    {
        parent::__construct($nom, $email, $nationalite);
        $this->role = $role;
        $this->pseudo = $pseudo;
        $this->valeurMarchande = $valeurMarchande;
        $this->salaireMensuel = $salaireMensuel;
    }
    public function getAnnualCost(): float
    {
        return $this->salaireMensuel * 12;
    }

    public function create()
    {
        $this->db = new Database("localhost", "apexmercato", "root", "");
        $conn = $this->db->getConnection();
        $sql = "INSERT INTO joueur (nom,email,nationalité,role,pseudo,salaireMensuel,valeurMarchande)VALUES (:nom,:email,:nationalite,:role,:pseudo,:salaireMensuel,:valeurMarchande)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':nom' => $this->nom,
            ':email' => $this->email,
            ':nationalite' => $this->nationalite,
            ':role' => $this->role,
            ':pseudo' => $this->pseudo,
            ':salaireMensuel' => $this->salaireMensuel,
            ':valeurMarchande' => $this->valeurMarchande
        ]);
    }

    public function getJoueurs()
    {
        $this->db = new Database("localhost", "apexmercato", "root", "");
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("SELECT j.id, j.nom, j.nationalité, 'Joueur' AS type, j.role, j.pseudo,
               c.salaire AS salaire, j.valeurMarchande, NULL AS experience
        FROM joueur j
        LEFT JOIN contrat c
            ON c.idJoueur = j.id
            AND c.dateFin >= CURDATE() 
           
        UNION
        SELECT k.id, k.nom, k.nationalité, 'Coach' AS type, NULL, NULL,
               c.salaire AS salaire, NULL, k.annéesExp
        FROM coach k
        LEFT JOIN contrat c
            ON c.idCoach = k.id
            AND c.dateFin >= CURDATE()");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    //Search
    public function searchMembre(string $nom)
    {
        $this->db = new Database("localhost", "apexmercato", "root", "");
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("SELECT id, nom, nationalité, 'Joueur' AS type, role, pseudo, salaireMensuel, valeurMarchande, NULL AS experience
                FROM joueur WHERE nom Like :nom
                UNION
                SELECT id, nom, nationalité, 'Coach' AS type, NULL, NULL, salaireMensuel, NULL, annéesExp
                FROM coach WHERE nom Like :nom");
        $stmt->execute([
            ':nom' => '%' . $nom . '%',
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);


    }
}

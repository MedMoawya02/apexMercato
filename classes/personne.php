<?php
abstract class Personne{
    protected int $id;
    protected ?string $nom=null;
    protected ?string $email=null;
    protected ?string $nationalite=null;

    public function __construct(string $nom,string $email,string $nationalite){
        $this->nom=$nom;
        $this->email=$email;
        $this->nationalite=$nationalite;
    }

    abstract public function  getAnnualCost():float;
}
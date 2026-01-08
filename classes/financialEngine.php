<?php
final class FinancialEngine{
    public static function calculTax(float $montant){
        return $montant*0.1;
    }

    //Salaire annuel
    public static function getSalAnn(float $salaire){
        return $salaire*12;
    }
}
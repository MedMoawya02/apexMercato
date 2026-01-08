<?php
class  Formater{
    public static function currency(float $montant){
        if($montant>=1000000){
            return number_format($montant/1000000,1);
        }elseif($montant>=1000){
            return number_format($montant/1000,1);
        }
        return number_format($montant);
    }
}
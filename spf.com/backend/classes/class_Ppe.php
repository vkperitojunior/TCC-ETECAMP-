<!-- Inicio do php -->
<?php

// criando a classe de pontos por dias com seus atributos
class Ppe {
    private $id_pont;
    private $equipe_id;
    private $soma_pont;
    private $ranking;
    private $obs_pont;
    private $status_pontpe;
    private $ult_us_atz;

    // criando o metodo construct com todos os atributos
    public function __construct(

        $id_pont,
        $equipe_id,
        $soma_pont,
        $ranking,
        $obs_pont,
        $status_pontpe,
        $ult_us_atz
    
    ){

        $this->id_pont= (int) $id_pont;
        $this->equipe_id= (int) $equipe_id;
        $this->soma_pont=$soma_pont;
        $this->ranking=$ranking;
        $this->obs_pont= (string) $obs_pont;
        $this->status_pontpe= (int) $status_pontpe;
        $this->ult_us_atz= (int) $ult_us_atz;
    }

        // criando o metodo de set
    public function setID_pont($id_pont){
        $this->id_pont=$id_pont;
    }

        // criando metodo get 
    public function getId_pont(){
        return $this->id_pont;
    }

        // criando o metodo de set
    public function setEquipe_id($equipe_id){
        $this->equipe_id=$equipe_id;
    }

        // criando metodo get 
    public function getEquipe_id(){
        return $this->equipe_id;
    }

        // criando o metodo de set
    public function setSoma_pont($soma_pont){
        $this->soma_pont=$soma_pont;
    }

        // criando metodo get 
    public function getSoma_pont(){
        return $this->soma_pont;
    }

        // criando o metodo de set
    public function setRanking($ranking){
        $this->ranking=$ranking;
    }

        // criando metodo get 
    public function getRanking(){
        return $this->ranking;
    }

        // criando o metodo de set
    public function setObs_pont($obs_pont){
        $this->obs_pont=$obs_pont;
    }

        // criando metodo get 
    public function getObs_pont(){
        return $this->obs_pont;
    }

    // criando o metodo de set
    public function setStatus_pontpe($status_pontpe){
        $this->status_pontpe=$status_pontpe;
    }

        // criando metodo get 
    public function getStatus_pontpe(){
        return $this->status_pontpe;
    }

                // criando o metodo de set
                public function setUlt_us_atz($ult_us_atz){
                    $this->ult_us_atz=$ult_us_atz;
                }
            
                    // criando metodo get 
                public function getUlt_us_atz(){
                    return $this->ult_us_atz;
                }

    // FIm do php e da classe
    // não precisa declarar fim por só ter php
}
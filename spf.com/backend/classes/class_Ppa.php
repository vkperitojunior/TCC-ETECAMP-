<!-- Inicio do php -->
<?php

// criando a classe de pontos por gincanas com seus atributos
class Ppa {
    private $id_pontpa;
    private $equipe_id;
    private $gincana_id;
    private $crie_1;
    private $crie_2;
    private $crie_3;
    private $dia_pontpa;
    private $pont_da_gin;
    private $obs_pontpa;
    private $status_pontpa;
    private $ult_us_atz;

    // criando o metodo construct com todos os atributos
    public function __construct($id_pontpa,$equipe_id,$gincana_id,$crie_1, $crie_2, $crie_3,
    $dia_pontpa,$pont_da_gin,$obs_pontpa,$status_pontpa, $ult_us_atz){

        $this->id_pontpa= (int) $id_pontpa;
        $this->equipe_id= (int) $equipe_id;
        $this->gincana_id= (int) $gincana_id;
        $this->crie_1= $crie_1;
        $this->crie_2= $crie_2;
        $this->crie_3= $crie_3;
        $this->dia_pontpa=$dia_pontpa;
        $this->pont_da_gin=$pont_da_gin;
        $this->obs_pontpa= (string) $obs_pontpa;
        $this->status_pontpa= (int) $status_pontpa;
        $this->ult_us_atz= (int) $ult_us_atz;
    }

        // criando o metodo de set
    public function setId_pontpa($id_pontpa){
        $this->id_pontpa=$id_pontpa;
    }

        // criando metodo get 
    public function getId_pontpa(){
        return $this->id_pontpa;
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
    public function setGincana_id($gincana_id){
        $this->gincana_id=$gincana_id;
    }

        // criando metodo get 
    public function getGincana_id(){
        return $this->gincana_id;
    }

            // criando o metodo de set
            public function setCrie_1($crie_1){
                $this->crie_1=$crie_1;
            }
        
                // criando metodo get 
            public function getCrie_1(){
                return $this->crie_1;
            }

                        // criando o metodo de set
                        public function setCrie_2($crie_2){
                            $this->crie_2=$crie_2;
                        }
                    
                            // criando metodo get 
                        public function getCrie_2(){
                            return $this->crie_2;
                        }

                                    // criando o metodo de set
            public function setCrie_3($crie_3){
                $this->crie_3=$crie_3;
            }
        
                // criando metodo get 
            public function getCrie_3(){
                return $this->crie_3;
            }

        // criando o metodo de set
    public function setDia_pontpa($dia_pontpa){
        $this->dia_pontpa=$dia_pontpa;
    }

        // criando metodo get 
    public function getDia_pontpa(){
        return $this->dia_pontpa;
    }

        // criando o metodo de set
    public function setPont_da_gin($pont_da_gin){
        $this->pont_da_gin=$pont_da_gin;
    }

        // criando metodo get 
    public function getPont_da_gin(){
        return $this->pont_da_gin;
    }

        // criando o metodo de set
        public function setObs_pontpa($obs_pontpa){
        $this->obs_pontpa=$obs_pontpa;
    }

        // criando metodo get 
    public function getObs_pontpa(){
        return $this->obs_pontpa;
    }

    // criando o metodo de set
    public function setStatus_pontpa($status_pontpa){
        $this->status_pontpa=$status_pontpa;
    }

        // criando metodo get 
    public function getStatus_pontpa(){
        return $this->status_pontpa;
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
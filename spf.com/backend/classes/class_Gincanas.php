<!-- Inicio do php -->
<?php

// criando a classe de gincanas com seus atributos
class Gincanas {
    private $id_gin;
    private $nome_gin;
    private $regras_gin;
    private $crie_1;
    private $crie_2;
    private $crie_3;
    private $exemplo_gin;
    private $foto_gin;
    private $horario_gin;
    private $local_gin;
    private $status_gin;
    private $ult_us_atz;

    // criando o metodo construct com todos os atributos
    public function __construct($id_gin,$nome_gin,$regras_gin,$crie_1, $crie_2, $crie_3,
    $exemplo_gin,$foto_gin,$horario_gin,$local_gin,$status_gin, $ult_us_atz){

        $this->id_gin= (int) $id_gin;
        $this->nome_gin= (string) $nome_gin;
        $this->regras_gin= (string) $regras_gin;
        $this->crie_1= $crie_1;
        $this->crie_2= $crie_2;
        $this->crie_3= $crie_3;
        $this->exemplo_gin=$exemplo_gin;
        $this->foto_gin=$foto_gin;
        $this->horario_gin=$horario_gin;
        $this->local_gin=$local_gin;
        $this->status_gin= (int) $status_gin;
        $this->ult_us_atz= (int) $ult_us_atz;
    }

        // criando o metodo de set
    public function setId_gin($id_gin){
        $this->id_gin=$id_gin;
    }

        // criando metodo get 
    public function getId_gin(){
        return $this->id_gin;
    }

        // criando o metodo de set
    public function setNome_gin($nome_gin){
        $this->nome_gin=$nome_gin;
    }

        // criando metodo get 
    public function getNome_gin(){
        return $this->nome_gin;
    }

        // criando o metodo de set
    public function setRegras_gin($regras_gin){
        $this->regras_gin=$regras_gin;
    }

        // criando metodo get 
    public function getRegras_gin(){
        return $this->regras_gin;
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
    public function setExemplo_gin($exemplo_gin){
        $this->exemplo_gin=$exemplo_gin;
    }

        // criando metodo get 
    public function getExemplo_gin(){
        return $this->exemplo_gin;
    }

        // criando o metodo de set
    public function setFoto_gin($foto_gin){
        $this->foto_gin=$foto_gin;
    }

        // criando metodo get 
    public function getFoto_gin(){
        return $this->foto_gin;
    }

        // criando o metodo de set
    public function setHorario_gin($horario_gin){
        $this->horario_gin=$horario_gin;
    }

        // criando metodo get 
    public function getHorario_gin(){
        return $this->horario_gin;
    }

         // criando o metodo de set
    public function setLocal_gin($local_gin){
        $this->local_gin=$local_gin;
    }

        // criando metodo get 
    public function getLocal_gin(){
        return $this->local_gin;
    }

        // criando o metodo de set
        public function setStatus_gin($status_gin){
        $this->status_gin=$status_gin;
    }

        // criando metodo get 
    public function getStatus_gin(){
        return $this->status_gin;
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
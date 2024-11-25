<!-- Inicio do php -->
<?php

// criando a classe de equipés com seus atributos
class equipes {
    private $id_eq;
    private $nome_eq;
    private $sala_eq;
    private $ano_eq;
    private $tema_eq;
    private $cor_eq;
    private $extra_eq;
    private $status_eq;
    private $ult_us_atz;

    // criando o metodo construct com todos os atributos
    public function __construct($id_eq,$nome_eq,$sala_eq,$ano_eq,$tema_eq,$cor_eq,$extra_eq,$status_eq, $ult_us_atz){
        $this->id_eq= (int) $id_eq;
        $this->nome_eq= (string) $nome_eq;
        $this->sala_eq= (string) $sala_eq;
        $this->ano_eq= (string) $ano_eq;
        $this->tema_eq= (string) $tema_eq;
        $this->cor_eq= (string) $cor_eq;
        $this->extra_eq= (string) $extra_eq;
        $this->status_eq= (int) $status_eq;
        $this->ult_us_atz= (int) $ult_us_atz;
    }

        // criando o metodo de set
    public function setId_eq($id_eq){
        $this->id_eq=$id_eq;
    }

        // criando metodo get 
    public function getId_eq(){
        return $this->id_eq;
    }

        // criando o metodo de set
    public function setNome_eq($nome_eq){
        $this->nome_eq=$nome_eq;
    }

        // criando metodo get 
    public function getNome_eq(){
        return $this->nome_eq;
    }

        // criando o metodo de set
    public function setSala_eq($sala_eq){
        $this->sala_eq=$sala_eq;
    }

        // criando metodo get 
    public function getSala_eq(){
        return $this->sala_eq;
    }

        // criando o metodo de set
    public function setAno_eq($ano_eq){
        $this->ano_eq=$ano_eq;
    }

        // criando metodo get 
    public function getAno_eq(){
        return $this->ano_eq;
    }

        // criando o metodo de set
    public function setTema_eq($tema_eq){
        $this->tema_eq=$tema_eq;
    }

        // criando metodo get 
    public function getTema_eq(){
        return $this->tema_eq;
    }

    // criando o metodo de set
    public function setCor_eq($cor_eq){
        $this->cor_eq=$cor_eq;
    }

        // criando metodo get 
    public function getCor_eq(){
        return $this->cor_eq;
    }

    // criando o metodo de set
    public function setExtra_eq($extra_eq){
        $this->extra_eq=$extra_eq;
    }

        // criando metodo get 
    public function getExtra_eq(){
        return $this->extra_eq;
    }

         // criando o metodo de set
    public function setStatus_eq($status_eq){
        $this->status_eq=$status_eq;
    }

        // criando metodo get 
    public function getStatus_eq(){
        return $this->status_eq;
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
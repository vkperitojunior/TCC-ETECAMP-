<!-- Inicio do php -->
<?php

// criando a classe de historico com seus atributos
class Historico {
    private $id_hist;
    private $ano_hist;
    private $tema_hist;
    private $primeiro_lugar;
    private $segundo_lugar;
    private $terceiro_lugar;
    private $melhor_gincana;
    private $foto_hist;
    private $status_hist;
    private $ult_us_atz;

    // criando o metodo construct com todos os atributos
    public function __construct($id_hist,$ano_hist,$tema_hist,
    $primeiro_lugar,$segundo_lugar,$terceiro_lugar,$melhor_gincana,$foto_hist,$status_hist, $ult_us_atz){

        $this->id_hist= (int) $id_hist;
        $this->ano_hist=$ano_hist;
        $this->tema_hist= (string) $tema_hist;
        $this->primeiro_lugar=$primeiro_lugar;
        $this->segundo_lugar=$segundo_lugar;
        $this->terceiro_lugar=$terceiro_lugar;
        $this->melhor_gincana=$melhor_gincana;
        $this->foto_hist=$foto_hist;
        $this->status_hist= (int) $status_hist;
        $this->ult_us_atz= (int) $ult_us_atz;
    }

        // criando o metodo de set
    public function setId_hist($id_hist){
        $this->id_hist=$id_hist;
    }

        // criando metodo get 
    public function getId_hist(){
        return $this->id_hist;
    }

        // criando o metodo de set
    public function setAno_hist($ano_hist){
        $this->ano_hist=$ano_hist;
    }

        // criando metodo get 
    public function getAno_hist(){
        return $this->ano_hist;
    }

        // criando o metodo de set
    public function setTema_hist($tema_hist){
        $this->tema_hist=$tema_hist;
    }

        // criando metodo get 
    public function getTema_hist(){
        return $this->tema_hist;
    }

        // criando o metodo de set
    public function setPrimeiro_lugar($primeiro_lugar){
        $this->primeiro_lugar=$primeiro_lugar;
    }

        // criando metodo get 
    public function getPrimeiro_lugar(){
        return $this->primeiro_lugar;
    }

        // criando o metodo de set
    public function setSegundo_lugar($segundo_lugar){
        $this->segundo_lugar=$segundo_lugar;
    }

        // criando metodo get 
    public function getSegundo_lugar(){
        return $this->segundo_lugar;
    }

        // criando o metodo de set
    public function setTerceiro_lugar($terceiro_lugar){
        $this->terceiro_lugar=$terceiro_lugar;
    }

        // criando metodo get 
    public function getTerceiro_lugar(){
        return $this->terceiro_lugar;
    }

    // criando o metodo de set
    public function setMelhor_gincana($melhor_gincana){
        $this->melhor_gincana=$melhor_gincana;
    }

        // criando metodo get 
    public function getMelhorGincana(){
        return $this->melhor_gincana;
    }

         // criando o metodo de set
    public function setFoto_hist($foto_hist){
        $this->foto_hist=$foto_hist;
    }

        // criando metodo get 
    public function getFoto_hist(){
        return $this->foto_hist;
    }

        // criando o metodo de set
        public function setStatus_hist($status_hist){
        $this->status_hist=$status_hist;
    }

        // criando metodo get 
    public function getStatus_hist(){
        return $this->status_hist;
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
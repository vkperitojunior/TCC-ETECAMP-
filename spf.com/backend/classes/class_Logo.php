<!-- Inicio do php -->
<?php

// criando a classe de Logo com seus atributos
class Logo {
    private $id_lg;
    private $titulo_lg;
    private $ano_lg;
    private $arquivo_lg;
    private $ult_us_atz;

    // criando o metodo construct com todos os atributos
    public function __construct($id_lg,$titulo_lg,$ano_lg,
    $arquivo_lg, $ult_us_atz){

        $this->id_lg= (int) $id_lg;
        $this->titulo_lg=$titulo_lg;
        $this->ano_lg= (string) $ano_lg;
        $this->arquivo_lg=$arquivo_lg;
        $this->ult_us_atz= (int) $ult_us_atz;
    }

        // criando o metodo de set
    public function setid_lg($id_lg){
        $this->id_lg=$id_lg;
    }

        // criando metodo get 
    public function getid_lg(){
        return $this->id_lg;
    }

        // criando o metodo de set
    public function settitulo_lg($titulo_lg){
        $this->titulo_lg=$titulo_lg;
    }

        // criando metodo get 
    public function gettitulo_lg(){
        return $this->titulo_lg;
    }

        // criando o metodo de set
    public function setano_lg($ano_lg){
        $this->ano_lg=$ano_lg;
    }

        // criando metodo get 
    public function getano_lg(){
        return $this->ano_lg;
    }

        // criando o metodo de set
    public function setarquivo_lg($arquivo_lg){
        $this->arquivo_lg=$arquivo_lg;
    }

        // criando metodo get 
    public function getarquivo_lg(){
        return $this->arquivo_lg;
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
<!-- Inicio do php -->
<?php

// criando a classe de historico com seus atributos
class Img_graf {
    private $id_graf;
    private $nome_graf;
    private $arq_graf;
    private $data_graf;
    private $ult_us_atz;

    // criando o metodo construct com todos os atributos
    public function __construct($id_graf,$nome_graf,$arq_graf,
    $data_graf, $ult_us_atz){

        $this->id_graf= (int) $id_graf;
        $this->nome_graf=$nome_graf;
        $this->arq_graf= (string) $arq_graf;
        $this->data_graf=$data_graf;
        $this->ult_us_atz= (int) $ult_us_atz;
    }

        // criando o metodo de set
    public function setid_graf($id_graf){
        $this->id_graf=$id_graf;
    }

        // criando metodo get 
    public function getid_graf(){
        return $this->id_graf;
    }

        // criando o metodo de set
    public function setnome_graf($nome_graf){
        $this->nome_graf=$nome_graf;
    }

        // criando metodo get 
    public function getnome_graf(){
        return $this->nome_graf;
    }

        // criando o metodo de set
    public function setarq_graf($arq_graf){
        $this->arq_graf=$arq_graf;
    }

        // criando metodo get 
    public function getarq_graf(){
        return $this->arq_graf;
    }

        // criando o metodo de set
    public function setdata_graf($data_graf){
        $this->data_graf=$data_graf;
    }

        // criando metodo get 
    public function getdata_graf(){
        return $this->data_graf;
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
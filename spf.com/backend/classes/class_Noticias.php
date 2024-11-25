<!-- Inicio do php -->
<?php

// criando a classe de noticias com seus atributos
class Noticias {
    private $id_not;
    private $titulo_not;
    private $descricao_not;
    private $data_not;
    private $foto_not;
    private $status_not;
    private $ult_us_atz;

    // criando o metodo construct com todos os atributos
    public function __construct($id_not,$titulo_not,$descricao_not,
    $data_not,$foto_not,$status_not, $ult_us_atz){

        $this->id_not= (int) $id_not;
        $this->titulo_not= (string) $titulo_not;
        $this->descricao_not= (string) $descricao_not;
        $this->data_not=$data_not;
        $this->foto_not=$foto_not;
        $this->status_not= (int) $status_not;
        $this->ult_us_atz= (int) $ult_us_atz;
    }
 
        // criando o metodo de set
    public function setId_not($id_not){
        $this->id_not=$id_not;
    }

        // criando metodo get 
    public function getId_not(){
        return $this->id_not;
    }

        // criando o metodo de set
    public function setTitulo_not($titulo_not){
        $this->titulo_not=$titulo_not;
    }

        // criando metodo get 
    public function getTitulo_not(){
        return $this->titulo_not;
    }

        // criando o metodo de set
    public function setDescricao_not($descricao_not){
        $this->descricao_not=$descricao_not;
    }

        // criando metodo get 
    public function getDescricao_not(){
        return $this->descricao_not;
    }

        // criando o metodo de set
    public function setData_not($data_not){
        $this->data_not=$data_not;
    }

        // criando metodo get 
    public function getData_not(){
        return $this->data_not;
    }

        // criando o metodo de set
    public function setFoto_not($foto_not){
        $this->foto_not=$foto_not;
    }

        // criando metodo get 
    public function getFoto_not(){
        return $this->foto_not;
    }

        // criando o metodo de set
    public function setStatus_not($status_not){
        $this->status_not=$status_not;
    }

        // criando metodo get 
    public function getStatus_not(){
        return $this->status_not;
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
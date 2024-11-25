<!-- Inicio do php -->
<?php

// criando a classe de equipés com seus atributos
class Carrosel {
    private $id_cs;
    private $titulo_cs;
    private $ordem_cs;
    private $arquivo_cs;
    private $data_cs;
    private $status_cs;
    private $ult_us_atz;

    // criando o metodo construct com todos os atributos
    public function __construct($id_cs,$titulo_cs,$ordem_cs,$arquivo_cs,$data_cs,$status_cs, $ult_us_atz){
        $this->id_cs= (int) $id_cs;
        $this->titulo_cs= (string) $titulo_cs;
        $this->ordem_cs= (string) $ordem_cs;
        $this->arquivo_cs= (string) $arquivo_cs;
        $this->data_cs= (string) $data_cs;
        $this->status_cs= (int) $status_cs;
        $this->ult_us_atz= (int) $ult_us_atz;
    }

        // criando o metodo de set
    public function setid_cs($id_cs){
        $this->id_cs=$id_cs;
    }

        // criando metodo get 
    public function getid_cs(){
        return $this->id_cs;
    }

        // criando o metodo de set
    public function settitulo_cs($titulo_cs){
        $this->titulo_cs=$titulo_cs;
    }

        // criando metodo get 
    public function gettitulo_cs(){
        return $this->titulo_cs;
    }

        // criando o metodo de set
    public function setordem_cs($ordem_cs){
        $this->ordem_cs=$ordem_cs;
    }

        // criando metodo get 
    public function getordem_cs(){
        return $this->ordem_cs;
    }

        // criando o metodo de set
    public function setarquivo_cs($arquivo_cs){
        $this->arquivo_cs=$arquivo_cs;
    }

        // criando metodo get 
    public function getarquivo_cs(){
        return $this->arquivo_cs;
    }

        // criando o metodo de set
    public function setdata_cs($data_cs){
        $this->data_cs=$data_cs;
    }

        // criando metodo get 
    public function getdata_cs(){
        return $this->data_cs;
    }

         // criando o metodo de set
    public function setstatus_cs($status_cs){
        $this->status_cs=$status_cs;
    }

        // criando metodo get 
    public function getstatus_cs(){
        return $this->status_cs;
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
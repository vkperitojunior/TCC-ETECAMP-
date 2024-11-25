<!-- Inicio do php -->
<?php

// criando a classe de Temas com seus atributos
class Temas {
    private $id_tema;
    private $tema_tm;
    private $motivacao_tm;
    private $primeiro_ano;
    private $status_tm;
    private $ult_us_atz;


    // criando o metodo construct com todos os atributos
    public function __construct(

    $id_tema,
    $tema_tm,
    $motivacao_tm,
    $primeiro_ano,
    $status_tm,
    $ult_us_atz

    ){

        $this->id_tema= (int) $id_tema;
        $this->tema_tm= (string) $tema_tm;
        $this->motivacao_tm= (string) $motivacao_tm;
        $this->primeiro_ano=$primeiro_ano;
        $this->status_tm= (int) $status_tm;
        $this->ult_us_atz= (int) $ult_us_atz;
    }

        // criando o metodo de set
    public function setid_tema($id_tema){
        $this->id_tema=$id_tema;
    }

        // criando metodo get 
    public function getid_tema(){
        return $this->id_tema;
    }

        // criando o metodo de set
    public function settema_tm($tema_tm){
        $this->tema_tm=$tema_tm;
    }

        // criando metodo get 
    public function gettema_tm(){
        return $this->tema_tm;
    }

        // criando o metodo de set
    public function setmotivacao_tm($motivacao_tm){
        $this->motivacao_tm=$motivacao_tm;
    }

        // criando metodo get 
    public function getmotivacao_tm(){
        return $this->motivacao_tm;
    }

        // criando o metodo de set
    public function setprimeiro_ano($primeiro_ano){
        $this->primeiro_ano=$primeiro_ano;
    }

        // criando metodo get 
    public function getprimeiro_ano(){
        return $this->primeiro_ano;
    }

        // criando o metodo de set
    public function setstatus_tm($status_tm){
        $this->status_tm=$status_tm;
    }

        // criando metodo get 
    public function getstatus_tm(){
        return $this->status_tm;
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
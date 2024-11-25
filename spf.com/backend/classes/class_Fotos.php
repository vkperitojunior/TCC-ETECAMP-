<!-- Inicio do php -->
<?php

// criando a classe de fotos com seus atributos
class Fotos {
    private $id_foto;
    private $titulo_foto;
    private $descricao_foto;
    private $ano_foto;
    private $arquivo_foto;
    private $status_foto;
    private $ult_us_atz;

    // criando o metodo construct com todos os atributos
    public function __construct(

    $id_foto,
    $titulo_foto,
    $descricao_foto,
    $ano_foto,
    $arquivo_foto,
    $status_foto,
    $ult_us_atz
    
    ){

        $this->id_foto= (int) $id_foto;
        $this->titulo_foto= (string) $titulo_foto;
        $this->descricao_foto= (string) $descricao_foto;
        $this->ano_foto=$ano_foto;
        $this->arquivo_foto=$arquivo_foto;
        $this->status_foto= (int) $status_foto;
        $this->ult_us_atz= (int) $ult_us_atz;
    }

        // criando o metodo de set
    public function setId_foto($id_foto){
        $this->id_foto=$id_foto;
    }

        // criando metodo get 
    public function getid_foto(){
        return $this->id_foto;
    }

        // criando o metodo de set
    public function setTitulo_foto($titulo_foto){
        $this->titulo_foto=$titulo_foto;
    }

        // criando metodo get 
    public function getTitulo_foto(){
        return $this->titulo_foto;
    }

        // criando o metodo de set
    public function setDescricao_foto($descricao_foto){
        $this->descricao_foto=$descricao_foto;
    }

        // criando metodo get 
    public function getDescricao_foto(){
        return $this->descricao_foto;
    }

        // criando o metodo de set
    public function setAno_foto($ano_foto){
        $this->ano_foto=$ano_foto;
    }

        // criando metodo get 
    public function getAno_foto(){
        return $this->ano_foto;
    }

        // criando o metodo de set
    public function setArquivo_foto($arquivo_foto){
        $this->arquivo_foto=$arquivo_foto;
    }

        // criando metodo get 
    public function getArquivo_foto(){
        return $this->arquivo_foto;
    }

        // criando o metodo de set
    public function setStatus_foto($status_foto){
        $this->status_foto=$status_foto;
    }

        // criando metodo get 
    public function getStatus_foto(){
        return $this->status_foto;
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
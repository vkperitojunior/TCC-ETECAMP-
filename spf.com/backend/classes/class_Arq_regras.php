<!-- Inicio do php -->
<?php

// criando a classe dos arquivos de regras da paulo freire com seus atributos
class Arq_regras {
    private $id_pdfregra;
    private $gincana_id;
    private $titulo_pdfregra;
    private $desc_pdfregra;
    private $arquivo_pdfregra;
    private $status_pdfregra;
    private $ult_us_atz;

    // criando o metodo construct com todos os atributos
    public function __construct($id_pdfregra,$gincana_id,$titulo_pdfregra,$desc_pdfregra,$arquivo_pdfregra,$status_pdfregra, $ult_us_atz){
        $this->id_pdfregra= (int) $id_pdfregra;
        $this->gincana_id= (int) $gincana_id;
        $this->titulo_pdfregra= (string) $titulo_pdfregra;
        $this->desc_pdfregra= (string) $desc_pdfregra;
        $this->arquivo_pdfregra=$arquivo_pdfregra;
        $this->status_pdfregra= (int) $status_pdfregra;
        $this->ult_us_atz= (int) $ult_us_atz;
    }

        // criando o metodo de set
    public function setId_pdfregra($id_pdfregra){
        $this->id_pdfregra=$id_pdfregra;
    }

        // criando metodo get 
    public function getId_pdfregra(){
        return $this->id_pdfregra;
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
    public function setTitulo_pdfregra($titulo_pdfregra){
        $this->titulo_pdfregra=$titulo_pdfregra;
    }

        // criando metodo get 
    public function getTitulo_pdfregra(){
        return $this->titulo_pdfregra;
    }

        // criando o metodo de set
    public function setDesc_pdfregra($desc_pdfregra){
        $this->desc_pdfregra=$desc_pdfregra;
    }

        // criando metodo get 
    public function getDesc_pdfregra(){
        return $this->desc_pdfregra;
    }

        // criando o metodo de set
    public function setArquivo_pdfregra($arquivo_pdfregra){
        $this->arquivo_pdfregra=$arquivo_pdfregra;
    }

        // criando metodo get 
    public function getArquivo_pdfregra(){
        return $this->arquivo_pdfregra;
    }

        // criando o metodo de set
    public function setStatus_pdfregra($status_pdfregra){
        $this->status_pdfregra=$status_pdfregra;
    }

        // criando metodo get 
    public function getStatus_pdfregra(){
        return $this->status_pdfregra;
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
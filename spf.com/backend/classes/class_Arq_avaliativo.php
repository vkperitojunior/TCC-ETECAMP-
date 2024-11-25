<!-- Inicio do php -->
<?php
// criando a classe de arquivos das regras de avaliação com seus atributos
class Arq_avaliativo {
    private $id_pdfavaliativo;
    private $gincana_id;
    private $titulo_pdfavaliativo;
    private $desc_pdfavaliativo;
    private $arquivo_pdfavaliativo;
    private $status_pdfavaliativo;
    private $ult_us_atz;

    // criando o metodo construct com todos os atributos
    public function __construct($id_pdfavaliativo,$gincana_id,$titulo_pdfavaliativo,$desc_pdfavaliativo,$arquivo_pdfavaliativo,$status_pdfavaliativo, $ult_us_atz){
        $this->id_pdfavaliativo= (int) $id_pdfavaliativo;
        $this->gincana_id= (int) $gincana_id;
        $this->titulo_pdfavaliativo= (string) $titulo_pdfavaliativo;
        $this->desc_pdfavaliativo= (string) $desc_pdfavaliativo;
        $this->arquivo_pdfavaliativo=$arquivo_pdfavaliativo;
        $this->status_pdfavaliativo= (int) $status_pdfavaliativo;
        $this->ult_us_atz= (int) $ult_us_atz;
    }

        // criando o metodo de set
    public function setId_pdfavaliativo($id_pdfavaliativo){
        $this->id_pdfavaliativo=$id_pdfavaliativo;
    }

        // criando metodo get 
    public function getId_pdfavaliativo(){
        return $this->id_pdfavaliativo;
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
    public function setTitulo_pdfavaliativo($titulo_pdfavaliativo){
        $this->titulo_pdfavaliativo=$titulo_pdfavaliativo;
    }

        // criando metodo get 
    public function geTtitulo_pdfavaliativo(){
        return $this->titulo_pdfavaliativo;
    }

        // criando o metodo de set
    public function setDesc_pdfavaliativo($desc_pdfavaliativo){
        $this->desc_pdfavaliativo=$desc_pdfavaliativo;
    }

        // criando metodo get 
    public function getDesc_pdfavaliativo(){
        return $this->desc_pdfavaliativo;
    }

        // criando o metodo de set
    public function setArquivo_pdfavaliativo($arquivo_pdfavaliativo){
        $this->arquivo_pdfavaliativo=$arquivo_pdfavaliativo;
    }

        // criando metodo get 
    public function getArquivo_pdfavaliativo(){
        return $this->arquivo_pdfavaliativo;
    }

        // criando o metodo de set
    public function setStatus_pdfavaliativo($status_pdfavaliativo){
        $this->status_pdfavaliativo=$status_pdfavaliativo;
    }

        // criando metodo get 
    public function getStatus_pdfavaliativo(){
        return $this->status_pdfavaliativo;
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
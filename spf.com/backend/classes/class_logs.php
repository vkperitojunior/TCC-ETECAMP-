<!-- Inicio do php -->
<?php

// criando a classe de logs com seus atributos
class log{
    private $id_log;
    private $titulo_log;
    private $descricao_log;
    private $sessao_log;
    private $ip_log;
    private $geolocalizacao_log;
    private $hora_log;
    private $data_log;
    private $usuario_id;
    private $usuario_email;

    // criando o metodo construct com todos os atributos
    public function __construct($id_log,$titulo_log,$descricao_log,
    $sessao_log,$ip_log,$geolocalizacao_log,$hora_log,$data_log,$usuario_id,$usuario_email){

        $this->id_log= $id_log;
        $this->titulo_log= $titulo_log;
        $this->descricao_log=  $descricao_log;
        $this->sessao_log= $sessao_log;
        $this->ip_log= $ip_log;
        $this->geolocalizacao_log=$geolocalizacao_log;
        $this->hora_log=$hora_log;
        $this->data_log=$data_log;
        $this->usuario_id= $usuario_id;
        $this->usuario_email= $usuario_email;
    }

        // criando o metodo de set
    public function setId_log($id_log){
        $this->id_log=$id_log;
    }

        // criando metodo get 
    public function getId_log(){
        return $this->id_log;
    }

        // criando o metodo de set
    public function setTitulo_log($titulo_log){
        $this->titulo_log=$titulo_log;
    }

        // criando metodo get 
    public function getTitulo_log(){
        return $this->titulo_log;
    }

        // criando o metodo de set
    public function setDescricao_log($descricao_log){
        $this->descricao_log=$descricao_log;
    }

        // criando metodo get 
    public function getDescricao_log(){
        return $this->descricao_log;
    }

        // criando o metodo de set
    public function setSessao_log($sessao_log){
        $this->sessao_log=$sessao_log;
    }

        // criando metodo get 
    public function getSessao_log(){
        return $this->sessao_log;
    }

    // criando o metodo de set
    public function setIp_log($ip_log){
        $this->ip_log=$ip_log;
    }

        // criando metodo get 
    public function getIp_log(){
        return $this->ip_log;
    }

        // criando o metodo de set
    public function setGeolocalizacao_log($geolocalizacao_log){
        $this->geolocalizacao_log=$geolocalizacao_log;
    }

        // criando metodo get 
    public function getGeolocalizacao_log(){
        return $this->geolocalizacao_log;
    }

        // criando o metodo de set
    public function setHora_log($hora_log){
        $this->hora_log=$hora_log;
    }

        // criando metodo get 
    public function getHora_log(){
        return $this->hora_log;
    }

    // criando o metodo de set
    public function setData_log($data_log){
        $this->data_log=$data_log;
    }

    // criando o metodo de set
    public function getData_log(){
        return $this->data_log;
    }

         // criando o metodo de set
    public function setUsuario_id($usuario_id){
        $this->usuario_id=$usuario_id;
    }

        // criando metodo get 
    public function getUsuario_id(){
        return $this->usuario_id;
    }

        // criando o metodo de set
        public function setUsuario_email($usuario_email){
        $this->usuario_email=$usuario_email;
    }

        // criando metodo get 
    public function getUsuario_email(){
        return $this->usuario_email;
    }

    // FIm do php e da classe
    // não precisa declarar fim por só ter php
}
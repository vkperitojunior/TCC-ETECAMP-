<!-- Inicio do php -->
<?php

// criando a classe de usuários com seus atributos
class usuario {
    private $id_us;
    private $nome_us;
    private $email_us;
    private $senha_us;
    private $foto_us;
    private $funcao_us;
    private $funcao_no_evento;
    private $status_us;

    // criando o metodo construct com todos os atributos
    public function __construct($id_us,$nome_us,$email_us,$senha_us,$foto_us,$funcao_us,$funcao_no_evento,$status_us){
        $this->id_us= (int) $id_us;
        $this->nome_us= (string) $nome_us;
        $this->email_us= (string) $email_us;
        $this->senha_us=$senha_us;
        $this->foto_us=$foto_us;
        $this->funcao_us= (int) $funcao_us;
        $this->funcao_no_evento=$funcao_no_evento;
        $this->status_us= (int) $status_us;
    }

        // criando o metodo de set
    public function setId_us($id_us){
        $this->id_us=$id_us;
    }

        // criando metodo get 
    public function getId_us(){
        return $this->id_us;
    }

        // criando o metodo de set
    public function setNome_us($nome_us){
        $this->nome_us=$nome_us;
    }

        // criando metodo get 
    public function getNome_us(){
        return $this->nome_us;
    }

        // criando o metodo de set
    public function setEmail_us($email_us){
        $this->email_us=$email_us;
    }

        // criando metodo get 
    public function getEmail_us(){
        return $this->email_us;
    }

        // criando o metodo de set
    public function setSenha_us($senha_us){
        $this->senha_us=$senha_us;
    }

        // criando metodo get 
    public function getSenha_us(){
        return $this->senha_us;
    }

        // criando o metodo de set
    public function setFoto_us($foto_us){
        $this->foto_us=$foto_us;
    }

        // criando metodo get 
    public function getFoto_us(){
        return $this->foto_us;
    }

        // criando o metodo de set
    public function setFuncao_us($funcao_us){
        $this->funcao_us=$funcao_us;
    }

        // criando metodo get 
    public function getFuncao_us(){
        return $this->funcao_us;
    }

    // criando o metodo de set
    public function setFuncao_no_evento($funcao_no_evento){
        $this->funcao_no_evento=$funcao_no_evento;
    }

        // criando metodo get 
    public function getFuncao_no_evento(){
        return $this->funcao_no_evento;
    }

         // criando o metodo de set
    public function setStatus_us($status_us){
        $this->status_us=$status_us;
    }

        // criando metodo get 
    public function getStatus_us(){
        return $this->status_us;
    }

    // FIm do php e da classe
    // não precisa declarar fim por só ter php
}
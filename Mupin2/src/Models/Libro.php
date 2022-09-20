<?php
declare (strict_types=1);
namespace Mupin\Models;

class Libro{
    private string $id_catalogo;
    private string $titolo;
    private string $autori;
    private string $casa_editrice;
    private int $anno;
    private int $num_pagine;
    private string $isbn;
    private string $note;
    private string $url;
    private string $tag;

    // Getters
    public function getIdCatalogo(){
        return $this->id_catalogo;
    }
    public function getTitolo(){
        return $this->titolo;
    }
    public function getAutori(){
        return $this->autori;
    }
    public function getCasaEditrice(){
        return $this->casa_editrice;
    }
    public function getAnno(){
        return $this->anno;
    }
    public function getNumPagine(){
        return $this->num_pagine;
    }
    public function getIsbn(){
        return $this->isbn;
    }
    public function getNote(){
        return $this->note;
    }
    public function getUrl(){
        return $this->url;
    }
    public function getTag(){
        return $this->tag;
    }

    // Setters
    public function setIdCatalogo($input){
        $this->id_catalogo = $input;
    }
    public function setTitolo($input){
    $this->titolo=$input;        
    }
    public function setAutori($input){
    $this->autori=$input;        
    }
    public function setCasaEditrice($input){
        $this->casa_editrice=$input;
    }
    public function setAnno($input){
        $this->anno = $input;
    }
    public function setNumPagine($input){
        $this->num_pagine=$input;
    }
    public function setIsbn($input){
        $this->isbn=$input;
    }
    public function setNote($input){
        $this->note = $input;
    }
    public function setUrl($input){
        $this->url = $input;
    }
    public function setTag($input){
        $this->tag = $input;
    }

}
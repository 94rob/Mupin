<?php
declare (strict_types=1);
namespace App\Models;

class Libro extends Model{    
    public string $titolo;
    public string $autori;
    public string $casa_editrice;
    public int $anno;
    public int $num_pagine;
    public string $isbn;
    public string $note;
    public string $url;
    public string $tag;

    // Getters    
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
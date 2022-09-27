<?php
declare (strict_types=1);
namespace App\Models;

class Rivista{
    public string $id_catalogo;
    public string $titolo;
    public int $numero_rivista;
    public int $anno;
    public string $casa_editrice;    
    public string $note;
    public string $url;
    public string $tag;

    // Getters    
    public function getIdCatalogo(){
        return $this->id_catalogo;
    }
    public function getTitolo()
    {
        return $this->titolo;
    }
    public function getNumeroRivista()
    {
        return $this->numero_rivista;
    }
    public function getAnno()
    {
        return $this->anno;
    }
    public function getCasaEditrice()
    {
        return $this->casa_editrice;
    }
    public function getNote()
    {
        return $this->note;
    }
    public function getUrl()
    {
        return $this->url;
    }
    public function getTag()
    {
        return $this->tag;
    }

    // Setters   
    public function setIdCatalogo($input){
        $this->id_catalogo = $input;
    }
    public function setTitolo($titolo)
    {
        $this->titolo = $titolo;
        return $this;
    }
    public function setNumeroRivista($input)
    {
        if(gettype($input) != "int"){
            $input = (int)$input;
        }
        $this->numero_rivista = $input;
        return $this;
    }
    public function setAnno($input)
    {
        if(gettype($input) != "int"){
            $input = (int)$input;
        }
        $this->anno = $input;
        return $this;
    }
    public function setCasaEditrice($casa_editrice)
    {
        $this->casa_editrice = $casa_editrice;
        return $this;
    }
    public function setNote($note)
    {
        $this->note = $note;
        return $this;
    }
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }
    public function setTag($tag)
    {
        $this->tag = $tag;
        return $this;
    }

    // Utils
    public function __isset($property){
        return isset($this->$property);
    } 

    public function equalsTo(Rivista $model): bool{
        if($this->id_catalogo == $model->getIdCatalogo()){
            return true;
        }
        return false;
    }

}
<?php
declare (strict_types=1);
namespace App\Models;

class Rivista{
    public string $id_catalogo;
    public string $titolo;
    public int $num_rivista;
    public int $anno;
    public string $casa_editrice;    
    public string $note;
    public string $url;
    public string $tag;

    // Getters
    public function getId_catalogo()
    {
        return $this->id_catalogo;
    }
    public function getTitolo()
    {
        return $this->titolo;
    }
    public function getNum_rivista()
    {
        return $this->num_rivista;
    }
    public function getAnno()
    {
        return $this->anno;
    }
    public function getCasa_editrice()
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
    public function setId_catalogo($id_catalogo)
    {
        $this->id_catalogo = $id_catalogo;

        return $this;
    }
    public function setTitolo($titolo)
    {
        $this->titolo = $titolo;

        return $this;
    }
    public function setNum_rivista($num_rivista)
    {
        $this->num_rivista = $num_rivista;

        return $this;
    }
    public function setAnno($anno)
    {
        $this->anno = $anno;

        return $this;
    }
    public function setCasa_editrice($casa_editrice)
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
}
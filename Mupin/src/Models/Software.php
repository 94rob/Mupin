<?php
declare (strict_types=1);
namespace App\Models;

class Software{
    private string $id_catalogo;
    private string $titolo;
    private string $sistema_operativo;
    private string $tipologia;    
    private string $supporto;
    private string $note;
    private string $url;
    private string $tag;
    
    // Getter
    public function getId_catalogo()
    {
        return $this->id_catalogo;
    }
    public function getTitolo()
    {
        return $this->titolo;
    }
    public function getSistema_operativo()
    {
        return $this->sistema_operativo;
    }
    public function getTipologia()
    {
        return $this->tipologia;
    }
    public function getSupporto()
    {
        return $this->supporto;
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
    
    // Setter
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
    public function setSistema_operativo($sistema_operativo)
    {
        $this->sistema_operativo = $sistema_operativo;

        return $this;
    }
    public function setTipologia($tipologia)
    {
        $this->tipologia = $tipologia;

        return $this;
    }    
    public function setSupporto($supporto)
    {
        $this->supporto = $supporto;

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
} 
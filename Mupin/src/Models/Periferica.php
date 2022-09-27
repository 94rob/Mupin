<?php
declare (strict_types=1);
namespace App\Models;

class Periferica extends Model{
    public string $modello;
    public string $tipologia;    
    public string $note;
    public string $url;
    public string $tag;
        
    // Getter    
    public function getModello()
    {
        return $this->modello;
    }
    public function getTipologia()
    {
        return $this->tipologia;
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
    public function setModello($modello)
    {
        $this->modello = $modello;

        return $this;
    }    
    public function setTipologia($tipologia)
    {
        $this->tipologia = $tipologia;

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
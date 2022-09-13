<?php
declare (strict_types=1);
namespace Mupin\Models;

class Computer{
    public string $id_catalogo;
    public string $modello;
    public int $anno;
    public string $cpu;
    public float $velocita_cpu;
    public int $memoria_ram;
    public int $dimensione_hard_disk;
    public string $sistema_operativo;
    public string $note;
    public string $url;
    public string $tag;      
      

    // Getter
    public function getIdCatalogo(){
        return $this->id_catalogo;
    }
    public function getModello(){
        return $this->modello;
    }
    public function getAnno(){
        return $this->anno;
    }
    public function getCpu(){
        return $this->cpu;
    }
    public function getVelocitaCpu(){
        return $this->velocita_cpu;
    }
    public function getMemoriaRAM(){
        return $this->memoria_ram;
    }
    public function getDimensioneHardDisk(){
        return $this->dimensione_hard_disk;
    }
    public function getSistemaOperativo(){
        return $this->sistema_operativo;
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

    // Setter
    public function setIdCatalogo($input){
        $this->id_catalogo = $input;
    }
    public function setModello($input){
         $this->modello = $input;
    }
    public function setAnno($input){
        $this->anno = $input;
    }
    public function setCpu($input){
        $this->cpu = $input;
    }
    public function setVelocitaCpu($input){
        $this->velocita_cpu = $input;
    }
    public function setMemoriaRAM($input){
        $this->memoria_ram = $input;
    }
    public function setDimensioneHardDisk($input){
        $this->dimensione_hard_disk = $input;
    }
    public function setSistemaOperativo($input){
        $this->sistema_operativo = $input;
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

    // Utils
    public function __isset($property){
        return isset($this->$property);
    } 


}
<?php
declare (strict_types=1);
namespace App\Models;

class Model{

    public string $id_catalogo;

    public function getIdCatalogo(){
        return $this->id_catalogo;
    }
    public function setIdCatalogo($input){
        $this->id_catalogo = $input;
    }

    // Utils
    public function __isset($property){
        return isset($this->$property);
    } 

    public function equalsTo(Model $model): bool{
        if($this->id_catalogo == $model->getIdCatalogo()){
            return true;
        }
        return false;
    }
}
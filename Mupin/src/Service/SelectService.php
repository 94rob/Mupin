<?php

declare(strict_types=1);

namespace App\Service;

require 'vendor/autoload.php';

class SelectService extends ModelService{
    // SELECT
    public function selectAllCatalogo(){
        $response_array = [];
        foreach($this->tables as $table){
            $result = $this->selectAllFromTable($table);
            $response_array[$table] = $this->fromArrayToModelArray($result, $table);
        }
        
        return $response_array;
    }

    public function selectAllFromTable(string $table){        
        $result = $this->selectRepo->selectAllFromTable($table);
        $response_array[$table] = $this->fromArrayToModelArray($result, $table); 
        return $response_array;
    }

    public function selectAllCatalogoByInput(string $input){
        $response_array = [];                       
        foreach($this->tables as $table){            
            $result = $this->selectRepo->selectFromTableWhereWhateverLikeInput($input, $table);
            $response_array[$table] = $this->fromArrayToModelArray($result, $table);
        }               
        return $response_array;
    }

    public function selectById(string $id, string $table){        
        $result = $this->selectRepo->selectWhereColumnLikeInput($table, "ID_CATALOGO", $id); 
        return $this->fromArrayToModelArray($result, $table);        
    }

    public function executeSelect(string $tabella, string $input, array $selettori){        
        $response_array = [];
        
        // NO INPUT -> Ritorna l'intera tabella
        if($input === ""){
            return $this->selectAllFromTable($tabella);              
        }

        // NO SELETTORI
        if (empty($selettori)) {            
            $result = $this->selectRepo->selectFromTableWhereWhateverLikeInput($input, $tabella);             
            $response_array[$tabella] = $this->fromArrayToModelArray($result, $tabella);
            return $response_array; 
        }

        //// SI SELETTORI
        // trovo le colonne della tabella 
        $columns = $this->utils->getColumnsByModelName($tabella);             

        if(in_array("modello-titolo", $selettori)){
            array_push($selettori, "modello");
            array_push($selettori, "titolo");
        }

        // Eseguo la ricerca per selettori solo se sono anche colonne della tabella corrispondente
        foreach($selettori as $selettore){
            if(in_array($this->utils->stringToColumnName($selettore), $columns)){
                $result = $this->selectRepo->selectWhereColumnLikeInput($tabella, $selettore, $input);
                $item_result = $this->fromArrayToModelArray($result, $tabella);
                $response_array[$tabella] =$this->pushInArrayIfNew($item_result, []);                  
                return $response_array;                  
            }
        }               
    }
}
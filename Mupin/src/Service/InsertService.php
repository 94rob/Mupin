<?php

declare(strict_types=1);

namespace App\Service;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require 'vendor/autoload.php';

class InsertService extends ModelService{             
    public function insertItemIntoTable(array $post, string $table, array $files): int
    {
        $id = $_POST["id-catalogo"];
        $log = new Logger('insert');
        $log->pushHandler(new StreamHandler('./public/log/file.log', Logger::INFO));
        // controllo l'input
        $inputCheck = $this->insertInputValidation($post, $table);
        if($inputCheck != 1){ 
            $log->info("User " . $_SESSION["user"] . " failed to add item " . $id . "(" . ucfirst($table) . ")");   
            return $inputCheck; 
        }

        // popolo l'array dei valori da inserire, trasformo l'array in oggetto e lo inserisco nel DB
        $arrayColumnNotEmpty = [];
        foreach($post as $key => $value){
            $columnName = $this->utils->stringToColumnName($key);
            $arrayColumnNotEmpty[$columnName] = $value;                
        }           

        $item = $this->fromArrayToModel($arrayColumnNotEmpty, $table);
        
        $querySuccess = $this->insertRepo->insertItemIntoTable($item, $table);
        
        // Se la insert ha avuto successo, inserisce l'immagine qualora ci sia        
        if($querySuccess){   
            $log->info("User " . $_SESSION["user"] . " added item " . $id . "(" . ucfirst($table) . ")");   
            $this->imageService->insertImage($files, $id);
            return 1;
        }   
        $log->info("User " . $_SESSION["user"] . " failed to add item " . $id . "(" . ucfirst($table) . ")");   
        return 0;       
    }

    public function insertInputValidation(array $post, string $table): int{
        $id = $_POST["id-catalogo"];

        $post_cols = $this->utils->fromArrayToColumnArray($post);
        
        // controllo che l'id catalogo non sia già registrato        
        $check = $this->selectRepo->selectWhereColumnLikeInput($table,"ID_CATALOGO", $id);
        if(!empty($check)){            
            return 2;
        }

        $notNullableColumns = [];
        $cols = $this->selectRepo->selectNotNullableColumnsName($table);
        foreach($cols as $column){
            array_push($notNullableColumns, $column["COLUMN_NAME"]);
        }
        
        foreach($notNullableColumns as $col){
            if(!array_key_exists($col, $post_cols)){
                return 3;
            }
        }
        return 1;        
    }
}
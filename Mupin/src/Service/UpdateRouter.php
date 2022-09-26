<?php

declare(strict_types=1);

namespace App\Service;
use App\Service\Implementations;

require 'vendor/autoload.php';



class UpdateRouter
{

    public Implementations\ComputerService $computerService;
    public Implementations\LibroService $libroService;
    public Implementations\PerifericaService $perifericaService;
    public Implementations\RivistaService $rivistaService;
    public Implementations\SoftwareService $softwareService;

    public function __construct()
    {
        $this->computerService = new Implementations\ComputerService();
        $this->libroService = new Implementations\LibroService();
        $this->perifericaService = new Implementations\PerifericaService();
        $this->rivistaService = new Implementations\RivistaService();
        $this->softwareService = new Implementations\SoftwareService();
    }

    public function selectRightQuery(string $tabella, string $idCatalogo, array $post): bool{

        switch($tabella){

            case("computer"):
                foreach($post as $key => $value){
                    //update solo se c'è un valore
                    if($value != ""){
                        $column = str_replace("-", "_", strtoupper($key));
                        $this->computerService->updateColumnByIdCatalogo($column, $idCatalogo, $value); 
                    }                                       
                }
                return true;                

            case("libro"):
                foreach($post as $key => $value){
                    //update solo se c'è un valore
                    if($value != ""){
                        $column = str_replace("-", "_", strtoupper($key));
                        $this->libroService->updateColumnByIdCatalogo($column, $idCatalogo, $value); 
                    }                                       
                }
                return true;  

            case("rivista"):
                foreach($post as $key => $value){
                    //update solo se c'è un valore
                    if($value != ""){
                        $column = str_replace("-", "_", strtoupper($key));
                        $this->rivistaService->updateColumnByIdCatalogo($column, $idCatalogo, $value); 
                    }                                       
                }
                return true;  

            case("software"):
                foreach($post as $key => $value){
                    //update solo se c'è un valore
                    if($value != ""){
                        $column = str_replace("-", "_", strtoupper($key));
                        $this->softwareService->updateColumnByIdCatalogo($column, $idCatalogo, $value); 
                    }                                       
                }
                return true;  

            case("periferica"):
                foreach($post as $key => $value){
                    //update solo se c'è un valore
                    if($value != ""){
                        $column = str_replace("-", "_", strtoupper($key));
                        $this->perifericaService->updateColumnByIdCatalogo($column, $idCatalogo, $value); 
                    }                                       
                }
                return true;  
                
            default:
                return false;
        }     
    }
}

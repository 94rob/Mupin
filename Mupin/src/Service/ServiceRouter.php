<?php
declare (strict_types=1);
namespace App\Service;
require 'vendor/autoload.php';



class ServiceRouter{

    public ComputerService $computerService;
    public LibroService $libroService;
    public PerifericaService $perifericaService;
    public RivistaService $rivistaService;
    public SoftwareService $softwareService;

    public function __construct(){
        $this->computerService = new ComputerService();        
        $this->libroService = new LibroService();
        $this->perifericaService = new PerifericaService();
        $this->rivistaService = new RivistaService();
        $this->softwareService = new SoftwareService();        
    }

    public function find($cosa_cercare, string $dove_cercare, array $selettori): array{

        switch($dove_cercare){

            case("ovunque"):                
                $response_array["computer"] = $this->computerService->selectFromComputerWhere($cosa_cercare);
                $response_array["libro"] = $this->libroService->selectFromLibroWhere($cosa_cercare);
                $response_array["rivista"] = $this->rivistaService->selectFromRivistaWhere($cosa_cercare);
                $response_array["periferica"] = $this->perifericaService->selectFromPerifericaWhere($cosa_cercare);
                $response_array["software"] = $this->softwareService->selectFromSoftwareWhere($cosa_cercare);

                return $response_array;

            case("computer"):
                $response_array["computer"] = [];
                if(in_array("modello-titolo", $selettori)){
                    $result = $this->computerService->selectByModello($cosa_cercare);
                   $response_array["computer"] = $this->pushInArrayIfNew($result, $response_array["computer"]);
                }
                if(in_array("anno", $selettori)){
                    $result = $this->computerService->selectByAnno((int)$cosa_cercare);
                    $response_array["computer"] = $this->pushInArrayIfNew($result, $response_array["computer"]);
                }
                if(in_array("sistema-operativo", $selettori)){
                    $result = $this->computerService->selectBySistemaOperativo($cosa_cercare);
                    $response_array["computer"] = $this->pushInArrayIfNew($result, $response_array["computer"]);
                }
                if(in_array("note", $selettori)){
                    $result = $this->computerService->selectByNote($cosa_cercare);
                    $response_array["computer"] = $this->pushInArrayIfNew($result, $response_array["computer"]);
                }
                if(in_array("tag", $selettori)){
                    $result = $this->computerService->selectByTag($cosa_cercare);
                    $response_array["computer"] = $this->pushInArrayIfNew($result, $response_array["computer"]);
                }

                return $response_array;                

            case("libro"):
                $response_array["libro"] = [];
                if(in_array("modello-titolo", $selettori)){
                    $result = $this->libroService->selectByTitolo($cosa_cercare);
                   $response_array["libro"] = $this->pushInArrayIfNew($result, $response_array["libro"]);
                }
                if(in_array("autore", $selettori)){
                    $result = $this->libroService->selectByAutore($cosa_cercare);
                    $response_array["libro"] = $this->pushInArrayIfNew($result, $response_array["libro"]);
                }
                if(in_array("anno", $selettori)){
                    $result = $this->libroService->selectByAnno((int)$cosa_cercare);
                    $response_array["libro"] = $this->pushInArrayIfNew($result, $response_array["libro"]);
                }
                if(in_array("casa-editrice", $selettori)){
                    $result = $this->libroService->selectByCasaEditrice($cosa_cercare);
                    $response_array["libro"] = $this->pushInArrayIfNew($result, $response_array["libro"]);
                }
                if(in_array("note", $selettori)){
                    $result = $this->libroService->selectByNote($cosa_cercare);
                    $response_array["libro"] = $this->pushInArrayIfNew($result, $response_array["libro"]);
                }
                if(in_array("tag", $selettori)){
                    $result = $this->libroService->selectByTag($cosa_cercare);
                    $response_array["libro"] = $this->pushInArrayIfNew($result, $response_array["libro"]);
                }

                return $response_array; 

            case("periferica"):
                $response_array["periferica"] = [];                
                if(in_array("modello-titolo", $selettori)){
                    $result = $this->perifericaService->selectByModello($cosa_cercare);
                    $response_array["periferica"] = $this->pushInArrayIfNew($result, $response_array["periferica"]);
                }
                if(in_array("note", $selettori)){
                    $result = $this->perifericaService->selectByNote($cosa_cercare);
                    $response_array["periferica"] = $this->pushInArrayIfNew($result, $response_array["periferica"]);
                }
                if(in_array("tag", $selettori)){
                    $result = $this->perifericaService->selectByTag($cosa_cercare);
                    $response_array["periferica"] = $this->pushInArrayIfNew($result, $response_array["periferica"]);
                }
                return $response_array; 

            case("rivista"):
                $response_array["rivista"] = []; 
                if(in_array("modello-titolo", $selettori)){
                    $result = $this->rivistaService->selectByTitolo($cosa_cercare);
                    $response_array["rivista"] = $this->pushInArrayIfNew($result, $response_array["rivista"]);
                }
                if(in_array("anno", $selettori)){
                    $result = $this->rivistaService->selectByAnno((int)$cosa_cercare);
                    $response_array["rivista"] = $this->pushInArrayIfNew($result, $response_array["rivista"]);
                }
                if(in_array("casa-editrice", $selettori)){
                    $result = $this->rivistaService->selectByCasaEditrice($cosa_cercare);
                    $response_array["rivista"] = $this->pushInArrayIfNew($result, $response_array["rivista"]);
                }
                if(in_array("note", $selettori)){
                    $result = $this->rivistaService->selectByNote($cosa_cercare);
                    $response_array["rivista"] = $this->pushInArrayIfNew($result, $response_array["rivista"]);
                }
                if(in_array("tag", $selettori)){
                    $result = $this->rivistaService->selectByTag($cosa_cercare);
                    $response_array["rivista"] = $this->pushInArrayIfNew($result, $response_array["rivista"]);
                }       
                return $response_array; 

            case("software"):
                $response_array["rivista"] = []; 
                if(in_array("modello-titolo", $selettori)){
                    $result = $this->softwareService->selectByTitolo($cosa_cercare);
                    $response_array["software"] = $this->pushInArrayIfNew($result, $response_array["software"]);
                }          
                if(in_array("sistema-operativo", $selettori)){
                    $result = $this->softwareService->selectBySistemaOperativo($cosa_cercare);
                    $response_array["software"] = $this->pushInArrayIfNew($result, $response_array["software"]);
                }          
                if(in_array("note", $selettori)){
                    $result = $this->softwareService->selectByNote($cosa_cercare);
                    $response_array["software"] = $this->pushInArrayIfNew($result, $response_array["software"]);
                }          
                if(in_array("tag", $selettori)){
                    $result = $this->softwareService->selectByTag($cosa_cercare);
                    $response_array["software"] = $this->pushInArrayIfNew($result, $response_array["software"]);
                }          
        }
    }

    public function pushInArrayIfNew(array $result, array $response_array): array{
        foreach($result as $computer){
            if(!in_array($computer, $response_array)){
                array_push($response_array, $computer);
            }                     
        }
        return $response_array;
    }
}
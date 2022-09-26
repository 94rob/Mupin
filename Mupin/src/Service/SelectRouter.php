<?php

declare(strict_types=1);

namespace App\Service;
use App\Service\Implementations;

require 'vendor/autoload.php';



class SelectRouter
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

    public function find($cosa_cercare, string $dove_cercare, array $selettori): array
    {

        switch ($dove_cercare) {

            case ("ovunque"):
                $response_array["computer"] = $this->computerService->selectFromComputerWhereWhateverLikeInput($cosa_cercare);
                $response_array["libro"] = $this->libroService->selectFromLibroWhereWhateverLikeInput($cosa_cercare);
                $response_array["rivista"] = $this->rivistaService->selectFromRivistaWhereWhateverLikeInput($cosa_cercare);
                $response_array["periferica"] = $this->perifericaService->selectFromPerifericaWhereWhateverLikeInput($cosa_cercare);
                $response_array["software"] = $this->softwareService->selectFromSoftwareWhereWhateverLikeInput($cosa_cercare);

                return $response_array;

            case ("computer"):
                $response_array["computer"] = [];
                if($cosa_cercare === null){
                    $result = $this->computerService->selectAll();
                    $response_array["computer"] = $this->pushInArrayIfNew($result, $response_array["computer"]);
                    return $response_array;
                }

                if (empty($selettori)) {
                    $result = $this->computerService->selectFromComputerWhereWhateverLikeInput($cosa_cercare);
                    $response_array["computer"] = $this->pushInArrayIfNew($result, $response_array["computer"]);
                    return $response_array;
                }

                if (in_array("modello-titolo", $selettori)) {
                    $selettori["modello"] = $selettori["modello-titolo"];
                    unset($selettori["modello-titolo"]);
                }
                $possibiliSelettori = ["id-catalogo", "modello", "anno", "sistema-operativo", "note", "tag"];
                foreach ($possibiliSelettori as $selettore) {
                    if (in_array($selettore, $selettori)) {
                        $column = str_replace("-", "_", strtoupper($selettore));
                        $result = $this->computerService->selectWhereColumnLikeInput($column, $cosa_cercare);
                        $response_array["computer"] = $this->pushInArrayIfNew($result, $response_array["computer"]);
                    }
                }

                return $response_array;

            case ("libro"):
                $response_array["libro"] = [];
                if (empty($selettori)) {
                    $result = $this->libroService->selectFromLibroWhereWhateverLikeInput($cosa_cercare);
                    $response_array["libro"] = $this->pushInArrayIfNew($result, $response_array["libro"]);
                }
                if (in_array("modello-titolo", $selettori)) {
                    $selettori["titolo"] = $selettori["modello-titolo"];
                    unset($selettori["modello-titolo"]);
                }
                
                $possibiliSelettori = ["id-catalogo", "titolo", "anno", "autori", "casa-editrice", "note", "tag"];
                foreach ($possibiliSelettori as $selettore) {
                    if (in_array($selettore, $selettori)) {
                        $column = str_replace("-", "_", strtoupper($selettore));
                        $result = $this->libroService->selectWhereColumnLikeInput($column, $cosa_cercare);
                        $response_array["libro"] = $this->pushInArrayIfNew($result, $response_array["libro"]);
                    }
                }

                return $response_array;

            case ("periferica"):
                $response_array["periferica"] = [];
                if (empty($selettori)) {
                    $result = $this->perifericaService->selectFromPerifericaWhereWhateverLikeInput($cosa_cercare);
                    $response_array["periferica"] = $this->pushInArrayIfNew($result, $response_array["periferica"]);
                }
                if (in_array("modello-titolo", $selettori)) {
                    $selettori["modello"] = $selettori["modello-titolo"];
                    unset($selettori["modello-titolo"]);
                }
                $possibiliSelettori = ["id-catalogo", "modello", "note", "tag"];
                foreach ($possibiliSelettori as $selettore) {
                    if (in_array($selettore, $selettori)) {
                        $column = str_replace("-", "_", strtoupper($selettore));
                        $result = $this->perifericaService->selectWhereColumnLikeInput($column, $cosa_cercare);
                        $response_array["periferica"] = $this->pushInArrayIfNew($result, $response_array["periferica"]);
                    }
                }
                return $response_array;

            case ("rivista"):
                $response_array["rivista"] = [];
                if (empty($selettori)) {
                    $result = $this->rivistaService->selectFromRivistaWhereWhateverLikeInput($cosa_cercare);
                    $response_array["rivista"] = $this->pushInArrayIfNew($result, $response_array["rivista"]);
                }
                if (in_array("modello-titolo", $selettori)) {
                    $selettori["titolo"] = $selettori["modello-titolo"];
                    unset($selettori["modello-titolo"]);
                }
                $possibiliSelettori = ["id-catalogo", "titolo", "anno", "casa-editrice", "note", "tag"];
                foreach ($possibiliSelettori as $selettore) {
                    if (in_array($selettore, $selettori)) {
                        $column = str_replace("-", "_", strtoupper($selettore));
                        $result = $this->rivistaService->selectWhereColumnLikeInput($column, $cosa_cercare);
                        $response_array["rivista"] = $this->pushInArrayIfNew($result, $response_array["rivista"]);
                    }
                }
                return $response_array;

            case ("software"):
                $response_array["software"] = [];
                if (empty($selettori)) {
                    $result = $this->softwareService->selectFromSoftwareWhereWhateverLikeInput($cosa_cercare);
                    $response_array["software"] = $this->pushInArrayIfNew($result, $response_array["software"]);
                }
               if (in_array("modello-titolo", $selettori)) {
                    $selettori["titolo"] = $selettori["modello-titolo"];
                    unset($selettori["modello-titolo"]);
                }

                $possibiliSelettori = ["id-catalogo", "titolo", "sistema-operativo", "note", "tag"];
                foreach ($possibiliSelettori as $selettore) {
                    if (in_array($selettore, $selettori)) {
                        $column = str_replace("-", "_", strtoupper($selettore));
                        $result = $this->softwareService->selectWhereColumnLikeInput($column, $cosa_cercare);
                        $response_array["software"] = $this->pushInArrayIfNew($result, $response_array["software"]);
                    }
                }
                return $response_array;

            default:
                return [];
        }
    }

    public function pushInArrayIfNew(array $result, array $response_array): array
    {
        foreach ($result as $computer) {
            if (!in_array($computer, $response_array)) {
                array_push($response_array, $computer);
            }
        }
        return $response_array;
    }
}

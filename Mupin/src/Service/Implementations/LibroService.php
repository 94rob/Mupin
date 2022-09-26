<?php
declare (strict_types=1);
namespace App\Service\Implementations;
require 'vendor/autoload.php';

use App\Models\Libro;
use App\Repository\LibroRepository;
use App\Service\Interfaces\ILibroService;
use PDO;
class LibroService implements ILibroService{
    public LibroRepository $libroRepository ; 
    
    public function __construct(){
        $config = include 'config.php';
        $pdo = new PDO($config['dsn'], $config['username'], $config['password']);        
        $this->libroRepository=new LibroRepository($pdo);        
    }
    // SELECT
    public function selectAll(): array
    {
        $result = $this->libroRepository->selectAll("libro");
        return $this->fromArrayToLibroArray($result);
    }
    public function selectFromLibroWhereWhateverLikeInput(string $input): array{
        $result = $this->libroRepository->selectFromLibroWhereWhateverLikeInput($input);
        return $this->fromArrayToLibroArray($result);
    }

    public function selectWhereColumnLikeInput(string $column, string $input): array {
        $result = $this->libroRepository->selectWhereColumnLikeInput($column, $input);
        return $this->fromArrayToLibroArray($result);
    } 

    // INSERT
    public function insertIntoLibro(array $array){
        $element = $this->fromArrayToLibro($array);
        $this->libroRepository->insertIntoLibro($element);
    }

    // UPDATE
    public function updateColumnByIdCatalogo(string $column, string $idCatalogo, string $input){
        $this->libroRepository->updateColumnByIdCatalogo($column, $idCatalogo, $input);
    }

    // DELETE
    public function deleteFromLibro(string $idCatalogo){
        $this->libroRepository->deleteFromLibro($idCatalogo);
    }

    // Utils
    public function fromArrayToLibro(array $array): Libro
    {
        $libro = new Libro();
        $libro->setIdCatalogo($array["ID_CATALOGO"]);
        $libro->setTitolo($array["TITOLO"]);
        $libro->setAutori($array["AUTORI"]);
        $libro->setCasaEditrice($array["CASA_EDITRICE"]);
        $libro->setAnno($array["ANNO"]);
        

        if(array_key_exists("NUM_PAGINE", $array) && $array["NUM_PAGINE"]!=null){
            $libro->setNumPagine($array["NUM_PAGINE"]);
        }    
        if(array_key_exists("ISBN", $array) && $array["ISBN"]!=null){
            $libro->setIsbn($array["ISBN"]);
        }
        if(array_key_exists("NOTE", $array)&& $array["NOTE"]!=null){
            $libro->setNote($array["NOTE"]);
        }
        if(array_key_exists("URL", $array)&& $array["URL"]!=null){
            $libro->setUrl($array["URL"]);
        }
        if(array_key_exists("TAG", $array)&& $array["TAG"]!=null){
            $libro->setTag($array["TAG"]);
        }    
        return $libro;
    }

    public function fromArrayToLibroArray(array $array){
        $objectArray = [];
        foreach ($array as $item) {
            $singleElement = $this->fromArrayToLibro($item);
            array_push($objectArray, $singleElement);
        }
        return $objectArray;
    }
}
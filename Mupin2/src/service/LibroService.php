<?php
declare (strict_types=1);
namespace Mupin\Service;
require 'vendor/autoload.php';

use Mupin\Models\Libro;
use Mupin\Repository\LibroRepository;
class LibroService implements ILibroService{
    public LibroRepository $libroRepository ; 
    
    public function __construct(){
        $this->libroRepository=new LibroRepository();        
    }
    // SELECT
    public function selectAll(): array
    {
        $result = $this->libroRepository->selectAll();
        return $this->fromArrayToLibroArray($result);
    }
    public function selectFromLibroWhere(string $input): array{
        $result = $this->computerRepository->selectFromLibroWhere($input);
        return $this->fromArrayToLibroArray($result);
    }
    public function selectByTitolo(string $input): array{
        $result = $this->libroRepository->selectByTitolo($input);
        return $this->fromArrayToLibroArray($result);
    }
    public function selectByAutore(string $input): array{
        $result = $this->libroRepository->selectByAutore($input);
        return $this->fromArrayToLibroArray($result);
    }
    public function selectByAnno(int $input): array{
        $result = $this->libroRepository->selectByAnno($input);
        return $this->fromArrayToLibroArray($result);
    }
    public function selectByCasaEditrice(string $input): array{
        $result = $this->libroRepository->selectByCasaEditrice($input);
        return $this->fromArrayToLibroArray($result);
    }
    public function selectByNote(string $input): array{
        $result = $this->libroRepository->selectByNote($input);
        return $this->fromArrayToLibroArray($result);
    }
    public function selectByTag(string $input): array{
        $result = $this->libroRepository->selectByTag($input);
        return $this->fromArrayToLibroArray($result);
    }

    // INSERT
    public function insertIntoLibro(array $array){
        $element = $this->fromArrayToLibro($array);
        $this->libroRepository->insertIntoLibro($element);
    }

    // UPDATE
    public function updateTitolo(string $idCatalogo, string $input)
    {
        $this->libroRepository->updateTitolo($idCatalogo, $input);
    }
    public function updateAutori(string $idCatalogo, string $input)
    {
        $this->libroRepository->updateAutori($idCatalogo, $input);
    }
    public function updateCasaEditrice(string $idCatalogo, string $input)
    {
        $this->libroRepository->updateCasaEditrice($idCatalogo, $input);
    }
    public function updateAnno(string $idCatalogo, int $input)
    {
        $this->libroRepository->updateAnno($idCatalogo, $input);
    }
    public function updateNumPagine(string $idCatalogo, int $input)
    {
        $this->libroRepository->updateNumPagine($idCatalogo, $input);
    }
    public function updateIsbn(string $idCatalogo, string $input)
    {
        $this->libroRepository->updateIsbn($idCatalogo, $input);
    }
    public function updateNote(string $idCatalogo, string $input)
    {
        $this->libroRepository->updateNote($idCatalogo, $input);
    }
    public function updateUrl(string $idCatalogo, string $input)
    {
        $this->libroRepository->updateUrl($idCatalogo, $input);
    }
    public function updateTag(string $idCatalogo, string $input)
    {
        $this->libroRepository->updateTag($idCatalogo, $input);
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
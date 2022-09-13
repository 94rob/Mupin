<?php
declare (strict_types=1);
namespace Mupin\Service;
require 'vendor/autoload.php';

interface ILibroService {
    // SELECT
    public function selectByAll(string $input): array;
    public function selectByTitolo(string $input): array;
    public function selectByAutore(string $input): array;
    public function selectByAnno(int $input): array;
    public function selectByCasaEditrice(string $input): array;
    public function selectByNote(string $input): array;
    public function selectByTag(string $input): array;  

    // INSERT
    public function insertIntoLibro(array $array);

    // UPDATE
    public function updateTitolo(string $idCatalogo, string $input);
    public function updateAutori(string $idCatalogo, string $input);
    public function updateCasaEditrice(string $idCatalogo, string $input);
    public function updateAnno(string $idCatalogo, string $input);
    public function updateNumPagine(string $idCatalogo, string $input);
    public function updateIsbn(string $idCatalogo, string $input);
    public function updateNote(string $idCatalogo, string $input);
    public function updateUrl(string $idCatalogo, string $input);
    public function updateTag(string $idCatalogo, string $input);

}
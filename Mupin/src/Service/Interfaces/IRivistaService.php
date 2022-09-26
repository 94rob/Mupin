<?php
declare(strict_types=1);
namespace App\Service\Interfaces;
require 'vendor/autoload.php';

interface IRivistaService{
    // SELECT
    public function selectAll(): array;    
    public function selectFromRivistaWhereWhateverLikeInput(string $input): array;
    public function selectWhereColumnLikeInput(string $column, string $input): array;

    // INSERT
    public function insertIntoRivista(array $array);

    // UPDATE
    public function updateColumnByIdCatalogo(string $column, string $idCatalogo, string $input);

    // DELETE
    public function deleteFromRivista(string $idCatalogo);
}
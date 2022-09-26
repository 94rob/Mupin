<?php

declare(strict_types=1);
namespace App\Service\Interfaces;
require 'vendor/autoload.php';

interface IPerifericaService{
    // SELECT
    public function selectAll(): array;    
    public function selectFromPerifericaWhereWhateverLikeInput(string $input): array;
    public function selectWhereColumnLikeInput(string $column, string $input): array;

    // INSERT
    public function insertIntoPeriferica(array $array);

    // UPDATE
    public function updateColumnByIdCatalogo(string $column, string $idCatalogo, string $input);

    // DELETE
    public function deleteFromPeriferica(string $idCatalogo);
}
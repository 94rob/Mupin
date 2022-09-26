<?php

declare(strict_types=1);

namespace App\Service\Interfaces;

require 'vendor/autoload.php';

interface IComputerService{

    // SELECT
    public function selectAll(): array;    
    public function selectFromComputerWhereWhateverLikeInput(string $input): array;
    public function selectWhereColumnLikeInput(string $column, string $input): array;

    // INSERT
    public function insertIntoComputer(array $array): void;

    // UPDATE
    public function updateColumnByIdCatalogo(string $column, string $idCatalogo, string $input);

    // DELETE
    public function deleteFromComputer(string $idCatalogo);

}
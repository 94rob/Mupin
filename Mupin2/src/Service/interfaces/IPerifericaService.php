<?php

declare(strict_types=1);
namespace Mupin\Service;
require 'vendor/autoload.php';

interface IPerifericaService{
    // SELECT
    public function selectByAll(string $input): array;
    public function selectByModello(string $input): array;
    public function selectByNote(string $input): array;
    public function selectByTag(string $input): array;

    // INSERT
    public function insertIntoPeriferica(array $array);

    // UPDATE
    public function updateModello(string $idCatalogo, string $input);
    public function updateTipologia(string $idCatalogo, string $input);
    public function updateNote(string $idCatalogo, string $input);
    public function updateUrl(string $idCatalogo, string $input);
    public function updateTag(string $idCatalogo, string $input);

    // DELETE
    public function deleteFromPeriferica(string $idCatalogo);
}
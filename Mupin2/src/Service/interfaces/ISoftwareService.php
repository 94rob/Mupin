<?php
declare(strict_types=1);
namespace Mupin\Service;
require 'vendor/autoload.php';

interface ISoftwareService{
    // SELECT
    public function selectByAll(string $input): array;
    public function selectByTitolo(string $input): array;
    public function selectBySistemaOperativo(string $input): array;
    public function selectByNote(string $input): array;
    public function selectByTag(string $input): array;

    // INSERT
    public function insertIntoSoftware(array $array);

    // UPDATE
    public function updateTitolo(string $idCatalogo, string $input);
    public function updateSistemaOperativo(string $idCatalogo, string $input);
    public function updateTipologia(string $idCatalogo, string $input);
    public function updateSupporto(string $idCatalogo, string $input);
    public function updateNote(string $idCatalogo, string $input);
    public function updateUrl(string $idCatalogo, string $input);
    public function updateTag(string $idCatalogo, string $input);
}
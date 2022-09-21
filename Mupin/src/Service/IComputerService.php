<?php

declare(strict_types=1);

namespace Mupin\Service;

require 'vendor/autoload.php';

interface IComputerService{

    // SELECT
    public function selectAll(): array;
    public function selectFromComputerWhere(string $input): array;
    public function selectByModello(string $input): array;
    public function selectByAnno(int $input): array;
    public function selectBySistemaOperativo(string $input): array;
    public function selectByNote(string $input): array;
    public function selectByTag(string $input): array;

    // INSERT
    public function insertIntoComputer(array $array): void;

    // UPDATE
    public function updateModello(string $idCatalogo, string $input);
    public function updateAnno(string $idCatalogo, int $input);
    public function updateCpu(string $idCatalogo, string $input);
    public function updateVelocitaCpu(string $idCatalogo, float $input);
    public function updateMemoriaRam(string $idCatalogo, int $input);
    public function updateDimensioneHardDisk(string $idCatalogo, int $input);
    public function updateSistemaOperativo(string $idCatalogo, string $input);
    public function updateNote(string $idCatalogo, string $input);
    public function updateUrl(string $idCatalogo, string $input);
    public function updateTag(string $idCatalogo, string $input);

    // DELETE
    public function deleteFromComputer(string $idCatalogo);

}
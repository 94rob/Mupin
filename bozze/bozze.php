<?php
declare (strict_types=1);
namespace Bozze;

use PDO;
class Bozze{
     
    // Metodi Service
    public function selectByAll(string $input): array
    {
        $result = $this->computerRepository->selectFromComputer($input);
        return $this->fromArrayToComputerArray($result);
    }
    public function selectByAll(string $input): array{
        $result = $this->libroRepository->selectFromLibro($input);
        return $this->fromArrayToLibroArray($result);
    }
    public function selectByAll(string $input): array
    {
        $result = $this->perifericaRepository->selectFromPeriferica($input);
        return $this->fromArrayToPerifericaArray($result);
    }
    public function selectByAll(string $input): array
    {
        $result = $this->rivistaRepository->selectFromRivista($input);
        return $this->fromArrayToRivistaArray($result);
    }    
    public function selectByAll(string $input): array
    {
        $result = $this->softwareRepository->selectFromSoftware($input);
        return $this->fromArrayToSoftwareArray($result);
    }




}
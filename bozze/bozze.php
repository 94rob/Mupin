<?php
declare (strict_types=1);
namespace Bozze;

use PDO;
class Bozze{

    // Metodi repository
    public function selectFromComputer(string $input): array
    {
        $input = '%' . $input . '%';
        $sqlInstruction = "SELECT * FROM computer WHERE MODELLO LIKE :input0 ";
        $sqlInstruction .= "OR ANNO LIKE :input1 ";
        $sqlInstruction .= "OR CPU LIKE :input2 ";
        $sqlInstruction .= "OR VELOCITA_CPU LIKE :input3 ";
        $sqlInstruction .= "OR MEMORIA_RAM LIKE :input4 ";
        $sqlInstruction .= "OR DIMENSIONE_HARD_DISK LIKE :input5 ";
        $sqlInstruction .= "OR SISTEMA_OPERATIVO LIKE :input6 ";
        $sqlInstruction .= "OR NOTE LIKE :input7 ";
        $sqlInstruction .= "OR URL LIKE :input8 ";
        $sqlInstruction .= "OR TAG LIKE :input9 ;";

        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindValue(':input0', $input, PDO::PARAM_STR);
        $sth->bindValue(':input1', $input, PDO::PARAM_STR);
        $sth->bindValue(':input2', $input, PDO::PARAM_STR);
        $sth->bindValue(':input3', $input, PDO::PARAM_STR);
        $sth->bindValue(':input4', $input, PDO::PARAM_STR);
        $sth->bindValue(':input5', $input, PDO::PARAM_STR);
        $sth->bindValue(':input6', $input, PDO::PARAM_STR);
        $sth->bindValue(':input7', $input, PDO::PARAM_STR);
        $sth->bindValue(':input8', $input, PDO::PARAM_STR);
        $sth->bindValue(':input9', $input, PDO::PARAM_STR);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectFromLibro(string $input) : array{
        $input ='%' . $input . '%';
        $sqlInstruction = "SELECT * FROM libro WHERE TITOLO LIKE :input0 ";         
        $sqlInstruction .= "OR AUTORI LIKE :input1 ";
        $sqlInstruction .= "OR CASA_EDITRICE LIKE :input2 ";
        $sqlInstruction .= "OR ANNO LIKE :input3 ";        
        $sqlInstruction .= "OR NUM_PAGINE LIKE :input4 ";        
        $sqlInstruction .= "OR ISBN LIKE :input5 ";        
        $sqlInstruction .= "OR NOTE LIKE :input6 ";
        $sqlInstruction .= "OR URL LIKE :input7 ";
        $sqlInstruction .= "OR TAG LIKE :input8 ;";
        
        $sth = $this -> pdo -> prepare($sqlInstruction);
        $sth -> bindValue(':input0', $input, PDO::PARAM_STR);
        $sth -> bindValue(':input1', $input, PDO::PARAM_STR);
        $sth -> bindValue(':input2', $input, PDO::PARAM_STR);
        $sth -> bindValue(':input3', $input, PDO::PARAM_STR);
        $sth -> bindValue(':input4', $input, PDO::PARAM_STR);
        $sth -> bindValue(':input5', $input, PDO::PARAM_STR);
        $sth -> bindValue(':input6', $input, PDO::PARAM_STR);
        $sth -> bindValue(':input7', $input, PDO::PARAM_STR);
        $sth -> bindValue(':input8', $input, PDO::PARAM_STR);        
        $sth -> execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectFromPeriferica(string $input) : array{
        $input ='%' . $input . '%';
        $sqlInstruction = "SELECT * FROM periferica WHERE MODELLO LIKE :input0 ";         
        $sqlInstruction .= "OR TIPOLOGIA LIKE :input1 ";
        $sqlInstruction .= "OR NOTE LIKE :input2 ";
        $sqlInstruction .= "OR URL LIKE :input3 ";
        $sqlInstruction .= "OR TAG LIKE :input4 ;";        
                
        $sth = $this -> pdo -> prepare($sqlInstruction);
        $sth -> bindValue(':input0', $input, PDO::PARAM_STR);
        $sth -> bindValue(':input1', $input, PDO::PARAM_STR);
        $sth -> bindValue(':input2', $input, PDO::PARAM_STR);
        $sth -> bindValue(':input3', $input, PDO::PARAM_STR);
        $sth -> bindValue(':input4', $input, PDO::PARAM_STR);
        
        $sth -> execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectFromRivista(string $input): array
    {
        $input = '%' . $input . '%';
        $sqlInstruction = "SELECT * FROM rivista WHERE TITOLO LIKE :input0 ";
        $sqlInstruction .= "OR NUMERO_RIVISTA LIKE :input1 ";
        $sqlInstruction .= "OR ANNO LIKE :input2 ";
        $sqlInstruction .= "OR CASA_EDITRICE LIKE :input3 ";
        $sqlInstruction .= "OR NOTE LIKE :input4 ";
        $sqlInstruction .= "OR URL LIKE :input5 ";
        $sqlInstruction .= "OR TAG LIKE :input6 ;";

        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindValue(':input0', $input, PDO::PARAM_STR);
        $sth->bindValue(':input1', $input, PDO::PARAM_STR);
        $sth->bindValue(':input2', $input, PDO::PARAM_STR);
        $sth->bindValue(':input3', $input, PDO::PARAM_STR);
        $sth->bindValue(':input4', $input, PDO::PARAM_STR);
        $sth->bindValue(':input5', $input, PDO::PARAM_STR);
        $sth->bindValue(':input6', $input, PDO::PARAM_STR);

        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectFromSoftware(string $input) : array{
        $input ='%' . $input . '%';
        $sqlInstruction = "SELECT * FROM software WHERE TITOLO LIKE :input0 ";         
        $sqlInstruction .= "OR SISTEMA_OPERATIVO LIKE :input1 ";
        $sqlInstruction .= "OR TIPOLOGIA LIKE :input2 ";
        $sqlInstruction .= "OR SUPPORTO LIKE :input3 ";
        $sqlInstruction .= "OR NOTE LIKE :input4 ";        
        $sqlInstruction .= "OR URL LIKE :input5 ";
        $sqlInstruction .= "OR TAG LIKE :input6  ;";        
        
        $sth = $this -> pdo -> prepare($sqlInstruction);
        $sth -> bindValue(':input0', $input, PDO::PARAM_STR);
        $sth -> bindValue(':input1', $input, PDO::PARAM_STR);
        $sth -> bindValue(':input2', $input, PDO::PARAM_STR);
        $sth -> bindValue(':input3', $input, PDO::PARAM_STR);
        $sth -> bindValue(':input4', $input, PDO::PARAM_STR);
        $sth -> bindValue(':input5', $input, PDO::PARAM_STR);
        $sth -> bindValue(':input6', $input, PDO::PARAM_STR);
        
        $sth -> execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

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
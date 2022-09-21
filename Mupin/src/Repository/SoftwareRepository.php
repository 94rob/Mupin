<?php
declare (strict_types=1);
namespace App\Repository;
require 'vendor/autoload.php';

use PDO;
use App\Models\Software;
class SoftwareRepository extends RepositoryFather{   

    // SELECT
    public function selectAll(): array{
        $sqlInstruction = "SELECT * FROM software;";
        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectFromSoftwareWhere(string $input): array
    {
        $input = '%' . $input . '%';
        $arrProperties = ["TITOLO", "SISTEMA_OPERATIVO", "TIPOLOGIA", "SUPPORTO", "NOTE", "URL", "TAG"];
        $i = 0;
        $len = count($arrProperties);
        $sqlInstruction = "SELECT * FROM software WHERE ";
        foreach($arrProperties as $element){
            $sqlInstruction .= $element . " LIKE :input" . $i;
            if ($i < $len - 1){
                $sqlInstruction .= " OR ";
            }
            $i +=1;
        }        

        $sth = $this->pdo->prepare($sqlInstruction);
        
        for($i=0; $i<$len;$i++){
            $sth->bindValue(':input' . $i, $input, PDO::PARAM_STR);
        }        
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    } 
    public function selectByTitolo(string $input){
        $input ='%' . $input . '%';
        $sqlInstruction = "SELECT * FROM software WHERE TITOLO LIKE :input ;";
        return parent::executeSelectString($input, $sqlInstruction, $this->pdo);
    }
    public function selectBySistemaOperativo(string $input){
        $input ='%' . $input . '%';
        $sqlInstruction = "SELECT * FROM software WHERE SISTEMA_OPERATIVO LIKE :input ;";
        return parent::executeSelectString($input, $sqlInstruction, $this->pdo);
    }
    public function selectByNote(string $input){
        $input ='%' . $input . '%';
        $sqlInstruction = "SELECT * FROM software WHERE NOTE LIKE :input ;";
        return parent::executeSelectString($input, $sqlInstruction, $this->pdo);
    }
    public function selectByTag(string $input){
        $input ='%' . $input . '%';
        $sqlInstruction = "SELECT * FROM software WHERE TAG LIKE :input ;";
        return parent::executeSelectString($input, $sqlInstruction, $this->pdo);
    }

    // INSERT
    public function insertIntoSoftware(Software $software)
    {
        $sqlInstruction = "INSERT INTO software (ID_CATALOGO,TITOLO, SISTEMA_OPERATIVO, TIPOLOGIA, SUPPORTO";
        $sqlInstruction .= ") VALUES ( :id_catalogo , :titolo, :sistema_operativo, :tipologia, :supporto ); ";        

        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindValue(':id_catalogo', $software->getId_catalogo(), PDO::PARAM_STR);
        $sth->bindValue(':titolo', $software->getTitolo(), PDO::PARAM_STR);
        $sth->bindValue(':sistema_operativo', $software->getSistema_operativo(), PDO::PARAM_INT);
        $sth->bindValue(':tipologia', $software->getTipologia(), PDO::PARAM_STR);
        $sth->bindValue(':supporto', $software->getSupporto());
        $sth->execute();
        
        if (isset($software->note)) {
            $this->updateNote($software->getId_catalogo(), $software->getNote());
        }
        if (isset($software->url)) {
            $this->updateUrl($software->getId_catalogo(), $software->getUrl());
        }
        if (isset($software->tag)) {
            $this->updateTag($software->getId_catalogo(), $software->getTag());
        }
    }

    // UPDATE
    public function updateTitolo(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE software SET TITOLO = :input WHERE ID_CATALOGO = :id_catalogo ;";
        parent::executeUpdateString($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }
    public function updateSistemaOperativo(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE software SET SISTEMA_OPERATIVO = :input WHERE ID_CATALOGO = :id_catalogo ;";
        parent::executeUpdateString($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }
    public function updateTipologia(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE software SET TIPOLOGIA = :input WHERE ID_CATALOGO = :id_catalogo ;";
        parent::executeUpdateString($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }
    public function updateSupporto(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE software SET SUPPORTO = :input WHERE ID_CATALOGO = :id_catalogo ;";
        parent::executeUpdateString($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }
    public function updateNote(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE software SET NOTE = :input WHERE ID_CATALOGO = :id_catalogo ;";
        parent::executeUpdateString($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }
    public function updateUrl(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE software SET URL = :input WHERE ID_CATALOGO = :id_catalogo ;";
        parent::executeUpdateString($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }
    public function updateTag(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE software SET TAG = :input WHERE ID_CATALOGO = :id_catalogo ;";
        parent::executeUpdateString($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }

    // DELETE
    public function deleteFromSoftware(string $idCatalogo){
        $sqlInstruction = "DELETE FROM software WHERE ID_CATALOGO = :id_catalogo ;";
        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindValue(':id_catalogo', $idCatalogo, PDO::PARAM_STR);
        $sth->execute();
    }
}
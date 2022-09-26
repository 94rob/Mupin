<?php
declare (strict_types=1);
namespace App\Repository;
require 'vendor/autoload.php';

use PDO;
use App\Models\Software;
class SoftwareRepository extends RepositoryFather{   

    // SELECT   
    public function selectFromSoftwareWhereWhateverLikeInput(string $input): array
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
    public function selectWhereColumnLikeInput(string $column, string $input){
        $input = '%' . $input . '%';
        $sqlInstruction = "SELECT * FROM software WHERE ". $column ." LIKE :input ;";
        return parent::executeSelectString($input, $sqlInstruction);
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
            $this->updateColumnByIdCatalogo("NOTE", $software->getId_catalogo(), $software->getNote());
        }
        if (isset($software->url)) {
            $this->updateColumnByIdCatalogo("URL", $software->getId_catalogo(), $software->getUrl());
        }
        if (isset($software->tag)) {
            $this->updateColumnByIdCatalogo("TAG", $software->getId_catalogo(), $software->getTag());
        }
    }

    // UPDATE
    public function updateColumnByIdCatalogo(string $column, string $idCatalogo, string $input){
        $sqlInstruction = "UPDATE software SET ". $column ." = :input WHERE ID_CATALOGO = :id_catalogo ;";
        parent::executeUpdateString($input, $idCatalogo, $sqlInstruction);
    }

    // DELETE
    public function deleteFromSoftware(string $idCatalogo){
        $sqlInstruction = "DELETE FROM software WHERE ID_CATALOGO = :id_catalogo ;";
        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindValue(':id_catalogo', $idCatalogo, PDO::PARAM_STR);
        $sth->execute();
    }
}
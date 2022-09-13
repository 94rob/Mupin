<?php
declare (strict_types=1);
namespace Mupin\Repository;
require 'vendor/autoload.php';

use PDO;
use Mupin\Models\Software;
class SoftwareRepository{
    public PDO $pdo;
    public function __construct(){
        $config = include 'config.php';
        $this -> pdo = new PDO($config['dsn'], $config['username'], $config['password']);
        $this->pdo->setAttribute (PDO::ATTR_STRINGIFY_FETCHES, false);
        $this->pdo->setAttribute (PDO::ATTR_EMULATE_PREPARES, false);
    }

    // SELECT
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
    public function selectByTitolo(string $input){
        $input ='%' . $input . '%';
        $sqlInstruction = "SELECT * FROM software WHERE TITOLO LIKE :input ;";
        $sth = $this -> pdo -> prepare($sqlInstruction);
        $sth -> bindValue(':input', $input, PDO::PARAM_STR);
        $sth -> execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectBySistemaOperativo(string $input){
        $input ='%' . $input . '%';
        $sqlInstruction = "SELECT * FROM software WHERE SISTEMA_OPERATIVO LIKE :input ;";
        $sth = $this -> pdo -> prepare($sqlInstruction);
        $sth -> bindValue(':input', $input, PDO::PARAM_STR);
        $sth -> execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectByNote(string $input){
        $input ='%' . $input . '%';
        $sqlInstruction = "SELECT * FROM software WHERE NOTE LIKE :input ;";
        $sth = $this -> pdo -> prepare($sqlInstruction);
        $sth -> bindValue(':input', $input, PDO::PARAM_STR);
        $sth -> execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectByTag(string $input){
        $input ='%' . $input . '%';
        $sqlInstruction = "SELECT * FROM software WHERE TAG LIKE :input ;";
        $sth = $this -> pdo -> prepare($sqlInstruction);
        $sth -> bindValue(':input', $input, PDO::PARAM_STR);
        $sth -> execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
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
            $sqlInstruction = "UPDATE software SET NOTE = :note WHERE ID_CATALOGO = :id_catalogo ;";
            $sth = $this->pdo->prepare($sqlInstruction);
            $sth->bindValue(':note', $software->getNote(), PDO::PARAM_STR);
            $sth->bindValue(':id_catalogo', $software->getId_catalogo(), PDO::PARAM_STR);
            $sth->execute();
        }
        if (isset($software->url)) {
            $sqlInstruction = "UPDATE software SET URL = :url WHERE ID_CATALOGO = :id_catalogo ;";
            $sth = $this->pdo->prepare($sqlInstruction);
            $sth->bindValue(':url', $software->getUrl(), PDO::PARAM_STR);
            $sth->bindValue(':id_catalogo', $software->getId_catalogo(), PDO::PARAM_STR);
            $sth->execute();
        }
        if (isset($software->tag)) {
            $sqlInstruction = "UPDATE software SET TAG = :tag WHERE ID_CATALOGO = :id_catalogo ;";
            $sth = $this->pdo->prepare($sqlInstruction);
            $sth->bindValue(':tag', $software->getTag(), PDO::PARAM_STR);
            $sth->bindValue(':id_catalogo', $software->getId_catalogo(), PDO::PARAM_STR);
            $sth->execute();
        }
    }

    // UPDATE
    public function updateTitolo(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE software SET TITOLO = :input WHERE ID_CATALOGO = :id_catalogo ;";
        $this->executeUpdateString($input, $idCatalogo, $sqlInstruction);
    }
    public function updateSistemaOperativo(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE software SET SISTEMA_OPERATIVO = :input WHERE ID_CATALOGO = :id_catalogo ;";
        $this->executeUpdateString($input, $idCatalogo, $sqlInstruction);
    }
    public function updateTipologia(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE software SET TIPOLOGIA = :input WHERE ID_CATALOGO = :id_catalogo ;";
        $this->executeUpdateString($input, $idCatalogo, $sqlInstruction);
    }
    public function updateSupporto(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE software SET SUPPORTO = :input WHERE ID_CATALOGO = :id_catalogo ;";
        $this->executeUpdateString($input, $idCatalogo, $sqlInstruction);
    }
    public function updateNote(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE software SET NOTE = :input WHERE ID_CATALOGO = :id_catalogo ;";
        $this->executeUpdateString($input, $idCatalogo, $sqlInstruction);
    }
    public function updateUrl(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE software SET URL = :input WHERE ID_CATALOGO = :id_catalogo ;";
        $this->executeUpdateString($input, $idCatalogo, $sqlInstruction);
    }
    public function updateTag(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE software SET TAG = :input WHERE ID_CATALOGO = :id_catalogo ;";
        $this->executeUpdateString($input, $idCatalogo, $sqlInstruction);
    }

    // Utils
    public function executeUpdateString($newValue, string $idCatalogo, string $sqlUpdate){
        $sth = $this->pdo->prepare($sqlUpdate);
        $sth->bindValue(':input', $newValue, PDO::PARAM_STR);
        $sth->bindValue(':id_catalogo', $idCatalogo, PDO::PARAM_STR);
        $sth->execute();
    }
    public function executeUpdateInt($newValue, string $idCatalogo, string $sqlUpdate){
        $sth = $this->pdo->prepare($sqlUpdate);
        $sth->bindValue(':input', $newValue, PDO::PARAM_INT);
        $sth->bindValue(':id_catalogo', $idCatalogo, PDO::PARAM_STR);
        $sth->execute();
    }

}
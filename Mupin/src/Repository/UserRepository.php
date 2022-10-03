<?php
declare(strict_types=1);
namespace App\Repository;

use PDO;
use PDOException;
use Exception;

class UserRepository extends ModelRepository
{   
    public function selectPassByEmail(string $email): array | bool
    {
        try{
            $sql_select_user = "SELECT * FROM utente WHERE EMAIL=:email";        
            $statement = $this->pdo->prepare($sql_select_user);
            $statement->bindParam(':email', $email, PDO::PARAM_STR);        
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e){
            return false;
        }
    }    
}
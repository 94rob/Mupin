<?php
declare(strict_types=1);
namespace App\Repository;

use PDO;
use PDOException;
use Exception;

class UserRepository extends RepositoryUtils
{   
     public function selectPassByEmail(string $email)
    {
        $sql_select_user = "SELECT * FROM utente WHERE email=:email";        
        $statement = $this->pdo->prepare($sql_select_user);
        $statement->bindValue(':email', $email, PDO::PARAM_STR);        
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    
}
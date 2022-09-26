<?php

declare(strict_types=1);
namespace App\Service;
require 'vendor/autoload.php';

class ServiceUtils{

    public function pushInArrayIfNew(array $result, array $response_array): array
    {
        foreach ($result as $item) {
            if (!in_array($item, $response_array)) {
                array_push($response_array, $item);
            }
        }
        return $response_array;
    }
}

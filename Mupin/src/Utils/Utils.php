<?php
declare(strict_types=1);

namespace App\Utils;

use ReflectionClass;
use ReflectionProperty;

class Utils{
    public function getterBuilder(string $property): string{
        return "get" . $this->stringToCamelCase($property, true); 
    }
    public function setterBuilder(string $property): string
    {
        return "set" . $this->stringToCamelCase($property, true);
    }

    function stringToCamelCase(string $string, $capitalizeFirstCharacter = false) 
    {
        $string = strtolower($string);
        $string = str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));
        $str = str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
        if (!$capitalizeFirstCharacter) {
            $str[0] = strtolower($str[0]);
        }
        return $str;
    }

    function stringToColumnName(string $string){
        return str_replace("-", "_", strtoupper($string));
    }

    public function getColumnsByModelName(string $name){
        $constructor = "App\Models\\" . $name;
        $object = new ${'constructor'}();
        $reflect = new ReflectionClass($object);
        $properties = $reflect->getProperties(ReflectionProperty::IS_PUBLIC);
        $columns = [];
        foreach($properties as $property){
            array_push($columns, $this->stringToColumnName($property->getName()));
        } 
        return $columns;
    }

    public function getObjectByModelName(string $name){
        $className = "App\Models\\" . ucfirst($name);
        return new ${"className"}();
    }

}
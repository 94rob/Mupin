<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\ComputerRepository;
use App\Repository\LibroRepository;
use App\Repository\PerifericaRepository;
use App\Repository\RivistaRepository;
use App\Repository\SoftwareRepository;
use App\Utils\Utils;
use PDO;
use PDOException;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use ReflectionClass;
use ReflectionProperty;

require 'vendor/autoload.php';

class ImageService{
    protected string $path;

    public function __construct(){
        $this->path = $_SERVER['DOCUMENT_ROOT']."/img";
    }

    public function insertImage($files, $id){        

        if( (array_key_exists("img", $files)) && ($files["img"]["size"] != 0)){                
                
            $temp = explode("/", $files["img"]['type']);
            $ext = $temp[1];
            
            $num = count(glob($this->path . "/" . $id . "*"));                
            $fileName = $this->path . "/" . $id. "_" . $num . "." . $ext;

            file_put_contents($fileName, file_get_contents($files["img"]["tmp_name"]));

            $log = new Logger('add-image'); 
            $log->pushHandler(new StreamHandler('./public/log/file.log', Logger::INFO));
            $log->info("User " . $_SESSION["user"] . " added image " . basename($fileName) . " to item " . $id);
        }
    }

    public function deleteAllImages(string $id){
        $images = glob($this->path . "/" . $id . "*");
        foreach($images as $image){
            unset($image);
        }
    }
}
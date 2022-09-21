<?php
declare (strict_types=1);
namespace App\Service;
require 'vendor/autoload.php';



class ServiceRouter{

    public ComputerService $c_serv;
    public LibroService $l_serv;
    public PerifericaService $p_serv;
    public RivistaService $r_serv;
    public SoftwareService $s_serv;

    public function __construct(){
        $this->c_serv = new ComputerService();        
        $this->l_serv = new LibroService();
        $this->p_serv = new PerifericaService();
        $this->r_serv = new RivistaService();
        $this->s_serv = new SoftwareService();        
    }

    public function find(string $cosa_cercare, string $dove_cercare, array $selettori): array{

        switch($dove_cercare){

            case("ovunque"):                
                $response_array["computer"] = $this->c_serv->selectFromComputerWhere($cosa_cercare);
                $response_array["libro"] = $this->l_serv->selectFromLibroWhere($cosa_cercare);
                $response_array["rivista"] = $this->r_serv->selectFromRivistaWhere($cosa_cercare);
                $response_array["periferica"] = $this->p_serv->selectFromPerifericaWhere($cosa_cercare);
                $response_array["software"] = $this->s_serv->selectFromSoftwareWhere($cosa_cercare);

                return $response_array;

            case("computer"):
                break;

            case("libro"):
                break;

            case("periferica"):
                break;

            case("rivista"):
                break;       
                     
            case("software"):
                break;            
        }
    }
}
<?php

use \Firebase\JWT\JWT; 
include 'datos.php'; // ver si va o sacarlo.

class Cliente{
    
    public $email;
    public $clave;

    public function __construct($email, $clave)
    {
        $this->email= $email;
        $this->clave= $clave;      
    }

    public function GuardarUsuario()
    {
        return Datos::guardarJson('datos.json', $this); 
    }

    public function Leer()
    {
        return Datos::leerJson('datos.json');
    }

    public static function Buscar($email, $clave)
    {
        $array = Datos::leerJson('datos.json');
        $retorno= false;

        foreach($array as $value)
        {
            if($value->email == $email)
            {
                if($value->clave ==$clave)
                {
                    $retorno=true;
                    
                    $key= "pro3-parcial";
                    $payload = array(
                        "email" => $email,
                        "clave" => $clave,                    
                    );
                    $jwt= JWT::encode($payload,$key);
                    echo "$jwt"; 
                    //var_dump($payload);
                    break; 
                }
                else
                {
                    echo "Clave incorrecta.";
                    break;
                }                
            }
            else
            {
                echo "Email incorrecto.";
                break;
            }
        }
        return $retorno;
    }
}
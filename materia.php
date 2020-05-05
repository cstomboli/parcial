<?php

include 'funciones.php';

class Materia{
    
    public $nombre;
    public $cuatrimestre;
    public $id;

    public function __construct($nombre, $cuatrimestre, $id)
    {
        $this->nombre= $nombre;
        $this->cuatrimestre= $cuatrimestre; 
        if($id==null)
        {
            $this->id =Funciones::GenerarId('materias.json');
        }     
    }

    public function GuardarMateria()
    {
        return Datos::guardarJson('materias.json', $this); 
    }

    public function Leer()
    {
        return Datos::leerJson('materias.json');
    }

    public static function Buscar($nombre, $id)
    {
        $array = Datos::leerJson('materias.json');
        $retorno= false;

        foreach($array as $value)
        {
            if($value->nombre == $nombre)
            {
                if($value->id ==$id)
                {
                    $retorno=true;
                    
                    $key= "pro3-parcial";
                    $payload = array(
                        "Nombre" => $nombre,
                        "Id" => $id,                    
                        "cuatrimestre"=>$value->cuatrimestre
                    );
                    $jwt= JWT::encode($payload,$key);
                    echo "$jwt"; 
                    //var_dump($payload);
                    break; 
                }                
            }
        }
        return $retorno;
    }
}
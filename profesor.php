<?php

class Profesor{

    public $nombre;
    public $legajo;
    public $foto;

    public function __construct($nombre, $legajo, $foto)
    {
        $this->nombre= $nombre;
        $this->legajo=$legajo;
        $this->foto= $foto; 
       
    }

    public function GuardarProfesor()
    {
        return Datos::guardarJson('profesores.json', $this); 
    }

    public function Leer()
    {
        return Datos::leerJson('profesores.json');
    }

    public static function legajoUnico($legajo)
    {
        $array = Datos::leerJson('profesores.json');
        $retorno = false;

        if($array != null)
        {
            foreach($array as $value)
            {
                if($value->legajo == $legajo)
                {
                    $retorno = true;
                }
            }
        }        
        return $retorno;
    }

    public static function buscarLegajo($legajo)
    {
        $array = Datos::leerJson('profesores.json');
        $retorno = false;

        if($array != null)
        {
            foreach($array as $value)
            {
                if($value->legajo == $legajo)
                {
                    $retorno = array("Legajo: "=> "$legajo", "Nombre: "=> "$value->nombre");
                }
            }
        }        
        return $retorno;

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
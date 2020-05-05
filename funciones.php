<?php

class Funciones{

    public static function GenerarId($archivo)
    {
        $array = Datos::leerJson($archivo);
        
        if(!isset($array))
        {
            $retorno=1;
        }
        else
        {
            $retorno=count($array)+1;
        }
        return $retorno;
    }

    
}
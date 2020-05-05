<?php

class Datos{

    public static function guardarJson($archivo, $datos)
    {
        $stringJson= Datos::LeerJson($archivo); 
        if($stringJson==null)
        {
            $stringJson=array();
        }
        array_push($stringJson,$datos); //esto agrega al final de lo q hay 
        $pFile = fopen($archivo, 'w'); //o a+ funciona mal Con 'w' borra el q esta
        $rta = fwrite($pFile, json_encode($stringJson));  //convierto el objetos a JSON con json_encode      
        fclose($pFile);
        return $rta;
    }

    public static function LeerJson($archivo)
    {
        $file = fopen($archivo,'r');
        $rta = '';    
        while(!feof($file)){
            $linea = json_decode(fgets($file));
            if($rta==''){
                $rta = $linea;
            }else{
                $rta = $rta.' '.$linea;
            }        
        }        
        return $rta;
    }

}
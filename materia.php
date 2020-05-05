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
}
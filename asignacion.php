<?php

class Asignacion{

    public $legajoProfesor;
    public $idMateria;
    public $turno;

    public function __construct($legajoProfesor, $idMateria, $turno)
    {
        $this->legajoProfesor= $legajoProfesor;
        $this->idMateria= $idMateria; 
        
        if($turno=='mañana' || $turno=='noche')
        {
            $this->turno =  $turno;
        }
        else{
            echo "Solo puede asignarse turno mañana o noche";
        }     
    }

    public function GuardarAsignacion()
    {
        return Datos::guardarJson('materia-profesor.json', $this); 
    }

    
    public function Leer()
    {
        return Datos::leerJson('materia-profesor.json');
    }

    public static function turnoMateria($legajoProfesor, $turno, $idMateria)
    {
        $array = Datos::leerJson('materia-profesor.json');
        $retorno = false;

        if($array != null)
        {
            foreach($array as $value)
            {
                if($value->legajoProfesor == $legajoProfesor)
                {
                    if($value->turno == $turno)
                    {
                        if($value->idMateria == $idMateria)
                        {                            
                            $retorno = true;
                        }
                    }
                }
            }
        }        
        return $retorno;
    }

}
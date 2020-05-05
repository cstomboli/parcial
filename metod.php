<?php

include 'cliente.php';
include 'materia.php';
include 'profesor.php';
include 'asignacion.php';

class Metod{

    public $request_method;
    public $path_info;

    public function __construct($request_method, $path_info)
    {
        $this->request_method= $request_method;
        $this->path_info= $path_info;
    }

    public function conexion()
    {
        switch ($this->request_method) 
        {
            case 'POST':
                switch ($this->path_info) 
                {
                    case '/usuario':    //Punto 1
                        if(isset($_POST['email']) && isset($_POST['clave'])) 
                        {
                            $usuario= new Cliente($_POST['email'], $_POST['clave']);
                            $usuario->GuardarUsuario(); 
                            //var_dump($usuario);
                            echo "Usuario creado correctamente.";
                        }
                        break;
                    
                    case '/login':      //Punto 2
                        if(isset($_POST['email']) && isset($_POST['clave'])) 
                        {
                            if(Cliente::Buscar($_POST['email'], $_POST['clave']))
                            {
                                echo "Ingreso correcto";
                            }
                        }
                        break;
                    
                    case '/materia':    //Punto 3
                        if(isset($_POST['nombre']) && isset($_POST['cuatrimestre'])) 
                        {
                            $materia= new Materia($_POST['nombre'], $_POST['cuatrimestre'], null);
                            $materia->GuardarMateria(); 
                            echo "Materia creada correctamente.";
                        }
                        break;

                    case '/profesor':   //Punto 4  //ver q no me guarda bien la foto
                        if(isset($_POST['nombre']) && isset($_POST['legajo']) && isset($_FILES['imagen'])) 
                        {
                            $tmp_name=$_FILES['imagen']['tmp_name'];
                            $name=$_FILES['imagen']['name'];
                            $nombre=$_POST['nombre'].'-'.$name.'-'.time();
                            $folder= 'imagenes/'; 
                            $profesor= new Profesor($_POST['nombre'], $_POST['legajo'], $nombre);
                            if(Profesor::legajoUnico($_POST['legajo'])==false) 
                            {
                                $profesor->GuardarProfesor(); 
                                move_uploaded_file($tmp_name,$folder.$nombre);
                                echo "Profesor creado correctamente.";

                            }
                            else
                            {
                                echo "El legajo ya se encuentra registrado, modifiquelo para guardar.";
                            }
                            
                            //var_dump($profesor);
                        }
                        break;

                    case '/asignacion': //Punto 5, me guarda mal el turno
                        if(isset($_POST['legajo']) && isset($_POST['id']) && isset($_POST['turno'])) 
                        {
                            $asignacion= new Asignacion($_POST['legajo'], $_POST['id'], $_POST['turno']);
                            if(Asignacion::turnoMateria($_POST['legajo'], $_POST['id'], $_POST['turno'])==false)
                            {
                                $asignacion->GuardarAsignacion();
                            }
                            else{
                                echo "El profesor ya esta asignado a este turno y materia.";
                            }


                        }
                        break;

                    
                    default:
                        # code...
                        break;
                }
            break;

            case 'GET':
                switch ($this->path_info)
                {
                    case '/materia':    //Punto 6
                        echo  json_encode ( Materia:: Leer());
                        break;
                    
                    case '/profesor':   //Punto 7
                        echo  json_encode ( Profesor:: Leer());
                        break;

                    case '/asignacion': //Punto 8
                        echo  json_encode ( Asignacion:: Leer());
                    
                    default:
                        # code...
                        break;
                }
            break;
            
            default:
                # code...
                break;
        }

    }
}
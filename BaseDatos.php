<?php


    class BaseDatos{

        //ATRIBUTOS
        public $usuarioBD="";
        public $passwordBD="";
        public $servidorBD="mysql:host=ACA TU HOSTING;";
        public $nombreBD="dbname=ACA TU BD";

        //CONSTRUCTOR
        public function __construct(){}

        //METODOS
        public function conectarBD(){
            try{
                $datosGeneralesBD=$this->servidorBD.$this->nombreBD;
                $conexion= new PDO($datosGeneralesBD,$this->usuarioBD,$this->passwordBD);
                return($conexion);
            }catch(PDOException $mensajeError){
                die("Error en la conexion: ".$mensajeError);
            }   
        }

        public function escribirRegistros($consultaSQL,$tipoConsulta){

            //1. Conectarme a la base datos
            $conexion=$this->conectarBD();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            try{
                //2. Decirle a la BD que se prepare porque le voy a enviar una consulta SQL
                $operacion=$conexion->prepare($consultaSQL);
                //3. Ejecutar la consulta
                $resultado=$operacion->execute();
                //4. Clasificar la consulta
                $mensaje="exito agregando el registro";
                return($mensaje);

            }catch(PDOException $mensajeError){
                die("error ".$mensajeError);
            }

        }

        public function buscarRegistros($consultaSQL){
            
            //1. Conectarme a la base datos
            $conexion=$this->conectarBD();

            //2. Decirle a la BD que se prepare porque le voy a enviar una consulta SQL
            $operacion=$conexion->prepare($consultaSQL);

            //3. Definir COMO(en que formato) nos llegará la información
            //FETCH_ASSOC-->ENVIA LOS DATOS EN FORMA DE ARRAY MULTIDIMENSIONAL
            $operacion->setFetchMode(PDO::FETCH_ASSOC);

            //4 Ejecutar la operacion
            $resultado=$operacion->execute();

            //5. Retornar la información solicitada
            return($operacion->fetchAll());
        }

       

    }

?>
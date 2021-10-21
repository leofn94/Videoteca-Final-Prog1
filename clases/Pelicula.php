<?php

require_once 'clases/Usuario.php';

class Pelicula
{
    protected $cod;
    // protected $id_usuario;
    protected $usuario;
    protected $NombrePelicula;
    protected $anio;
    protected $Duracion_Minutos;
    protected $CostoBlueRay;


    public function __construct(Usuario $usuario, $NombrePelicula, $anio,$Duracion_Minutos,$CostoBlueRay,$cod = null)
    {
        $this->cod = $cod;
        $this->usuario = $usuario;
        $this->NombrePelicula = $NombrePelicula;
        $this->anio = $anio;
        $this->Duracion_Minutos = $Duracion_Minutos;
        $this->CostoBlueRay = $CostoBlueRay;

    }

    public function getcod() {return $this->cod;}
    public function setcod($cod) {$this->cod = $cod;}
    public function getIdUsuario() {return $this->usuario->getId();}
    public function getanio() {return $this->anio;}
    public function getDuracion_Minutos() {return $this->Duracion_Minutos;}   
    public function getCostoBlueRay() {return $this->CostoBlueRay;}
    public function getNombrePelicula() {return $this->NombrePelicula;}
    public function getUsuario() {return $this->usuario;}


}



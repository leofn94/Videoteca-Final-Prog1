<?php
class Peliculas
{
    protected $id;
    protected $id_usuario;
    protected $NombrePelicula;
    protected $anio;
    protected $Duracion_Minutos;
    protected $CostoBlueRay;


    public function __construct($id_usuario, $NombrePelicula, $anio,$Duracion_Minutos,$CostoBlueRay,$id = null)
    {
        $this->id = $id;
        $this->id_usuario = $id_usuario;
        $this->NombrePelicula = $NombrePelicula;
        $this->anio = $anio;
        $this->Duracion_Minutos = $Duracion_Minutos;
        $this->CostoBlueRay = $CostoBlueRay;

    }

    public function getId() {return $this->id;}
    public function setId($id) {$this->id = $id;}
    public function id_usuario() {return $this->id_usuario;}
    public function anio() {return $this->anio;}
    public function Duracion_Minutos() {return $this->Duracion_Minutos;}   
    public function CostoBlueRay() {return $this->CostoBlueRay;}

    
    public function NombrePelicula() {return $this->NombrePelicula;}

}



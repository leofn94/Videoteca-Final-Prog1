<?php
require_once 'clases/Usuario.php';
require_once 'clases/RepositorioPelicula.php';
require_once 'clases/RepositorioUsuario.php';
require_once 'clases/Pelicula.php';
require_once 'clases/Repo.php';


session_start();
if (isset($_SESSION['usuario']) && isset($_POST['NombrePelicula'])  && isset($_POST['anio'])  && isset($_POST['Duracion_Minutos'] ) && isset($_POST['CostoBlueRay'] )) 
{
    $usuario = unserialize($_SESSION['usuario']);
    $rp = new RepositorioPelicula();
    $pelicula = $rp->get_one($_POST['pelicula']);
    if ($pelicula->getIdUsuario() != $usuario->getId()) {
        die("Error: La película registrada no pertenece al usuario");
    }

//Al querer aplicar los cambios el update no logra aplicarlos

$rp->editPelicula($pelicula);
$respuesta['resultado'] = "OK";

}else {
    $respuesta['resultado'] = "Error al realizar la operación";
}

$respuesta['NombrePelicula'] = $pelicula->getcod();
$respuesta['anio'] = $pelicula->getanio();
$respuesta['Duracion_Minutos'] = $pelicula->getDuracion_Minutos();
$respuesta['CostoBlueRay'] = $pelicula->getCostoBlueRay();
echo json_encode ($respuesta);



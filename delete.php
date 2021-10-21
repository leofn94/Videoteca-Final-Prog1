<?php
require_once 'clases/Usuario.php';
require_once 'clases/RepositorioPelicula.php';
require_once 'clases/RepositorioUsuario.php';
require_once 'clases/Pelicula.php';
require_once 'clases/Repo.php';



session_start();
if (isset($_SESSION['usuario']) && isset($_GET['cod'])) {
    $usuario = unserialize($_SESSION['usuario']);
    $rp = new RepositorioPelicula();
    $pelicula = $rp->get_one($_GET['cod']);
    if ($pelicula->getIdUsuario() != $usuario->getId()) {
        die("Error: La película registrada no pertenece al usuario");
    }
 else {
        if ($rp->delete($pelicula)) {
            $mensaje = "Se eliminó la Película con éxito del registro";
        } else {
            $mensaje = "Error al eliminar la película";
        }
        header("Location: home.php?mensaje=$mensaje");
    }
} else {
    header('Location: index.php');
}
?>
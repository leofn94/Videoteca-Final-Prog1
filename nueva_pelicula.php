<?php
require_once 'clases/Usuario.php';
require_once 'clases/Pelicula.php';
require_once 'clases/RepositorioPelicula.php';


session_start();
if (isset($_SESSION['usuario'])) {
  $usuario = unserialize($_SESSION['usuario']);
  $nomApe = $usuario->getNombreApellido();
  //Registro de nueva película
  $pelicula = new Pelicula ($usuario, $_POST['NombrePelicula'], $_POST['anio'], $_POST['Duracion_Minutos'], $_POST['CostoBlueRay']);
  $rp = new RepositorioPelicula();
  $cod = $rp->save($pelicula);
    if ($cod === false){
        header('Location: home.php?mensaje=Error al registrar la pelicula');
    } else{
        $pelicula->setcod($cod);
        header('Location: home.php?mensaje=Pelicula registrada exitosamente');
    }

} else {
  header('Location: index.php');
}
?>





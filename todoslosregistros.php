<?php
require_once 'clases/Usuario.php';
require_once 'clases/RepositorioPelicula.php';
require_once 'clases/Pelicula.php';
require_once 'clases/Repo.php';

//La idea es que muestre todos los registros guardados de todos los usuarios

session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);
    $nomApe = $usuario->getNombreApellido();
    $rp = new RepositorioPelicula();
    $peliculas = $rp->registros($usuario);

} else {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Videoteca Paradiso</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="css/estiloconsulta.css">


</head>

<body class="container">
    <div class="jumbotron text-center">
        <h1>Videoteca Paradiso</h1>
    </div>
    <div class="text-center">
        <h3>Hola, <?php echo $nomApe; ?></h3>
        <p><a href="logout.php">Cerrar sesión</a></p>
    </div>

    <br>
    <h3>Todos los registros</h3>
    <br>

    <table class="table">
        <thead class="table-success table-striped">
            <tr>
                <th>Código</th>
                <th>Nombre de la película</th>
                <th>Año</th>
                <th>Duración</th>
                <th>Precio</th>
            </tr>
        </thead>

<?php


if (count($peliculas) == 0) {
    echo "<tr><td colspan='5'>No tiene peliculas registradas</td></tr>";
} else {
    foreach ($peliculas as $unapelicula) {
        $cod = $unapelicula->getcod();
        echo '<tr>';
        echo "<td>$cod</td>";
        echo "<td id='NombrePelicula-$cod'>" . $unapelicula->getNombrePelicula(). "</td>";
        echo "<td id='anio-$cod'>" . $unapelicula->getanio(). "</td>";
        echo "<td id='Duracion_Minutos-$cod'>" . $unapelicula->getDuracion_Minutos(). "</td>";
        echo "<td id='CostoBlueRay-$cod'>" . $unapelicula->getCostoBlueRay(). "</td>";
        echo '</tr>';

    }

}

?>

        <a class="btn btn-primary" href="home.php">Volver atrás</a>
        <br><br>
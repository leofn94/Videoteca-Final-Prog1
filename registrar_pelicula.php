<?php
require_once 'clases/Usuario.php';
session_start();
if (isset($_SESSION['usuario'])) {
  $usuario = unserialize($_SESSION['usuario']);
  $nomApe = $usuario->getNombreApellido();
} else {
  header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css">


    <link rel="stylesheet" href="css/estilo_registrar_pelicula.css">



    <title>Registrar película</title>
</head>

<body>

    <!-- <div class="container mt-5">
    <div class="row">



      <div class="col-md-10"> -->

    </div class="registrar">

    <h3>Ingrese los datos de la película:</h3> <br>
    <form action="nueva_pelicula.php" method="post">

        <label for="Titulo">Nombre </label> <br>
        <input type="text" name="NombrePelicula" placeholder="Escriba el titulo" required id="NombrePelicula"><br> <br>

        <label for="Año">Año </label> <br>
        <input type="number" name="anio" placeholder="Año de estreno" min="1900" required id="anio"> <br> <br>

        <label for="Minutos de duración">Duración </label> <br>
        <input type="number" name="Duracion_Minutos" placeholder="Minutos de duración" min="60" required
            id="Duracion_Minutos"> <br> <br>

        <label for="Precio">Precio </label> <br>
        <input type="number" name="CostoBlueRay" placeholder="Ingrese el importe" required id="CostoBlueRay"> <br> <br>

        <input type="submit" value="Ingresar registro" class="btn btn-success">
        <a class="btn btn-primary" href="home.php">Volver atrás</a>

    </form>
    </div>

</body>

</html>
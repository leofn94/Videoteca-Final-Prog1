<?php

require_once 'clases/Usuario.php';
require_once 'clases/RepositorioPelicula.php';
require_once 'clases/Pelicula.php';

session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);
    $nomApe = $usuario->getNombreApellido();
    $rp = new RepositorioPelicula();
    $peliculas = $rp->get_all($usuario);

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

</head>



<body class="container">
  <div class="jumbotron text-center">
    <h1>Videoteca Paradiso</h1>
  </div>
  <div class="text-center">
    <h3>Hola, <?php echo $nomApe; ?></h3>
    <p><a href="logout.php">Cerrar sesión</a></p>
  </div>


  <?php
if (isset($_GET['mensaje'])) {
    echo '<p class="alert alert-primary">' . $_GET['mensaje'] . '</p>';
}
?>

<!--
  <div class="container mt-5">
    <div class="row">



      <div class="col-md-3">

        <h3>Ingrese los datos de la película:</h3> <br>
        <form action="agregardatos.php">


          <label for="Codigo pelicula">Codigo </label>
          <input type="number" name="cod" value="101" min="101"> <br> <br>

          <label for="Titulo">Nombre </label>
          <input type="text" name="nombre" placeholder="Escriba el titulo"><br> <br>

          <label for="Año">Año </label> <br>
          <input type="number" name="anio" placeholder="Año de estreno" min="1900"> <br> <br>

          <label for="Minutos de duración">Duración </label>
          <input type="number" name="anio" placeholder="Minutos de duración" min="60"> <br> <br>

          <label for="Precio">Precio </label>
          <input type="number" name="Precio" placeholder="Ingrese el importe"> <br> <br>

          <input type="submit" value="Ingresar registro"class="btn btn-primary"> <br>
        </form>


      </div>



    </div>



    <div class="col-md-9">
        <table class="table">
          <thead class="table-success table-striped">

            <tr>
              <th>Codigo</th>
              <th>Nombre</th>
              <th>Año</th>
              <th>Duración</th>
              <th>Precio</th>
            <tr>
          </thead>

        </table>

</div> -->


<a class="btn btn-primary" href="registrar_pelicula.php">Registrar nueva película</a>

<br><br>

<h3>Listado de películas</h3>
<br>
<table class="table table-striped">

<tr>

<th>Código</th>
<th>Nombre de la película</th>
<th>Año</th>
<th>Duración</th>
<th>Precio</th>
<th>Editar</th>
<th>Eliminar</th>

</tr>

<?php
if (count($peliculas) == 0) {
    echo "<tr><td colspan='5'>No tiene peliculas registradas</td></tr>";
} else {
    foreach ($peliculas as $unapelicula) {
        $cod = $unapelicula->getcod();
        echo '<tr>';
        echo "<td>$cod</td>";
        // echo '<tr>';
        // echo "<td>" . $unapelicula->getcod(). "</td>";
        // echo '<tr>';
        echo "<td>" . $unapelicula->getNombrePelicula(). "</td>";
        // echo '<tr>';
        echo "<td>" . $unapelicula->getanio(). "</td>";
        // echo '<tr>';
        echo "<td>" . $unapelicula->getDuracion_Minutos(). "</td>";
        // echo '<tr>';
        echo "<td>" . $unapelicula->getCostoBlueRay(). "</td>";
        echo "<td><button type='button' onclick='Editar($cod)'>Editar</button></td>";
        echo "<td><a href='delete.php?cod=$cod'>Eliminar</a></td>";
        echo '</tr>';

    }

}

?>

</body>

</html>
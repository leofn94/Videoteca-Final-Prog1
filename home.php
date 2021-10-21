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
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Videoteca Paradiso</title>
  <link rel="stylesheet" href="bootstrap.min.css">

</head>



<body>
  <!-- <div class="jumbotron text-center"> -->
    <!-- <h1>Videoteca Paradiso</h1>
  </div> -->
  <!-- <div class="text-center">
    <h3>Hola, <?php echo $nomApe; ?></h3>
    <p><a href="logout.php">Cerrar sesión</a></p> -->
  <!-- </div> -->


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
    
 
    
    <!-- </div> -->



    <div class="col-md-8">
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

</tbody>

</div>


</body>

</html>
<?php

require_once 'clases/Usuario.php';
require_once 'clases/RepositorioPelicula.php';
require_once 'clases/Pelicula.php';
require_once 'clases/Repo.php';

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
    <link rel="stylesheet" href="css/estilohome.css">

</head>

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
<br>
<a class="btn btn-success" href="registrar_pelicula.php">Registrar nueva película</a>

<a class="btn btn-info" href="todoslosregistros.php">Consultar todos los registros</a>
<br><br>

<body>

    <h3>Listado de películas</h3>

    <div class="container mt-5">
        <div class="row">


            <!-- seccion de edicion -->
            <div class="col-md-3">

                <div id="edicion">
                    <h3 id="edicion">Edición</h3> <br>
                    <input type="hidden" id="cod">

                    <label for="Titulo">Nombre </label>
                    <input type="text" name="NombrePelicula" placeholder="Escriba el titulo" required
                        id="NombrePelicula"><br> <br>

                    <label for="Año">Año </label> <br>
                    <input type="number" name="anio" placeholder="Año de estreno" min="1900" required id="anio"> <br>
                    <br>

                    <label for="Minutos de duración">Duración </label>
                    <input type="number" name="Duracion_Minutos" placeholder="Minutos de duración" min="60" required
                        id="Duracion_Minutos"> <br> <br>

                    <label for="Precio">Precio </label>
                    <input type="number" name="CostoBlueRay" placeholder="Ingrese el importe" required
                        id="CostoBlueRay"> <br> <br>

                    <button type="button" onclick="edit();">Realizar edicion</button>
                    <br>
                    <br>
                    <br>

                </div>
            </div>

            <!-- Tablas generadas -->

            <div class="col-md8">

                <table class="table">
                    <thead class="table-success table-striped">
                        <tr>
                            <th>Código</th>
                            <th>Nombre de la película</th>
                            <th>Año</th>
                            <th>Duración</th>
                            <th>Precio</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>

            </div>

            <?php
if (count($peliculas) == 0) {
    echo "<tr><td colspan='5'>No tiene peliculas registradas</td></tr>";
} else {
    foreach ($peliculas as $unapelicula) {
        $cod = $unapelicula->getcod();
        echo '<tr>';
        echo "<td>$cod</td>";
        echo "<td id='NombrePelicula-$cod'>" . $unapelicula->getNombrePelicula() . "</td>";
        echo "<td id='anio-$cod'>" . $unapelicula->getanio() . "</td>";
        echo "<td id='Duracion_Minutos-$cod'>" . $unapelicula->getDuracion_Minutos() . "</td>";
        echo "<td id='CostoBlueRay-$cod'>" . $unapelicula->getCostoBlueRay() . "</td>";
        echo "<td><button type='button' onclick='Editar($cod)'>Editar</button></td>";
        echo "<td><a href='delete.php?cod=$cod'>Eliminar</a></td>";
    }

}
?>



































            <script>
            function edit() {
                var pelicula = document.querySelector('#cod').value;
                var NombrePelicula = document.querySelector('#NombrePelicula').value;
                var anio = document.querySelector('#anio').value;
                var Duracion_Minutos = document.querySelector('#Duracion_Minutos').value;
                var CostoBlueRay = document.querySelector('#CostoBlueRay').value;
                var cadena = "pelicula=" + cod + "&NombrePelicula=" + NombrePelicula + "&anio=" + anio +
                    "&Duracion_Minutos=" + Duracion_Minutos + "&CostoBlueRay=" + CostoBlueRay;

                var solicitud = new XMLHttpRequest();

                solicitud.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var respuesta = JSON.parse(this.responseText);
                        var identificadorNombre = "#NombrePelicula-" + respuesta.codigo_pelicula;
                        var celda = document.querySelector(identificadorNombre);

                        var identificadorAnio = "#anio-" + respuesta.codigo_pelicula;
                        var celda = document.querySelector(identificadorAnio);

                        var identificadorDuracion = "#Duracion_Minutos-" + respuesta.codigo_pelicula;
                        var celda = document.querySelector(identificadorDuracion);

                        var identificadorPrecio = "#CostoBlueRay-" + respuesta.codigo_pelicula;
                        var celda = document.querySelector(identificadorPrecio);

                        if (respuesta.resultado == "OK") {
                            celda.innerHTML = respuesta.nombre;
                        } else {
                            alert(respuesta.resultado);
                        }
                        celda.scrollIntoView();
                    }
                };
                solicitud.open("POST", "update.php", true);
                solicitud.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                solicitud.send(cadena);
            }

            function Editar(Ncodigo) {
                document.querySelector('#cod').value = Ncodigo;
                document.querySelector('#NombrePelicula').focus();

            }
            </script>

</body>

</html>
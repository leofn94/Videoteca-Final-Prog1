<?php
require_once '.env.php';
require_once 'clases/usuario.php';
require_once 'clases/Pelicula.php';

class RepositorioPelicula
{
    private static $conexion = null;


    public function __construct()
    {
        if (is_null(self::$conexion)) {
            $credenciales = credenciales();
            self::$conexion = new mysqli($credenciales['servidor'],
                $credenciales['usuario'],
                $credenciales['clave'],
                $credenciales['base_de_datos']);
            if (self::$conexion->connect_error) {
                $error = 'Error de conexión: ' . self::$conexion->connect_error;
                self::$conexion = null;
                die($error);
            }
            self::$conexion->set_charset('utf8');
        }
    }

    public function save(Pelicula $pelicula)
    {
        $NombrePelicula = $pelicula->getNombrePelicula();
        $anio = $pelicula->getanio();
        $Duracion_Minutos = $pelicula->getDuracion_Minutos();
        $CostoBlueRay = $pelicula->getCostoBlueRay();
        $idUsuario = $pelicula->getIdUsuario();

        $q = "INSERT INTO peliculas (NombrePelicula, anio, Duracion_Minutos, CostoBlueRay, id_usuario) VALUES (?, ?, ?, ?, ?)";
        try {
            $query = self::$conexion->prepare($q);

            $query->bind_param("siiii", $NombrePelicula, $anio, $Duracion_Minutos, $CostoBlueRay, $idUsuario);

            if ($query->execute()) {
                return self::$conexion->insert_id;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }



    public function get_all(Usuario $usuario)
    {
        $idUsuario = $usuario->getId();
        $q = " SELECT NombrePelicula, anio, Duracion_Minutos, CostoBlueRay, cod FROM peliculas WHERE id_usuario = ? " ;
        try {
            $query = self::$conexion->prepare($q);
            $query->bind_param( "i", $idUsuario );
            $query->bind_result( $NombrePelicula, $anio, $Duracion_Minutos, $CostoBlueRay, $cod );

            if ($query->execute()) {
                $listaPeliculas = array();
                while ($query->fetch()) {
                    $listaPeliculas[] = new Pelicula ($usuario, $NombrePelicula, $anio, $Duracion_Minutos, $CostoBlueRay, $cod );
                }
                return $listaPeliculas;
            }
            return false;
        } catch(Exception $e) {
            return false;
        }
    }

    public function get_one($cod)
    {
        $q = "SELECT NombrePelicula, anio, Duracion_Minutos, CostoBlueRay, id_usuario FROM peliculas WHERE cod = ?";
        try {
            $query = self::$conexion->prepare($q);
            $query->bind_param("i", $cod);
            $query->bind_result( $NombrePelicula, $anio, $Duracion_Minutos, $CostoBlueRay, $idUsuario);

            if ($query->execute()) {
                if ($query->fetch()) {
                    $ru = new RepositorioUsuario();
                    $usuario = $ru->get_one($idUsuario);
                    return new Pelicula($usuario, $NombrePelicula, $anio, $Duracion_Minutos, $CostoBlueRay, $cod);
                }
            }
            return false;
        } catch(Exception $e) {
            return false;
        }
    }

       

    public function delete(Pelicula $pelicula)
    {
        $cod = $pelicula->getcod();
        $q = "DELETE FROM peliculas WHERE cod = ?";
        $query = self::$conexion->prepare($q);
        $query->bind_param("i", $cod);
        return ($query->execute());
    }

    public function editPelicula(Pelicula $pelicula)
    {
        $cod = $pelicula->getcod();
        $NombrePelicula = $pelicula->getNombrePelicula();
        $anio = $pelicula->getanio();
        $Duracion_Minutos = $pelicula->getDuracion_Minutos();
        $CostoBlueRay = $pelicula->getCostoBlueRay();
        

        $q = "UPDATE peliculas SET NombrePelicula = ? , anio = ? , Duracion_Minutos = ? , CostoBlueRay = ? WHERE cod = ?";
        $query = self::$conexion->prepare($q);
        $query->bind_param("siiii", $NombrePelicula, $anio, $Duracion_Minutos, $CostoBlueRay, $cod);
        return ($query->execute());

    }

}
    



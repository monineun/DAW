<html>
<?php
session_start();
if(isset($_SESSION['nombre'])){

  require("requires/mysqli.php");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    else {
      $sql = "SELECT Clave FROM usuarios where NomUsuario='{$_SESSION['nombre']}'";
      $consulta = $mysqli->query($sql);

      $fila = $consulta->fetch_assoc();

      if($fila['Clave']==$_POST['pass']){
        //BORRAR SOLICITUDES?
        $sql = "DELETE u, a, f FROM usuarios u LEFT JOIN albumes a ON u.IdUsuario = a.Usuario LEFT JOIN fotos f ON f.Album = a.IdAlbum WHERE u.NomUsuario = '{$_SESSION['nombre']}'";
        $consulta = $mysqli->query($sql);
        $host = $_SERVER['HTTP_HOST'];
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'cerrarsesion.php?del=1';
        header("Location: http://$host$uri/$extra");
        exit;
      }
      else {
        $host = $_SERVER['HTTP_HOST'];
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'baja.php';
        header("Location: http://$host$uri/$extra");
        exit;
      }
    mysqli_close($mysqli);
  }
}

else {
  $host = $_SERVER['HTTP_HOST'];
  $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  $extra = 'cerrarsesion.php';
  header("Location: http://$host$uri/$extra");
  exit;
}

?>
</html>

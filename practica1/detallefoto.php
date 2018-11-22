<!--  Página detalle foto
  Muestra toda la información sobre una foto seleccionada en la página anterior (foto, título, fecha, país, álbum de fotos y usuario al que pertenece)-->

  <?php
  session_start();

  if(isset($_COOKIE['last_visit'])) {
    $current_visit = date("c");
    setcookie("last_visit", $current_visit, (time()+60*60*24*90), $secure = true);
  }

  if(isset($_SESSION['nombre'])){
  require_once("requires/cabecera.php");
  require_once("requires/inicio.php");
  require_once("requires/barrabusqueda.php");
  require_once("requires/ensesion.php");

    if(isset($_GET['id'])){

      $id = $_GET['id'];

      $connection = new mysqli("localhost", "root", "root", "pibd");

      if ($connection->connect_error) {
          die("Connection failed: " . $connection->connect_error);
      }
        //Foto para los id impares
        else {
          $sql = "SELECT * FROM fotos where fotos.IdFoto=$id";
          $consulta = $connection->query($sql);

          if ($consulta->num_rows > 0) {

            $fila = $consulta->fetch_assoc();

            $sql2 = "SELECT * FROM paises where paises.IdPais={$fila["Pais"]}";
            $consulta2 = $connection->query($sql2);
            $fila2 = $consulta2->fetch_assoc();

            $sql3 = "SELECT * FROM albumes where albumes.IdAlbum={$fila["Album"]}";
            $consulta3 = $connection->query($sql3);
            $fila3 = $consulta3->fetch_assoc();

            $sql4 = "SELECT * FROM usuarios where usuarios.IdUsuario={$fila3["IdAlbum"]}";
            $consulta4 = $connection->query($sql4);
            $fila4 = $consulta4->fetch_assoc();


            $nombre = "{$fila["Titulo"]}";
            $fecha = "'2018-09'>{$fila["Fecha"]}";
            $pais = "{$fila2["NomPais"]}";
            $album = "<a href='#album'> <span>{$fila3["Titulo"]}</span> </a>";
            $usuario = "<a href='usuario.php?id={$fila4["IdUsuario"]}'> <span>{$fila4["NomUsuario"]}</span> </a>";
            $foto = "{$fila["Fichero"]}";

          }
        }

echo<<<EOF

        <h1>Detalles de la foto</h1>

        <figure id='fotoendetalle'>
          <img src='$foto' alt='Fotografía' style='width:100%'>
          <figcaption>$nombre</figcaption>

          <ul>
            <li><time datetime=$fecha</time></li>
            <li>$pais</li>
            <li> Perteneciente al álbum $album del usuario $usuario</li>
          </ul>
        </figure>
EOF;
}
else{
  $host = $_SERVER['HTTP_HOST'];
  $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  $extra = 'index.php';
  header("Location: http://$host$uri/$extra");
  exit;
}

       $volver="index.php";
    require_once("requires/pie.php");
}

else{
  $host = $_SERVER['HTTP_HOST'];
  $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  $extra = 'index.php?error=403';
  header("Location: http://$host$uri/$extra");
  exit;
}

?>

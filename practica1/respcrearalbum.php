<!-- Página “Respuesta crear álbum”
    Muestra los datos necesarios para crear un álbum (título y descripción). -->

    <?php
    session_start();

    if(isset($_COOKIE['last_visit'])) {
      $current_visit = date("c");
      setcookie("last_visit", $current_visit, (time()+60*60*24*90), $secure = true);
    }

    if(isset($_SESSION['nombre'])){
    require_once("requires/cabecera.php");
    require_once("requires/inicio.php");
    require_once("requires/ensesion.php");


echo<<<EOF
    <p>Has creado el álbum {$_POST["titulo"]} con descripción {$_POST["descripcion"]} de manera exitosa.</p>
EOF;


     $volver="index.php";
    require_once("requires/pie.php");
  }
  else {
    $host = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $extra = 'index.php';
    header("Location: http://$host$uri/$extra");
    exit;
  }
    ?>

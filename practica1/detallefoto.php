<!--  Página detalle foto
  Muestra toda la información sobre una foto seleccionada en la página anterior (foto, título, fecha, país, álbum de fotos y usuario al que pertenece)-->

  <?php
  require_once("requires/cabecera.php");
  require_once("requires/inicio.php");
  require_once("requires/barrabusqueda.php");
  require_once("requires/ensesion.php");
   ?>

      <?php
        $id = $_GET['id'];

        //Foto para los id pares
        if($id%2 == 0){
          $nombre = 'Foto par';
          $fecha = "'2018-09'>Septiembre 2018";
          $pais = 'España';
          $album = "<a href='#albumpar'> <span>Álbum Par</span> </a>";
          $usuario = "<a href='#usuariopar'> <span>Usuario Par</span> </a>";
          $foto = "images/foto1.jpg";
        }
        //Foto para los id impares
        else {
          $nombre = 'Foto impar';
          $fecha = "'2018-10'>Octubre 2018";
          $pais = 'Alemania';
          $album = "<a href='#albumimpar'> <span>Álbum Impar</span> </a>";
          $usuario = "<a href='#usuarioimpar'> <span>Usuario Impar</span> </a>";
          $foto = "images/foto2.jpg";
        }

        echo "<h1>Detalles de la foto</h1>

        <figure id='fotoendetalle'>
          <img src='".$foto."' alt='Fotografía' style='width:100%'>
          <figcaption>".$nombre."</figcaption>

          <ul>
            <li><time datetime=".$fecha."</time></li>
            <li>".$pais."</li>
            <li> Perteneciente al álbum ".$album." del usuario ".$usuario."</li>
          </ul>
        </figure>"
      ?>

    <!-- En el pie de página incluye los nombres de los autores de la práctica, un aviso de copyright con el año y alguna información más. -->
    <?php $volver="index.php";
    require_once("requires/pie.php"); ?>

<?php
session_start();

if(isset($_COOKIE['last_visit'])) {
  $current_visit = date("c");
  setcookie("last_visit", $current_visit, (time()+60*60*24*90), $secure = true);
}

if (isset($_COOKIE['nombre'])) {
   if($_COOKIE['nombre'] == $_COOKIE['cont']){
  $_SESSION['nombre'] = $_COOKIE['nombre'];
  $_SESSION['estilo'] = $_COOKIE['estilo'];
  }
}


if(isset($_SESSION['nombre'])) {
require_once("requires/cabecera.php");
require_once("requires/inicio.php");

$mysqli = new mysqli("localhost", "root", "root", "pibd");
if($mysqli -> connect_errno) echo "<p>mal asunto</p>";
//else echo "<p>tamos dentro</p>";

$sentencia = "SELECT IdUsuario from Usuarios where NomUsuario='{$_SESSION['nombre']}'";
$usu = $mysqli->query($sentencia);
if(!$usu || $mysqli->errno) echo "<p>mal asunto</p>";
//else echo "<p>lo tenemo</p>";

$idusu = $usu->fetch_assoc();
$id = $idusu['IdUsuario'];

//Tenemos el id del usuario actual asi que buscamos sus misalbumes
$sentencia2 = "SELECT * from Albumes where Usuario='{$id}'";
$alb = $mysqli->query($sentencia2);
if(!$alb || $mysqli->errno) echo "<p>mal asunto</p>";
//else echo "<p>lo tenemo</p>";

echo<<<EOF
    <h2> Mis álbumes </h2>
    <ul>
EOF;

while($fila = $alb->fetch_assoc()){
  echo "<li><a href='veralbum.php?idalb={$fila['IdAlbum']}'>{$fila['Titulo']}, {$fila['Descripcion']}</a></li>";
}

echo<<<EOF
    </ul>
EOF;

     $volver="index.php";
    require_once("requires/pie.php");
  }
  else{
    $host = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $extra = 'index.php';
    header("Location: http://$host$uri/$extra");
    exit;
  }

?>

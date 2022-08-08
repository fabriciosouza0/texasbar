<?php 

$servidor = "localhost";
$usuario = "root";
$senha = "";
$bd = "restaurante";

$con = mysqli_connect($servidor,$usuario,$senha,$bd);
mysqli_set_charset($con, "utf8");

?>
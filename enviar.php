<?php

// Include confi.php
include_once('backend/config.php');
include "backend/methods.php";

$titulo = filter_input(INPUT_POST, 'titulo');
$cuerpo = filter_input(INPUT_POST, 'cuerpo');

echo Methods::enviar($conn, $titulo, $cuerpo);

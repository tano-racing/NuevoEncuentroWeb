<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../../vendor/autoload.php';
require_once "../../entities/Actividades.php";
require_once "../../entities/Usuarios.php";
require_once "../../backend/config.php";
require_once "../../backend/metodos.php";

if (filter_input(INPUT_SERVER, "REQUEST_METHOD") === "POST") {

    $nombre = filter_input(INPUT_POST, 'nombre');
    $descripcion = filter_input(INPUT_POST, 'descripcion');
    $imagen = $_FILES['imagen_img']['tmp_name'];
    $cuando = filter_input(INPUT_POST, 'cuando');
    $repeticion = filter_input(INPUT_POST, 'repeticion');
    $esTaller = filter_var(filter_input(INPUT_GET, 'esTaller'), FILTER_VALIDATE_BOOLEAN);


    $actividadesRepo = $entityManager->getRepository('Actividades');
    $actividad = $actividadesRepo->findOneBy(array('nombre' => $nombre));
    if (!$actividad) {

        $msg = "Actividad agregada";
        $actividad = new Actividades();
        $actividad->setNombre($nombre);

        $actividad->setDescripcion($descripcion);
        $actividad->setCuando($cuando);
        $actividad->setRepeticion($repeticion);
        $actividad->setEsTaller($esTaller);

        try {
            $entityManager->persist($actividad);
            $entityManager->flush();

            $lastid = $actividad->getIdActividad();

            Metodos::resize($imagen, $lastid, $esTaller);
            Metodos::enviar($entityManager, "", "Actividades");

            $json = array("error" => false, "mensaje" => $msg);
        } catch (Exception $ex) {
            $json = array("error" => true, "mensaje" => $ex->getMessage());
        }
    } else {
        $json = array("error" => true, "mensaje" => "La actividad ya existe");
    }
} else {
    $json = array("error" => true, "mensaje" => "No se paso ningun parametro");
}

header('Content-type: application/json');
echo json_encode($json);

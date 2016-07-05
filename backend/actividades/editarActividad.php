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

    $idActividad = filter_input(INPUT_POST, 'idActividad');
    $nombre = filter_input(INPUT_POST, 'nombre');
    $descripcion = filter_input(INPUT_POST, 'descripcion');
    if (isset($_FILES['imagen_img'])) {
        $imagen = $_FILES['imagen_img']['tmp_name'];
    }
    $cuando = filter_input(INPUT_POST, 'cuando');
    $repeticion = filter_input(INPUT_POST, 'repeticion');
    $esTaller = filter_var(filter_input(INPUT_GET, 'esTaller'), FILTER_VALIDATE_BOOLEAN);

    $actividadesRepo = $entityManager->getRepository('Actividades');
    $actividad = $actividadesRepo->find($idActividad);
    if ($actividad) {

        $actividad->setDescripcion($descripcion);
        $actividad->setCuando($cuando);
        $actividad->setRepeticion($repeticion);
        $actividad->setEsTaller($esTaller);

        try {
            $entityManager->persist($actividad);
            $entityManager->flush();

            if (isset($_FILES['imagen_img'])) {
                $lastid = $actividad->getIdActividad();
                $destino = "../imagenes/actividad-$lastid.jpg";

                Metodos::resize($imagen, $lastid, $esTaller);
            }
            Metodos::enviar($entityManager, "", "Actividades", -1);

            $json = array("error" => false, "mensaje" => "Actividad actualizada");
        } catch (Exception $ex) {
            $json = array("error" => true, "mensaje" => $ex->getMessage());
        }
    } else {
        $json = array("error" => true, "mensaje" => "No existe la actividad");
    }
} else {
    $json = array("error" => true, "mensaje" => "No se paso ningun parametro");
}

header('Content-type: application/json');
echo json_encode($json);

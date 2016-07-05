<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../../vendor/autoload.php';
require_once "../../entities/Actividades.php";
require_once "../../backend/config.php";

header('Content-type: application/json');

if (filter_has_var(INPUT_GET, "fid")) {
    $fid = filter_input(INPUT_GET, "fid");
    $esTaller = filter_var(filter_input(INPUT_GET, "esTaller"), FILTER_VALIDATE_BOOLEAN);

    $buscar = "0";
    if ($esTaller == "true") {
        $buscar = "1";
    }

    $actividadesRepo = $entityManager->getRepository('Actividades');
    $actividades = $actividadesRepo->findBy(array('esTaller' => $buscar)); //(Array("esTaller" => $esTaller));

    $result = array();
    foreach ($actividades as $actividad) {
        $result[] = Array(
            "idActividad" => $actividad->getIdActividad(),
            "nombre" => $actividad->getNombre(),
            "descripcion" => $actividad->getDescripcion(),
            "imagen" => $actividad->getImagen(),
            "cuando" => $actividad->getCuando(),
            "repeticion" => $actividad->getRepeticion(),
            "esTaller" => $actividad->getEsTaller()
        );
    }

    echo json_encode($result);
} else {
    echo "Se necesita setear un ID";
}
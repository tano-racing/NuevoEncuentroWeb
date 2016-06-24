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

    $actividadesRepo = $entityManager->getRepository('Actividades');
    $actividad = $actividadesRepo->find($idActividad);

    try {
        $entityManager->remove($actividad);
        $entityManager->flush();

        Metodos::enviar($entityManager, "", "Actividades");

        $json = array("error" => false, "mensaje" => "Actividad Borrada");
    } catch (Exception $ex) {
        $json = array("error" => true, "mensaje" => $ex->getMessage());
    }
} else {
    $json = array("error" => true, "mensaje" => "No se paso ningun parametro");
}

header('Content-type: application/json');
echo json_encode($json);

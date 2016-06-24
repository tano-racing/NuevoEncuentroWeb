<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../../vendor/autoload.php';
require_once "../../entities/Usuarios.php";
require_once "../../backend/config.php";

if (filter_input(INPUT_SERVER, "REQUEST_METHOD") === "POST") {

    $msg = "Usuario actualizado";

    $facebookId = filter_input(INPUT_POST, 'facebookId');
    $registrationId = filter_input(INPUT_POST, 'registrationId');
    $nombreApellido = filter_input(INPUT_POST, 'nombreApellido');
    $email = filter_input(INPUT_POST, 'email');
    $fecha = new DateTime('now');

    $usuariosRepo = $entityManager->getRepository('Usuarios');
    $usuario = $usuariosRepo->findOneBy(array('facebookId' => $facebookId));
    if (!$usuario) {

        $msg = "Usuario agregado";
        $usuario = new Usuarios();
        $usuario->setFacebookId($facebookId);
    }

    $usuario->setRegistrationId($registrationId);
    $usuario->setNombreApellido($nombreApellido);
    $usuario->setEmail($email);
    $usuario->setCreadoEl($fecha);

    try {
        $entityManager->persist($usuario);
        $entityManager->flush();

        $json = array("error" => false, "mensaje" => $msg);
    } catch (Exception $ex) {
        $json = array("error" => true, "mensaje" => $ex->getMessage());
    }
} else {
    $json = array("error" => true, "mensaje" => "No se paso ningun parametro");
}

header('Content-type: application/json');
echo json_encode($json);

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../../vendor/autoload.php';
require_once "../../entities/Usuarios.php";
require_once "../../backend/config.php";


if (filter_has_var(INPUT_GET, "fid")) {
    $fid = filter_input(INPUT_GET, "fid");

    $usuariosRepo = $entityManager->getRepository('Usuarios');
    $usuarios = $usuariosRepo->findAll();

    $result = array();
    foreach ($usuarios as $usuario) {
        $result[] = Array(
            "idUsuario" => $usuario->getIdUsuario(),
            "nombreApellido" => $usuario->getNombreApellido(),
            "email" => $usuario->getEmail(),
            "facebookId" => $usuario->getFacebookId(),
            "creadoEl" => $usuario->getCreadoEl()
        );
    }

    echo json_encode($result);
} else {
    echo "Se necesita setear un ID";
}
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

define('API_ACCESS_KEY', 'AIzaSyAt3ON-TO3No3JszkD1qbvErB4M1NpvuDk');

class Metodos {

    public static function enviar($entityManager, $titulo, $cuerpo) {
        $msg = array('icon' => 'This is a subtitle. subtitle', 'sound' => '', 'tag' => '', 'color' => '');

        $usuariosRepo = $entityManager->getRepository('Usuarios');
        $usuarios = $usuariosRepo->findAll();

        $gcmRegIds = array();
        foreach ($usuarios as $usuario) {
            array_push($gcmRegIds, $usuario->getRegistrationId());
        }

        $msg['title'] = $titulo;
        $msg['body'] = $cuerpo;

        $fields = array('registration_ids' => $gcmRegIds, 'data' => $msg);
        $headers = array("Authorization:key=" . API_ACCESS_KEY, "Content-Type:application/json");

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public static function resize($fn, $detino) {

        $maxwidth = 800;
        $maxheight = 800;
        list($width, $height) = getimagesize($fn);
        if ($maxwidth < $width && $width >= $height) {
            $thumbwidth = $maxwidth;
            $thumbheight = ($thumbwidth / $width) * $height;
        } elseif ($maxheight < $height && $height >= $width) {
            $thumbheight = $maxheight;
            $thumbwidth = ($thumbheight / $height) * $width;
        } else {
            $thumbheight = $height;
            $thumbwidth = $width;
        }

        $imgbuffer = imagecreatetruecolor($thumbwidth, $thumbheight);
        $image = imagecreatefromjpeg($fn);
        imagecopyresampled($imgbuffer, $image, 0, 0, 0, 0, $thumbwidth, $thumbheight, $width, $height);
        imageinterlace($imgbuffer);
        $output = imagejpeg($imgbuffer, $detino, 100);
        imagedestroy($imgbuffer);
        return $output;
    }

}

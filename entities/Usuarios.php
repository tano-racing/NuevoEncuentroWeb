<?php

/**
 * @Entity @Table(name="usuarios")
 * */
class Usuarios {

    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $idUsuario;

    /**
     * @Column(type="string", unique=true)
     */
    protected $facebookId;

    /** 
     * @Column(type="string") 
     */
    protected $nombreApellido;

    /** 
     * @Column(type="string") 
     */
    protected $email;

    /** 
     * @Column(type="string") 
     */
    protected $registrationId;

    /** 
     * @Column(type="datetime") 
     */
    protected $creadoEl;

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getFacebookId() {
        return $this->facebookId;
    }

    function getNombreApellido() {
        return $this->nombreApellido;
    }

    function getEmail() {
        return $this->email;
    }

    function getRegistrationId() {
        return $this->registrationId;
    }

    function getCreadoEl() {
        return $this->creadoEl->format('Y-m-d H:i:s');;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setFacebookId($facebookId) {
        $this->facebookId = $facebookId;
    }

    function setNombreApellido($nombreApellido) {
        $this->nombreApellido = $nombreApellido;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setRegistrationId($registrationId) {
        $this->registrationId = $registrationId;
    }

    function setCreadoEl($creadoEl) {
        $this->creadoEl = $creadoEl;
    }



}

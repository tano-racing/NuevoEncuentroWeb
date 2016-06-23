<?php
/**
 * @Entity @Table(name="usuarios")
 **/
class Usuarios{
    
    /** @Id @Column(type="integer") * */
    protected $idUsuario;
    
    /** $idActividad @Column(type="string") * */
    protected $facebookId;
    
    /** $idActividad @Column(type="string") * */
    protected $nombreApellido;
    
    /** $idActividad @Column(type="string") * */
    protected $email;
    
    /** $idActividad @Column(type="string") * */
    protected $registrationId;
    
    /** $idActividad @Column(type="date") * */
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
        return $this->creadoEl;
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
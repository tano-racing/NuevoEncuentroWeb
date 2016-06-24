<?php

/**
 * @Entity @Table(name="actividades")
 * */
class Actividades {

    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $idActividad;

    /**
     * @Column(type="string", unique=true)
     */
    protected $nombre;

    /**
     * @Column(type="string") 
     */
    protected $descripcion;

    /**
     * @Column(type="integer") 
     */
    protected $cuando;

    /**
     * @Column(type="integer") 
     */
    protected $repeticion;

    /**
     * @Column(type="boolean") 
     */
    protected $esTaller;

    function getIdActividad() {
        return $this->idActividad;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getImagen() {
        return "actividad-$this->idActividad.jpg";
    }

    function getCuando() {
        return $this->cuando;
    }

    function getRepeticion() {
        return $this->repeticion;
    }

    function setIdActividad($idActividad) {
        $this->idActividad = $idActividad;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setCuando($cuando) {
        $this->cuando = $cuando;
    }

    function setRepeticion($repeticion) {
        $this->repeticion = $repeticion;
    }

    function getEsTaller() {
        return $this->esTaller;
    }

    function setEsTaller($esTaller) {
        $this->esTaller = $esTaller;
    }

}

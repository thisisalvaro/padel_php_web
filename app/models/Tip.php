<?php
class Tip {
    private $id;
    private $titulo;
    private $descripcion;
    private $enlace;
    private $categoria_id;
    private $imagen;
    
    public function __construct() {
    }

    public function getId() {
        return $this->id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getEnlace() {    
        return $this->enlace;
    }

    public function getCategoria_id() {    
        return $this->categoria_id;
    }

    public function getImagen() {    
        return $this->imagen;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setEnlace($enlace) {
        $this->enlace = $enlace;
    }

    public function setCategoria_id($categoria_id) {
        $this->categoria_id = $categoria_id;
    }

    public function setImagen($imagen) {
        $this->imagen = $imagen;
    }
}
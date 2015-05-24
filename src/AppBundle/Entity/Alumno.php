<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Alumno
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Alumno
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=30)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidoP", type="string", length=30)
     */
    private $apellidoP;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidoM", type="string", length=30)
     */
    private $apellidoM;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=255)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="generacion", type="string", length=10)
     */
    private $generacion;

    /**
     * @var string
     *
     * @ORM\Column(name="areaInteres", type="string", length=80)
     */
    private $areaInteres;

    /**
     * @var string
     *
     * @ORM\Column(name="enlaceImagen", type="string", length=255)
     */
    private $enlaceImagen;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Alumno
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellidoP
     *
     * @param string $apellidoP
     * @return Alumno
     */
    public function setApellidoP($apellidoP)
    {
        $this->apellidoP = $apellidoP;

        return $this;
    }

    /**
     * Get apellidoP
     *
     * @return string 
     */
    public function getApellidoP()
    {
        return $this->apellidoP;
    }

    /**
     * Set apellidoM
     *
     * @param string $apellidoM
     * @return Alumno
     */
    public function setApellidoM($apellidoM)
    {
        $this->apellidoM = $apellidoM;

        return $this;
    }

    /**
     * Get apellidoM
     *
     * @return string 
     */
    public function getApellidoM()
    {
        return $this->apellidoM;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Alumno
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return Alumno
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set generacion
     *
     * @param string $generacion
     * @return Alumno
     */
    public function setGeneracion($generacion)
    {
        $this->generacion = $generacion;

        return $this;
    }

    /**
     * Get generacion
     *
     * @return string 
     */
    public function getGeneracion()
    {
        return $this->generacion;
    }

    /**
     * Set areaInteres
     *
     * @param string $areaInteres
     * @return Alumno
     */
    public function setAreaInteres($areaInteres)
    {
        $this->areaInteres = $areaInteres;

        return $this;
    }

    /**
     * Get areaInteres
     *
     * @return string 
     */
    public function getAreaInteres()
    {
        return $this->areaInteres;
    }

    /**
     * Set enlaceImagen
     *
     * @param string $enlaceImagen
     * @return Alumno
     */
    public function setEnlaceImagen($enlaceImagen)
    {
        $this->enlaceImagen = $enlaceImagen;

        return $this;
    }

    /**
     * Get enlaceImagen
     *
     * @return string 
     */
    public function getEnlaceImagen()
    {
        return $this->enlaceImagen;
    }
}

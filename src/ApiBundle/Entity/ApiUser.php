<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ApiUser
 *
 * @ORM\Table(name="api_user")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\ApiUserRepository")
 */
class ApiUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="string")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=255)
     */
    private $apellido;

    /**
     * @var int
     *
     * @ORM\Column(name="dni", type="integer")
     */
    private $dni;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_app", type="string", length=255)
     */
    private $nombreApp;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario", type="string", length=255)
     */
    private $usuario;


    /**
     * @var bool
     *
     * @ORM\Column(name="autorizacion", type="boolean")
     */
    private $autorizacion;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return ApiUser
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
     * Set apellido
     *
     * @param string $apellido
     *
     * @return ApiUser
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set dni
     *
     * @param integer $dni
     *
     * @return ApiUser
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get dni
     *
     * @return int
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set nombreApp
     *
     * @param string $nombreApp
     *
     * @return ApiUser
     */
    public function setNombreApp($nombreApp)
    {
        $this->nombreApp = $nombreApp;

        return $this;
    }

    /**
     * Get nombreApp
     *
     * @return string
     */
    public function getNombreApp()
    {
        return $this->nombreApp;
    }

    /**
     * Set usuario
     *
     * @param string $usuario
     *
     * @return ApiUser
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return string
     */
    public function getUsuario()
    {
        return $this->usuario;
    }


    /**
     * Set autorizacion
     *
     * @param boolean $autorizacion
     *
     * @return ApiUser
     */
    public function setAutorizacion($autorizacion)
    {
        $this->autorizacion = $autorizacion;

        return $this;
    }

    /**
     * Get autorizacion
     *
     * @return bool
     */
    public function getAutorizacion()
    {
        return $this->autorizacion;
    }
}

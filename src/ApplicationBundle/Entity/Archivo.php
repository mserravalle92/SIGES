<?php

namespace ApplicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Archivo
 *
 * @ORM\Table(name="archivo")
 * @ORM\Entity(repositoryClass="ApplicationBundle\Repository\ArchivoRepository")
 */
class Archivo
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text" , nullable=true)
     */
    private $observaciones;

    /**
     * Muchos Archivos pertenecen a una Biblioteca
     * @ORM\ManyToOne(targetEntity="BibliotecaAlumno", inversedBy="archivos")
     * @ORM\JoinColumn(name="bibliotecaAlumno_id", referencedColumnName="id")
     */
    private $bibliotecaAlumno;


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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Archivo
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return Archivo
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set bibliotecaAlumno
     *
     * @param integer $bibliotecaAlumno
     *
     * @return Archivo
     */
    public function setBibliotecaAlumno($bibliotecaAlumno)
    {
        $this->bibliotecaAlumno = $bibliotecaAlumno;

        return $this;
    }

    /**
     * Get bibliotecaAlumno
     *
     * @return int
     */
    public function getBibliotecaAlumno()
    {
        return $this->bibliotecaAlumno;
    }
}

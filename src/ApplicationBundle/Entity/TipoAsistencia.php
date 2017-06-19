<?php

namespace ApplicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoAsistencia
 *
 * @ORM\Table(name="tipo_asistencia")
 * @ORM\Entity(repositoryClass="ApplicationBundle\Repository\TipoAsistenciaRepository")
 */
class TipoAsistencia
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
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAlta", type="datetime")
     */
    private $fechaAlta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaModificacion", type="datetime")
     */
    private $fechaModificacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaBaja", type="datetime", nullable=true)
     */
    private $fechaBaja;

    /**
     * @var float
     *
     * @ORM\Column(name="valorNumerico", type="float")
     */
    private $valorNumerico;


    /**
     *
     * @ORM\OneToMany(targetEntity="Asistencia", mappedBy="tipoAsistencia")
     */

    private $asistencias;

    public function __construct(){
        $this->$fechaAlta = new \DateTime();
        $this->$fechaModificacion = new \DateTime();
    }

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
     * @return TipoAsistencia
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
     * Set fechaAlta
     *
     * @param \DateTime $fechaAlta
     *
     * @return TipoAsistencia
     */
    public function setFechaAlta($fechaAlta)
    {
        $this->fechaAlta = $fechaAlta;

        return $this;
    }

    /**
     * Get fechaAlta
     *
     * @return \DateTime
     */
    public function getFechaAlta()
    {
        return $this->fechaAlta;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     *
     * @return TipoAsistencia
     */
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;

        return $this;
    }

    /**
     * Get fechaModificacion
     *
     * @return \DateTime
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }

    /**
     * Set fechaBaja
     *
     * @param \DateTime $fechaBaja
     *
     * @return TipoAsistencia
     */
    public function setFechaBaja($fechaBaja)
    {
        $this->fechaBaja = $fechaBaja;

        return $this;
    }

    /**
     * Get fechaBaja
     *
     * @return \DateTime
     */
    public function getFechaBaja()
    {
        return $this->fechaBaja;
    }

    /**
     * Add asistencia
     *
     * @param \ApplicationBundle\Entity\Asistencia $asistencia
     *
     * @return TipoAsistencia
     */
    public function addAsistencia(\ApplicationBundle\Entity\Asistencia $asistencia)
    {
        $this->asistencias[] = $asistencia;

        return $this;
    }

    /**
     * Remove asistencia
     *
     * @param \ApplicationBundle\Entity\Asistencia $asistencia
     */
    public function removeAsistencia(\ApplicationBundle\Entity\Asistencia $asistencia)
    {
        $this->asistencias->removeElement($asistencia);
    }

    /**
     * Get asistencias
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAsistencias()
    {
        return $this->asistencias;
    }

    /**
     * Set valorNumerico
     *
     * @param integer $valorNumerico
     *
     * @return TipoAsistencia
     */
    public function setValorNumerico($valorNumerico)
    {
        $this->valorNumerico = $valorNumerico;

        return $this;
    }

    /**
     * Get valorNumerico
     *
     * @return integer
     */
    public function getValorNumerico()
    {
        return $this->valorNumerico;
    }
}

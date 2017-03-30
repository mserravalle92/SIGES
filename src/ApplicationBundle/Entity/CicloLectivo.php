<?php

namespace ApplicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ciclo_lectivo
 *
 * @ORM\Table(name="ciclo_lectivo")
 * @ORM\Entity(repositoryClass="ApplicationBundle\Repository\Ciclo_lectivoRepository")
 */
class Ciclo_lectivo
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
     * @var \DateTime
     *
     * @ORM\Column(name="fechaInicio", type="datetime")
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaFin", type="datetime")
     */
    private $fechaFin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaInicioVacaciones", type="datetime")
     */
    private $fechaInicioVacaciones;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaFinVacaciones", type="datetime")
     */
    private $fechaFinVacaciones;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaBaja", type="datetime", nullable=true)
     */
    private $fechaBaja;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAlta", type="datetime", nullable=false)
     */
    private $fechaAlta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaModificacion", type="datetime", nullable=false)
     */
    private $fechaModificacion;


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
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     *
     * @return Ciclo_lectivo
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     *
     * @return Ciclo_lectivo
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set fechaInicioVacaciones
     *
     * @param \DateTime $fechaInicioVacaciones
     *
     * @return Ciclo_lectivo
     */
    public function setFechaInicioVacaciones($fechaInicioVacaciones)
    {
        $this->fechaInicioVacaciones = $fechaInicioVacaciones;

        return $this;
    }

    /**
     * Get fechaInicioVacaciones
     *
     * @return \DateTime
     */
    public function getFechaInicioVacaciones()
    {
        return $this->fechaInicioVacaciones;
    }

    /**
     * Set fechaFinVacaciones
     *
     * @param \DateTime $fechaFinVacaciones
     *
     * @return Ciclo_lectivo
     */
    public function setFechaFinVacaciones($fechaFinVacaciones)
    {
        $this->fechaFinVacaciones = $fechaFinVacaciones;

        return $this;
    }

    /**
     * Get fechaFinVacaciones
     *
     * @return \DateTime
     */
    public function getFechaFinVacaciones()
    {
        return $this->fechaFinVacaciones;
    }

    /**
     * Set fechaBaja
     *
     * @param \DateTime $fechaBaja
     *
     * @return Ciclo_lectivo
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
     * Set fechaAlta
     *
     * @param \DateTime $fechaAlta
     *
     * @return Ciclo_lectivo
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
     * @return Ciclo_lectivo
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

    public function __construct(){
        $this->fechaAlta = new DateTime();
        $this->fechaModificacion = new DateTime();
    }

}


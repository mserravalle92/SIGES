<?php

namespace ApplicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/*use Symfony\Component\Validator\Constraints\DateTime;*/

/**
 * CicloLectivo
 *
 * @ORM\Table(name="cicloLectivo")
 * @ORM\Entity(repositoryClass="ApplicationBundle\Repository\CicloLectivoRepository")
 */
class CicloLectivo
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
     * @var int
     *
     * @ORM\Column(name="anio", type="integer")
     */
    private $anio;

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
     * @ORM\OneToMany(targetEntity="Curso", mappedBy="ciclolectivo")
     */
    private $cursos;

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
     * @return CicloLectivo
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
     * @return CicloLectivo
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
     * @return CicloLectivo
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
     * @return CicloLectivo
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
     * @return CicloLectivo
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
     * @return CicloLectivo
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
     * @return CicloLectivo
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
        $this->fechaAlta=new \DateTime();
        $this->fechaModificacion=new \DateTime();
    }


    /**
     * Add curso
     *
     * @param \ApplicationBundle\Entity\Curso $curso
     *
     * @return CicloLectivo
     */
    public function addCurso(\ApplicationBundle\Entity\Curso $curso)
    {
        $this->cursos[] = $curso;

        return $this;
    }

    /**
     * Remove curso
     *
     * @param \ApplicationBundle\Entity\Curso $curso
     */
    public function removeCurso(\ApplicationBundle\Entity\Curso $curso)
    {
        $this->cursos->removeElement($curso);
    }

    /**
     * Get cursos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCursos()
    {
        return $this->cursos;
    }

    /**
     * Set anio
     *
     * 
     *
     * @return CicloLectivo
     */
    public function setAnio($anio)
    {
        $this->anio = $anio;

        return $this;
    }

    /**
     * Get anio
     *
     * @return \int
     */
    public function getAnio()
    {
        return $this->anio;
    }

    public function __toString(){
        return (string)$this->anio;
    }
}

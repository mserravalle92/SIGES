<?php

namespace ApplicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AlumnoExamen
 *
 * @ORM\Table(name="alumno_examen")
 * @ORM\Entity(repositoryClass="ApplicationBundle\Repository\AlumnoExamenRepository")
 */
class AlumnoExamen
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
     * @var int
     *
     * @ORM\Column(name="IdAlumno", type="integer", unique=true)
     */
    private $idAlumno;

    /**
     * @var int
     *
     * @ORM\Column(name="IdExamen", type="integer", unique=true)
     */
    private $idExamen;

    /**
     * @var int
     *
     * @ORM\Column(name="Nota", type="integer")
     */
    private $nota;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=255)
     */
    private $observaciones;

    /**
     * @var int
     *
     * @ORM\Column(name="tipoNota", type="integer")
     */
    private $tipoNota;


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
     * Set idAlumno
     *
     * @param integer $idAlumno
     *
     * @return AlumnoExamen
     */
    public function setIdAlumno($idAlumno)
    {
        $this->idAlumno = $idAlumno;

        return $this;
    }

    /**
     * Get idAlumno
     *
     * @return int
     */
    public function getIdAlumno()
    {
        return $this->idAlumno;
    }

    /**
     * Set idExamen
     *
     * @param integer $idExamen
     *
     * @return AlumnoExamen
     */
    public function setIdExamen($idExamen)
    {
        $this->idExamen = $idExamen;

        return $this;
    }

    /**
     * Get idExamen
     *
     * @return int
     */
    public function getIdExamen()
    {
        return $this->idExamen;
    }

    /**
     * Set nota
     *
     * @param integer $nota
     *
     * @return AlumnoExamen
     */
    public function setNota($nota)
    {
        $this->nota = $nota;

        return $this;
    }

    /**
     * Get nota
     *
     * @return int
     */
    public function getNota()
    {
        return $this->nota;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return AlumnoExamen
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
     * Set tipoNota
     *
     * @param integer $tipoNota
     *
     * @return AlumnoExamen
     */
    public function setTipoNota($tipoNota)
    {
        $this->tipoNota = $tipoNota;

        return $this;
    }

    /**
     * Get tipoNota
     *
     * @return int
     */
    public function getTipoNota()
    {
        return $this->tipoNota;
    }
}


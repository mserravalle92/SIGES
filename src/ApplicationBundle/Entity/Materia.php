<?php

namespace ApplicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Materia
 *
 * @ORM\Table(name="materia")
 * @ORM\Entity(repositoryClass="ApplicationBundle\Repository\MateriaRepository")
 */
class Materia
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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="Curso", inversedBy="materias")
     * @ORM\JoinColumn(name="curso_id", referencedColumnName="id", nullable=true)
     */
    private $curso;

    /**
     * Many Materias have Many PersonalDocentes.
     * @ORM\ManyToMany(targetEntity="PersonalDocente", mappedBy="materias")
     * @ORM\JoinTable(name="Profesor_Materia")
     */
     private $docentes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAlta", type="datetime", nullable=false)
     */
    private $fechaAlta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaBaja", type="datetime",nullable=true)
     */
    private $fechaBaja;

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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Materia
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
     * Set profesor
     *
     * @param integer $profesor
     *
     * @return Materia
     */
    public function setProfesor($profesor)
    {
        $this->profesor = $profesor;

        return $this;
    }

    /**
     * Get profesor
     *
     * @return int
     */
    public function getProfesor()
    {
        return $this->profesor;
    }

    /**
     * Set cicloLectivo
     *
     * @param integer $cicloLectivo
     *
     * @return Materia
     */
    public function setCicloLectivo($cicloLectivo)
    {
        $this->cicloLectivo = $cicloLectivo;

        return $this;
    }

    /**
     * Get cicloLectivo
     *
     * @return int
     */
    public function getCicloLectivo()
    {
        return $this->cicloLectivo;
    }

    /**
     * Set curso
     *
     * @param integer $curso
     *
     * @return Materia
     */
    public function setCurso($curso)
    {
        $this->curso = $curso;

        return $this;
    }

    /**
     * Get curso
     *
     * @return int
     */
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * Set fechaAlta
     *
     * @param \DateTime $fechaAlta
     *
     * @return Materia
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
     * Set fechaBaja
     *
     * @param \DateTime $fechaBaja
     *
     * @return Materia
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
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     *
     * @return Materia
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
        $this->docentes = new \Doctrine\Common\Collections\ArrayCollection();

    }

    /**
     * Add docente
     *
     * @param \ApplicationBundle\Entity\PersonalDocente $docente
     *
     * @return Materia
     */
    public function addDocente(\ApplicationBundle\Entity\PersonalDocente $docente)
    {
        $this->docentes[] = $docente;

        return $this;
    }

    /**
     * Remove docente
     *
     * @param \ApplicationBundle\Entity\PersonalDocente $docente
     */
    public function removeDocente(\ApplicationBundle\Entity\PersonalDocente $docente)
    {
        $this->docentes->removeElement($docente);
    }

    /**
     * Get docentes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDocentes()
    {
        return $this->docentes;
    }
}

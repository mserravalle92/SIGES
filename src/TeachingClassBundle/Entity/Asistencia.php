<?php

namespace TeachingClassBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Asistencia
 *
 * @ORM\Table(name="asistencia")
 * @ORM\Entity(repositoryClass="TeachingClassBundle\Repository\AsistenciaRepository")
 */
class Asistencia
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
     *
     * @ORM\ManyToOne(targetEntity="Alumno", inversedBy="asistencias")
     * @ORM\JoinColumn(name="alumno_id", referencedColumnName="id")
     */
    private $idAlumno;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Materia", inversedBy="asistencias")
     * @ORM\JoinColumn(name="materia_id", referencedColumnName="id")
     */
    private $idMateria;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var bool
     *
     * @ORM\Column(name="presentismo", type="boolean")
     */
    private $presentismo;

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
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="Curso", inversedBy="asistencias")
     * @ORM\JoinColumn(name="curso_id", referencedColumnName="id")
     */
    private $curso;

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
     * Set idAlumno
     *
     * @param integer $idAlumno
     *
     * @return Asistencia
     */
    public function setIdAlumno($idAlumno)
    {
        $this->idAlumno = $idAlumno;

        return $this;
    }

    /**
     * Get idAlumno
     *
     * @return integer
     */
    public function getIdAlumno()
    {
        return $this->idAlumno;
    }

    /**
     * Set idMateria
     *
     * @param integer $idMateria
     *
     * @return Asistencia
     */
    public function setIdMateria($idMateria)
    {
        $this->idMateria = $idMateria;

        return $this;
    }

    /**
     * Get idMateria
     *
     * @return integer
     */
    public function getIdMateria()
    {
        return $this->idMateria;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Asistencia
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
     * Set presentismo
     *
     * @param boolean $presentismo
     *
     * @return Asistencia
     */
    public function setPresentismo($presentismo)
    {
        $this->presentismo = $presentismo;

        return $this;
    }

    /**
     * Get presentismo
     *
     * @return boolean
     */
    public function getPresentismo()
    {
        return $this->presentismo;
    }

    /**
     * Set fechaAlta
     *
     * @param \DateTime $fechaAlta
     *
     * @return Asistencia
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
     * @return Asistencia
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
     * @return Asistencia
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
     * Set curso
     *
     * @param \TeachingClassBundle\Entity\Curso $curso
     *
     * @return Asistencia
     */
    public function setCurso(\TeachingClassBundle\Entity\Curso $curso = null)
    {
        $this->curso = $curso;

        return $this;
    }

    /**
     * Get curso
     *
     * @return \TeachingClassBundle\Entity\Curso
     */
    public function getCurso()
    {
        return $this->curso;
    }
}

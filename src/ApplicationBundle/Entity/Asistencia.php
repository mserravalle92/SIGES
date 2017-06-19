<?php

namespace ApplicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Asistencia
 *
 * @ORM\Table(name="asistencia")
 * @ORM\Entity(repositoryClass="ApplicationBundle\Repository\AsistenciaRepository")
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
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="Alumno", inversedBy="asistencias")
     * @ORM\JoinColumn(name="alumno_id", referencedColumnName="id")
     */
    private $alumno;

    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="Curso", inversedBy="asistencias")
     * @ORM\JoinColumn(name="curso_id", referencedColumnName="id")
     */
    private $curso;

    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="TipoAsistencia", inversedBy="asistencias")
     * @ORM\JoinColumn(name="tipoAsistencia_id", referencedColumnName="id")
     */

    private $tipoAsistencia;



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

    public function __construct(){

        $this->setFechaAlta(new \DateTime());
        $this->setFechaModificacion(new \DateTime());
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
     * Set alumno
     *
     * @param \ApplicationBundle\Entity\Alumno $alumno
     *
     * @return Asistencia
     */
    public function setAlumno(\ApplicationBundle\Entity\Alumno $alumno = null)
    {
        $this->alumno = $alumno;

        return $this;
    }

    /**
     * Get alumno
     *
     * @return \ApplicationBundle\Entity\Alumno
     */
    public function getAlumno()
    {
        return $this->alumno;
    }

    /**
     * Set materia
     *
     * @param \ApplicationBundle\Entity\Materia $materia
     *
     * @return Asistencia
     */
    public function setMateria(\ApplicationBundle\Entity\Materia $materia = null)
    {
        $this->materia = $materia;

        return $this;
    }

    /**
     * Get materia
     *
     * @return \ApplicationBundle\Entity\Materia
     */
    public function getMateria()
    {
        return $this->materia;
    }

    /**
     * Set tipoAsistencia
     *
     * @param \ApplicationBundle\Entity\TipoAsistencia $tipoAsistencia
     *
     * @return Asistencia
     */
    public function setTipoAsistencia(\ApplicationBundle\Entity\TipoAsistencia $tipoAsistencia = null)
    {
        $this->tipoAsistencia = $tipoAsistencia;

        return $this;
    }

    /**
     * Get tipoAsistencia
     *
     * @return \ApplicationBundle\Entity\TipoAsistencia
     */
    public function getTipoAsistencia()
    {
        return $this->tipoAsistencia;
    }

    /**
     * Set curso
     *
     * @param \ApplicationBundle\Entity\Curso $curso
     *
     * @return Asistencia
     */
    public function setCurso(\ApplicationBundle\Entity\Curso $curso = null)
    {
        $this->curso = $curso;

        return $this;
    }

    /**
     * Get curso
     *
     * @return \ApplicationBundle\Entity\Curso
     */
    public function getCurso()
    {
        return $this->curso;
    }
}

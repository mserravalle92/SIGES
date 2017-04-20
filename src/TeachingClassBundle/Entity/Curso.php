<?php

namespace TeachingClassBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Curso
 *
 * @ORM\Table(name="curso")
 * @ORM\Entity(repositoryClass="TeachingClassBundle\Repository\CursoRepository")
 */
class Curso
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
     * @ORM\Column(name="anio", type="integer")
     */
    private $anio;

    /**
     * @var string
     *
     * @ORM\Column(name="turno", type="string", length=255)
     */
    private $turno;

    /**
     * @var string
     *
     * @ORM\Column(name="seccion", type="string", length=255)
     */
    private $seccion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAlta", type="datetime", nullable=false)
     */
    private $fechaAlta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaBaja", type="datetime", nullable=true)
     */
    private $fechaBaja;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaModificacion", type="datetime", nullable=false)
     */
    private $fechaModificacion;

    /**
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="Materia", mappedBy="curso")
     */
     private $materias;

     /**
      * One Product has Many Features.
      * @ORM\OneToMany(targetEntity="Asistencia", mappedBy="curso")
      */
     private $asistencias;

     /**
      * Un curso tiene muchos alumnos
      * @ORM\OneToMany(targetEntity="Alumno", mappedBy="curso")
      */

      private $alumnos;


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
     * Set a�o
     *
     * @param integer $a�o
     *
     * @return Curso
     */
    public function setAnio($anio)
    {
        $this->anio = $anio;

        return $this;
    }

    /**
     * Get a�o
     *
     * @return int
     */
    public function getAnio()
    {
        return $this->anio;
    }

    /**
     * Set turno
     *
     * @param string $turno
     *
     * @return Curso
     */
    public function setTurno($turno)
    {
        $this->turno = $turno;

        return $this;
    }

    /**
     * Get turno
     *
     * @return string
     */
    public function getTurno()
    {
        return $this->turno;
    }

    /**
     * Set seccion
     *
     * @param string $seccion
     *
     * @return Curso
     */
    public function setSeccion($seccion)
    {
        $this->seccion = $seccion;

        return $this;
    }

    /**
     * Get seccion
     *
     * @return string
     */
    public function getSeccion()
    {
        return $this->seccion;
    }

    /**
     * Set fechaAlta
     *
     * @param \DateTime $fechaAlta
     *
     * @return Curso
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
     * @return Curso
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
     * @return Curso
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

    /**
     * Add materia
     *
     * @param \ApplicationBundle\Entity\Materia $materia
     *
     * @return Curso
     */
    public function addMateria(\ApplicationBundle\Entity\Materia $materia)
    {
        $this->materias[] = $materia;

        return $this;
    }

    /**
     * Remove materia
     *
     * @param \ApplicationBundle\Entity\Materia $materia
     */
    public function removeMateria(\ApplicationBundle\Entity\Materia $materia)
    {
        $this->materias->removeElement($materia);
    }

    /**
     * Get materias
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMaterias()
    {
        return $this->materias;
    }

    /**
     * Add asistencia
     *
     * @param \TeachingClassBundle\Entity\Asistencia $asistencia
     *
     * @return Curso
     */
    public function addAsistencia(\TeachingClassBundle\Entity\Asistencia $asistencia)
    {
        $this->asistencias[] = $asistencia;

        return $this;
    }

    /**
     * Remove asistencia
     *
     * @param \TeachingClassBundle\Entity\Asistencia $asistencia
     */
    public function removeAsistencia(\TeachingClassBundle\Entity\Asistencia $asistencia)
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
     * Add alumno
     *
     * @param \TeachingClassBundle\Entity\Alumno $alumno
     *
     * @return Curso
     */
    public function addAlumno(\TeachingClassBundle\Entity\Alumno $alumno)
    {
        $this->alumnos[] = $alumno;

        return $this;
    }

    /**
     * Remove alumno
     *
     * @param \TeachingClassBundle\Entity\Alumno $alumno
     */
    public function removeAlumno(\TeachingClassBundle\Entity\Alumno $alumno)
    {
        $this->alumnos->removeElement($alumno);
    }

    /**
     * Get alumnos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAlumnos()
    {
        return $this->alumnos;
    }
}

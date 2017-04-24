<?php

namespace ApplicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/*use Symfony\Component\Validator\Constraints\DateTime;*/

/**
 * Curso
 *
 * @ORM\Table(name="curso")
 * @ORM\Entity(repositoryClass="ApplicationBundle\Repository\CursoRepository")
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
     * @ORM\OneToMany(targetEntity="Alumno", mappedBy="curso")
     */
     private $alumnos;

     /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="Anio", inversedBy="cursos")
     * @ORM\JoinColumn(name="anio_id", referencedColumnName="id", nullable=true)
     */
    private $anio;

    /**
     * @ORM\ManyToOne(targetEntity="CicloLectivo", inversedBy="cursos")
     * @ORM\JoinColumn(name="ciclolectivo", referencedColumnName="id")
     */
    private $ciclolectivo;


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
     * Set anio
     *
     * @param integer $anio
     *
     * @return Curso
     */
    public function setAnio($anio)
    {
        $this->anio = $anio;

        return $this;
    }

    /**
     * Get anio
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
        $this->fechaAlta = new \DateTime();
        $this->fechaModificacion = new \DateTime();
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
     * Add alumno
     *
     * @param \ApplicationBundle\Entity\Alumno $alumno
     *
     * @return Curso
     */
    public function addAlumno(\ApplicationBundle\Entity\Alumno $alumno)
    {
        $this->alumnos[] = $alumno;

        return $this;
    }

    /**
     * Remove alumno
     *
     * @param \ApplicationBundle\Entity\Alumno $alumno
     */
    public function removeAlumno(\ApplicationBundle\Entity\Alumno $alumno)
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

    /**
     * Set ciclolectivo
     *
     * @param \ApplicationBundle\Entity\CicloLectivo $ciclolectivo
     *
     * @return Curso
     */
    public function setCiclolectivo(\ApplicationBundle\Entity\CicloLectivo $ciclolectivo = null)
    {
        $this->ciclolectivo = $ciclolectivo;

        return $this;
    }

    /**
     * Get ciclolectivo
     *
     * @return \ApplicationBundle\Entity\CicloLectivo
     */
    public function getCiclolectivo()
    {
        return $this->ciclolectivo;
    }


}

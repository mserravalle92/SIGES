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
     * @ORM\ManyToMany(targetEntity="Materia", mappedBy="curso")
     * @ORM\JoinTable(name="curso_materia")
     */
     private $materias;

      /**
     * One Product has Many Features.
     * @ORM\ManyToMany(targetEntity="Alumno", mappedBy="cursos" , cascade={"persist"} )
    *

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
     * Un Curso puede tener muchas Bibliotecas
     * @ORM\OneToMany(targetEntity="BibliotecaAlumno", mappedBy="curso")
     */
    private $bibliotecasAlumnos;

    /**
     * @ORM\OneToMany(targetEntity="HorarioDiaMateria", mappedBy="curso")
     */

    private $horarioDiaMateria;


    /**
     * Un Curso puede tener muchos Examenes
     * @ORM\OneToMany(targetEntity="Examen", mappedBy="curso")
     */
    private $examenes;

    /**
     *
     * @ORM\OneToMany(targetEntity="Asistencia", mappedBy="curso")
     */

    private $asistencias;

 
    
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
        $this->materias = new \Doctrine\Common\Collections\ArrayCollection();
        $this->alumnos = new \Doctrine\Common\Collections\ArrayCollection();
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



    /**
     * Add bibliotecasAlumno
     *
     * @param \ApplicationBundle\Entity\BibliotecaAlumno $bibliotecasAlumno
     *
     * @return Curso
     */
    public function addBibliotecasAlumno(\ApplicationBundle\Entity\BibliotecaAlumno $bibliotecasAlumno)
    {
        $this->bibliotecasAlumnos[] = $bibliotecasAlumno;

        return $this;
    }

    /**
     * Remove bibliotecasAlumno
     *
     * @param \ApplicationBundle\Entity\BibliotecaAlumno $bibliotecasAlumno
     */
    public function removeBibliotecasAlumno(\ApplicationBundle\Entity\BibliotecaAlumno $bibliotecasAlumno)
    {
        $this->bibliotecasAlumnos->removeElement($bibliotecasAlumno);
    }

    /**
     * Get bibliotecasAlumnos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBibliotecasAlumnos()
    {
        return $this->bibliotecasAlumnos;
    }


     public function __toString(){
      return (string)$this->anio->getNumero() . 'Turno'. $this->turno. ' Seccion '. $this->seccion;
    }

    /**
     * Add examene
     *
     * @param \ApplicationBundle\Entity\Examen $examene
     *
     * @return Curso
     */
    public function addExamene(\ApplicationBundle\Entity\Examen $examene)
    {
        $this->examenes[] = $examene;

        return $this;
    }

    /**
     * Remove examene
     *
     * @param \ApplicationBundle\Entity\Examen $examene
     */
    public function removeExamene(\ApplicationBundle\Entity\Examen $examene)
    {
        $this->examenes->removeElement($examene);
    }

    /**
     * Get examenes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExamenes()
    {
        return $this->examenes;
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
     * Add horarioDiaMaterium
     *
     * @param \ApplicationBundle\Entity\HorarioDiaMateria $horarioDiaMaterium
     *
     * @return Curso
     */
    public function addHorarioDiaMaterium(\ApplicationBundle\Entity\HorarioDiaMateria $horarioDiaMaterium)
    {
        $this->horarioDiaMateria[] = $horarioDiaMaterium;

        return $this;
    }

    /**
     * Remove horarioDiaMaterium
     *
     * @param \ApplicationBundle\Entity\HorarioDiaMateria $horarioDiaMaterium
     */
    public function removeHorarioDiaMaterium(\ApplicationBundle\Entity\HorarioDiaMateria $horarioDiaMaterium)
    {
        $this->horarioDiaMateria->removeElement($horarioDiaMaterium);
    }

    /**
     * Get horarioDiaMateria
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHorarioDiaMateria()
    {
        return $this->horarioDiaMateria;
    }

    /**
     * Add asistencia
     *
     * @param \ApplicationBundle\Entity\Asistencia $asistencia
     *
     * @return Curso
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
}

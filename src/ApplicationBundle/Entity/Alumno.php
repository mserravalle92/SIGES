<?php

namespace ApplicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Alumno
 *
 * @ORM\Table(name="alumno")
 * @ORM\Entity(repositoryClass="ApplicationBundle\Repository\AlumnoRepository")
 */
class Alumno extends Persona
{

    /**
     * @var int
     *
     * @ORM\Column(name="dni", type="integer", unique=true)
     */
    private $dni;

    /**
     * @var string
     *
     * @ORM\Column(name="legajo", type="string", length=255)
     */
    private $legajo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaNacimiento", type="date")
     */
    private $fechaNacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="localidad", type="string", length=255)
     */
    private $localidad;

    /**
     * @var string
     *
     * @ORM\Column(name="nacionalidad", type="string", length=255)
     */
    private $nacionalidad;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=255)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="obraSocial", type="string", length=255, nullable=true)
     */
    private $obraSocial;

    /**
     * @var string
     *
     * @ORM\Column(name="fichaMedica", type="string", length=255, nullable=true)
     */
    private $fichaMedica;

	/**
     * @var int
     *
     * @ORM\Column(name="sexo", type="integer")
     */
    private $sexo;

	/**
     * @var int
     *
     * @ORM\Column(name="usuario", type="integer", nullable=true)
     */
    private $usuario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAlta", type="datetime")
     */
    private $fechaAlta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaModificacion", type="datetime", nullable=true)
     */
    private $fechaModificacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaBaja", type="datetime", nullable=true)
     */
    private $fechaBaja;

    /**
       * Many Users have Many Groups.
       * @ORM\ManyToMany(targetEntity="Tutor", inversedBy="alumnos")
       * @ORM\JoinTable(name="alumnos_tutores")
       */
    private $tutores;

    /**
     * Many Features have One Product.
     * @ORM\ManyToMany(targetEntity="Curso", inversedBy="alumnos", cascade={"persist"})
     * @ORM\JoinTable(name="alumnoCurso")
     */
    private $cursos;

    /**
     *
     * @ORM\OneToMany(targetEntity="Asistencia", mappedBy="alumno")
     */

    private $asistencias;

	public function __construct(){
		$this->fechaAlta = new \DateTime();
		$this->fechaModificacion = new \DateTime();
        $this->curso = new \Doctrine\Common\Collections\ArrayCollection();
	}





    /**
     * Set dni
     *
     * @param integer $dni
     *
     * @return Alumno
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get dni
     *
     * @return integer
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set legajo
     *
     * @param string $legajo
     *
     * @return Alumno
     */
    public function setLegajo($legajo)
    {
        $this->legajo = $legajo;

        return $this;
    }

    /**
     * Get legajo
     *
     * @return string
     */
    public function getLegajo()
    {
        return $this->legajo;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     *
     * @return Alumno
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set localidad
     *
     * @param string $localidad
     *
     * @return Alumno
     */
    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;

        return $this;
    }

    /**
     * Get localidad
     *
     * @return string
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }

    /**
     * Set nacionalidad
     *
     * @param string $nacionalidad
     *
     * @return Alumno
     */
    public function setNacionalidad($nacionalidad)
    {
        $this->nacionalidad = $nacionalidad;

        return $this;
    }

    /**
     * Get nacionalidad
     *
     * @return string
     */
    public function getNacionalidad()
    {
        return $this->nacionalidad;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Alumno
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return Alumno
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Alumno
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set obraSocial
     *
     * @param string $obraSocial
     *
     * @return Alumno
     */
    public function setObraSocial($obraSocial)
    {
        $this->obraSocial = $obraSocial;

        return $this;
    }

    /**
     * Get obraSocial
     *
     * @return string
     */
    public function getObraSocial()
    {
        return $this->obraSocial;
    }

    /**
     * Set fichaMedica
     *
     * @param string $fichaMedica
     *
     * @return Alumno
     */
    public function setFichaMedica($fichaMedica)
    {
        $this->fichaMedica = $fichaMedica;

        return $this;
    }

    /**
     * Get fichaMedica
     *
     * @return string
     */
    public function getFichaMedica()
    {
        return $this->fichaMedica;
    }


    /**
     * Set fechaAlta
     *
     * @param \DateTime $fechaAlta
     *
     * @return Alumno
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
     * @return Alumno
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
     * @return Alumno
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
     * Set sexo
     *
     * @param integer $sexo
     *
     * @return Alumno
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return integer
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Add tutore
     *
     * @param \ApplicationBundle\Entity\Tutor $tutore
     *
     * @return Alumno
     */
    public function addTutore(\ApplicationBundle\Entity\Tutor $tutore)
    {
        $this->tutores[] = $tutore;

        return $this;
    }

    /**
     * Remove tutore
     *
     * @param \ApplicationBundle\Entity\Tutor $tutore
     */
    public function removeTutore(\ApplicationBundle\Entity\Tutor $tutore = null)
    {
        $this->tutores->removeElement($tutore);
    }

    /**
     * Get tutores
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTutores()
    {
        return $this->tutores;
    }



    /**
     * Add asistencia
     *
     * @param \ApplicationBundle\Entity\Asistencia $asistencia
     *
     * @return Alumno
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
     * Add curso
     *
     * @param \ApplicationBundle\Entity\Curso $curso
     *
     * @return Alumno
     */
    public function addCurso(\ApplicationBundle\Entity\Curso $curso)
    {
        $this->curso[] = $curso;

        return $this;
    }

    /**
     * Remove curso
     *
     * @param \ApplicationBundle\Entity\Curso $curso
     */
    public function removeCurso(\ApplicationBundle\Entity\Curso $curso)
    {
        $this->curso->removeElement($curso);
    }

    /**
     * Get curso
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCurso()
    {
        return $this->curso;
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
}

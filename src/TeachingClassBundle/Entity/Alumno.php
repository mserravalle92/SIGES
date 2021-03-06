<?php

namespace TeachingClassBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * Alumno
 *
 * @ORM\Table(name="alumno")
 * @ORM\Entity(repositoryClass="TeachingClassBundle\Repository\AlumnoRepository")
 */
class Alumno
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"alumno"})
     */
    private $id;

    /**
     * @var string
     *  @Groups({"alumno"})
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     * @Groups({"alumno"})
     * @ORM\Column(name="apellido", type="string", length=255)
     */
    private $apellido;

    /**
     * @var int
     * @Groups({"alumno"})
     * @ORM\Column(name="dni", type="integer", unique=true)
     */
    private $dni;

    /**
     * @var string
     * @Groups({"alumno"})
     * @ORM\Column(name="legajo", type="string", length=255)
     */
    private $legajo;

    /**
     * @var \DateTime
     * @Groups({"alumno"})
     * @ORM\Column(name="fechaNacimiento", type="datetime")
     */
    private $fechaNacimiento;

    /**
     * @var string
     * @Groups({"alumno"})
     * @ORM\Column(name="localidad", type="string", length=255)
     */
    private $localidad;

    /**
     * @var string
     * @Groups({"alumno"})
     * @ORM\Column(name="nacionalidad", type="string", length=255)
     */
    private $nacionalidad;

    /**
     * @var string
     * @Groups({"alumno"})
     * @ORM\Column(name="direccion", type="string", length=255)
     */
    private $direccion;

    /**
     * @var string
     * @Groups({"alumno"})
     * @ORM\Column(name="mail", type="string", length=255)
     */
    private $mail;

    /**
     * @var string
     * @Groups({"alumno"})
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
     *
     * @ORM\ManyToOne(targetEntity="Curso", inversedBy="alumnos")
     * @ORM\JoinColumn(name="curso_id", referencedColumnName="id")
     */
    private $curso;

     /**
      * Un alumno tiene muchas asistencias
      * @ORM\OneToMany(targetEntity="Alumno", mappedBy="curso")
      */

      private $asistencias;



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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Alumno
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
     * Set apellido
     *
     * @param string $apellido
     *
     * @return Alumno
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
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
     * Set usuario
     *
     * @param integer $usuario
     *
     * @return Alumno
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return integer
     */
    public function getUsuario()
    {
        return $this->usuario;
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
     * Set curso
     *
     * @param \TeachingClassBundle\Entity\Curso $curso
     *
     * @return Alumno
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

    /**
     * Add asistencia
     *
     * @param \TeachingClassBundle\Entity\Alumno $asistencia
     *
     * @return Alumno
     */
    public function addAsistencia(\TeachingClassBundle\Entity\Alumno $asistencia)
    {
        $this->asistencias[] = $asistencia;

        return $this;
    }

    /**
     * Remove asistencia
     *
     * @param \TeachingClassBundle\Entity\Alumno $asistencia
     */
    public function removeAsistencia(\TeachingClassBundle\Entity\Alumno $asistencia)
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

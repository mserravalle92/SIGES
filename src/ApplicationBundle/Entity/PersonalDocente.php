<?php

namespace ApplicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PersonalDocente
 *
 * @ORM\Table(name="personal_docente")
 * @ORM\Entity(repositoryClass="ApplicationBundle\Repository\PersonalDocenteRepository")
 */
class PersonalDocente extends Persona
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
     * @ORM\Column(name="matricula", type="string", length=255)
     */
    private $matricula;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255)
     */
    private $direccion;

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
     * @var \DateTime
     *
     * @ORM\Column(name="fechaNacimiento", type="date")
     */
    private $fechaNacimiento;

	/**
     * @var int
     *
     * @ORM\Column(name="sexo", type="integer", nullable=true)
     */
    private $sexo;



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
     * Many PersonalDocente have Many Materias.
     * @ORM\ManyToMany(targetEntity="Materia", inversedBy="docentes")
     * @ORM\JoinTable(name="Docente_Materia")
     */
     private $materias;

     /**
      * un profesor puede crear muchas bibliotecas
      * @ORM\OneToMany(targetEntity="BibliotecaAlumno", mappedBy="personalDocente")
      */
     private $bibliotecasAlumnos;


	public function __construct(){
		$this->fechaAlta = new \DateTime();
		$this->fechaModificacion = new \DateTime();
        $this->materias = new \Doctrine\Common\Collections\ArrayCollection();

	}


    /**
     * Set dni
     *
     * @param integer $dni
     *
     * @return PersonalDocente
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
     * Set matricula
     *
     * @param string $matricula
     *
     * @return PersonalDocente
     */
    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;

        return $this;
    }

    /**
     * Get matricula
     *
     * @return string
     */
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return PersonalDocente
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
     * Set localidad
     *
     * @param string $localidad
     *
     * @return PersonalDocente
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
     * @return PersonalDocente
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
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     *
     * @return PersonalDocente
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
     * Set sexo
     *
     * @param integer $sexo
     *
     * @return PersonalDocente
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
     * Set fechaAlta
     *
     * @param \DateTime $fechaAlta
     *
     * @return PersonalDocente
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
     * @return PersonalDocente
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
     * @return PersonalDocente
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
     * Add materia
     *
     * @param \ApplicationBundle\Entity\Materia $materia
     *
     * @return PersonalDocente
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
     * Add bibliotecasAlumno
     *
     * @param \ApplicationBundle\Entity\BibliotecaAlumno $bibliotecasAlumno
     *
     * @return PersonalDocente
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

    public function getDiscr(){
        return 'personalDocente';
    }




}

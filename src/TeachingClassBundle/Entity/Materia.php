<?php

namespace TeachingClassBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Materia
 *
 * @ORM\Table(name="materia")
 * @ORM\Entity(repositoryClass="TeachingClassBundle\Repository\MateriaRepository")
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
     *
     * @ORM\ManyToOne(targetEntity="PersonalDocente", inversedBy="materias")
     * @ORM\JoinColumn(name="profesor_id", referencedColumnName="id")
     */
    private $profesor;

    /**
     * @var int
     *
     * @ORM\Column(name="cicloLectivo", type="integer")
     */
    private $cicloLectivo;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Curso", inversedBy="materias")
     * @ORM\JoinColumn(name="curso_id", referencedColumnName="id")
     */
    private $curso;

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
     * Una Materia Puede tener muchas clases didacticas
     * @ORM\OneToMany(targetEntity="ClaseDidactica", mappedBy="materia")
     */
    private $clasesDidacticas;




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
    }

    /**
     * Add clasesDidactica
     *
     * @param \TeachingClassBundle\Entity\ClaseDidactica $clasesDidactica
     *
     * @return Materia
     */
    public function addClasesDidactica(\TeachingClassBundle\Entity\ClaseDidactica $clasesDidactica)
    {
        $this->clasesDidacticas[] = $clasesDidactica;

        return $this;
    }

    /**
     * Remove clasesDidactica
     *
     * @param \TeachingClassBundle\Entity\ClaseDidactica $clasesDidactica
     */
    public function removeClasesDidactica(\TeachingClassBundle\Entity\ClaseDidactica $clasesDidactica)
    {
        $this->clasesDidacticas->removeElement($clasesDidactica);
    }

    /**
     * Get clasesDidacticas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClasesDidacticas()
    {
        return $this->clasesDidacticas;
    }

    /**
     * Add docente
     *
     * @param \TeachingClassBundle\Entity\PersonalDocente $docente
     *
     * @return Materia
     */
    public function addDocente(\TeachingClassBundle\Entity\PersonalDocente $docente)
    {
        $this->docentes[] = $docente;

        return $this;
    }

    /**
     * Remove docente
     *
     * @param \TeachingClassBundle\Entity\PersonalDocente $docente
     */
    public function removeDocente(\TeachingClassBundle\Entity\PersonalDocente $docente)
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

    public function __toString(){
      return $this->nombre;
    }
}

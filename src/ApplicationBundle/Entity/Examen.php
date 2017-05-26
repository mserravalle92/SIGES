<?php

namespace ApplicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Examen
 *
 * @ORM\Table(name="examen")
 * @ORM\Entity(repositoryClass="ApplicationBundle\Repository\ExamenRepository")
 */
class Examen
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
     * @ORM\Column(name="contenido", type="string", length=255)
     */
    private $contenido;

    /**
     * @var int
     *
     * @ORM\Column(name="horarioDiaMateria", type="integer")
     */
    private $horarioDiaMateria;

  

    /**
     * @var bool
     *
     * @ORM\Column(name="promediable", type="boolean")
     */
    private $promediable;

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
     * muchos examenes tienen un curso.
     * @ORM\ManyToOne(targetEntity="Curso", inversedBy="examenes")
     * @ORM\JoinColumn(name="curso_id", referencedColumnName="id", nullable=true)
     */
    private $curso;

    /**
     * muchos examenes tienen una materia.
     * @ORM\ManyToOne(targetEntity="Materia", inversedBy="examenes")
     * @ORM\JoinColumn(name="materia_id", referencedColumnName="id", nullable=true)
     */
    private $materia;

    /**
     * un examen tienen un tipoNota.
     * @ORM\ManyToOne(targetEntity="TipoNota", inversedBy="examenes")
     * @ORM\JoinColumn(name="tipoNota_id", referencedColumnName="id", nullable=true)
     */
    private $tipoNota;

    public function __construct(){
        $this->fechaAlta = new \DateTime();
        $this->fechaModificacion = new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set contenido
     *
     * @param string $contenido
     *
     * @return Examen
     */
    public function setContenido($contenido)
    {
        $this->contenido = $contenido;

        return $this;
    }

    /**
     * Get contenido
     *
     * @return string
     */
    public function getContenido()
    {
        return $this->contenido;
    }

    /**
     * Set horarioDiaMateria
     *
     * @param integer $horarioDiaMateria
     *
     * @return Examen
     */
    public function setHorarioDiaMateria($horarioDiaMateria)
    {
        $this->horarioDiaMateria = $horarioDiaMateria;

        return $this;
    }

    /**
     * Get horarioDiaMateria
     *
     * @return integer
     */
    public function getHorarioDiaMateria()
    {
        return $this->horarioDiaMateria;
    }

    /**
     * Set promediable
     *
     * @param boolean $promediable
     *
     * @return Examen
     */
    public function setPromediable($promediable)
    {
        $this->promediable = $promediable;

        return $this;
    }

    /**
     * Get promediable
     *
     * @return boolean
     */
    public function getPromediable()
    {
        return $this->promediable;
    }

    /**
     * Set fechaAlta
     *
     * @param \DateTime $fechaAlta
     *
     * @return Examen
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
     * @return Examen
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
     * @return Examen
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
     * @param \ApplicationBundle\Entity\Curso $curso
     *
     * @return Examen
     */
    public function setCurso(\ApplicationBundle\Entity\Curso $curso)
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

    /**
     * Set materia
     *
     * @param \ApplicationBundle\Entity\Materia $materia
     *
     * @return Examen
     */
    public function setMateria(\ApplicationBundle\Entity\Materia $materia)
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
     * Set tipoNota
     *
     * @param \ApplicationBundle\Entity\TipoNota $tipoNota
     *
     * @return Examen
     */
    public function setTipoNota(\ApplicationBundle\Entity\TipoNota $tipoNota)
    {
        $this->tipoNota = $tipoNota;

        return $this;
    }

    /**
     * Get TipoNota
     *
     * @return \ApplicationBundle\Entity\TipoNota
     */
    public function getTipoNota()
    {
        return $this->tipoNota;
    }
}

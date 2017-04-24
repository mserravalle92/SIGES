<?php

namespace TeachingClassBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sesion
 *
 * @ORM\Table(name="sesion")
 * @ORM\Entity(repositoryClass="TeachingClassBundle\Repository\SesionRepository")
 */
class Sesion
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
     * @ORM\ManyToOne(targetEntity="Pregunta" , inversedBy="sesiones")
     * @ORM\JoinColumn(name="pregunta_id", referencedColumnName="id")
     */
    private $pregunta;

    /**
     *
     * @ORM\ManyToOne(targetEntity="ClaseDidactica", inversedBy="sesiones")
     * @ORM\JoinColumn(name="clase_id", referencedColumnName="id")
     */
    private $claseDidactica;

    /**
     * Una clase puede tener muchas preguntas
     * @ORM\OneToMany(targetEntity="Respuesta", mappedBy="sesion")
     */
     private $respuestas;


    /**
    * @var boolean
    * @ORM\Column(name="estado", type="boolean")
    */
     private $estado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaCreacion", type="datetime", nullable=false)
     */
    private $fechaCreacion;


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
     * Set pregunta
     *
     * @param integer $pregunta
     *
     * @return Sesion
     */
    public function setPregunta($pregunta)
    {
        $this->pregunta = $pregunta;

        return $this;
    }

    /**
     * Get pregunta
     *
     * @return int
     */
    public function getPregunta()
    {
        return $this->pregunta;
    }

    /**
     * Set claseDidactica
     *
     * @param integer $claseDidactica
     *
     * @return Sesion
     */
    public function setClaseDidactica($claseDidactica)
    {
        $this->claseDidactica = $claseDidactica;

        return $this;
    }

    /**
     * Get claseDidactica
     *
     * @return int
     */
    public function getClaseDidactica()
    {
        return $this->claseDidactica;
    }

    /**
     * Set fechaCreación
     *
     * @param integer $fechaCreación
     *
     * @return Sesion
     */
    public function setFechaCreación($fechaCreación)
    {
        $this->fechaCreación = $fechaCreación;

        return $this;
    }

    /**
     * Get fechaCreación
     *
     * @return int
     */
    public function getFechaCreación()
    {
        return $this->fechaCreación;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return Sesion
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    public function __construct(){
      $this->fechaCreacion = new \DateTime('now');
      $this->estado = 0;
    }

    /**
     * Add respuesta
     *
     * @param \TeachingClassBundle\Entity\Respuesta $respuesta
     *
     * @return Sesion
     */
    public function addRespuesta(\TeachingClassBundle\Entity\Respuesta $respuesta)
    {
        $this->respuestas[] = $respuesta;

        return $this;
    }

    /**
     * Remove respuesta
     *
     * @param \TeachingClassBundle\Entity\Respuesta $respuesta
     */
    public function removeRespuesta(\TeachingClassBundle\Entity\Respuesta $respuesta)
    {
        $this->respuestas->removeElement($respuesta);
    }

    /**
     * Get respuestas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRespuestas()
    {
        return $this->respuestas;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     *
     * @return Sesion
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean
     */
    public function getEstado()
    {
        return $this->estado;
    }
}

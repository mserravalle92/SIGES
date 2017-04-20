<?php

namespace TeachingClassBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Respuesta
 *
 * @ORM\Table(name="respuesta")
 * @ORM\Entity(repositoryClass="TeachingClassBundle\Repository\RespuestaRepository")
 */
class Respuesta
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
     * @ORM\Column(name="idAlumno", type="integer", nullable=true)
     */
    private $idAlumno;

    /**
     *
     * @ORM\ManyToOne(targetEntity="OpcionPregunta", inversedBy="respuestas")
     * @ORM\JoinColumn(name="opcion_id", referencedColumnName="id")
     */
    private $idOpcionPregunta;


    /**
     *
     * @ORM\ManyToOne(targetEntity="Pregunta", inversedBy="respuestas")
     * @ORM\JoinColumn(name="pregunta_id", referencedColumnName="id")
     */
    private $pregunta;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Sesion", inversedBy="respuestas")
     * @ORM\JoinColumn(name="sesion_id", referencedColumnName="id")
     */
    private $sesion;


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
     * @return Respuesta
     */
    public function setIdAlumno($idAlumno)
    {
        $this->idAlumno = $idAlumno;

        return $this;
    }

    /**
     * Get idAlumno
     *
     * @return int
     */
    public function getIdAlumno()
    {
        return $this->idAlumno;
    }

    /**
     * Set idPregunta
     *
     * @param integer $idPregunta
     *
     * @return Respuesta
     */
    public function setIdPregunta($idPregunta)
    {
        $this->idPregunta = $idPregunta;

        return $this;
    }

    /**
     * Get idPregunta
     *
     * @return int
     */
    public function getIdPregunta()
    {
        return $this->idPregunta;
    }

    /**
     * Set idOpcionPregunta
     *
     * @param integer $idOpcionPregunta
     *
     * @return Respuesta
     */
    public function setIdOpcionPregunta($idOpcionPregunta)
    {
        $this->idOpcionPregunta = $idOpcionPregunta;

        return $this;
    }

    /**
     * Get idOpcionPregunta
     *
     * @return int
     */
    public function getIdOpcionPregunta()
    {
        return $this->idOpcionPregunta;
    }

    /**
     * Set pregunta
     *
     * @param \TeachingClassBundle\Entity\Pregunta $pregunta
     *
     * @return Respuesta
     */
    public function setPregunta(\TeachingClassBundle\Entity\Pregunta $pregunta = null)
    {
        $this->pregunta = $pregunta;

        return $this;
    }

    /**
     * Get pregunta
     *
     * @return \TeachingClassBundle\Entity\Pregunta
     */
    public function getPregunta()
    {
        return $this->pregunta;
    }

    /**
     * Set sesion
     *
     * @param \TeachingClassBundle\Entity\Sesion $sesion
     *
     * @return Respuesta
     */
    public function setSesion(\TeachingClassBundle\Entity\Sesion $sesion = null)
    {
        $this->sesion = $sesion;

        return $this;
    }

    /**
     * Get sesion
     *
     * @return \TeachingClassBundle\Entity\Sesion
     */
    public function getSesion()
    {
        return $this->sesion;
    }
}

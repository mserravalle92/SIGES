<?php

namespace TeachingClassBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoPregunta
 *
 * @ORM\Table(name="tipo_pregunta")
 * @ORM\Entity(repositoryClass="TeachingClassBundle\Repository\TipoPreguntaRepository")
 */
class TipoPregunta
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
     * @ORM\Column(name="tipo", type="string", length=255)
     */
    private $tipo;
    /**
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="Pregunta", mappedBy="tipoPregunta")
     */
    private $preguntas;

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
     * Set tipo
     *
     * @param string $tipo
     *
     * @return TipoPregunta
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->preguntas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add pregunta
     *
     * @param \TeachingClassBundle\Entity\Pregunta $pregunta
     *
     * @return TipoPregunta
     */
    public function addPregunta(\TeachingClassBundle\Entity\Pregunta $pregunta)
    {
        $this->preguntas[] = $pregunta;

        return $this;
    }

    /**
     * Remove pregunta
     *
     * @param \TeachingClassBundle\Entity\Pregunta $pregunta
     */
    public function removePregunta(\TeachingClassBundle\Entity\Pregunta $pregunta)
    {
        $this->preguntas->removeElement($pregunta);
    }

    /**
     * Get preguntas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPreguntas()
    {
        return $this->preguntas;
    }

    public function __toString(){
      return $this->tipo;
    }
}

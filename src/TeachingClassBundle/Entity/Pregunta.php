<?php

namespace TeachingClassBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pregunta
 *
 * @ORM\Table(name="pregunta")
 * @ORM\Entity(repositoryClass="TeachingClassBundle\Repository\PreguntaRepository")
 */
class Pregunta
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
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="ClaseDidactica", inversedBy="preguntas")
     * @ORM\JoinColumn(name="clase_didactica_id", referencedColumnName="id")
     */
    private $claseDidactica;

    /**
     * @var string
     *
     * @ORM\Column(name="pregunta", type="text")
     */
    private $pregunta;

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
     * Una pregunta puede tener muchas opciones
     * @ORM\OneToMany(targetEntity="OpcionPregunta", mappedBy="pregunta")
     */
    private $opciones;

    /**
     * Una pregunta tiene un tipo
     * @ORM\ManyToOne(targetEntity="TipoPregunta" ,inversedBy="preguntas")
     * @ORM\JoinColumn(name="tipo_id", referencedColumnName="id")
     */

    private $tipoPregunta;

    /**
     * Una pregunta puede tener muchas opciones
     * @ORM\OneToMany(targetEntity="Respuesta", mappedBy="pregunta")
     */

    private $respuestas;

    /**
     * @var int
     *
     * @ORM\Column(name="envio", type="boolean", nullable = true)
     */
    private $envio;

    /**
     * Una pregunta puede estar en muchas sesiones
     * @ORM\OneToMany(targetEntity="Sesion", mappedBy="pregunta")
     */

     private $sesiones;


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
     * Set claseEnVivo
     *
     * @param integer $claseEnVivo
     *
     * @return Pregunta
     */
    public function setClaseEnVivo($claseEnVivo)
    {
        $this->claseEnVivo = $claseEnVivo;

        return $this;
    }

    /**
     * Get claseEnVivo
     *
     * @return int
     */
    public function getClaseEnVivo()
    {
        return $this->claseEnVivo;
    }

    /**
     * Set pregunta
     *
     * @param string $pregunta
     *
     * @return Pregunta
     */
    public function setPregunta($pregunta)
    {
        $this->pregunta = $pregunta;

        return $this;
    }

    /**
     * Get pregunta
     *
     * @return string
     */
    public function getPregunta()
    {
        return $this->pregunta;
    }

    /**
     * Set fechaAlta
     *
     * @param \DateTime $fechaAlta
     *
     * @return Pregunta
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
     * @return Pregunta
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
     * @return Pregunta
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
     * Set claseDidactica
     *
     * @param \TeachingClassBundle\Entity\ClaseDidactica $claseDidactica
     *
     * @return Pregunta
     */
    public function setClaseDidactica(\TeachingClassBundle\Entity\ClaseDidactica $claseDidactica = null)
    {
        $this->claseDidactica = $claseDidactica;

        return $this;
    }

    /**
     * Get claseDidactica
     *
     * @return \TeachingClassBundle\Entity\ClaseDidactica
     */
    public function getClaseDidactica()
    {
        return $this->claseDidactica;
    }

    /**
     * Add opcione
     *
     *
     *
     * @return Pregunta
     */
    public function addOpcione($opcion)
    {
        $this->opciones[] = $opcion;

        return $this;
    }

    /**
     * Remove opcione
     *
     * @param \TeachingClassBundle\Entity\OpcionesPregunta $opcione
     */
    public function removeOpcione( $opcione)
    {
        $this->opciones->removeElement($opcione);
    }

    /**
     * Get opciones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOpciones()
    {
        return $this->opciones;
    }

    /**
     * Set tipoPregunta
     *
     * @param \TeachingClassBundle\Entity\TipoPregunta $tipoPregunta
     *
     * @return Pregunta
     */
    public function setTipoPregunta(\TeachingClassBundle\Entity\TipoPregunta $tipoPregunta = null)
    {
        $this->tipoPregunta = $tipoPregunta;

        return $this;
    }

    /**
     * Get tipoPregunta
     *
     * @return \TeachingClassBundle\Entity\TipoPregunta
     */
    public function getTipoPregunta()
    {
        return $this->tipoPregunta;
    }

    /**
     * Set envio
     *
     * @param boolean $envio
     *
     * @return Pregunta
     */
    public function setEnvio($envio)
    {
        $this->envio = $envio;

        return $this;
    }

    /**
     * Get envio
     *
     * @return boolean
     */
    public function getEnvio()
    {
        return $this->envio;
    }

    public function serialize(){
      $array = [
        'pregunta'=>$this->pregunta,
        'id'=>$this->id,
      ];
      return $array;
    }

    /**
     * Add respuesta
     *
     * @param \TeachingClassBundle\Entity\Respuesta $respuesta
     *
     * @return Pregunta
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
     * Add sesione
     *
     * @param \TeachingClassBundle\Entity\Sesion $sesione
     *
     * @return Pregunta
     */
    public function addSesione(\TeachingClassBundle\Entity\Sesion $sesione)
    {
        $this->sesiones[] = $sesione;

        return $this;
    }

    /**
     * Remove sesione
     *
     * @param \TeachingClassBundle\Entity\Sesion $sesione
     */
    public function removeSesione(\TeachingClassBundle\Entity\Sesion $sesione)
    {
        $this->sesiones->removeElement($sesione);
    }

    /**
     * Get sesiones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSesiones()
    {
        return $this->sesiones;
    }
}

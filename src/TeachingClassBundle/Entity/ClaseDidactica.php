<?php

namespace TeachingClassBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Clase_en_vivo
 *
 * @ORM\Table(name="ClaseDidactica")
 * @ORM\Entity(repositoryClass="TeachingClassBundle\Repository\ClaseDidacticaRepository")
 */
class ClaseDidactica
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
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora", type="datetime")
     */
    private $hora;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAlta", type="datetime", nullable=false)
     */
    private $fechaAlta;

    /**
     * @var int
     *
     * @ORM\Column(name="fechaBaja", type="integer", nullable=true)
     */
    private $fechaBaja;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaModificacion", type="datetime", nullable=false)
     */
    private $fechaModificacion;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Estado", inversedBy="clasesDidacticas")
     * @ORM\JoinColumn(name="estado_id", referencedColumnName="id")
     */
    private $estado;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Materia", inversedBy="clasesDidacticas")
     * @ORM\JoinColumn(name="materia_id", referencedColumnName="id")
     */
    private $materia;

    /**
     * Una clase puede tener muchas preguntas
     * @ORM\OneToMany(targetEntity="Pregunta", mappedBy="claseDidactica")
     */
    private $preguntas;

    /**
     * @var int
     *
     * @ORM\Column(name="usuarioId", type="integer", nullable=false)
     */
    private $usuarioId;


    /**
     * @var int
     *
     * @ORM\Column(name="habilitada", type="boolean")
     */
    private $habilitada;

    /**
     * @var int
     *
     * @ORM\Column(name="claveAcceso", type="string", length=9, nullable=true)
     */
    private $claveAcceso;

    /**
     * Una clase puede tener muchas sesiones
     * @ORM\OneToMany(targetEntity="Sesion", mappedBy="claseDidactica")
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
     * Set clase
     *
     * @param integer $clase
     *
     * @return Clase_en_vivo
     */
    public function setClase($clase)
    {
        $this->clase = $clase;

        return $this;
    }

    /**
     * Get clase
     *
     * @return int
     */
    public function getClase()
    {
        return $this->clase;
    }

    /**
     * Set hora
     *
     * @param \DateTime $hora
     *
     * @return Clase_en_vivo
     */
    public function setHora($hora)
    {
        $this->hora = $hora;

        return $this;
    }

    /**
     * Get hora
     *
     * @return \DateTime
     */
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * Set fechaAlta
     *
     * @param \DateTime $fechaAlta
     *
     * @return Clase_en_vivo
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
     * @param integer $fechaBaja
     *
     * @return Clase_en_vivo
     */
    public function setFechaBaja($fechaBaja)
    {
        $this->fechaBaja = $fechaBaja;

        return $this;
    }

    /**
     * Get fechaBaja
     *
     * @return int
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
     * @return Clase_en_vivo
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
     * Set estado
     *
     * @param boolean $estado
     *
     * @return ClaseDidactica
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

    /**
     * Set materia
     *
     * @param \TeachingClassBundle\Entity\Materia $materia
     *
     * @return ClaseDidactica
     */
    public function setMateria(\TeachingClassBundle\Entity\Materia $materia = null)
    {
        $this->materia = $materia;

        return $this;
    }

    /**
     * Get materia
     *
     * @return \TeachingClassBundle\Entity\Materia
     */
    public function getMateria()
    {
        return $this->materia;
    }

    /**
     * Add pregunta
     *
     * @param \TeachingClassBundle\Entity\Pregunta $pregunta
     *
     * @return ClaseDidactica
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

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return ClaseDidactica
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set usuarioId
     *
     * @param integer $usuarioId
     *
     * @return ClaseDidactica
     */
    public function setUsuarioId($usuarioId)
    {
        $this->usuarioId = $usuarioId;

        return $this;
    }

    /**
     * Get usuarioId
     *
     * @return integer
     */
    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

    /**
     * Set habilitada
     *
     * @param boolean $habilitada
     *
     * @return ClaseDidactica
     */
    public function setHabilitada($habilitada)
    {
        $this->habilitada = $habilitada;

        return $this;
    }

    /**
     * Get habilitada
     *
     * @return boolean
     */
    public function getHabilitada()
    {
        return $this->habilitada;
    }

    /**
     * Set claveAcceso
     *
     * @param string $claveAcceso
     *
     * @return ClaseDidactica
     */
    public function setClaveAcceso($claveAcceso)
    {
        $this->claveAcceso = $claveAcceso;

        return $this;
    }

    /**
     * Get claveAcceso
     *
     * @return string
     */
    public function getClaveAcceso()
    {
        return $this->claveAcceso;
    }

    /**
     * Add sesione
     *
     * @param \TeachingClassBundle\Entity\Sesion $sesione
     *
     * @return ClaseDidactica
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

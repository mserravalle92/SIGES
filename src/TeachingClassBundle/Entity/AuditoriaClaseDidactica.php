<?php

namespace TeachingClassBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AuditoriaClaseDidactica
 *
 * @ORM\Table(name="auditoria_clase_didactica")
 * @ORM\Entity(repositoryClass="TeachingClassBundle\Repository\AuditoriaClaseDidacticaRepository")
 */
class AuditoriaClaseDidactica
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
     * @ORM\Column(name="clase", type="string", length=255)
     */
    private $clase;

    /**
     * @var string
     *
     * @ORM\Column(name="profesor", type="string", length=255)
     */
    private $profesor;

    /**
     * @var string
     *
     * @ORM\Column(name="fecha", type="string", length=255)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="cantidadAlumnos", type="integer", nullable=true)
     */
    private $cantidadAlumnos;


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
     * @param string $clase
     *
     * @return AuditoriaClaseDidactica
     */
    public function setClase($clase)
    {
        $this->clase = $clase;

        return $this;
    }

    /**
     * Get clase
     *
     * @return string
     */
    public function getClase()
    {
        return $this->clase;
    }

    /**
     * Set profesor
     *
     * @param string $profesor
     *
     * @return AuditoriaClaseDidactica
     */
    public function setProfesor($profesor)
    {
        $this->profesor = $profesor;

        return $this;
    }

    /**
     * Get profesor
     *
     * @return string
     */
    public function getProfesor()
    {
        return $this->profesor;
    }

    /**
     * Set fecha
     *
     * @param string $fecha
     *
     * @return AuditoriaClaseDidactica
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return string
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set cantidadAlumnos
     *
     * @param string $cantidadAlumnos
     *
     * @return AuditoriaClaseDidactica
     */
    public function setCantidadAlumnos($cantidadAlumnos)
    {
        $this->cantidadAlumnos = $cantidadAlumnos;

        return $this;
    }

    /**
     * Get cantidadAlumnos
     *
     * @return string
     */
    public function getCantidadAlumnos()
    {
        return $this->cantidadAlumnos;
    }
}

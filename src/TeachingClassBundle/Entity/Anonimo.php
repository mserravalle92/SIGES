<?php

namespace TeachingClassBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Anonimo
 *
 * @ORM\Table(name="anonimo")
 * @ORM\Entity(repositoryClass="TeachingClassBundle\Repository\AnonimoRepository")
 */
class Anonimo
{
    /**
     * @var string
     *
     * @ORM\Column(name="id",type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=255 , nullable=true)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     *
     * @ORM\OneToMany(targetEntity="Respuesta", mappedBy="anonimo")
     */
    private $respuesta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAlta", type="datetime")
     */
    private $fechaAlta;




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
     * Set codigo
     *
     * @param string $codigo
     *
     * @return Anonimo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Anonimo
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->respuesta = new \Doctrine\Common\Collections\ArrayCollection();
        $this->fechaAlta = new \DateTime();
    }

    /**
     * Add respuestum
     *
     * @param \TeachingClassBundle\Entity\Anonimo $respuestum
     *
     * @return Anonimo
     */
    public function addRespuestum(\TeachingClassBundle\Entity\Anonimo $respuestum)
    {
        $this->respuesta[] = $respuestum;

        return $this;
    }

    /**
     * Remove respuestum
     *
     * @param \TeachingClassBundle\Entity\Anonimo $respuestum
     */
    public function removeRespuestum(\TeachingClassBundle\Entity\Anonimo $respuestum)
    {
        $this->respuesta->removeElement($respuestum);
    }

    /**
     * Get respuesta
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRespuesta()
    {
        return $this->respuesta;
    }

    /**
     * Set fechaAlta
     *
     * @param \DateTime $fechaAlta
     *
     * @return Anonimo
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
}

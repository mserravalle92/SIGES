<?php

namespace TeachingClassBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estado
 *
 * @ORM\Table(name="estado")
 * @ORM\Entity(repositoryClass="TeachingClassBundle\Repository\EstadoRepository")
 */
class Estado
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
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;

    /**
     * Una estado puede estar en  muchas clases
     * @ORM\OneToMany(targetEntity="ClaseDidactica", mappedBy="estado")
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Estado
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
     * Constructor
     */
    public function __construct()
    {
        $this->clasesDidacticas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add clasesDidactica
     *
     * @param \TeachingClassBundle\Entity\ClaseDidactica $clasesDidactica
     *
     * @return Estado
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
}

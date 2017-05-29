<?php

namespace ApplicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="ApplicationBundle\Repository\PostRepository")
 */
class Post
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
     * @ORM\Column(name="titulo", type="string", length=255)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="texto", type="text")
     */
    private $texto;

    /**
     * Un Post puede tener muchos archivos
     * @ORM\OneToMany(targetEntity="Archivo", mappedBy="post")
     */
    private $archivos;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaCarga", type="datetime")
     */
    private $fechaCarga;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=255)
     */
    private $estado;

    /**
     * Muchos Posts pertenecen a un curso
     * @ORM\ManyToOne(targetEntity="BibliotecaAlumno", inversedBy="posts")
     * @ORM\JoinColumn(name="biblioteca_id", referencedColumnName="id")
     */
    private $biblioteca;


    /**
     * Get idtitulo
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
     * @return Post
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
     * Set texto
     *
     * @param string $texto
     *
     * @return Post
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;

        return $this;
    }

    /**
     * Get texto
     *
     * @return string
     */
    public function getTexto()
    {
        return $this->texto;
    }


    /**
     * Set fechaCarga
     *
     * @param \DateTime $fechaCarga
     *
     * @return Post
     */
    public function setFechaCarga($fechaCarga)
    {
        $this->fechaCarga = $fechaCarga;

        return $this;
    }

    /**
     * Get fechaCarga
     *
     * @return \DateTime
     */
    public function getFechaCarga()
    {
        return $this->fechaCarga;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return Post
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set biblioteca
     *
     * @param \ApplicationBundle\Entity\BibliotecaAlumno $biblioteca
     *
     * @return Post
     */
    public function setBiblioteca(\ApplicationBundle\Entity\BibliotecaAlumno $biblioteca = null)
    {
        $this->biblioteca = $biblioteca;

        return $this;
    }

    /**
     * Get biblioteca
     *
     * @return \ApplicationBundle\Entity\BibliotecaAlumno
     */
    public function getBiblioteca()
    {
        return $this->biblioteca;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     *
     * @return Post
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->archivos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add archivo
     *
     * @param \ApplicationBundle\Entity\Archivo $archivo
     *
     * @return Post
     */
    public function addArchivo(\ApplicationBundle\Entity\Archivo $archivo)
    {
        $this->archivos[] = $archivo;

        return $this;
    }

    /**
     * Remove archivo
     *
     * @param \ApplicationBundle\Entity\Archivo $archivo
     */
    public function removeArchivo(\ApplicationBundle\Entity\Archivo $archivo)
    {
        $this->archivos->removeElement($archivo);
    }

    /**
     * Get archivos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArchivos()
    {
        return $this->archivos;
    }

    public function __toString(){
        return $this->titulo;
    }
}

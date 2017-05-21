<?php

namespace ApplicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BibliotecaAlumno
 *
 * @ORM\Table(name="biblioteca_alumno")
 * @ORM\Entity(repositoryClass="ApplicationBundle\Repository\BibliotecaAlumnoRepository")
 */
class BibliotecaAlumno
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
     * Muchas Bibliotecas pueden pertenecer a una Materia
     * @ORM\ManyToOne(targetEntity="Materia", inversedBy="bibliotecasAlumnos")
     * @ORM\JoinColumn(name="materia_id", referencedColumnName="id")
     */

    private $materia;

    /**
     * Muchas bibliotecas son cargadas por un profiesor
     * @ORM\ManyToOne(targetEntity="PersonalDocente", inversedBy="bibliotecasAlumnos")
     * @ORM\JoinColumn(name="personalDocente_id", referencedColumnName="id")
     */
    private $personalDocente;

    /**
     * Muchas bibliotecas pertenecen a un curso
     * @ORM\ManyToOne(targetEntity="Curso", inversedBy="bibliotecasAlumnos")
     * @ORM\JoinColumn(name="curso_id", referencedColumnName="id")
     */
    private $curso;

    /**
     * Una Biblioteca puede tener muchos Posts
     * @ORM\OneToMany(targetEntity="Post", mappedBy="biblioteca")
     */
    private $posts;


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
     * Set idMateria
     *
     * @param integer $idMateria
     *
     * @return BibliotecaAlumno
     */
    public function setIdMateria($idMateria)
    {
        $this->idMateria = $idMateria;

        return $this;
    }

    /**
     * Get idMateria
     *
     * @return int
     */
    public function getIdMateria()
    {
        return $this->idMateria;
    }

    /**
     * Set idProfesor
     *
     * @param integer $idProfesor
     *
     * @return BibliotecaAlumno
     */
    public function setIdProfesor($idProfesor)
    {
        $this->idProfesor = $idProfesor;

        return $this;
    }

    /**
     * Get idProfesor
     *
     * @return int
     */
    public function getIdProfesor()
    {
        return $this->idProfesor;
    }

    /**
     * Set idCurso
     *
     * @param integer $idCurso
     *
     * @return BibliotecaAlumno
     */
    public function setIdCurso($idCurso)
    {
        $this->idCurso = $idCurso;

        return $this;
    }

    /**
     * Get idCurso
     *
     * @return int
     */
    public function getIdCurso()
    {
        return $this->idCurso;
    }

    /**
     * Set archivos
     *
     * @param integer $archivos
     *
     * @return BibliotecaAlumno
     */
    public function setArchivos($archivos)
    {
        $this->archivos = $archivos;

        return $this;
    }

    /**
     * Get archivos
     *
     * @return int
     */
    public function getArchivos()
    {
        return $this->archivos;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->archivos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set materia
     *
     * @param \ApplicationBundle\Entity\Materia $materia
     *
     * @return BibliotecaAlumno
     */
    public function setMateria(\ApplicationBundle\Entity\Materia $materia = null)
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
     * Set personalDocente
     *
     * @param \ApplicationBundle\Entity\PersonalDocente $personalDocente
     *
     * @return BibliotecaAlumno
     */
    public function setPersonalDocente(\ApplicationBundle\Entity\PersonalDocente $personalDocente = null)
    {
        $this->personalDocente = $personalDocente;

        return $this;
    }

    /**
     * Get personalDocente
     *
     * @return \ApplicationBundle\Entity\PersonalDocente
     */
    public function getPersonalDocente()
    {
        return $this->personalDocente;
    }

    /**
     * Set curso
     *
     * @param \ApplicationBundle\Entity\Curso $curso
     *
     * @return BibliotecaAlumno
     */
    public function setCurso(\ApplicationBundle\Entity\Curso $curso = null)
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
     * Add archivo
     *
     * @param \ApplicationBundle\Entity\BibliotecaAlumno $archivo
     *
     * @return BibliotecaAlumno
     */
    public function addArchivo(\ApplicationBundle\Entity\BibliotecaAlumno $archivo)
    {
        $this->archivos[] = $archivo;

        return $this;
    }

    /**
     * Remove archivo
     *
     * @param \ApplicationBundle\Entity\BibliotecaAlumno $archivo
     */
    public function removeArchivo(\ApplicationBundle\Entity\BibliotecaAlumno $archivo)
    {
        $this->archivos->removeElement($archivo);
    }

    /**
     * Add post
     *
     * @param \ApplicationBundle\Entity\Post $post
     *
     * @return BibliotecaAlumno
     */
    public function addPost(\ApplicationBundle\Entity\Post $post)
    {
        $this->posts[] = $post;

        return $this;
    }

    /**
     * Remove post
     *
     * @param \ApplicationBundle\Entity\Post $post
     */
    public function removePost(\ApplicationBundle\Entity\Post $post)
    {
        $this->posts->removeElement($post);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }
}

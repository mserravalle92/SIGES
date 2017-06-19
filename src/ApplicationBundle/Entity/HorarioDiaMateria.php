<?php

namespace ApplicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HorarioDiaMateria
 *
 * @ORM\Table(name="horario_dia_matera")
 * @ORM\Entity(repositoryClass="ApplicationBundle\Repository\HorarioDiaMateraRepository")
 */
class HorarioDiaMateria
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
     * @ORM\ManyToOne(targetEntity="Dia", inversedBy="horarioDiaMateria")
     * @ORM\JoinColumn(name="dia_id", referencedColumnName="id")
     */
    private $dia;

    /**
     * @ORM\ManyToOne(targetEntity="Horario", inversedBy="horarioDiaMateria")
     * @ORM\JoinColumn(name="horario_id", referencedColumnName="id")
     */
    private $horario;

    /**
     * @ORM\ManyToOne(targetEntity="Materia", inversedBy="horarioDiaMateria")
     * @ORM\JoinColumn(name="materia_id", referencedColumnName="id")
     */
    private $materia;

    /**
     * @ORM\ManyToOne(targetEntity="Curso", inversedBy="horarioDiaMateria")
     * @ORM\JoinColumn(name="curso_id", referencedColumnName="id")
     */
    private $curso;



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
     * Set dia
     *
     * @param string $dia
     *
     * @return HorarioDiaMateria
     */
    public function setDia($dia)
    {
        $this->dia = $dia;

        return $this;
    }

    /**
     * Get dia
     *
     * @return string
     */
    public function getDia()
    {
        return $this->dia;
    }

    /**
     * Set horario
     *
     * @param string $horario
     *
     * @return HorarioDiaMateria
     */
    public function setHorario($horario)
    {
        $this->horario = $horario;

        return $this;
    }

    /**
     * Get horario
     *
     * @return string
     */
    public function getHorario()
    {
        return $this->horario;
    }

    /**
     * Set materia
     *
     * @param string $materia
     *
     * @return HorarioDiaMateria
     */
    public function setMateria($materia)
    {
        $this->materia = $materia;

        return $this;
    }

    /**
     * Get materia
     *
     * @return string
     */
    public function getMateria()
    {
        return $this->materia;
    }

    /**
     * Set curso
     *
     * @param \ApplicationBundle\Entity\Curso $curso
     *
     * @return HorarioDiaMateria
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
}

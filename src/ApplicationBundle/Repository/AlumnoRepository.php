<?php

namespace ApplicationBundle\Repository;

/**
 * AlumnoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AlumnoRepository extends \Doctrine\ORM\EntityRepository
{

    public function getAlumnosByCurso($curso)
    {
        $em = $this->getEntityManager();

        $RAW_QUERY = 'SELECT * FROM alumno,alumnoCurso where alumno_id = id and curso_id = '.$curso->getId();

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();

        $result = $statement->fetchAll();

        return $result;

    }

    public function getInstance(){
        return get_class($this);
    }
}

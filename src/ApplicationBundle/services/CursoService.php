<?php

namespace ApplicationBundle\services;

class CursoService{

    public function getCursoActivo($persona){

        $cursosPersona = $persona->getCursos();

        $cursoActivo = null;

        foreach ($cursosPersona as $curso){
            if ($curso->getCicloLectivo()->getActivo()){
                $cursoActivo = $curso;
            }
        }

        return $cursoActivo;

    }

}
<?php

namespace ApplicationBundle\Controller;

use ApplicationBundle\Entity\Examen;
use ApplicationBundle\Entity\Curso;
use ApplicationBundle\Entity\Materia;
use ApplicationBundle\Entity\TipoNota;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Examen controller.
 *
 * @Route("examen")
 */
class ExamenController extends Controller
{
    /**
     * Lists all examen entities.
     *
     * @Route("/", name="examen_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $examens = $em->getRepository('ApplicationBundle:Examen')->findAll();

        return $this->render('examen/index.html.twig', array(
            'examens' => $examens,
        ));
    }

    /**
     * Creates a new examen entity.
     *
     * @Route("/new", name="examen_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $materias = [];
        $tipoNota = [];
        $idCurso = 0;
        $idMateria = 0;
        $em = $this->getDoctrine()->getManager();        

        /* Si es get recien entra, devuelvo solo lista de cursos */
        if ($request->getMethod() == 'POST') {            
            $idCurso = $request->get("idCurso");     
            $idMateria = $request->get("idMateria");
            $idTipoNota = $request->get("idTipoNota");
            dump($idTipoNota);

            /* Si no seleccionó tipo de nota */
            if (empty($idTipoNota)) {
                dump("fase anterior");
                /* Si es el primer caso no trae materia, devuelvo una lista para que elija */
                if (empty($idMateria)) {
                    $materias = $em->getRepository('ApplicationBundle:Materia')->findByCurso($idCurso);
                }
                /* Si ya selecciono materia queda el paso final, le devuelvo una lista de tipo de notas disponibles */
                else {
                    $tipoNota = $em->getRepository('ApplicationBundle:TipoNota')->findAll(); 
                }
            }
            /* Si seleccionó tipo de nota, ya finalizó, guardo examen  */
            else {
                /* Guardo el examen */
                $examen = new Examen();
                $curso = $em->getRepository('ApplicationBundle:Curso')->findById($idCurso)[0];
                $materia = $em->getRepository('ApplicationBundle:Materia')->findById($idMateria)[0];
                $tipoNota = $em->getRepository('ApplicationBundle:TipoNota')->findById($idTipoNota)[0];

                $examen->setContenido($request->get("contenido"));
                $examen->setHorarioDiaMateria($request->get("horarioDiaMateria"));
                $examen->setPromediable($request->get("promediable"));
                $examen->setCurso($curso);
                $examen->setMateria($materia);
                $examen->setTipoNota($tipoNota);
                $em->persist($examen);
                $em->flush();

                return $this->redirectToRoute('examen_show', array('id' => $examen->getId()));
            }
        }

        $cursos = $em->getRepository('ApplicationBundle:Curso')->findAll();
        
        return $this->render('examen/new.html.twig', array(
            'cursos' => $cursos,
            'idCurso' => $idCurso,
            'materias' => $materias,
            'idMateria' => $idMateria,            
            'tipoNotas' => $tipoNota,

        ));
    }

    /**
     * Finds and displays a examen entity.
     *
     * @Route("/{id}", name="examen_show")
     * @Method("GET")
     */ 
    public function showAction(Examen $examen)
    {
        $deleteForm = $this->createDeleteForm($examen);

        return $this->render('examen/show.html.twig', array(
            'examen' => $examen,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing examen entity.
     *
     * @Route("/{id}/edit", name="examen_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Examen $examen)
    {
        $deleteForm = $this->createDeleteForm($examen);
        $editForm = $this->createForm('ApplicationBundle\Form\ExamenType', $examen);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('examen_edit', array('id' => $examen->getId()));
        }

        return $this->render('examen/edit.html.twig', array(
            'examen' => $examen,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a examen entity.
     *
     * @Route("/{id}", name="examen_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Examen $examen)
    {
        $form = $this->createDeleteForm($examen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($examen);
            $em->flush();
        }

        return $this->redirectToRoute('examen_index');
    }

    /**
     * Creates a form to delete a examen entity.
     *
     * @param Examen $examen The examen entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Examen $examen)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('examen_delete', array('id' => $examen->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
     /**
     * 
     *
     * @Route("/examentMateria", name="examen_materia")
     * @Method({"GET", "POST"})
     */
    public function step2(Request $request)
    {
       return new Response('<html> <body> hola mundo'.$request->get('idMateria').'  </body></html>');
    } 
    /**
     * 
     *
     * @Route("/materiaCurso", name="materia_curso")
     * @Method({"GET", "POST"})
     */
    public function step3(Request $request)
    {
       return new Response('<html> <body> hola mundo'.$request->get('idMateria').'  </body></html>');
    } 
} 

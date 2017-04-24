<?php

namespace TeachingClassBundle\Controller;

use TeachingClassBundle\Entity\OpcionPregunta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use TeachingClassBundle\Entity\Pregunta;

/**
 * Opcionpreguntum controller.
 *
 * @Route("opciones")
 */
class OpcionPreguntaController extends Controller
{
    /**
     * Lists all opcionPreguntum entities.
     *
     * @Route("/{id}", name="opciones_index")
     * @Method("GET")
     */
    public function indexAction(Pregunta $pregunta)
    {
        $em = $this->getDoctrine()->getManager();

        $opcionPreguntas = $pregunta->getOpciones();

        return $this->render('TeachingClassBundle:opcionpregunta:index.html.twig', array(
            'opcionPreguntas' => $opcionPreguntas,
            'pregunta' => $pregunta,
        ));
    }

    /**
     * Creates a new opcionPreguntum entity.
     *
     * @Route("/{id}/new", name="opciones_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, Pregunta $pregunta)
    {
        $opcionPreguntum = new OpcionPregunta();
        $form = $this->createForm('TeachingClassBundle\Form\OpcionPreguntaType', $opcionPreguntum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager('claseDidactica');
            $opcionPreguntum->setPregunta($pregunta);
            if ($this->controlarOpcion($opcionPreguntum)) {
              $em->persist($opcionPreguntum);
              $em->flush();
            }
            else{
                $this->addFlash(
                        'errorOpcion',
                        'La pregunta no puede tener mas de una respuesta correcta.'
                );
            }


            return $this->redirectToRoute('opciones_new', array('id' => $pregunta->getId()));
        }

        $opciones = $pregunta->getOpciones();

        return $this->render('TeachingClassBundle:opcionpregunta:new.html.twig', array(
            'opcionPreguntum' => $opcionPreguntum,
            'form' => $form->createView(),
            'pregunta'=>$pregunta,
            'opciones'=>$opciones,
        ));
    }

    /**
     * Finds and displays a opcionPreguntum entity.
     *
     * @Route("/{id}", name="opciones_show")
     * @Method("GET")
     */
    public function showAction(OpcionPregunta $opcionPreguntum)
    {
        $deleteForm = $this->createDeleteForm($opcionPreguntum);

        return $this->render('opcionpregunta/show.html.twig', array(
            'opcionPreguntum' => $opcionPreguntum,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing opcionPreguntum entity.
     *
     * @Route("/{id}/edit", name="opciones_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, OpcionPregunta $opcionPreguntum)
    {
        $deleteForm = $this->createDeleteForm($opcionPreguntum);
        $editForm = $this->createForm('TeachingClassBundle\Form\OpcionPreguntaType', $opcionPreguntum);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('opciones_edit', array('id' => $opcionPreguntum->getId()));
        }

        return $this->render('opcionpregunta/edit.html.twig', array(
            'opcionPreguntum' => $opcionPreguntum,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a opcionPreguntum entity.
     *
     * @Route("/{id}", name="opciones_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, OpcionPregunta $opcionPreguntum)
    {
        $form = $this->createDeleteForm($opcionPreguntum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($opcionPreguntum);
            $em->flush();
        }

        return $this->redirectToRoute('opciones_index');
    }

    /**
     * Creates a form to delete a opcionPreguntum entity.
     *
     * @param OpcionPregunta $opcionPreguntum The opcionPreguntum entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(OpcionPregunta $opcionPreguntum)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('opciones_delete', array('id' => $opcionPreguntum->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


    /**
     * Creates a new opcionPreguntum entity.
     *
     * @Route("/finalizar/carga/{id}", name="opciones_finalizar")
     * @Method({"GET", "POST"})
     */
    public function finalizarAction(Pregunta $pregunta)
    {
      if ($this->controlarOpciones($pregunta)) {
        return $this->redirectToRoute('opciones_index',['id'=>$pregunta->getId()]);
      }
      else{
        $this->addFlash(
                'errorOpcionCorrectas',
                'La pregunta debe tener al menos una opción correcta.'
        );
        return $this->redirectToRoute('opciones_new',['id'=>$pregunta->getId()]);
      }
    }

    public function controlarOpcion($opcion)
    {
      $em = $this->getDoctrine()->getManager('claseDidactica');

      $pregunta = $opcion->getPregunta();

      $esCorrecto= true;

      if ($opcion->getCorrecta()) {
        if ($pregunta->getTipoPregunta()->getId() == 1) {

          $qb = $em->createQueryBuilder();
          $qb->select('count(op.id)');
          $qb->from('TeachingClassBundle:OpcionPregunta','op');
          $qb->where('op.correcta = 1');
          $qb->andWhere('op.pregunta ='.$pregunta->getId());

          $count = $qb->getQuery()->getSingleScalarResult();

          if ($count > 1) {
            $esCorrecto = false;
          }
      }

      }
      return $esCorrecto;
    }

    public function controlarOpciones($pregunta)
    {
      $opciones = $pregunta->getOpciones();
      $cantCorrectas = 0;
      $correcto = true;

      foreach ($opciones as $opcion) {
        if ($opcion->getCorrecta() == 1) {
          $cantCorrectas +=1;
        }
      }

      if ($cantCorrectas == 0) {
        $correcto = false;
      }

      return $correcto;

    }
}

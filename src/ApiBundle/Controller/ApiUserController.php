<?php

namespace ApiBundle\Controller;

use ApiBundle\Entity\ApiUser;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Apiuser controller.
 *
 * @Route("apiuser")
 */
class ApiUserController extends Controller
{
    /**
     * Lists all apiUser entities.
     *
     * @Route("/", name="apiuser_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $apiUsers = $em->getRepository('ApiBundle:ApiUser')->findAll();
        return $this->render('ApiBundle:apiuser:index.html.twig', array(
            'apiUsers' => $apiUsers,
        ));
    }

    /**
     * Creates a new apiUser entity.
     *
     * @Route("/new", name="apiuser_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $apiUser = new Apiuser();
        $form = $this->createForm('ApiBundle\Form\ApiUserType', $apiUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($apiUser);
            $em->flush();

            return $this->redirectToRoute('apiuser_show', array('id' => $apiUser->getId()));
        }

        return $this->render('ApiBundle:apiuser:new.html.twig', array(
            'apiUser' => $apiUser,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a apiUser entity.
     *
     * @Route("/{id}", name="apiuser_show")
     * @Method("GET")
     */
    public function showAction(ApiUser $apiUser)
    {
        $deleteForm = $this->createDeleteForm($apiUser);

        return $this->render('ApiBundle:apiuser:show.html.twig', array(
            'apiUser' => $apiUser,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing apiUser entity.
     *
     * @Route("/{id}/edit", name="apiuser_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ApiUser $apiUser)
    {
        $deleteForm = $this->createDeleteForm($apiUser);
        $editForm = $this->createForm('ApiBundle\Form\ApiUserType', $apiUser);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('apiuser_edit', array('id' => $apiUser->getId()));
        }

        return $this->render('ApiBundle:apiuser:edit.html.twig', array(
            'apiUser' => $apiUser,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a apiUser entity.
     *
     * @Route("/{id}", name="apiuser_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ApiUser $apiUser)
    {
        $form = $this->createDeleteForm($apiUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($apiUser);
            $em->flush();
        }

        return $this->redirectToRoute('apiuser_index');
    }

    /**
     * Creates a form to delete a apiUser entity.
     *
     * @param ApiUser $apiUser The apiUser entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ApiUser $apiUser)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('apiuser_delete', array('id' => $apiUser->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

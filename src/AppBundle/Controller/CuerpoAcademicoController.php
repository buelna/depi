<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\CuerpoAcademico;
use AppBundle\Form\CuerpoAcademicoType;

/**
 * CuerpoAcademico controller.
 *
 */
class CuerpoAcademicoController extends Controller
{

    /**
     * Lists all CuerpoAcademico entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:CuerpoAcademico')->findAll();

        return $this->render('AppBundle:CuerpoAcademico:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new CuerpoAcademico entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new CuerpoAcademico();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cuerpoAcademico_show', array('id' => $entity->getId())));
        }

        return $this->render('AppBundle:CuerpoAcademico:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a CuerpoAcademico entity.
     *
     * @param CuerpoAcademico $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(CuerpoAcademico $entity)
    {
        $form = $this->createForm(new CuerpoAcademicoType(), $entity, array(
            'action' => $this->generateUrl('cuerpoAcademico_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new CuerpoAcademico entity.
     *
     */
    public function newAction()
    {
        $entity = new CuerpoAcademico();
        $form   = $this->createCreateForm($entity);

        return $this->render('AppBundle:CuerpoAcademico:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CuerpoAcademico entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:CuerpoAcademico')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CuerpoAcademico entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:CuerpoAcademico:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CuerpoAcademico entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:CuerpoAcademico')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CuerpoAcademico entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:CuerpoAcademico:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a CuerpoAcademico entity.
    *
    * @param CuerpoAcademico $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(CuerpoAcademico $entity)
    {
        $form = $this->createForm(new CuerpoAcademicoType(), $entity, array(
            'action' => $this->generateUrl('cuerpoAcademico_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing CuerpoAcademico entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:CuerpoAcademico')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CuerpoAcademico entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('cuerpoAcademico_edit', array('id' => $id)));
        }

        return $this->render('AppBundle:CuerpoAcademico:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a CuerpoAcademico entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:CuerpoAcademico')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CuerpoAcademico entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('cuerpoAcademico'));
    }

    /**
     * Creates a form to delete a CuerpoAcademico entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cuerpoAcademico_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

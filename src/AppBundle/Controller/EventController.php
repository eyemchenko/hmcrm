<?php

namespace AppBundle\Controller;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Deal;
use AppBundle\Form\DealType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Event controller.
 *
 * @Route("/event")
 */
class EventController extends Controller
{
    /**
     * Lists all Event entities.
     *
     * @return Response
     *
     * @Route("/", name="event")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        $entities = $em->getRepository('AppBundle:Deal')->findByUser($user);

        return [
            'entities' => $entities,
        ];
    }

    /**
     * Creates a new Event entity.
     *
     * @param Deal $deal Deal
     *
     * @return RedirectResponse|Response
     *
     * @Route("/", name="event_create")
     * @Method("POST")
     * @Template("AppBundle:Deal:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Deal();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setUser($this->getUser());
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('deal_show', [
                'id' => $entity->getId(),
            ]));
        }

        return [
            'entity' => $entity,
            'form' => $form->createView(),
        ];
    }

    /**
     * Creates a form to create a Deal entity.
     *
     * @param Deal $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Deal $entity)
    {
        $form = $this->createForm(new DealType(), $entity, [
            'action' => $this->generateUrl('deal_create'),
            'method' => 'POST',
        ]);

        $form->add('submit', 'submit', [
            'label' => 'Create',
        ]);

        return $form;
    }

    /**
     * Displays a form to create a new Deal entity.
     *
     * @return Response
     *
     * @Route("/new", name="event_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Deal();
        $form = $this->createCreateForm($entity);

        return [
            'entity' => $entity,
            'form' => $form->createView(),
        ];
    }

    /**
     * Finds and displays a Deal entity.
     *
     * @param Deal $deal Deal
     *
     * @throws NotFoundHttpException
     *
     * @return Response
     *
     * @Route("/{id}", name="event_show")
     * @Method("GET")
     * @ParamConverter("deal", class="AppBundle:Deal")
     * @Template()
     */
    public function showAction(Deal $deal)
    {
        $deleteForm = $this->createDeleteForm($deal->getId());

        if ($this->getUser() !== $deal->getUser()) {
            throw $this->createNotFoundException('Unable to find Deal entity.');
        }

        return [
            'entity' => $deal,
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Displays a form to edit an existing Deal entity.
     *
     * @param Deal $deal Deal
     *
     * @throws NotFoundHttpException
     *
     * @return Response
     *
     * @Route("/{id}/edit", name="event_edit")
     * @Method("GET")
     * @ParamConverter("deal", class="AppBundle:Deal")
     * @Template()
     */
    public function editAction(Deal $deal)
    {
        if ($this->getUser() !== $deal->getUser()) {
            throw $this->createNotFoundException('Unable to find Deal entity.');
        }

        $editForm = $this->createEditForm($deal);
        $deleteForm = $this->createDeleteForm($deal->getId());

        return [
            'entity' => $deal,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Creates a form to edit a Deal entity.
     *
     * @param Deal $entity The entity
     *
     * @return Form The form
     */
    private function createEditForm(Deal $entity)
    {
        $form = $this->createForm(new DealType(), $entity, [
            'action' => $this->generateUrl('deal_show', [
                'id' => $entity->getId(),
            ]),
            'method' => 'PUT',
        ]);

        $form->add('submit', 'submit', [
            'label' => 'Update',
        ]);

        return $form;
    }

    /**
     * Edits an existing Deal entity.
     *
     * @param Deal $deal Deal
     *
     * @throws NotFoundHttpException
     *
     * @return RedirectResponse|Response
     *
     * @Route("/{id}", name="event_update")
     * @Method("PUT")
     * @ParamConverter("deal", class="AppBundle:Deal")
     * @Template("AppBundle:Deal:edit.html.twig")
     */
    public function updateAction(Request $request, Deal $deal)
    {
        if ($this->getUser() !== $deal->getUser()) {
            throw $this->createNotFoundException('Unable to find Deal entity.');
        }

        $em = $this->getDoctrine()->getManager();

        $deleteForm = $this->createDeleteForm($deal->getId());
        $editForm = $this->createEditForm($deal);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('deal_show', [
                'id' => $deal->getId(),
            ]));
        }

        return [
            'entity' => $deal,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Deletes a Deal entity.
     *
     * @param Deal $deal Deal
     *
     * @throws NotFoundHttpException
     *
     * @return RedirectResponse
     *
     * @Route("/delete/{id}", name="deal_delete")
     * @ParamConverter("deal", class="AppBundle:Deal")
     */
    public function deleteAction(Request $request, Deal $deal)
    {
        if ($this->getUser() !== $deal->getUser()) {
            throw $this->createNotFoundException('Unable to find Deal entity.');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($deal);
        $em->flush();

        return $this->redirect($this->generateUrl('deal'));
    }

    /**
     * Creates a form to delete a Deal entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('deal_delete', [
                'id' => $id,
            ]))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class, [
                'label' => 'Delete',
            ])
            ->getForm();
    }
}

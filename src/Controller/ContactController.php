<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;


class ContactController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {

        $entityManager = $this->getDoctrine()->getRepository(Contact::class);
        $contacts = $entityManager->findAll();

        if(is_null($contacts))
        {
            throw new NotFoundHttpException();
        }

        return $this->render('home.html.twig',
            [
                'contacts' => $contacts
            ]
        );
    }

    /**
     * @Route("/contact/new", name="contact_new")
     */
    public function newContact(Request $request)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();
            return $this->redirectToRoute('home' );
        }

        return $this->render('contact_add.html.twig',
            [
            'form' =>  $form->createView()
            ]
        );
    }

    /**
     * @Route("/contact/delete/{id}", name="contact_delete")
     * @ParamConverter("contact", class="App\Entity\Contact")
     */
    public function removeContact(Contact $contact)
    {
        if(is_null($contact))
        {
            throw new NotFoundHttpException();
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($contact);
        $em->flush();
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/contact/edit/{id}", name="contact_edit")
     * @ParamConverter("contact", class="App\Entity\Contact")
     */
    public function editContact(Contact $contact, Request $request)
    {

        if(is_null($contact))
        {
            throw new NotFoundHttpException();
        }

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('contact_edit.html.twig',[
            'form' => $form->createView(),
            'conference' => $contact
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($contact);
            $entityManager->flush();

            $this->addFlash('success', 'Your message has been sent !');
            return $this->redirectToRoute('app_home');
        }
        return $this->render('contact/index.html.twig', [
            'contact_address'=>$this->getParameter('app.contact.address'),
            'contact_phone'=>$this->getParameter('app.contact.phone'),
            'contact_email'=>$this->getParameter('app.contact.email'),
            'form'=>$form->createView()
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Activity;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\AboutRepository;
use App\Repository\ActivityRepository;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{   
    private $aboutRepository;
    private $activityRepository;
    private $contactRepository;

    public function __construct(
        AboutRepository $aboutRepository,
        ActivityRepository $activityRepository,
        ContactRepository $contactRepository) 
    {
        $this->aboutRepository = $aboutRepository;
        $this->activityRepository = $activityRepository;
    }

    /**
     * @Route("/", name="home")
     */
    public function Index(): Response
    {
        return $this->render('default/index.html.twig', [
            'about' => $this->aboutRepository->findAll()[0]
        ]);
    }

    /**
     * @Route("/activités", name="activities")
     */    
    public function Activities(): Response
    {
        return $this->render('default/activities.html.twig', [
            'activités' => $this->activityRepository->findAll()
        ]);
    }

    /**
     * @Route("/activité/{slug}", name="show_activity")
     */
    public function ShowActivity(Activity $activity): Response
    {
        return $this->render('default/show_activity.html.twig', [
            'activité' => $activity,
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function Contact(Request $request): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entiyManager = $this->getDoctrine()->getManager();
            $entiyManager->persist($contact);
            $entiyManager->flush();

            return $this->redirectToRoute('home');
        }
        return $this->render('default/contact.html.twig', [
            'contact' => $contact,
            'form' => $form->createView()
        ]);
    }
}

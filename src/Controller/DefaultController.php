<?php

namespace App\Controller;

use App\Entity\Activity;
use App\Entity\Coach;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\AboutRepository;
use App\Repository\ActivityRepository;
use App\Repository\CoachRepository;
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
        CoachRepository $coachRepository,
        ContactRepository $contactRepository) 
    {
        $this->aboutRepository = $aboutRepository;
        $this->activityRepository = $activityRepository;
        $this->coachRepository = $coachRepository;
        $this->contactRepository = $contactRepository;
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
     * @Route("/coaches", name="coaches")
     */    
    public function Coaches(): Response
    {
        return $this->render('default/coaches.html.twig', [
            'coaches' => $this->coachRepository->findAll()
        ]);
    }

    /**
     * @Route("/coach/{id}", name="show_coach")
     */    
    public function ShowCoach(Coach $coach): Response
    {
        return $this->render('default/show_coach.html.twig', [
            'coach' => $coach
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

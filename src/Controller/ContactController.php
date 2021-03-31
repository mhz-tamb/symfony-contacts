<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ContactController
 * @package App\Controller
 */
class ContactController extends AbstractController
{
    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $entityManager;

    /**
     * ContactController constructor.
     * @param \Doctrine\ORM\EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param \App\Repository\ContactRepository $contactRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    #[Route('/', name: 'contact_list')]
    public function list(ContactRepository $contactRepository): Response
    {
        return $this->render('contact/list.html.twig', [
            'contacts' => $contactRepository->findWithFavoriteFlag($this->getUser())
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    #[Route('/my', name: 'contact_list_my')]
    public function listMy(): Response
    {
        return $this->render('contact/list_my.html.twig', [
            'contacts' => $this->getUser()->getContacts()
        ]);
    }

    /**
     * @param \App\Entity\Contact $contact
     * @return \Symfony\Component\HttpFoundation\Response
     */
    #[Route('/add-to-user/{id}', name: 'contact_add_to_user')]
    public function add(Request $request, Contact $contact): Response
    {
        $contact->addUser($this->getUser());

        $this->entityManager->persist($contact);
        $this->entityManager->flush();

        $this->addFlash('success', 'Contact added successfully');
        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * @param \App\Entity\Contact $contact
     * @return \Symfony\Component\HttpFoundation\Response
     */
    #[Route('/remove-to-user/{id}', name: 'contact_remove_to_user')]
    public function remove(Request $request, Contact $contact): Response
    {
        $contact->removeUser($this->getUser());

        $this->entityManager->persist($contact);
        $this->entityManager->flush();

        $this->addFlash('success', 'Contact remove successfully');
        return $this->redirect($request->headers->get('referer'));
    }
}
<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    private UserRepository $repo;
    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @Route("/", name="user_show")
     */
    public function showAllAction(): Response
    {
        $user = $this->repo->findAll();
        return $this->render('user/index.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * @Route("/delete/{id}",name="user_delete",requirements={"id"="\d+"})
     */

    public function deleteAction(User $user): Response
    {
        $this->repo->remove($user, true);
        return $this->redirectToRoute('user_show', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/edit/{id}", name="user_edit",requirements={"id"="\d+"})
     */
    public function editAction(Request $req, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->repo->add($user, true);
            return $this->redirectToRoute('user_show', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("user/form.html.twig", [
            'form' => $form->createView(), 'u' => $user
        ]);
    }
}

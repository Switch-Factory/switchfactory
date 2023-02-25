<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditUserType;
use App\Repository\SupplierRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/userprofile", name="RouteName")
 */
class UserProfileController extends AbstractController
{
    private UserRepository $repo;
    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @Route("/", name="userprofile_show")
     */
    public function showUserprofileAction(SupplierRepository $supRepo): Response
    {
        $user = $this->repo->findAll();
        return $this->render('user_profile/index.html.twig', [
            'user' => $user,
            'supplier' => $supRepo
        ]);
    }

    /**
     * @Route("/edit/{user}", name="userprofile_edit",requirements={"id"="\d+"})
     */
    public function editProfileAction(Request $req, User $user, SupplierRepository $supRepo): Response
    {
        $form = $this->createForm(EditUserType::class, $user);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->repo->add($user, true);
            return $this->redirectToRoute('user_edit', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render("user_profile/index.html.twig", [
            'form' => $form->createView(), 
            'user' => $user, 
            'supplier' => $supRepo
        ]);
    }

    /**
     * @Route("/userp", name="userchange")
     */
    public function userProfilechange(SupplierRepository $sup): Response
    {
        return $this->render('user_profile/index.html.twig', [
            'supplier' => $sup
        ]);
    }
}
 
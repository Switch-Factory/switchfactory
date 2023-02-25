<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditUserType;
use App\Repository\CategoryRepository;
use App\Repository\SupplierRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class UserProfileController extends AbstractController
{
    private UserRepository $repo;
    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }
    /**
     * @Route("/profile", name="app_profile")
     */
    public function userProfilechange( SupplierRepository $suprepo, UserRepository $upUser, Request $req): Response
    {   
        $sup = $suprepo->findAll();
        $u = $this->getUser();
        $form = $this->createForm(EditUserType::class, $u);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()){
            // return $u;
            $upUser->add($u, true);
            return $this->redirectToRoute('app_profile', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user_profile/newprofile.html.twig', [
            'supplier' => $sup,
            'form'=> $form->createView(),
        ]);
    }
 
}
 
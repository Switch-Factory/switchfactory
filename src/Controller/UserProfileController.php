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

        // /**
        //  * @Route("/", name="userprofile_show")
        //  */
        // public function showUserprofileAction(SupplierRepository $supRepo): Response
        // {
        //     $user = $this->repo->findAll();
        //     return $this->render('user_profile/index.html.twig', [
        //         'user' => $user,
        //         'supplier' => $supRepo
        //     ]);
        // }

        // /**
        //  * @Route("/edit/{user}", name="userprofile_edit",requirements={"id"="\d+"})
        //  */
        // public function editProfileAction(Request $req, User $user, SupplierRepository $supRepo): Response
        // {   

        //     

        //     $form->handleRequest($req);
        //     if ($form->isSubmitted() && $form->isValid()) {
        //         $this->repo->add($user, true);
        //         return $this->redirectToRoute('user_edit', [], Response::HTTP_SEE_OTHER);
        //     }

        //     return $this->render("user_profile/index.html.twig", [
        //         'form' => $form->createView(), 
        //         'user' => $user, 
        //         'supplier' => $supRepo
        //     ]);
        // }

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
 
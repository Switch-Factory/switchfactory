<?php

namespace App\Controller;

use App\Repository\SupplierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserProfileController extends AbstractController
{
    /**
     * @Route("/user/profile", name="user_profile_show")
     */
    public function userProfileShowAction(SupplierRepository $sup): Response
    {
        return $this->render('user_profile/index.html.twig', [
            'controller_name' => 'UserProfileController',
            'supplier' => $sup
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

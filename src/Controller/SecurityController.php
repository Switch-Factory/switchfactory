<?php

namespace App\Controller;

use App\Repository\SupplierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function loginAction(AuthenticationUtils $authenticationUtils, SupplierRepository $sup): Response
    {
        //get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login2.html.twig', [
            'last_username'=>$lastUsername,
            'error'=>$error,
            'supplier' => $sup            
        ]);
    }
    /**
     * @Route("/logout", name="app_logout")
     */
    public function logoutAction(): void
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}

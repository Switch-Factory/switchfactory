<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\SupplierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    /**
     * @Route("register", name="app_register")
     */
    public function registerAction(Request $req, UserPasswordHasherInterface $userPass, 
    EntityManagerInterface $entityManager, SupplierRepository $suprepo): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $sup = $suprepo->findAll();
        $form->handleRequest($req);

        if($form->isSubmitted()&&$form->isValid()){
            $user->setPassword(
                $userPass->hashPassword(
                    $user,
                    $form->get('password')->getData()
                ) 
            );
            $user->setRoles(['ROLE_USER']);

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'form' => $form->createView(),
            'supplier' => $sup
        ]);
    }
}

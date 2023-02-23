<?php

namespace App\Controller;

use App\Repository\SupplierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     */
    public function cartAction(SupplierRepository $suprepo): Response
    {   
        $sup = $suprepo->findAll();
        return $this->render('cart/index.html.twig', [
            'supplier' => $sup,
            'controller_name' => 'MainController'
            
        ]);
    }
}

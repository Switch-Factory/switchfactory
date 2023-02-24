<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Category;
use App\Entity\Product;
use App\Repository\CartRepository;
use App\Repository\CategoryRepository;
use App\Repository\SupplierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/cart")
 */
class CartController extends AbstractController
{
    /**
     * @Route("/add/{id}", name="cart_add")
     */
    public function addCartAction(CartRepository $repo, Product $product, CategoryRepository $cateRepo, Request $req): Response
    {
        $quantity = $req->query->get('quantity');
        $user = $this->getUser();
        $data[] = [
            'id' => $user->getId()
        ];
        $id = $data[0]['id'];
        //check pro id exist with $userId
        $carts = $repo->findBy([
            'product' => $product->getId(),
            'user' => $id
        ]);
        //if null
        if (count($carts) == 0) {
            $cart = new Cart();
            $cart->setProduct($product);
            $cart->setQuantity($quantity);
            $cart->setUser($user);
        } else {
            $cart = $repo->find($carts[0]->getId());
            $oldquantity = $cart->getQuantity();
            $newquantity = $oldquantity + $quantity;
            $cart->setquantity($newquantity);
        }
        $repo->add($cart, true);
        return $this->redirectToRoute('cart_show', [], Response::HTTP_SEE_OTHER);
    }

     /**
     * @Route("/delete/{product}",name="cart_delete",requirements={"product"="\d+"})
     */
     public function cartDeleteAction(CartRepository $repo, Cart $c): Response
     {
         $repo->remove($c,true);
         return $this->redirectToRoute('cart_show', [], Response::HTTP_SEE_OTHER);
     }

    // /**
    //  * @Route("/", name="cart_show")
    //  */
    // public function showCartAction(): Response
    // {
    //     return $this->render('cart/index.html.twig', []);
    // }

    /**
     * @Route("/", name="cart_show")
     */
    public function showCartAction(CartRepository $repo, CategoryRepository $cateRepo, SupplierRepository $supplier): Response
    {
        $user = $this->getUser();
        $data[]=[
            'id' => $user->getId()
        ];
        $userId = $data[0]['id'];
        $product = $repo->showCartAction($userId);
        $total = 0;
        foreach ($product as $p){
            $total += $p['total'];
        }
        $category = $cateRepo->findAll();
        return $this->render('cart/index.html.twig', [
            'product' => $product,
            'total' => $total,
            'supplier' => $supplier
        ]);
    }
}

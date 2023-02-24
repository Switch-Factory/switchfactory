<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\CartRepository;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\SupplierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    private ProductRepository $repo;
    public function __construct(ProductRepository $repo)
    {
        $this->repo = $repo;
    }
    /**
     * @Route("/index", name="search", methods={"POST"})
     */
    public function searchAction(CategoryRepository $catrepo, SupplierRepository $suprepo, Request $request): Response
    {
        $query = $request->request->get('search');
        $cat = $catrepo->findAll();
        $sup = $suprepo->findAll();
        $products = $this->repo->findProdByName($query);
        return $this->render('main/home.html.twig', [
            'products' => $products, 'category' => $cat , 'supplier' => $sup
        ]);
    }

    /**
     * @Route("/index", name="index")
     */
    public function showProductsByCategory(CategoryRepository $catrepo,SupplierRepository $suprepo, ProductRepository $productRepository, Request $request)
    {
        if ($request->query->has('name')) {
            $name = $request->query->get('name');
            $cat = $catrepo->findAll();
            $catID = $catrepo->findBy(array('name' => $name));
            $products = $productRepository->findByCategory($catID);
            $sup = $suprepo->findAll();
            return $this->render('main/home.html.twig', [
                'category' => $cat,
                'products' => $products,
                'supplier' => $sup
            ]);
        } 
        elseif ($request->query->has('suppname')){
            $name = $request->query->get('suppname');
            $sup = $suprepo->findAll();
            $cat = $catrepo->findAll();
            // $supID = $suprepo->findBy(array('name' => $name));
            $products = $productRepository->findBySupplier($name);
            return $this->render('main/home.html.twig', [
                'products' => $products,
                'supplier' => $sup,
                'category' => $cat
            ]);
            return $this->json($products);
        }
        else {
            $products = $this->repo->findAll();
            $cat = $catrepo->findAll();
            $sup = $suprepo->findAll();
            return $this->render('main/home.html.twig', [
                'products' => $products, 'category' => $cat , 'supplier' => $sup
            ]);
        }
    }


    /**
     * @Route("/admin", name="adminPage")
     */

    public function adminPageAction(): Response
    {
        return $this->render('main/admin.html.twig', []);
    }

    /**
     * @Route("/homepage", name="homepage")
     */
    public function homepageAction(): Response
    {
        return $this->render('main/home.html.twig', [
            'controller_name' => 'MainController'
        ]);
    }

    // /**
    //  * @Route("/cart", name="cart")
    //  */
    // public function cartAction(SupplierRepository $suprepo): Response
    // {   
    //     $sup = $suprepo->findAll();
    //     return $this->render('cart.html.twig', [
    //         'supplier' => $sup,
    //         'controller_name' => 'MainController'
            
    //     ]);
    // }

    /**
     * @Route("/aboutus", name="aboutus")
     */
    public function FunctionName(SupplierRepository $suprepo): Response
    {    $sup = $suprepo->findAll();    
        return $this->render('main/aboutus.html.twig', ['supplier' => $sup]);
    }

    /**
     * @Route("detail/{id}", name="product_read",requirements={"id"="\d+"})
     */
    public function showAction(Product $p ,SupplierRepository $suprepo): Response
    {    $sup = $suprepo->findAll();
        return $this->render('main/detail.html.twig', [
            'supplier' => $sup,
            'p' => $p
        ]);
    }

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
}

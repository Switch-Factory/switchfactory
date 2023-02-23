<?php

namespace App\Controller;

use App\Entity\Product;
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
    public function searchAction(CategoryRepository $catrepo,Request $request): Response
    {
        $query = $request->request->get('search');
        $cat = $catrepo->findAll();
        $products = $this->repo->findProdByName($query);
        return $this->render('main/home.html.twig', [
            'products' => $products, 'category' => $cat 
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
        return $this->render('admin.html.twig', []);
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

    /**
     * @Route("cart", name="cart")
     */
    public function cartAction(): Response
    {
        return $this->render('cart.html.twig', [
            'controller_name' => 'MainController'
        ]);
    }

    /**
     * @Route("/aboutus", name="aboutus")
     */
    public function FunctionName(): Response
    {
        return $this->render('aboutus.html.twig', []);
    }

    /**
     * @Route("detail/{id}", name="product_read",requirements={"id"="\d+"})
     */
    public function showAction(Product $p): Response
    {
        return $this->render('detail.html.twig', [
            'p' => $p
        ]);
    }

}

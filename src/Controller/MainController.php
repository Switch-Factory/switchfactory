<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @Route("/index", name="index")
     */
    public function indexPageAction(CategoryRepository $catrepo): Response
    {
        $products = $this->repo->findAll();
        $cat = $catrepo->findAll();
        return $this->render('home.html.twig', [
            'products' => $products, 'category' => $cat
        ]);
    }

    /**
     * @Route("/admin", name="adminPage")
     */

    public function adminPageAction(): Response
    {
        return $this->render('admin.html.twig', []);
    }

    //  /**
    //  * @Route("/{name}", name="findProdByName")
    //  */
    // public function FunctionName(ProductRepository $repo, string $name): Response
    // {
    //     $prod = $repo->findProdByName($name);
    //     return $this->json($prod);
    // }

    // /**
    //  * @Route("login", name="login")
    //  */
    // public function loginAction(): Response
    // {
    //     return $this->render('login.html.twig', [
    //         'controller_name' => 'MainController'
    //     ]);
    // }

    // /**
    //  * @Route("register", name="registerAccount")
    //  */
    // public function registerAction(): Response
    // {
    //     return $this->render('register.html.twig', [
    //         'controller_name' => 'MainController'
    //     ]);
    // }

    /**
     * @Route("cart", name="cart")
     */
    public function cartAction(): Response
    {
        return $this->render('cart.html.twig', [
            'controller_name' => 'MainController'
        ]);
    }

    // /**
    //  * @Route("/cat", name="show_cat")
    //  */
    // public function showProductCat(CategoryRepository $repo2): Response
    // {
    //     $cat = $repo2->findAll();
    //     return $this->render('product/index.html.twig', [
    //         'category' => $cat
    //     ]);
    // }   

        /**
     * @Route("/homepage", name="homepage")
     */
    public function homepageAction(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController'
        ]);
    }
}
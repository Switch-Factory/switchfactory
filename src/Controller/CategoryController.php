<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/category")
 */
class CategoryController extends AbstractController
{
    private CategoryRepository $repo;
    public function __construct(CategoryRepository $repo)
    {
        $this->repo = $repo;
    }
    
    /**
     * @Route("/", name="category_show")
     */
    public function readAllAction(): Response
    {
        $cat = $this->repo->findAll();
        return $this->render('category/index.html.twig', [
            'category' => $cat
        ]);
    }

        /**
     * @Route("/add", name="category_create")
     */
    public function createAction(Request $req): Response
    {
        $c = new Category();
        $form = $this->createForm(CategoryType::class, $c);
        $form->handleRequest($req);
        return $this->render("category/form.html.twig", [
            'form' => $form->createView()
        ]);
    }
}

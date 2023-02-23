<?php

namespace App\Controller;

use App\Entity\Supplier;
use App\Entity\SupplierType;
use App\Repository\SupplierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/supplier")
 */
class SupplierController extends AbstractController
{
    private SupplierRepository $repo;
    public function __construct(SupplierRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @Route("/", name="supplier_show")
     */
    public function showAllAction(): Response
    {
        $sup = $this->repo->findAll();
        return $this->render('supplier/index.html.twig', [
            'sup' => $sup
        ]);
    }

    /**
     * @Route("/add", name="supplier_create")
     */
    public function createAction(Request $req): Response
    {
        $s = new Supplier();
        $form = $this->createForm(SupplierType::class, $s);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->repo->add($s, true);
            return $this->redirectToRoute('supplier_show', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("supplier/form.html.twig", [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}",name="supplier_delete",requirements={"id"="\d+"})
     */

    public function deleteAction(Supplier $s): Response
    {
        $this->repo->remove($s, true);
        return $this->redirectToRoute('supplier_show', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/edit/{id}", name="supplier_edit",requirements={"id"="\d+"})
     */
    public function editAction(Request $req, Supplier $s): Response
    {
        $form = $this->createForm(SupplierType::class, $s);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->repo->add($s, true);
            return $this->redirectToRoute('supplier_show', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("supplier/form.html.twig", [
            'form' => $form->createView()
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Order;
use App\Entity\OrderDetail;
use App\Entity\Product;
use App\Entity\User;
use App\Repository\CartRepository;
use App\Repository\CategoryRepository;
use App\Repository\OrderdetailRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Doctrine\DBAL\Schema\Exception\ForeignKeyDoesNotExist;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
* @Route("/order")
*/
class OrderController extends AbstractController
{
    /**
    * @Route("/", name="checkout")
    */
    public function checkout(CategoryRepository $cateRepo, 
    OrderRepository $orderRepo, 
    CartRepository $cartRepo, 
    OrderdetailRepository $orderdetail, 
    ProductRepository $productRepo, 
    UserRepository $userRepo): Response
    {
        //insert  to order
        $category = $cateRepo->findAll();
        $order1 = new Order();
        $userRepo = $this->getUser();
        $data[] = [
            'id' => $userRepo->getId()
        ];
        $id = $data[0]['id'];
        $order1->setUser($userRepo);
        $product = $cartRepo->showCartAction($id);
        $totalAll = 0;
        foreach ($product as $p) {
            $totalAll += $p['total'];
        }
        $order1->setTotal($totalAll);
        $order1->setDate(new \Datetime());
        $orderRepo->add($order1, true);

        // insert to orderdetail
        $oid = $orderRepo->orderDetail($id)[0]['oid'];
        $orderobject = $orderRepo->find($oid);
        $date = $orderRepo->date($oid);

        $carts_uid = $cartRepo->showCartAction($id);

        foreach ($carts_uid as $c) {
            $orderdetail1 = new OrderDetail();
            $product = $c['id'];
            $productobject = $productRepo->find($product);
            $quantity = $c['quantity'];
            $orderdetail1->setOrd($orderobject);
            $orderdetail1->setProduct($productobject);
            $orderdetail1->setQuantity($quantity);
            $orderdetail->add($orderdetail1, true);
        }
        $delete = $cartRepo->findUserId($id);
        foreach ($delete as $d) {
            $idcat = $d['id'];
            $deleteproductcart = $cartRepo->find($idcat);
            $cartRepo->remove($deleteproductcart, true);
        }


        //create view
        $userinfo = $orderRepo->getUserInfo($id);
        $productdetail = $orderdetail->productDetail($oid);

        return $this->redirectToRoute('index', [
            'category' => $category, 
            'oid' => $oid, 
            'total' => $totalAll, 
            'userinfo' => $userinfo,
            'productdetail' => $productdetail, 
            'date' => $date
        ], Response::HTTP_SEE_OTHER);
    }
    // /**
    //  * @Route("/bill", name="app_bill")`
    //  */
    // public function lastbill(
    //     CategoryRepository $brand,
    //     OrderRepository $order,
    //     CartRepository $repo,
    //     OrderdetailRepository $orderdetail,
    //     ProductRepository $pro,
    //     UserRepository $user
    // ): Response {

    //     $BR = $brand->findAll();
    //     $user = $this->getUser();
    //     $data[] = [
    //         'id' => $user->getId()
    //     ];
    //     $id = $data[0]['id'];
    //     $oid = $order->orderdetail($id)[0]['oid'];
    //     $userinfo = $order->userinfo($id);
    //     $productdetail = $orderdetail->productdetail($oid);
    //     $product = $repo->cart($id);
    //     $totalAll = 0;
    //     foreach ($product as $p) {
    //         $totalAll += $p['total'];
    //     }
    //     $date = $order->date($oid);
    //     return $this->render('bill/bill.html.twig', [
    //         'brand' => $BR, 'oid' => $oid, 'total' => $totalAll, 'userinfo' => $userinfo, 'productdetail' => $productdetail, 'date' => $date
    //     ]);
    // }
}

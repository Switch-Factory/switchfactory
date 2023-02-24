<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Order;
use App\Entity\OrderDetail;
use App\Entity\Product;
use App\Entity\User;
use App\Repository\CartRepository;
use App\Repository\CategoryRepository;
use App\Repository\OrderDetailRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Doctrine\DBAL\Schema\Exception\ForeignKeyDoesNotExist;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/order")
     */
    public function checkout(CategoryRepository $brand, OrderRepository $order, CartRepository $repo, OrderDetailRepository $orderdetail, ProductRepository $pro, UserRepository $user): Response
    {
        //insert  to order
        $category = $category->findAll();
        $order1 = new Order();
        $user = $this->getUser();
        $data[] = [
            'id' => $user->getId()
        ];
        $id = $data[0]['id'];
        $order1->setUserorder($user);
        $product = $repo->cart($id);
        $totalAll = 0;
        foreach ($product as $p) {
            $totalAll += $p['total'];
        }
        $order1->setTotal($totalAll);
        $order1->setDatecreate(new \Datetime());
        $order->add($order1, true);

        // insert to orderdetail
        $oid = $order->orderdetail($id)[0]['oid'];
        $orderobject = $order->find($oid);
        $date = $order->date($oid);


        $carts_uid = $repo->findcart($id);

        foreach ($carts_uid as $c) {
            $orderdetail1 = new OrderDetail();
            $product = $c['id'];
            $productobject = $pro->find($product);
            $quantity = $c['quantity'];
            $orderdetail1->setOrderid($orderobject);
            $orderdetail1->setProduct($productobject);
            $orderdetail1->setQuantity($quantity);
            $orderdetail->add($orderdetail1, true);
        }
        $delete = $repo->finduserid($id);
        foreach ($delete as $d) {
            $idcat = $d['id'];
            $deleteproductcart = $repo->find($idcat);
            $repo->remove($deleteproductcart, true);
        }


        //create view
        $userinfo = $order->userinfo($id);
        $productdetail = $order->productdetail($oid);


        return $this->redirectToRoute('app_bill', [
            'brand' => $BR, 'oid' => $oid, 'total' => $totalAll, 'userinfo' => $userinfo,               'productdetail' => $productdetail, 'date' => $date
        ], Response::HTTP_SEE_OTHER);
    }


    /**
     * @Route("/bill", name="app_bill")`
     */
    public function lastbill(
        CategoryRepository $brand,
        OrderRepository $order,
        CartRepository $repo,
        OrderDetailRepository $orderdetail,
        ProductRepository $pro,
        UserRepository $user
    ): Response {

        $BR = $brand->findAll();
        $user = $this->getUser();
        $data[] = [
            'id' => $user->getId()
        ];
        $id = $data[0]['id'];
        $oid = $order->orderdetail($id)[0]['oid'];
        $userinfo = $order->userinfo($id);
        $productdetail = $orderdetail->productdetail($oid);
        $product = $repo->cart($id);
        $totalAll = 0;
        foreach ($product as $p) {
            $totalAll += $p['total'];
        }
        $date = $order->date($oid);
        return $this->render('bill/bill.html.twig', [
            'brand' => $BR, 'oid' => $oid, 'total' => $totalAll, 'userinfo' => $userinfo, 'productdetail' => $productdetail, 'date' => $date
        ]);
    }
}

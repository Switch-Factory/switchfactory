<?php

namespace App\Repository;

use App\Entity\Cart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cart>
 *
 * @method Cart|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cart|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cart[]    findAll()
 * @method Cart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cart::class);
    }

    public function add(Cart $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Cart $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

       public function updateProInCart($id, $proid, $quantity)
       {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "       
            UPDATE cart
            SET quantity = :quantity
            WHERE user_id = :id AND product_id = :proid
        ";
        $re = $conn->executeQuery($sql,['id'=>$id,'proid'=>$proid,'quantity'=>$quantity]);
        return $re->fetchAllAssociative();
       }

    //    /**
    //     * @return Cart[] Returns an array of Cart objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Cart
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    /**
     * @return Cart[] Returns an array of Cart objects
     */
    public function showCartAction($value): array
    {
        return $this->createQueryBuilder('c')
            ->select('p.id as id, p.image, p.name, p.price, c.quantity as quantity, p.price*c.quantity as total')
            ->innerJoin('c.product', 'p')
            ->Where('c.user = :id')
            ->setParameter('id', $value)
            ->getQuery()
            ->getResult();
    }

    /**
    * @return Cart[] Returns an array of Cart objects
    */
   public function findUserId($value): array
   {
       return $this->createQueryBuilder('c')
       ->select('c.id')
           ->andWhere('c.user = :val')
           ->setParameter('val', $value)
           ->getQuery()
           ->getArrayResult()
       ;
   }
}

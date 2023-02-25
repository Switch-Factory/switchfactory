<?php

namespace App\Repository;

use App\Entity\Orderdetail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Orderdetail>
 *
 * @method Orderdetail|null find($id, $lockMode = null, $lockVersion = null)
 * @method Orderdetail|null findOneBy(array $criteria, array $orderBy = null)
 * @method Orderdetail[]    findAll()
 * @method Orderdetail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderdetailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Orderdetail::class);
    }

    public function add(Orderdetail $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Orderdetail $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return Orderdetail[] Returns an array of Orderdetail objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('o.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Orderdetail
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    /**
     * @return OrderDetail[] Returns an array of OrderDetail objects
     */
    public function productDetail($value): array
    {
        return $this->createQueryBuilder('o')
            ->select('p.name, p.price, o.quantity, p.price*o.quantity as total')
            ->innerJoin('o.product', 'p')
            ->andWhere('o.product= :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return OrderDetail[] Returns an array of OrderDetail objects
     */
    public function showAction($value): array
    {
        return $this->createQueryBuilder('od')
            ->select('od.id, p.name, p.price, 
            od.quantity, o.total, o.date')
            ->innerJoin('od.product', 'p')
            ->innerJoin('od.ord', 'o')
            ->andWhere('o.user= :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult();
    }
}

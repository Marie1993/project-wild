<?php

namespace App\Repository;

use App\Entity\Argonauts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Argonauts|null find($id, $lockMode = null, $lockVersion = null)
 * @method Argonauts|null findOneBy(array $criteria, array $orderBy = null)
 * @method Argonauts[]    findAll()
 * @method Argonauts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArgonautsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Argonauts::class);
    }

    // /**
    //  * @return Argonauts[] Returns an array of Argonauts objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Argonauts
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
